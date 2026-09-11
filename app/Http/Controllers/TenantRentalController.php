<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoomTenant;
use App\Models\Bill;
use App\Services\PaymentService;
use App\Services\RoomTenantService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class TenantRentalController extends Controller
{
    public function __construct(
        private RoomTenantService $roomTenantService,
        private PaymentService $paymentService
    ) {
    }

    public function store(Request $request, Room $room)
    {
        $validated = $request->validate([
            'duration_option' => ['required', 'in:1,3,6,12,custom'],
            'custom_duration' => ['nullable', 'integer', 'min:1', 'max:24'],
        ]);

        $durationMonths = $validated['duration_option'] === 'custom'
            ? (int) ($validated['custom_duration'] ?? 0)
            : (int) $validated['duration_option'];

        if ($durationMonths < 1) {
            throw ValidationException::withMessages([
                'custom_duration' => 'Durasi custom harus diisi minimal 1 bulan.',
            ]);
        }

        $bill = DB::transaction(function () use ($room, $durationMonths) {
            $lockedRoom = Room::whereKey($room->id)->lockForUpdate()->firstOrFail();

            if ($lockedRoom->status !== 'available') {
                throw ValidationException::withMessages([
                    'room' => 'Maaf, kamar ini baru saja tidak tersedia.',
                ]);
            }

            $tenant = Auth::user()->tenant;

            if (!$tenant) {
                throw ValidationException::withMessages([
                    'room' => 'Profil tenant belum tersedia untuk akun ini.',
                ]);
            }

            $hasActiveRental = RoomTenant::where('tenant_id', $tenant->id)
                ->where('status', 'active')
                ->exists();

            if ($hasActiveRental) {
                throw ValidationException::withMessages([
                    'room' => 'Anda masih memiliki penyewaan kamar yang aktif.',
                ]);
            }

            $roomTenant = $this->roomTenantService->store([
                'room_id' => $lockedRoom->id,
                'tenant_id' => $tenant->id,
                'start_date' => Carbon::today(),
                'duration_month' => $durationMonths,
                'status' => 'active',
            ]);

            return $roomTenant->bills()->oldest('bill_month')->firstOrFail();
        });

        return redirect()
            ->route('tenant.bills.show', $bill->id)
            ->with('success', 'Pengajuan sewa berhasil dibuat. Tagihan pertama berstatus belum dibayar.');
    }

    public function pay(Request $request, int $id)
    {
        $validated = $request->validate([
            'method' => ['required', 'in:cash,transfer,ewallet'],
        ]);

        $bill = DB::transaction(function () use ($id, $validated) {
            $tenant = Auth::user()->tenant;

            $bill = Bill::with(['roomTenant.room', 'roomTenant.tenant.user'])
                ->whereKey($id)
                ->whereHas('roomTenant.tenant', function ($query) use ($tenant) {
                    $query->whereKey($tenant?->id);
                })
                ->lockForUpdate()
                ->firstOrFail();

            if ($bill->status === 'paid') {
                throw ValidationException::withMessages([
                    'method' => 'Tagihan ini sudah dibayar.',
                ]);
            }

            $this->paymentService->store([
                'bill_id' => $bill->id,
                'paid_at' => now(),
                'amount' => $bill->amount + ($bill->fine_amount ?? 0),
                'method' => $validated['method'],
            ]);

            return $bill;
        });

        return redirect()
            ->route('tenant.bills.show', $bill->id)
            ->with('success', 'Pembayaran berhasil dicatat.');
    }
}