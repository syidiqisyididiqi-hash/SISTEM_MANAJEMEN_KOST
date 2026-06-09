@extends('layouts.admin.app')

@section('title', 'Create Bill')

@section('content')

    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-xl shadow p-6">

            <h1 class="text-2xl font-bold mb-6">
                Create Bill
            </h1>

            <form action="{{ route('admin.bills.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label class="block mb-2 font-medium">
                        Tenant
                    </label>

                    <select name="room_tenant_id" class="w-full border rounded-lg p-2">
                        <option value="">
                            Select Tenant
                        </option>

                        @forelse($roomTenants as $tenant)
                            <option value="{{ $tenant->id }}">
                                {{ $tenant->user->name ?? 'Unknown User' }}
                            </option>
                        @empty
                            <option disabled>
                                No Tenant Available
                            </option>
                        @endforelse

                    </select>

                    @error('room_tenant_id')
                        <p class="text-red-500 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block mb-2 font-medium">
                        Bill Month
                    </label>

                    <input type="month" name="bill_month" value="{{ old('bill_month') }}"
                        class="w-full border rounded-lg p-2">

                    @error('bill_month')
                        <p class="text-red-500 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block mb-2 font-medium">
                        Amount
                    </label>

                    <input type="number" name="amount" value="{{ old('amount') }}" class="w-full border rounded-lg p-2">

                    @error('amount')
                        <p class="text-red-500 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block mb-2 font-medium">
                        Due Date
                    </label>

                    <input type="date" name="due_date" value="{{ old('due_date') }}" class="w-full border rounded-lg p-2">

                    @error('due_date')
                        <p class="text-red-500 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block mb-2 font-medium">
                        Fine Amount
                    </label>

                    <input type="number" name="fine_amount" value="{{ old('fine_amount', 0) }}"
                        class="w-full border rounded-lg p-2">

                    @error('fine_amount')
                        <p class="text-red-500 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block mb-2 font-medium">
                        Status
                    </label>

                    <select name="status" class="w-full border rounded-lg p-2">
                        <option value="unpaid">Unpaid</option>
                        <option value="paid">Paid</option>
                        <option value="overdue">Overdue</option>
                    </select>

                    @error('status')
                        <p class="text-red-500 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                    Save
                </button>

            </form>

        </div>
    </div>

@endsection