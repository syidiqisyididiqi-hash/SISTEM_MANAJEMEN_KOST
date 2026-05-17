<?php

namespace App\Services;

use App\Models\Bill;
use App\Models\Payment;
use App\Services\ActivityLogService;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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

    public function findById(int $id): Payment
    {
        $payment = Payment::with([
            'bill.roomTenant.room',
            'bill.roomTenant.tenant.user',
        ])->find($id);

        if (!$payment) {
            throw new ModelNotFoundException('Payment not found');
        }

        return $payment;
    }

    public function update(Payment $payment, array $data): Payment
    {
        $oldData = $payment->toArray();

        $payment->update($data);

        $changes = array_diff_assoc($payment->toArray(), $oldData);
        if (!empty($changes)) {
            $this->activityLogService->store(
                "Payment #{$payment->id} updated: " . json_encode($changes)
            );
        }

        return $payment;
    }

    public function delete(Payment $payment): void
    {
        $payment->delete();
    }
}