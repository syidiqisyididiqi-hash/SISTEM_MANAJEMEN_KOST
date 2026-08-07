<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Room;
use App\Models\RoomTenant;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class RoomTenantService
{
    public function __construct(
        private ActivityLogService $activityLogService,
        private BillService $billService
    ) {
    }

    public function getAll($search = null)
    {
        return RoomTenant::with(['room', 'tenant.user'])
            ->when($search, function ($query) use ($search) {
                $query->whereHas('tenant.user', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10);
    }

    public function store(array $data): RoomTenant
    {
        $durationMonths = (int) ($data['duration_month'] ?? 0);
        $startDate = Carbon::parse($data['start_date']);

        $data['duration_month'] = $durationMonths;
        $data['end_date'] = $startDate
            ->copy()
            ->addMonthsNoOverflow($durationMonths);

        $roomTenant = RoomTenant::create($data);
        $roomTenant->load(['room', 'tenant.user']);

        if ($data['status'] === 'active') {

            Room::where('id', $data['room_id'])
                ->update(['status' => 'occupied']);

            for ($i = 0; $i < $data['duration_month']; $i++) {

                $billMonth = $startDate
                    ->copy()
                    ->addMonthsNoOverflow($i);

                $this->billService->store([
                    'room_tenant_id' => $roomTenant->id,
                    'bill_month' => $billMonth,
                    'amount' => $roomTenant->room->price_per_month,
                    'due_date' => $billMonth->copy()->addDays(7),
                    'fine_amount' => 0,
                    'status' => 'unpaid',
                ], true);
            }
        }

        $this->activityLogService->store(
            "Menambahkan data penyewaan kamar {$roomTenant->id}. " .
            "Nomor Kamar: {$roomTenant->room->room_number}, " .
            "Nama Penyewa: {$roomTenant->tenant->user->name}, " .
            "Tanggal Mulai: {$roomTenant->start_date?->format('Y-m-d')}, " .
            "Durasi Kontrak: {$roomTenant->duration_month} bulan, " .
            "Tanggal Selesai: {$roomTenant->end_date?->format('Y-m-d')}, " .
            "Status: {$roomTenant->status}."
        );

        return $roomTenant;
    }

    public function findById(int $id): RoomTenant
    {
        $data = RoomTenant::with([
            'room',
            'tenant.user'
        ])->find($id);

        if (!$data) {
            throw new ModelNotFoundException("RoomTenant not found");
        }

        return $data;
    }

    public function update(RoomTenant $roomTenant, array $data): RoomTenant
    {
        if (isset($data['duration_month'])) {
            $durationMonths = (int) $data['duration_month'];
            $data['duration_month'] = $durationMonths;

            $startDate = Carbon::parse($data['start_date'] ?? $roomTenant->start_date);

            $data['end_date'] = $startDate
                ->copy()
                ->addMonthsNoOverflow($durationMonths);

        }
        $roomTenant->load(['room', 'tenant.user']);

        $oldData = $roomTenant->toArray();

        $roomTenant->update($data);
        $roomTenant->refresh()->load(['room', 'tenant.user']);

        if (isset($data['status'])) {

            if ($data['status'] === 'active') {
                Room::where('id', $roomTenant->room_id)
                    ->update(['status' => 'occupied']);
            }

            if ($data['status'] === 'inactive') {
                Room::where('id', $roomTenant->room_id)
                    ->update(['status' => 'available']);
            }
        }
        $messages = [];
        if ($roomTenant->wasChanged('start_date')) {
            $messages[] = "Tanggal Mulai: {$oldData['start_date']} → {$roomTenant->start_date?->format('Y-m-d')}";
        }

        if ($roomTenant->wasChanged('duration_month')) {
            $messages[] =
                "Durasi Kontrak: {$oldData['duration_month']} bulan → {$roomTenant->duration_month} bulan";
        }

        if ($roomTenant->wasChanged('end_date')) {
            $messages[] = "Tanggal Selesai: {$oldData['end_date']} → {$roomTenant->end_date?->format('Y-m-d')}";
        }

        if ($roomTenant->wasChanged('status')) {
            $messages[] = "Status: {$oldData['status']} → {$roomTenant->status}";
        }

        if (!empty($messages)) {
            $this->activityLogService->store(
                "Mengubah data penyewaan kamar {$roomTenant->id}. " .
                "Nomor Kamar: {$roomTenant->room->room_number}, " .
                "Nama Penyewa: {$roomTenant->tenant->user->name}, " .
                implode(", ", $messages) . "."
            );
        }

        return $roomTenant;
    }
    public function delete(RoomTenant $roomTenant): void
    {
        $roomTenant->load(['room', 'tenant.user']);

        $roomTenantId = $roomTenant->id;
        $roomNumber = $roomTenant->room->room_number;
        $tenantName = $roomTenant->tenant->user->name;

        $roomTenant->delete();

        $this->activityLogService->store(
            "Menghapus data penyewaan kamar {$roomTenantId}. " .
            "Nomor Kamar: {$roomNumber}, " .
            "Nama Penyewa: {$tenantName}."
        );
    }
}