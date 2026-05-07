<?php

namespace App\Services;

use App\Models\Bill;
use App\Models\Payment;
use Exception;

class PaymentService
{
    public function getAll()
    {
        return Payment::with([
            'bill.roomTenant.room',
            'bill.roomTenant.tenant.user'
        ])->latest()->get();
    }

    public function create(array $data): Payment
    {
        $bill = Bill::findOrFail($data['bill_id']);

        if ($bill->status === 'paid') {
            throw new Exception('Bill already paid.');
        }

        $payment = Payment::create($data);
        $bill->update([
            'status' => 'paid',
        ]);

        return $payment;
    }
}