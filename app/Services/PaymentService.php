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
                "Menambahkan data pembayaran {$payment->id}. " .
                "Nama Penyewa: {$bill->roomTenant->tenant->user->name}, " .
                "Nomor Kamar: {$bill->roomTenant->room->room_number}, " .
                "Bulan Tagihan: {$bill->bill_month->format('Y-m')}, " .
                "Nominal: Rp" . number_format($payment->amount, 0, ',', '.') . ", " .
                "Metode Pembayaran: {$payment->method}, " .
                "Tanggal Pembayaran: {$payment->paid_at}."
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
            $messages[] =
                "Tanggal Pembayaran: {$oldData['paid_at']} → {$payment->paid_at}";
        }

        if (!empty($messages)) {
            $this->activityLogService->store(
                "Mengubah data pembayaran {$payment->id}. " .
                "Nama Penyewa: {$payment->bill->roomTenant->tenant->user->name}. " .
                implode(", ", $messages) . "."
            );
        }

        return $payment;
    }

    public function delete(Payment $payment): void
    {
        DB::transaction(function () use ($payment) {

            $tenantName = $payment->bill->roomTenant->tenant->user->name;
            $roomNumber = $payment->bill->roomTenant->room->room_number;
            $billMonth = $payment->bill->bill_month;
            $amount = $payment->amount;
            $method = $payment->method;

            $payment->delete();

            $this->activityLogService->store(
                "Menghapus data pembayaran {$payment->id}. " .
                "Nama Penyewa: {$tenantName}, " .
                "Nomor Kamar: {$roomNumber}, " .
                "Bulan Tagihan: {$billMonth}, " .
                "Nominal: Rp" . number_format($amount, 0, ',', '.') . ", " .
                "Metode Pembayaran: {$method}."
            );
        });
    }
}