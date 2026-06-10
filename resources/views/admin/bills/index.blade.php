@extends('layouts.admin.app')

@section('title', 'Bills')

@section('content')

<x-ui.page-header
    title="Data Bills"
    description="Kelola data tagihan tenant" />

@if(session('success'))
    <x-ui.alert>
        {{ session('success') }}
    </x-ui.alert>
@endif

<x-ui.card>

    <div class="flex flex-col gap-4 mb-6 md:flex-row md:items-center md:justify-between">

        <div>

            <h3 class="text-xl font-semibold text-slate-800">
                Daftar Bills
            </h3>

            <p class="text-sm text-slate-500">
                Menampilkan seluruh data tagihan tenant.
            </p>

        </div>

        <a href="{{ route('admin.bills.create') }}">
            <x-ui.button>
                + Tambah Bill
            </x-ui.button>
        </a>

    </div>

    @if($bills->count())

        <x-ui.table>

            <thead class="bg-slate-50 border-b">

                <tr>

                    <th class="px-6 py-4 text-left font-semibold">
                        No
                    </th>

                    <th class="px-6 py-4 text-left font-semibold">
                        Tenant
                    </th>

                    <th class="px-6 py-4 text-left font-semibold">
                        Month
                    </th>

                    <th class="px-6 py-4 text-left font-semibold">
                        Amount
                    </th>

                    <th class="px-6 py-4 text-left font-semibold">
                        Due Date
                    </th>

                    <th class="px-6 py-4 text-left font-semibold">
                        Fine
                    </th>

                    <th class="px-6 py-4 text-left font-semibold">
                        Status
                    </th>

                    <th class="px-6 py-4 text-center font-semibold">
                        Action
                    </th>

                </tr>

            </thead>

            <tbody>

                @foreach($bills as $bill)

                    <tr class="border-b hover:bg-gray-50">

                        <td class="px-6 py-4">
                            {{ $loop->iteration }}
                        </td>

                        <td class="px-6 py-4">
                            {{ $bill->roomTenant->tenant->user->name ?? '-' }}
                        </td>

                        <td class="px-6 py-4">
                            {{ \Carbon\Carbon::parse($bill->bill_month)->format('F Y') }}
                        </td>

                        <td class="px-6 py-4">
                            Rp {{ number_format($bill->amount, 0, ',', '.') }}
                        </td>

                        <td class="px-6 py-4">
                            {{ \Carbon\Carbon::parse($bill->due_date)->format('d/m/Y') }}
                        </td>

                        <td class="px-6 py-4">
                            Rp {{ number_format($bill->fine_amount, 0, ',', '.') }}
                        </td>

                        <td class="px-6 py-4">

                            @if($bill->status == 'paid')
                                <x-ui.badge>
                                    Paid
                                </x-ui.badge>

                            @elseif($bill->status == 'overdue')
                                <x-ui.badge color="secondary">
                                    Overdue
                                </x-ui.badge>

                            @else
                                <span class="inline-flex items-center px-3 py-1 text-xs font-medium text-yellow-700 bg-yellow-100 rounded-full">
                                    Pending
                                </span>
                            @endif

                        </td>

                        <td class="px-6 py-4">

                            <div class="flex justify-center gap-2">

                                <a href="{{ route('admin.bills.edit', $bill) }}">
                                    <x-ui.button>
                                        Edit
                                    </x-ui.button>
                                </a>

                                <form
                                    action="{{ route('admin.bills.destroy', $bill) }}"
                                    method="POST"
                                    class="inline"
                                    onsubmit="return confirm('Yakin ingin menghapus data ini?');">

                                    @csrf
                                    @method('DELETE')

                                    <x-ui.button
                                        type="submit"
                                        color="secondary"
                                        class="bg-red-500 hover:bg-red-600 text-white">
                                        Hapus
                                    </x-ui.button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @endforeach

            </tbody>

        </x-ui.table>

    @else

        <x-ui.empty-state
            title="Belum Ada Data Bills"
            description="Silakan tambahkan data tagihan terlebih dahulu." />

        <div class="flex justify-center mt-6">

            <a href="{{ route('admin.bills.create') }}">
                <x-ui.button>
                    + Tambah Bill
                </x-ui.button>
            </a>

        </div>

    @endif

</x-ui.card>

@endsection
