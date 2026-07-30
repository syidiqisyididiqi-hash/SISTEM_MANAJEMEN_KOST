<?php

namespace App\Services;

use App\Models\Bill;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;

class BillService
{
    public function __construct(
        private ActivityLogService $activityLogService
    ) {
    }

    public function getAll()
    {
        return Bill::with('roomTenant.room', 'roomTenant.tenant.user')
            ->latest()
            ->get();
    }

    public function store(array $data): Bill
    {
        $data['bill_month'] = Carbon::parse($data['bill_month'])
            ->startOfMonth()
            ->format('Y-m-d');

        $exists = Bill::where('room_tenant_id', $data['room_tenant_id'])
            ->whereDate('bill_month', $data['bill_month'])
            ->exists();

        if ($exists) {
            throw ValidationException::withMessages([
                'bill_month' => ['Tagihan untuk bulan tersebut sudah tersedia.'],
            ]);
        }

        $bill = Bill::create($data);

        $bill->refresh();

        $bill->load([
            'roomTenant.room',
            'roomTenant.tenant.user'
        ]);

        $this->activityLogService->store(
            "Menambahkan data tagihan {$bill->id}. " .
            "Nomor Kamar: {$bill->roomTenant->room->room_number}, " .
            "Nama Penyewa: {$bill->roomTenant->tenant->user->name}, " .
            "Bulan Tagihan: {$bill->bill_month->translatedFormat('F Y')}, " .
            "Jumlah Tagihan: Rp" . number_format($bill->amount, 0, ',', '.') . ", " .
            "Jatuh Tempo: {$bill->due_date->format('Y-m-d')}, " .
            "Denda: Rp" . number_format($bill->fine_amount, 0, ',', '.') . ", " .
            "Status: {$bill->status}."
        );

        return $bill;
    }

    public function findById(int $id): Bill
    {
        $bill = Bill::with([
            'roomTenant.room',
            'roomTenant.tenant.user',
            'payments'
        ])->find($id);

        if (!$bill) {
            throw new ModelNotFoundException('Bill not found');
        }

        return $bill;
    }

    public function update(Bill $bill, array $data): Bill
    {
        $bill->load([
            'roomTenant.room',
            'roomTenant.tenant.user'
        ]);

        $oldData = $bill->toArray();

        $bill->update($data);

        if ($bill->status === 'unpaid' && Carbon::now()->gt($bill->due_date)) {
            $bill->update([
                'status' => 'overdue'
            ]);
        }

        $bill->refresh()->load([
            'roomTenant.room',
            'roomTenant.tenant.user'
        ]);

        $messages = [];

        if ($bill->wasChanged('bill_month')) {
            $messages[] =
                "Bulan Tagihan: " .
                Carbon::parse($oldData['bill_month'])->translatedFormat('F Y') .
                " → " .
                $bill->bill_month->translatedFormat('F Y');
        }

        if ($bill->wasChanged('amount')) {
            $messages[] =
                "Jumlah Tagihan: Rp" .
                number_format($oldData['amount'], 0, ',', '.') .
                " → Rp" .
                number_format($bill->amount, 0, ',', '.');
        }

        if ($bill->wasChanged('due_date')) {
            $messages[] =
                "Jatuh Tempo: " .
                Carbon::parse($oldData['due_date'])->format('Y-m-d') .
                " → " .
                $bill->due_date->format('Y-m-d');
        }

        if ($bill->wasChanged('fine_amount')) {
            $messages[] =
                "Denda: Rp" .
                number_format($oldData['fine_amount'], 0, ',', '.') .
                " → Rp" .
                number_format($bill->fine_amount, 0, ',', '.');
        }

        if ($bill->wasChanged('status')) {
            $messages[] =
                "Status: {$oldData['status']} → {$bill->status}";
        }

        if (!empty($messages)) {
            $this->activityLogService->store(
                "Mengubah data tagihan {$bill->id}. " .
                implode(', ', $messages) . "."
            );
        }

        return $bill;
    }

    public function delete(Bill $bill): void
    {
        $bill->load([
            'roomTenant.room',
            'roomTenant.tenant.user'
        ]);

        $billId = $bill->id;
        $roomNumber = $bill->roomTenant->room->room_number;
        $tenantName = $bill->roomTenant->tenant->user->name;
        $billMonth = $bill->bill_month->translatedFormat('F Y');

        $bill->delete();

        $this->activityLogService->store(
            "Menghapus data tagihan {$billId}. " .
            "Nomor Kamar: {$roomNumber}, " .
            "Nama Penyewa: {$tenantName}, " .
            "Bulan Tagihan: {$billMonth}."
        );
    }
}