@extends('layouts.tenant.app')

@section('content')

<div class="space-y-8">

    {{-- HEADER --}}
    <div
        class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-indigo-600 via-purple-600 to-blue-500 p-8 text-white shadow-xl">

        <div class="relative z-10">
            <h1 class="text-4xl font-bold mb-3">
                Dashboard Tenant 👋
            </h1>

            <p class="text-white/90 text-lg">
                Selamat datang kembali di sistem manajemen kos.
            </p>

            <div class="mt-6 flex flex-wrap gap-4">
                <a href="#"
                    class="rounded-xl bg-white px-5 py-3 text-sm font-semibold text-indigo-600 shadow-md transition hover:scale-105">
                    Lihat Tagihan
                </a>

                <a href="#"
                    class="rounded-xl border border-white/40 px-5 py-3 text-sm font-semibold text-white transition hover:bg-white/10">
                    Ajukan Keluhan
                </a>
            </div>
        </div>

        {{-- ORNAMEN --}}
        <div
            class="absolute -right-10 -top-10 h-40 w-40 rounded-full bg-white/10 blur-2xl">
        </div>

        <div
            class="absolute bottom-0 left-0 h-32 w-32 rounded-full bg-white/10 blur-2xl">
        </div>

    </div>

    {{-- CARD STATISTIK --}}
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-4">

        {{-- STATUS KAMAR --}}
        <div
            class="rounded-3xl border border-gray-100 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-xl">

            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">
                        Status Kamar
                    </p>

                    <h2 class="mt-2 text-2xl font-bold text-gray-800">
                        Aktif
                    </h2>
                </div>

                <div
                    class="flex h-14 w-14 items-center justify-center rounded-2xl bg-green-100 text-2xl">
                    🏠
                </div>
            </div>

        </div>

        {{-- TAGIHAN --}}
        <div
            class="rounded-3xl border border-gray-100 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-xl">

            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">
                        Tagihan Bulan Ini
                    </p>

                    <h2 class="mt-2 text-2xl font-bold text-gray-800">
                        Rp 750K
                    </h2>
                </div>

                <div
                    class="flex h-14 w-14 items-center justify-center rounded-2xl bg-yellow-100 text-2xl">
                    💳
                </div>
            </div>

        </div>

        {{-- JATUH TEMPO --}}
        <div
            class="rounded-3xl border border-gray-100 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-xl">

            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">
                        Jatuh Tempo
                    </p>

                    <h2 class="mt-2 text-2xl font-bold text-gray-800">
                        28 Mei
                    </h2>
                </div>

                <div
                    class="flex h-14 w-14 items-center justify-center rounded-2xl bg-red-100 text-2xl">
                    ⏰
                </div>
            </div>

        </div>

        {{-- STATUS PEMBAYARAN --}}
        <div
            class="rounded-3xl border border-gray-100 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-xl">

            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">
                        Pembayaran
                    </p>

                    <h2 class="mt-2 text-2xl font-bold text-green-600">
                        Lunas
                    </h2>
                </div>

                <div
                    class="flex h-14 w-14 items-center justify-center rounded-2xl bg-blue-100 text-2xl">
                    ✅
                </div>
            </div>

        </div>

    </div>

    {{-- GRID CONTENT --}}
    <div class="grid grid-cols-1 gap-6 xl:grid-cols-3">

        {{-- INFORMASI KAMAR --}}
        <div class="xl:col-span-2">

            <div class="rounded-3xl bg-white p-6 shadow-sm">

                <div class="mb-6 flex items-center justify-between">
                    <div>
                        <h2 class="text-xl font-bold text-gray-800">
                            Informasi Kamar
                        </h2>

                        <p class="text-sm text-gray-500">
                            Detail kamar tenant saat ini
                        </p>
                    </div>

                    <span
                        class="rounded-full bg-green-100 px-4 py-2 text-sm font-semibold text-green-700">
                        Aktif
                    </span>
                </div>

                <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                    <div class="rounded-2xl bg-gray-50 p-5">
                        <p class="text-sm text-gray-500">
                            Nomor Kamar
                        </p>

                        <h3 class="mt-2 text-lg font-bold text-gray-800">
                            A-12
                        </h3>
                    </div>

                    <div class="rounded-2xl bg-gray-50 p-5">
                        <p class="text-sm text-gray-500">
                            Tipe Kamar
                        </p>

                        <h3 class="mt-2 text-lg font-bold text-gray-800">
                            Premium
                        </h3>
                    </div>

                    <div class="rounded-2xl bg-gray-50 p-5">
                        <p class="text-sm text-gray-500">
                            Check In
                        </p>

                        <h3 class="mt-2 text-lg font-bold text-gray-800">
                            10 Januari 2026
                        </h3>
                    </div>

                    <div class="rounded-2xl bg-gray-50 p-5">
                        <p class="text-sm text-gray-500">
                            Durasi Sewa
                        </p>

                        <h3 class="mt-2 text-lg font-bold text-gray-800">
                            12 Bulan
                        </h3>
                    </div>

                </div>

            </div>

        </div>

        {{-- AKTIVITAS --}}
        <div>

            <div class="rounded-3xl bg-white p-6 shadow-sm">

                <h2 class="mb-6 text-xl font-bold text-gray-800">
                    Aktivitas Terbaru
                </h2>

                <div class="space-y-5">

                    <div class="flex items-start gap-4">
                        <div
                            class="flex h-10 w-10 items-center justify-center rounded-xl bg-green-100">
                            ✅
                        </div>

                        <div>
                            <p class="font-semibold text-gray-800">
                                Pembayaran berhasil
                            </p>

                            <p class="text-sm text-gray-500">
                                Pembayaran bulan Mei telah diterima
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div
                            class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-100">
                            📢
                        </div>

                        <div>
                            <p class="font-semibold text-gray-800">
                                Pengumuman baru
                            </p>

                            <p class="text-sm text-gray-500">
                                Jadwal maintenance listrik minggu depan
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div
                            class="flex h-10 w-10 items-center justify-center rounded-xl bg-yellow-100">
                            🛠️
                        </div>

                        <div>
                            <p class="font-semibold text-gray-800">
                                Keluhan diproses
                            </p>

                            <p class="text-sm text-gray-500">
                                Permintaan perbaikan AC sedang diproses
                            </p>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection