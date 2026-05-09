<?php

namespace App\Services;

use App\Models\Bill;
use App\Models\Payment;
use App\Services\ActivityLogService;
use Exception;
use Illuminate\Support\Facades\DB;

class PaymentService
{
    public function __construct(
        private ActivityLogService $activityLogService
    ) {
    }

    public function getAll()
    {
        return Payment::with([
            'bill.roomTenant.room',
            'bill.roomTenant.tenant.user'
        ])->latest()->get();
    }

    public function store(array $data): Payment
    {
        return DB::transaction(function () use ($data) {
            $bill = Bill::findOrFail($data['bill_id']);

            if ($bill->status === 'paid') {
                throw new Exception('Bill already paid.');
            }

            $payment = Payment::create($data);

            $bill->update([
                'status' => 'paid'
            ]);

            $this->activityLogService->store(
                "Payment of {$payment->amount} created for Bill #{$bill->id} using {$payment->method}"
            );

            return $payment;
        });
    }

    public function update(Payment $payment, array $data): Payment
    {
        $payment->update($data);

        return $payment;
    }

    public function delete(Payment $payment): void
    {
        $payment->delete();
    }
}