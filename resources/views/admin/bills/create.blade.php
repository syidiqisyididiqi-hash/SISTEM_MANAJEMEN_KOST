@extends('layouts.admin.app')

@section('title', 'Tambah Bill')

@section('content')

    <x-ui.page-header title="Tambah Bill" description="Tambahkan data tagihan tenant" />

    <x-ui.card>

        <form action="{{ route('admin.bills.store') }}" method="POST">

            @csrf

            <x-ui.form-group label="Tenant" name="room_tenant_id" required>

                <x-ui.select id="room_tenant_id" name="room_tenant_id">

                    <option value="">
                        Pilih Tenant
                    </option>

                    @foreach($roomTenants as $tenant)

                        <option value="{{ $tenant->id }}" {{ old('room_tenant_id') == $tenant->id ? 'selected' : '' }}>

                            {{ $tenant->tenant->user->name ?? 'Unknown User' }}
                            (Room {{ $tenant->room->room_number ?? '-' }})

                        </option>

                    @endforeach

                </x-ui.select>

            </x-ui.form-group>

            <x-ui.form-group label="Bulan Tagihan" name="bill_month" required>

                <x-ui.input type="month" id="bill_month" name="bill_month" :value="old('bill_month')" />

            </x-ui.form-group>

            <x-ui.form-group label="Jumlah Tagihan" name="amount" required>

                <x-ui.input type="number" id="amount" name="amount" :value="old('amount')" />

            </x-ui.form-group>

            <x-ui.form-group label="Tanggal Jatuh Tempo" name="due_date" required>

                <x-ui.input type="date" id="due_date" name="due_date" :value="old('due_date')" />

            </x-ui.form-group>

            <x-ui.form-group label="Denda" name="fine_amount">

                <x-ui.input type="number" id="fine_amount" name="fine_amount" :value="old('fine_amount', 0)" />

            </x-ui.form-group>

            <x-ui.form-group label="Status" name="status" required>

                <x-ui.select id="status" name="status">

                    <option value="unpaid" {{ old('status', 'unpaid') == 'unpaid' ? 'selected' : '' }}>
                        Unpaid
                    </option>

                    <option value="paid" {{ old('status') == 'paid' ? 'selected' : '' }}>
                        Paid
                    </option>

                    <option value="overdue" {{ old('status') == 'overdue' ? 'selected' : '' }}>
                        Overdue
                    </option>

                </x-ui.select>

            </x-ui.form-group>

            <div class="flex gap-3">

                <x-ui.button type="submit">
                    Simpan
                </x-ui.button>

                <a href="{{ route('admin.bills.index') }}"
                    class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-lg font-medium inline-block text-center">

                    Batal

                </a>

            </div>

        </form>

    </x-ui.card>

@endsection