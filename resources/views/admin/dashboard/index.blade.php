@extends('layouts.admin.app')

@section('content')

<div class="space-y-6">

    <div>
        <h1 class="text-3xl font-bold text-gray-800">
            Dashboard
        </h1>

        <p class="text-gray-500 mt-1">
            Monitoring sistem manajemen kost
        </p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

        <div class="bg-white rounded-3xl shadow-sm p-6">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-gray-500 text-sm">
                        Total Tenant
                    </p>

                    <h2 class="text-3xl font-bold text-gray-800 mt-2">
                        120
                    </h2>
                </div>

                <div class="w-14 h-14 rounded-2xl bg-blue-100 flex items-center justify-center text-2xl">
                    👤
                </div>

            </div>

        </div>
        <div class="bg-white rounded-3xl shadow-sm p-6">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-gray-500 text-sm">
                        Total Kamar
                    </p>

                    <h2 class="text-3xl font-bold text-gray-800 mt-2">
                        85
                    </h2>
                </div>

                <div class="w-14 h-14 rounded-2xl bg-green-100 flex items-center justify-center text-2xl">
                    🛏️
                </div>

            </div>

        </div>
        <div class="bg-white rounded-3xl shadow-sm p-6">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-gray-500 text-sm">
                        Pembayaran
                    </p>

                    <h2 class="text-3xl font-bold text-gray-800 mt-2">
                        74
                    </h2>
                </div>

                <div class="w-14 h-14 rounded-2xl bg-yellow-100 flex items-center justify-center text-2xl">
                    💳
                </div>

            </div>

        </div>

        <div class="bg-white rounded-3xl shadow-sm p-6">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-gray-500 text-sm">
                        Pendapatan
                    </p>

                    <h2 class="text-2xl font-bold text-gray-800 mt-2">
                        Rp 15JT
                    </h2>
                </div>

                <div class="w-14 h-14 rounded-2xl bg-red-100 flex items-center justify-center text-2xl">
                    📈
                </div>

            </div>

        </div>

    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

        <div class="xl:col-span-2 space-y-6">

            <div class="bg-white rounded-3xl shadow-sm p-6">

                <div class="flex items-center justify-between mb-6">

                    <div>
                        <h2 class="text-xl font-bold text-gray-800">
                            Pembayaran Terbaru
                        </h2>

                        <p class="text-sm text-gray-500 mt-1">
                            Aktivitas pembayaran tenant
                        </p>
                    </div>

                    <button class="text-blue-600 hover:underline text-sm">
                        Lihat Semua
                    </button>

                </div>

                <div class="overflow-x-auto">

                    <table class="w-full">

                        <thead>
                            <tr class="text-left text-gray-500 border-b">
                                <th class="pb-4">Tenant</th>
                                <th class="pb-4">Kamar</th>
                                <th class="pb-4">Tanggal</th>
                                <th class="pb-4">Status</th>
                            </tr>
                        </thead>

                        <tbody class="text-gray-700">

                            <tr class="border-b">
                                <td class="py-4">Syahid</td>
                                <td>A-01</td>
                                <td>29 Mei 2026</td>
                                <td>
                                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                                        Lunas
                                    </span>
                                </td>
                            </tr>

                            <tr class="border-b">
                                <td class="py-4">Rizky</td>
                                <td>B-02</td>
                                <td>29 Mei 2026</td>
                                <td>
                                    <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm">
                                        Pending
                                    </span>
                                </td>
                            </tr>

                            <tr>
                                <td class="py-4">Fajar</td>
                                <td>C-03</td>
                                <td>28 Mei 2026</td>
                                <td>
                                    <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">
                                        Telat
                                    </span>
                                </td>
                            </tr>

                        </tbody>

                    </table>

                </div>

            </div>

            <div class="bg-white rounded-3xl shadow-sm p-6">

                <h2 class="text-xl font-bold text-gray-800 mb-6">
                    Activity Log
                </h2>

                <div class="space-y-5">

                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center">
                            👤
                        </div>

                        <div>
                            <p class="text-gray-800 font-medium">
                                Admin menambahkan tenant baru
                            </p>

                            <p class="text-sm text-gray-500">
                                5 menit yang lalu
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center">
                            💳
                        </div>

                        <div>
                            <p class="text-gray-800 font-medium">
                                Pembayaran berhasil dikonfirmasi
                            </p>

                            <p class="text-sm text-gray-500">
                                20 menit yang lalu
                            </p>
                        </div>
                    </div>

                </div>

            </div>

        </div>

        <div class="space-y-6">

            <div class="bg-white rounded-3xl shadow-sm p-6">

                <h2 class="text-xl font-bold text-gray-800 mb-6">
                    Status Kamar
                </h2>

                <div class="space-y-5">

                    <div>
                        <div class="flex justify-between mb-2">
                            <span class="text-sm text-gray-600">
                                Terisi
                            </span>

                            <span class="text-sm font-semibold">
                                70%
                            </span>
                        </div>

                        <div class="w-full bg-gray-200 rounded-full h-3">
                            <div class="bg-green-500 h-3 rounded-full w-[70%]"></div>
                        </div>
                    </div>

                    <div>
                        <div class="flex justify-between mb-2">
                            <span class="text-sm text-gray-600">
                                Kosong
                            </span>

                            <span class="text-sm font-semibold">
                                20%
                            </span>
                        </div>

                        <div class="w-full bg-gray-200 rounded-full h-3">
                            <div class="bg-yellow-500 h-3 rounded-full w-[20%]"></div>
                        </div>
                    </div>

                    <div>
                        <div class="flex justify-between mb-2">
                            <span class="text-sm text-gray-600">
                                Maintenance
                            </span>

                            <span class="text-sm font-semibold">
                                10%
                            </span>
                        </div>

                        <div class="w-full bg-gray-200 rounded-full h-3">
                            <div class="bg-red-500 h-3 rounded-full w-[10%]"></div>
                        </div>
                    </div>

                </div>

            </div>

            <div class="bg-white rounded-3xl shadow-sm p-6">

                <h2 class="text-xl font-bold text-gray-800 mb-6">
                    Quick Action
                </h2>

                <div class="space-y-4">

                    <button class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-2xl transition">
                        + Tambah Tenant
                    </button>

                    <button class="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-2xl transition">
                        + Tambah Kamar
                    </button>

                    <button class="w-full bg-yellow-500 hover:bg-yellow-600 text-white py-3 rounded-2xl transition">
                        Generate Tagihan
                    </button>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection