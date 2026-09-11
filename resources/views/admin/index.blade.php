@extends('layouts.admin.app')

@section('content')

<div class="space-y-6">

    {{-- Header --}}
    <div>
        <h1 class="text-3xl font-bold text-gray-800">
            Dashboard
        </h1>

        <p class="text-gray-500 mt-1">
            Monitoring Sistem Manajemen Kost
        </p>
    </div>

    {{-- Statistik --}}
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

        <div class="bg-white rounded-3xl shadow-sm p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">
                        Total Tenant
                    </p>

                    <h2 class="text-3xl font-bold text-gray-800 mt-2">
                        {{ $totalTenants }}
                    </h2>
                </div>

                <div
                    class="w-14 h-14 rounded-2xl bg-blue-100 flex items-center justify-center text-2xl">
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
                        {{ $totalRooms }}
                    </h2>
                </div>

                <div
                    class="w-14 h-14 rounded-2xl bg-green-100 flex items-center justify-center text-2xl">
                    🛏️
                </div>
            </div>
        </div>

        <div class="bg-white rounded-3xl shadow-sm p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">
                        Total Pembayaran
                    </p>

                    <h2 class="text-3xl font-bold text-gray-800 mt-2">
                        {{ $totalPayments }}
                    </h2>
                </div>

                <div
                    class="w-14 h-14 rounded-2xl bg-yellow-100 flex items-center justify-center text-2xl">
                    💳
                </div>
            </div>
        </div>

        <div class="bg-white rounded-3xl shadow-sm p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">
                        Total Pendapatan
                    </p>

                    <h2 class="text-2xl font-bold text-gray-800 mt-2">
                        Rp {{ number_format($totalPaidAmount, 0, ',', '.') }}
                    </h2>
                </div>

                <div
                    class="w-14 h-14 rounded-2xl bg-red-100 flex items-center justify-center text-2xl">
                    📈
                </div>
            </div>
        </div>

    </div>

    {{-- Content --}}
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

        {{-- Left --}}
        <div class="xl:col-span-2 space-y-6">

            {{-- Pembayaran --}}
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

                </div>

                <div class="overflow-x-auto">

                    <table class="w-full">

                        <thead>

                            <tr class="border-b text-left text-gray-500">

                                <th class="pb-4">Tenant</th>
                                <th class="pb-4">Kamar</th>
                                <th class="pb-4">Tanggal</th>
                                <th class="pb-4">Status</th>

                            </tr>

                        </thead>

                        <tbody class="text-gray-700">

                            @forelse($recentPayments as $payment)

                                <tr class="border-b">

                                    <td class="py-4">
                                        {{ optional(optional(optional(optional($payment->bill)->roomTenant)->tenant)->user)->name ?? 'N/A' }}
                                    </td>

                                    <td>
                                        {{ optional(optional($payment->bill)->roomTenant)->room->room_number ?? 'N/A' }}
                                    </td>

                                    <td>
                                        {{ $payment->created_at->format('d M Y') }}
                                    </td>

                                    <td>
                                        <span
                                            class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                                            Terbayar
                                        </span>
                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="4"
                                        class="py-6 text-center text-gray-500">

                                        Belum ada pembayaran

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

            {{-- Activity Log --}}
            <div class="bg-white rounded-3xl shadow-sm p-6">

                <h2 class="text-xl font-bold text-gray-800 mb-6">
                    Activity Log
                </h2>

                <div class="space-y-5">

                    @forelse($recentActivities as $activity)

                        <div class="flex items-start gap-4">

                            <div
                                class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center">
                                📋
                            </div>

                            <div>

                                <p class="text-gray-800 font-medium">
                                    {{ $activity->description }}
                                </p>

                                <p class="text-sm text-gray-500">
                                    {{ $activity->created_at->diffForHumans() }}
                                </p>

                            </div>

                        </div>

                    @empty

                        <p class="text-center text-gray-500">
                            Tidak ada aktivitas
                        </p>

                    @endforelse

                </div>

            </div>

        </div>

        {{-- Right --}}
        <div class="space-y-6">

            {{-- Status Kamar --}}
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
                                {{ $occupiedPercentage }}%
                            </span>

                        </div>

                        <div class="w-full bg-gray-200 rounded-full h-3">

                            <div
                                class="bg-green-500 h-3 rounded-full">
                            </div>

                        </div>

                    </div>

                    <div>

                        <div class="flex justify-between mb-2">

                            <span class="text-sm text-gray-600">
                                Kosong
                            </span>

                            <span class="text-sm font-semibold">
                                {{ $availablePercentage }}%
                            </span>

                        </div>

                        <div class="w-full bg-gray-200 rounded-full h-3">

                            <div
                                class="bg-yellow-500 h-3 rounded-full">
>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

            {{-- Quick Action --}}
            <div class="bg-white rounded-3xl shadow-sm p-6">

                <h2 class="text-xl font-bold text-gray-800 mb-6">
                    Quick Action
                </h2>

                <div class="space-y-4">

                    <a href="{{ route('admin.tenants.create') }}"
                        class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-2xl transition">

                        + Tambah Tenant

                    </a>

                    <a href="{{ route('admin.rooms.create') }}"
                        class="block w-full text-center bg-green-600 hover:bg-green-700 text-white py-3 rounded-2xl transition">

                        + Tambah Kamar

                    </a>

                    <a href="{{ route('admin.bills.index') }}"
                        class="block w-full text-center bg-yellow-500 hover:bg-yellow-600 text-white py-3 rounded-2xl transition">

                        Kelola Tagihan

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection