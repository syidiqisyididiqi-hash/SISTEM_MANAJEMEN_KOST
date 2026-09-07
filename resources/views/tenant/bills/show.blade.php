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

            @if(session('success'))
                <div class="mb-8 rounded-xl bg-green-50 border border-green-200 px-4 py-3 text-sm text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-8 rounded-xl bg-red-50 border border-red-200 px-4 py-3 text-sm text-red-700">
                    {{ $errors->first() }}
                </div>
            @endif

            <div class="mb-8 flex items-center gap-4 rounded-xl bg-gray-50 p-4">
                <img src="{{ $bill->roomTenant->room->image_url }}"
                    alt="Kamar {{ $bill->roomTenant->room->room_number }}"
                    class="h-20 w-28 shrink-0 rounded-xl object-cover border border-gray-200">

                <div>
                    <p class="text-sm text-gray-500">Kamar</p>
                    <p class="text-lg font-bold text-gray-800">
                        {{ $bill->roomTenant->room->room_number }}
                    </p>
                </div>
            </div>

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

                    <a href="https://wa.me/6283820195022?text={{ urlencode('Halo, saya ingin melakukan pembayaran tagihan. Nomor kamar: ' . $bill->roomTenant->room->room_number . ', bulan: ' . $bill->bill_month->translatedFormat('F Y') . ', total: Rp ' . number_format($bill->amount + $bill->fine_amount, 0, ',', '.')) }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="inline-flex items-center gap-2 px-5 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            class="w-5 h-5 fill-current">
                            <path d="M20.52 3.48A11.82 11.82 0 0 0 12.05 0C5.52 0 .2 5.32.2 11.85c0 2.09.55 4.13 1.59 5.93L.1 24l6.37-1.67a11.84 11.84 0 0 0 5.57 1.42h.01c6.53 0 11.85-5.32 11.85-11.85 0-3.17-1.24-6.15-3.38-8.42ZM12.06 21.7h-.01a9.84 9.84 0 0 1-5.02-1.37l-.36-.21-3.78.99 1.01-3.68-.23-.38a9.85 9.85 0 0 1-1.51-5.2c0-5.43 4.42-9.85 9.86-9.85a9.8 9.8 0 0 1 6.97 2.89 9.8 9.8 0 0 1 2.89 6.98c0 5.43-4.42 9.85-9.82 9.85Zm5.4-7.38c-.3-.15-1.76-.87-2.03-.97-.27-.1-.47-.15-.67.15-.2.3-.77.97-.94 1.17-.17.2-.35.22-.65.07-.3-.15-1.27-.47-2.42-1.5-.9-.8-1.5-1.78-1.68-2.08-.17-.3-.02-.46.13-.61.14-.14.3-.35.45-.52.15-.17.2-.3.3-.5.1-.2.05-.37-.02-.52-.07-.15-.67-1.61-.92-2.21-.24-.58-.49-.5-.67-.51h-.57c-.2 0-.52.07-.79.37-.27.3-1.04 1.02-1.04 2.49s1.07 2.89 1.22 3.09c.15.2 2.1 3.21 5.08 4.5.71.31 1.27.49 1.7.63.72.23 1.38.2 1.9.12.58-.09 1.76-.72 2.01-1.41.25-.69.25-1.29.17-1.41-.07-.12-.27-.2-.57-.35Z"/>
                        </svg>

                        <span>Bayar Sekarang</span>

                    </a>

                @endif

            </div>

        </div>

    </div>

@endsection
