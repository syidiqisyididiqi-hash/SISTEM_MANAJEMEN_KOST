@extends('layouts.admin.app')

@section('title', 'Tambah Payment')

@section('content')

    <x-ui.page-header title="Tambah Payment" description="Tambah data pembayaran tenant" />

    <x-ui.card>

        @if($errors->any() && !$errors->has('error'))
            <x-ui.alert type="danger" class="mb-5">
                Silakan periksa kembali data yang Anda masukkan.
            </x-ui.alert>
        @endif

        <form id="formTambahPayment" action="{{ route('admin.payments.store') }}" method="POST">
            @csrf

            <x-ui.form-group label="Bill" name="bill_id" required>

                <x-ui.select id="bill_id" name="bill_id">

                    @forelse($bills as $bill)

                        <option value="{{ $bill->id }}" {{ old('bill_id') == $bill->id ? 'selected' : '' }}>

                            {{ $bill->roomtenant->tenant->user->name }}
                            -
                            {{ \Carbon\Carbon::parse($bill->bill_month)->format('F Y') }}

                        </option>

                    @empty

                        <option value="">-- Tidak ada bill unpaid tersedia --</option>

                    @endforelse

                </x-ui.select>

            </x-ui.form-group>

            <x-ui.form-group label="Tanggal Bayar" name="paid_at" required>

                <x-ui.input type="datetime-local" id="paid_at" name="paid_at" :value="old('paid_at')" />

            </x-ui.form-group>

            <x-ui.form-group label="Jumlah Pembayaran" name="amount" required>

                <x-ui.input type="number" id="amount" name="amount" :value="old('amount')" />

            </x-ui.form-group>

            <x-ui.form-group label="Metode Pembayaran" name="method" required>

                <x-ui.select id="method" name="method">

                    <option value="cash" {{ old('method') == 'cash' ? 'selected' : '' }}>Cash</option>
                    <option value="transfer" {{ old('method') == 'transfer' ? 'selected' : '' }}>Transfer</option>
                    <option value="ewallet" {{ old('method') == 'ewallet' ? 'selected' : '' }}>E-Wallet</option>

                </x-ui.select>

            </x-ui.form-group>

            <div class="flex gap-3">

                <x-ui.button type="submit">
                    Simpan
                </x-ui.button>

                <a href="{{ route('admin.payments.index') }}" class="px-5 py-2 bg-gray-500 text-white rounded-lg">
                    Kembali
                </a>

            </div>

        </form>

    </x-ui.card>

    <script>
        document.getElementById('formTambahPayment').addEventListener('submit', function (e) {

            e.preventDefault();

            Swal.fire({
                icon: 'question',
                title: 'Konfirmasi',
                text: 'Apakah Anda yakin ingin menyimpan data pembayaran ini?',
                width: '400px',
                showCancelButton: true,
                confirmButtonText: 'Ya, Simpan',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#2563eb',
                cancelButtonColor: '#6b7280',
                reverseButtons: true
            }).then((result) => {

                if (result.isConfirmed) {
                    this.submit();
                }

            });

        });
    </script>
@endsection