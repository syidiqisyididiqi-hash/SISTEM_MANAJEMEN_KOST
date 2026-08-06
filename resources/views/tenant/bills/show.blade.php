@extends('layouts.tenant.app')

@section('content')

    <div class="container mx-auto px-4 sm:px-6 py-10 max-w-5xl">

        <div class="mb-8">

            <h1 class="text-3xl font-bold">
                Detail Tagihan
            </h1>

            <p class="text-gray-500 mt-2">
                Informasi lengkap mengenai tagihan Anda.
            </p>

        </div>

        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-8">

            <div class="grid md:grid-cols-2 gap-8">

                <div>

                    <h3 class="font-semibold mb-4">
                        Informasi Tagihan
                    </h3>

                    <div class="space-y-3">

                        <p>
                            <strong>Nomor Kamar :</strong>
                            {{ $bill->roomTenant->room->room_number }}
                        </p>

                        <p>
                            <strong>Bulan :</strong>
                            {{ $bill->bill_month->translatedFormat('F Y') }}
                        </p>

                        <p>
                            <strong>Jatuh Tempo :</strong>
                            {{ $bill->due_date->format('d M Y') }}
                        </p>

                        <p>
                            <strong>Status :</strong>

                            @if($bill->status == 'paid')

                                <span class="text-green-600 font-semibold">
                                    Sudah Dibayar
                                </span>

                            @elseif($bill->status == 'overdue')

                                <span class="text-red-600 font-semibold">
                                    Terlambat
                                </span>

                            @else

                                <span class="text-yellow-600 font-semibold">
                                    Belum Dibayar
                                </span>

                            @endif

                        </p>

                    </div>

                </div>

                <div>

                    <h3 class="font-semibold mb-4">
                        Ringkasan Pembayaran
                    </h3>

                    <div class="space-y-3">

                        <div class="flex justify-between">
                            <span>Tagihan</span>
                            <span>
                                Rp {{ number_format($bill->amount, 0, ',', '.') }}
                            </span>
                        </div>

                        <div class="flex justify-between">
                            <span>Denda</span>
                            <span>
                                Rp {{ number_format($bill->fine_amount, 0, ',', '.') }}
                            </span>
                        </div>

                        <hr>

                        <div class="flex justify-between font-bold text-lg">
                            <span>Total</span>
                            <span>
                                Rp {{ number_format($bill->amount + $bill->fine_amount, 0, ',', '.') }}
                            </span>
                        </div>

                    </div>

                </div>

            </div>

            <div class="mt-10 flex justify-between">

                <a href="{{ route('tenant.bills.index') }}" class="px-5 py-2 border rounded-lg hover:bg-gray-100">

                    Kembali

                </a>

                @if($bill->status != 'paid')

                    <a href="#" class="px-5 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">

                        Bayar Sekarang

                    </a>

                @endif

            </div>

        </div>

    </div>

@endsection