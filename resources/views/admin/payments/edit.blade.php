@extends('layouts.admin.app')

@section('title', 'Edit Payment')

@section('content')

    <x-ui.page-header title="Edit Payment" description="Perbarui data pembayaran tenant" />

    <x-ui.card>

        <form action="{{ route('admin.payments.update', $payment) }}" method="POST">

            @csrf
            @method('PUT')

            <x-ui.form-group label="Bill" name="bill_id" required>

                <x-ui.select id="bill_id" name="bill_id">

                    @foreach($bills as $bill)

                        <option value="{{ $bill->id }}" {{ old('bill_id', $payment->bill_id) == $bill->id ? 'selected' : '' }}>

                            {{ $bill->roomtenant->tenant->user->name }}
                            -
                            {{ \Carbon\Carbon::parse($bill->bill_month)->format('F Y') }}

                        </option>

                    @endforeach

                </x-ui.select>

            </x-ui.form-group>

            <x-ui.form-group label="Tanggal Bayar" name="paid_at" required>

                <x-ui.input type="datetime-local" id="paid_at" name="paid_at" :value="old(
            'paid_at',
            $payment->paid_at
            ? \Carbon\Carbon::parse($payment->paid_at)->format('Y-m-d\TH:i')
            : ''
        )" />

            </x-ui.form-group>

            <x-ui.form-group label="Jumlah Pembayaran" name="amount" required>

                <x-ui.input type="number" id="amount" name="amount" :value="old('amount', $payment->amount)" />

            </x-ui.form-group>

            <x-ui.form-group label="Metode Pembayaran" name="method" required>

                <x-ui.select id="method" name="method">

                    <option value="cash" {{ old('method', $payment->method) == 'cash' ? 'selected' : '' }}>
                        Cash
                    </option>

                    <option value="transfer" {{ old('method', $payment->method) == 'transfer' ? 'selected' : '' }}>
                        Transfer
                    </option>

                    <option value="ewallet" {{ old('method', $payment->method) == 'ewallet' ? 'selected' : '' }}>
                        E-Wallet
                    </option>

                </x-ui.select>

            </x-ui.form-group>

            <div class="flex gap-3">

                <x-ui.button type="submit">
                    Update
                </x-ui.button>

                <a href="{{ route('admin.payments.index') }}"
                    class="px-5 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-lg font-medium inline-block text-center">
                    Kembali
                </a>

            </div>

        </form>

    </x-ui.card>

@endsection