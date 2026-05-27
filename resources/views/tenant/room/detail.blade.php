@extends('layouts.tenant.app')

@section('content')

    <div class="container mx-auto px-6 py-8">

        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800">
                Detail Kamar
            </h1>

            <p class="text-gray-500 mt-2">
                Informasi lengkap kamar tenant
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <div class="lg:col-span-2">

                <div class="bg-white rounded-3xl shadow-sm overflow-hidden">

                    <div class="h-96 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1505693416388-ac5ce068fe85" alt="Room"
                            class="w-full h-full object-cover">
                    </div>

                    <div class="p-8">

                        <div class="flex items-center justify-between">

                            <div>
                                <h2 class="text-2xl font-bold text-gray-800">
                                    Kamar A-01
                                </h2>

                                <p class="text-gray-500 mt-2">
                                    Lantai 1
                                </p>
                            </div>

                            <span class="bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm">
                                Aktif
                            </span>

                        </div>

                        <div class="mt-10">

                            <h3 class="text-lg font-semibold text-gray-800 mb-5">
                                Fasilitas
                            </h3>

                            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">

                                <div class="bg-gray-50 p-4 rounded-2xl">
                                    ❄️ AC
                                </div>

                                <div class="bg-gray-50 p-4 rounded-2xl">
                                    📶 WiFi
                                </div>

                                <div class="bg-gray-50 p-4 rounded-2xl">
                                    🚿 Kamar Mandi Dalam
                                </div>

                                <div class="bg-gray-50 p-4 rounded-2xl">
                                    🛏️ Kasur
                                </div>

                                <div class="bg-gray-50 p-4 rounded-2xl">
                                    ⚡ Listrik
                                </div>

                                <div class="bg-gray-50 p-4 rounded-2xl">
                                    🪑 Lemari
                                </div>

                            </div>

                        </div>

                        <div class="mt-10">

                            <h3 class="text-lg font-semibold text-gray-800 mb-4">
                                Deskripsi
                            </h3>

                            <p class="text-gray-600 leading-relaxed">
                                Kamar nyaman dengan fasilitas lengkap,
                                cocok untuk mahasiswa maupun pekerja.
                                Lingkungan aman, bersih, dan dekat
                                dengan pusat kota.
                            </p>

                        </div>

                    </div>

                </div>

            </div>

            <div>

                <div class="bg-white rounded-3xl shadow-sm p-6">

                    <h3 class="text-xl font-bold text-gray-800 mb-6">
                        Informasi Sewa
                    </h3>

                    <div class="space-y-5">

                        <div>
                            <p class="text-sm text-gray-500">
                                Harga Sewa
                            </p>

                            <h4 class="text-xl font-bold text-gray-800 mt-1">
                                Rp 1.500.000 / bulan
                            </h4>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">
                                Tanggal Masuk
                            </p>

                            <h4 class="text-lg font-semibold text-gray-800 mt-1">
                                12 Januari 2025
                            </h4>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">
                                Status
                            </p>

                            <span class="inline-block mt-2 bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm">
                                Sedang Ditempati
                            </span>
                        </div>

                    </div>

                    <div class="mt-8">

                        <a href="{{ route('tenant.payment') }}"
                            class="w-full flex items-center justify-center bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-2xl transition duration-300">
                            Bayar Tagihan
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection