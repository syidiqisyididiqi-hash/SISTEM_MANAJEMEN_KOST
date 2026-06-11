<?php

namespace App\Services;
use App\Models\Bill;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BillService
{
    public function getAll()
    {
        return Bill::with('roomtenant.room', 'roomtenant.tenant.user')
            ->latest()
            ->get();
    }

    public function store(array $data): Bill
    {
        $data['bill_month'] = $data['bill_month'] . '-01';

        return Bill::create($data);
    }

    public function findById(int $id): Bill
    {
        $bill = Bill::with([
            'roomTenant.room',
            'roomTenant.tenant.user',
            'payments'
        ])->find($id);

        if (!$bill) {
            throw new ModelNotFoundException("bill not found");
        }

        return $bill;
    }

    public function update(Bill $bill, array $data): Bill
    {
        $bill->update($data);

        if ($bill->status === 'unpaid' && Carbon::now()->gt($bill->due_date)) {
            $bill->update(['status' => 'overdue']);
        }

        return $bill;
    }

    public function delete(Bill $bill): void
    {
        $bill->delete();
    }
}