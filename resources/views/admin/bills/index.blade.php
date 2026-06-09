@extends('layouts.admin.app')

@section('title', 'Bills')

@section('content')

    <div class="max-w-7xl mx-auto">

        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">
                Bills
            </h1>

            <a href="{{ route('admin.bills.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg">
                Add Bill
            </a>
        </div>

        <div class="bg-white rounded-xl shadow overflow-hidden">

            <table class="w-full">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-3 text-left">Tenant</th>
                        <th class="p-3 text-left">Month</th>
                        <th class="p-3 text-left">Amount</th>
                        <th class="p-3 text-left">Due Date</th>
                        <th class="p-3 text-left">Fine</th>
                        <th class="p-3 text-left">Status</th>
                        <th class="p-3 text-center">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($bills as $bill)
                        <tr class="border-t">

                            <td class="p-3">
                                {{ $bill->roomTenant->user->name ?? '-' }}
                            </td>

                            <td class="p-3">
                                {{ \Carbon\Carbon::parse($bill->bill_month)->format('F Y') }}
                            </td>

                            <td class="p-3">
                                Rp {{ number_format($bill->amount, 0, ',', '.') }}
                            </td>

                            <td class="p-3">
                                {{ $bill->due_date }}
                            </td>

                            <td class="p-3">
                                Rp {{ number_format($bill->fine_amount, 0, ',', '.') }}
                            </td>

                            <td class="p-3">
                                <span class="px-2 py-1 rounded text-sm
                                                                @if($bill->status == 'paid')
                                                                    bg-green-100 text-green-700
                                                                @elseif($bill->status == 'overdue')
                                                                    bg-red-100 text-red-700
                                                                @else
                                                                    bg-yellow-100 text-yellow-700
                                                                @endif
                                                            ">
                                    {{ ucfirst($bill->status) }}
                                </span>
                            </td>

                            <td class="p-3 text-center">
                                <a href="{{ route('admin.bills.edit', $bill->id) }}" class="text-blue-600">
                                    Edit
                                </a>

                                <form action="{{ route('admin.bills.destroy', $bill->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')

                                    <button onclick="return confirm('Delete this bill?')" class="text-red-600 ml-3">
                                        Delete
                                    </button>
                                </form>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center p-4">
                                No data available.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>

        </div>

    </div>

@endsection