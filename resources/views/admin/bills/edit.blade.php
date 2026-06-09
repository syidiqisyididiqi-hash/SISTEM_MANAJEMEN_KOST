@extends('layouts.admin.app')

@section('title', 'Edit Bill')

@section('content')

    <div class="max-w-3xl mx-auto">

        <div class="bg-white rounded-xl shadow p-6">

            <h1 class="text-2xl font-bold mb-6">
                Edit Bill
            </h1>

            <form action="{{ route('admin.bills.update', $bill->id) }}" method="POST">

                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block mb-2">Tenant</label>

                    <select name="room_tenant_id" class="w-full border rounded-lg p-2">

                        @foreach($roomTenants as $tenant)
                            <option value="{{ $tenant->id }}" {{ $bill->room_tenant_id == $tenant->id ? 'selected' : '' }}>
                                {{ $tenant->user->name }}
                            </option>
                        @endforeach

                    </select>
                </div>

                <div class="mb-4">
                    <label class="block mb-2">Bill Month</label>

                    <input type="month" name="bill_month"
                        value="{{ \Carbon\Carbon::parse($bill->bill_month)->format('Y-m') }}"
                        class="w-full border rounded-lg p-2">
                </div>

                <div class="mb-4">
                    <label class="block mb-2">Amount</label>

                    <input type="number" name="amount" value="{{ $bill->amount }}" class="w-full border rounded-lg p-2">
                </div>

                <div class="mb-4">
                    <label class="block mb-2">Due Date</label>

                    <input type="date" name="due_date" value="{{ $bill->due_date }}" class="w-full border rounded-lg p-2">
                </div>

                <div class="mb-4">
                    <label class="block mb-2">Fine Amount</label>

                    <input type="number" name="fine_amount" value="{{ $bill->fine_amount }}"
                        class="w-full border rounded-lg p-2">
                </div>

                <div class="mb-4">
                    <label class="block mb-2">Status</label>

                    <select name="status" class="w-full border rounded-lg p-2">

                        <option value="unpaid" {{ $bill->status == 'unpaid' ? 'selected' : '' }}>
                            Unpaid
                        </option>

                        <option value="paid" {{ $bill->status == 'paid' ? 'selected' : '' }}>
                            Paid
                        </option>

                        <option value="overdue" {{ $bill->status == 'overdue' ? 'selected' : '' }}>
                            Overdue
                        </option>

                    </select>
                </div>

                <button class="bg-green-600 text-white px-4 py-2 rounded-lg">
                    Update
                </button>

            </form>

        </div>

    </div>

@endsection