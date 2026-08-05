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

    public function getAll($search = null)
    {
        return Payment::with([
            'bill.roomTenant.room',
            'bill.roomTenant.tenant.user'
        ])
            ->when($search, function ($query) use ($search) {
                $query->whereHas('bill.roomTenant.tenant.user', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10);
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
                "Menambahkan pembayaran Bill #{$bill->id} sebesar Rp" .
                number_format($payment->amount, 0, ',', '.') .
                " menggunakan metode {$payment->method}."
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

        $messages = [];

        if ($oldData['amount'] != $payment->amount) {
            $messages[] = "Jumlah: Rp" .
                number_format($oldData['amount'], 0, ',', '.') .
                " → Rp" .
                number_format($payment->amount, 0, ',', '.');
        }

        if ($oldData['method'] != $payment->method) {
            $messages[] = "Metode: {$oldData['method']} → {$payment->method}";
        }

        if ($oldData['paid_at'] != $payment->paid_at) {
            $messages[] = "Tanggal pembayaran diperbarui";
        }

        if (!empty($messages)) {
            $this->activityLogService->store(
                "Mengubah pembayaran Bill #{$payment->bill_id}. " .
                implode(", ", $messages)
            );
        }

        return $payment;
    }

    public function delete(Payment $payment): void
    {
        DB::transaction(function () use ($payment) {

            $billId = $payment->bill_id;
            $amount = $payment->amount;
            $method = $payment->method;

            $payment->delete();

            $this->activityLogService->store(
                "Menghapus pembayaran Bill #{$billId} sebesar Rp" .
                number_format($amount, 0, ',', '.') .
                " menggunakan metode {$method}."
            );
        });
    }
}