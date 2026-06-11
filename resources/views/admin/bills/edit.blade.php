@extends('layouts.admin.app')

@section('title', 'Edit Bill')

@section('content')

    <x-ui.page-header title="Edit Bill" description="Perbarui data tagihan tenant" />

    <x-ui.card>

        <form action="{{ route('admin.bills.update', $bill->id) }}" method="POST">

            @csrf
            @method('PUT')

            <x-ui.form-group label="Tenant" name="room_tenant_id" required>

                <x-ui.select id="room_tenant_id" name="room_tenant_id">

                    @foreach($roomTenants as $roomTenant)
                        <option value="{{ $roomTenant->id }}" {{ old('room_tenant_id', $bill->room_tenant_id) == $roomTenant->id ? 'selected' : '' }}>
                            {{ $roomTenant->tenant->user->name }}
                        </option>
                    @endforeach

                </x-ui.select>

            </x-ui.form-group>

            <x-ui.form-group label="Bill Month" name="bill_month" required>

                <x-ui.input type="month" id="bill_month" name="bill_month" :value="old(
            'bill_month',
            \Carbon\Carbon::parse($bill->bill_month)->format('Y-m')
        )" />

            </x-ui.form-group>

            <x-ui.form-group label="Amount" name="amount" required>

                <x-ui.input type="number" id="amount" name="amount" :value="old('amount', $bill->amount)" />

            </x-ui.form-group>

            <x-ui.form-group label="Due Date" name="due_date" required>

                <x-ui.input type="date" id="due_date" name="due_date" :value="old(
            'due_date',
            $bill->due_date
            ? \Carbon\Carbon::parse($bill->due_date)->format('Y-m-d')
            : ''
        )" />

            </x-ui.form-group>

            <x-ui.form-group label="Fine Amount" name="fine_amount">

                <x-ui.input type="number" id="fine_amount" name="fine_amount" :value="old('fine_amount', $bill->fine_amount)" />

            </x-ui.form-group>

            <x-ui.form-group label="Status" name="status" required>

                <x-ui.select id="status" name="status">

                    <option value="unpaid" {{ old('status', $bill->status) == 'unpaid' ? 'selected' : '' }}>
                        Unpaid
                    </option>

                    <option value="paid" {{ old('status', $bill->status) == 'paid' ? 'selected' : '' }}>
                        Paid
                    </option>

                    <option value="overdue" {{ old('status', $bill->status) == 'overdue' ? 'selected' : '' }}>
                        Overdue
                    </option>

                </x-ui.select>

            </x-ui.form-group>

            <div class="flex gap-3">

                <x-ui.button type="submit">
                    Update
                </x-ui.button>

                <a href="{{ route('admin.bills.index') }}"
                    class="px-5 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-lg font-medium inline-block text-center">
                    Kembali
                </a>

            </div>

        </form>

    </x-ui.card>

@endsection