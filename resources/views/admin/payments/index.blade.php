@extends('layouts.admin.app')

@section('title', 'Data Payment')

@section('content')

    <x-ui.page-header title="Data Payment" description="Kelola data pembayaran tenant" />

    @if(session('success'))
        <x-ui.alert>
            {{ session('success') }}
        </x-ui.alert>
    @endif

    <x-ui.card>

        <div class="flex flex-col gap-4 mb-6 md:flex-row md:items-center md:justify-between">

            <div>

                <h3 class="text-xl font-semibold text-slate-800">
                    Daftar Payment
                </h3>

                <p class="text-sm text-slate-500">
                    Menampilkan seluruh data pembayaran tenant.
                </p>

            </div>

            <a href="{{ route('admin.payments.create') }}">
                <x-ui.button>
                    + Tambah Data
                </x-ui.button>
            </a>

        </div>

        @if($payments->count())

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
                            Bulan Tagihan
                        </th>

                        <th class="px-6 py-4 text-left font-semibold">
                            Nominal
                        </th>

                        <th class="px-6 py-4 text-left font-semibold">
                            Metode
                        </th>

                        <th class="px-6 py-4 text-left font-semibold">
                            Tanggal Bayar
                        </th>

                        <th class="px-6 py-4 text-center font-semibold">
                            Aksi
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($payments as $payment)

                        <tr class="border-b hover:bg-gray-50">

                            <td class="px-6 py-4">
                                {{ $loop->iteration }}
                            </td>

                            <td class="px-6 py-4">

                                <div class="flex items-center gap-3">

                                    <div
                                        class="flex items-center justify-center w-10 h-10 font-semibold text-blue-600 bg-blue-100 rounded-full">
                                        {{ strtoupper(substr($payment->bill->roomtenant->tenant->user->name, 0, 1)) }}
                                    </div>

                                    <div>

                                        <p class="font-medium text-slate-800">
                                            {{ $payment->bill->roomtenant->tenant->user->name }}
                                        </p>

                                        <p class="text-xs text-slate-500">
                                            Tenant
                                        </p>

                                    </div>

                                </div>

                            </td>

                            <td class="px-6 py-4">
                                {{ \Carbon\Carbon::parse($payment->bill->bill_month)->format('F Y') }}
                            </td>

                            <td class="px-6 py-4">
                                Rp {{ number_format($payment->amount, 0, ',', '.') }}
                            </td>

                            <td class="px-6 py-4">
                                {{ ucfirst($payment->method) }}
                            </td>

                            <td class="px-6 py-4">
                                {{ \Carbon\Carbon::parse($payment->paid_at)->format('d/m/Y H:i') }}
                            </td>

                            <td class="px-6 py-4">

                                <div class="flex justify-center gap-2">

                                    <a href="{{ route('admin.payments.edit', $payment) }}">
                                        <x-ui.button>
                                            Edit
                                        </x-ui.button>
                                    </a>

                                    <form action="{{ route('admin.payments.destroy', $payment) }}" method="POST" class="inline"
                                        onsubmit="return confirm('Yakin ingin menghapus data ini?');">

                                        @csrf
                                        @method('DELETE')

                                        <x-ui.button type="submit" color="secondary" class="bg-red-500 hover:bg-red-600 text-white">
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

            <x-ui.empty-state title="Belum Ada Data Payment" description="Silakan tambahkan data pembayaran terlebih dahulu." />

            <div class="flex justify-center mt-6">

                <a href="{{ route('admin.payments.create') }}">
                    <x-ui.button>
                        + Tambah Data
                    </x-ui.button>
                </a>

            </div>

        @endif

    </x-ui.card>

@endsection