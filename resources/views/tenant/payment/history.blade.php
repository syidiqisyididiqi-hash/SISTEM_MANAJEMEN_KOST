@extends('layouts.tenant.app')

@section('content')

<div class="space-y-8">

    {{-- HEADER --}}
    <div>
        <h1 class="text-3xl font-bold text-gray-800">
            Riwayat Pembayaran
        </h1>

        <p class="mt-1 text-gray-500">
            Lihat seluruh riwayat pembayaran sewa dan tagihan Anda.
        </p>
    </div>


    {{-- RINGKASAN --}}
    <div class="grid grid-cols-1 gap-6 md:grid-cols-3">

        {{-- TOTAL PEMBAYARAN --}}
        <div class="rounded-3xl border border-gray-100 bg-white p-6 shadow-sm">
            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm text-gray-500">
                        Total Pembayaran
                    </p>

                    <h2 class="mt-2 text-2xl font-bold text-gray-800">
                        Rp {{ number_format($totalAmount, 0, ',', '.') }}
                    </h2>
                </div>

                <div
                    class="flex h-14 w-14 items-center justify-center rounded-2xl bg-blue-100 text-2xl">
                    💳
                </div>

            </div>
        </div>


        {{-- PEMBAYARAN BERHASIL --}}
        <div class="rounded-3xl border border-gray-100 bg-white p-6 shadow-sm">
            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm text-gray-500">
                        Pembayaran Berhasil
                    </p>

                    <h2 class="mt-2 text-2xl font-bold text-green-600">
                        {{ $successfulCount }}
                    </h2>
                </div>

                <div
                    class="flex h-14 w-14 items-center justify-center rounded-2xl bg-green-100 text-2xl">
                    ✅
                </div>

            </div>
        </div>


        {{-- MENUNGGU --}}
        <div class="rounded-3xl border border-gray-100 bg-white p-6 shadow-sm">
            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm text-gray-500">
                        Menunggu Pembayaran
                    </p>

                    <h2 class="mt-2 text-2xl font-bold text-yellow-600">
                        {{ $pendingCount }}
                    </h2>
                </div>

                <div
                    class="flex h-14 w-14 items-center justify-center rounded-2xl bg-yellow-100 text-2xl">
                    ⏳
                </div>

            </div>
        </div>

    </div>


    {{-- RIWAYAT PEMBAYARAN --}}
    <div class="rounded-3xl bg-white p-6 shadow-sm">

        <div class="mb-6">
            <h2 class="text-xl font-bold text-gray-800">
                Daftar Pembayaran
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Riwayat transaksi pembayaran Anda.
            </p>
        </div>


        {{-- TABEL --}}
        <div class="overflow-x-auto">

            <table class="w-full text-left">

                <thead>
                    <tr class="border-b border-gray-200 text-sm text-gray-500">

                        <th class="px-4 py-4 font-semibold">
                            No
                        </th>

                        <th class="px-4 py-4 font-semibold">
                            Periode
                        </th>

                        <th class="px-4 py-4 font-semibold">
                            Kamar
                        </th>

                        <th class="px-4 py-4 font-semibold">
                            Jumlah
                        </th>

                        <th class="px-4 py-4 font-semibold">
                            Tanggal Pembayaran
                        </th>

                        <th class="px-4 py-4 font-semibold">
                            Metode
                        </th>

                        <th class="px-4 py-4 font-semibold">
                            Status
                        </th>

                    </tr>
                </thead>


                <tbody>

                    @forelse($payments as $payment)
                        <tr class="border-b border-gray-100">

                            <td class="px-4 py-5 text-gray-700">
                                {{ $payments->firstItem() + $loop->index }}
                            </td>

                            <td class="px-4 py-5">
                                <p class="font-semibold text-gray-800">
                                    {{ $payment->bill->bill_month->translatedFormat('F Y') }}
                                </p>
                            </td>

                            <td class="px-4 py-5">
                                <span class="font-semibold text-gray-800">
                                    {{ $payment->bill->roomTenant->room->room_number }}
                                </span>
                            </td>

                            <td class="px-4 py-5 font-semibold text-gray-800">
                                Rp {{ number_format($payment->amount, 0, ',', '.') }}
                            </td>

                            <td class="px-4 py-5 text-gray-600">
                                {{ $payment->paid_at->translatedFormat('d M Y') }}
                            </td>

                            <td class="px-4 py-5 text-gray-600">
                                {{ match ($payment->method) {
                                    'cash' => 'Tunai',
                                    'transfer' => 'Transfer Bank',
                                    'ewallet' => 'E-Wallet',
                                    default => ucfirst($payment->method),
                                } }}
                            </td>

                            <td class="px-4 py-5">

                                <span
                                    class="inline-flex rounded-full bg-green-100 px-3 py-1 text-sm font-semibold text-green-700">
                                    Lunas
                                </span>

                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-12 text-center text-gray-500">
                                Belum ada riwayat pembayaran.
                            </td>
                        </tr>
                    @endforelse


                </tbody>

            </table>

        </div>

        <div class="mt-6">
            {{ $payments->links() }}
        </div>

    </div>

</div>

@endsection
