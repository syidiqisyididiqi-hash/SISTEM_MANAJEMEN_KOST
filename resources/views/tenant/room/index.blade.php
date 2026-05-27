@extends('layouts.tenant.app')

@section('content')

<div class="container mx-auto px-6 py-8">

    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">
                Kamar Saya
            </h1>

            <p class="text-gray-500 mt-1">
                Informasi detail kamar tenant
            </p>
        </div>
    </div>

    <div class="bg-white rounded-3xl shadow-sm overflow-hidden">

        <div class="h-72 overflow-hidden">
            <img
                src="https://images.unsplash.com/photo-1505693416388-ac5ce068fe85"
                alt="Room"
                class="w-full h-full object-cover"
            >
        </div>

        <div class="p-8">

            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">

                <div>
                    <h2 class="text-2xl font-bold text-gray-800">
                        Kamar A-01
                    </h2>

                    <p class="text-gray-500 mt-2">
                        Lantai 1 • AC • WiFi • Kamar Mandi Dalam
                    </p>
                </div>

                <div>
                    <span class="bg-green-100 text-green-700 text-sm px-4 py-2 rounded-full">
                        Aktif
                    </span>
                </div>

            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-10">

                <div class="bg-gray-50 rounded-2xl p-5">
                    <p class="text-sm text-gray-500">
                        Harga Sewa
                    </p>

                    <h3 class="text-xl font-bold text-gray-800 mt-2">
                        Rp 1.500.000
                    </h3>
                </div>

                <div class="bg-gray-50 rounded-2xl p-5">
                    <p class="text-sm text-gray-500">
                        Tanggal Masuk
                    </p>

                    <h3 class="text-xl font-bold text-gray-800 mt-2">
                        12 Januari 2025
                    </h3>
                </div>

                <div class="bg-gray-50 rounded-2xl p-5">
                    <p class="text-sm text-gray-500">
                        Status Pembayaran
                    </p>

                    <h3 class="text-xl font-bold text-green-600 mt-2">
                        Lunas
                    </h3>
                </div>

            </div>

            <div class="mt-10">
                <a
                    href="{{ route('tenant.room.detail') }}"
                    class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-2xl transition duration-300"
                >
                    Lihat Detail Kamar
                </a>
            </div>

        </div>

    </div>

</div>

@endsection