@extends('layouts.tenant.app')

@section('content')

<div class="space-y-8">

<div class="space-y-6">
        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-indigo-600 via-purple-600 to-blue-500 p-6 md:p-8 text-white shadow-xl">
            <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-indigo-600 via-purple-600 to-blue-500 p-6 md:p-8 text-white shadow-xl">
                <div class="relative z-10">
                    <h1 class="text-2xl md:text-3xl lg:text-4xl font-bold mb-2 tracking-tight">
                        Dashboard Tenant, {{ auth()->user()->name }}
                    </h1>

                    <p class="text-white/80 text-sm md:text-base">
                        Selamat datang kembali di sistem manajemen kos. Pantau status dan informasi sewa Anda di sini.
                    </p>

                    <div class="mt-6 flex flex-wrap gap-3">
                        <a href="{{ route('tenant.bills.index') }}" class="inline-flex items-center gap-2 rounded-xl bg-white px-5 py-2.5 text-sm font-semibold text-indigo-600 shadow-md transition-all hover:bg-gray-50 hover:scale-[1.02] active:scale-[0.98]">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.75 0V5.25A60.07 60.07 0 002.25 18.75zM2.25 18.75v-10.5a2.25 2.25 0 012.25-2.25h13.5a2.25 2.25 0 012.25 2.25v10.5m-18 0v-10.5m18 10.5v-10.5" />
                            </svg>
                            Lihat Tagihan
                        </a>

                        <a href="{{ route('tenant.announcement.index') }}" class="inline-flex items-center gap-2 rounded-xl border border-white/40 bg-white/5 backdrop-blur-sm px-5 py-2.5 text-sm font-semibold text-white transition-all hover:bg-white/15 active:scale-[0.98]">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.34 15.84c-.688-.06-1.386-.09-2.09-.09H7.5a4.5 4.5 0 110-9h.75c.704 0 1.402-.03 2.09-.09m0 9.18c.253.962.584 1.892.985 2.783.247.55.06 1.21-.41 1.551l-1.557 1.13a1.5 1.5 0 01-1.921-.144l-2.073-2.073m14.62-11.854a48.108 48.108 0 00-3.472-.375m-12.75 0c.932.128 1.856.275 2.772.441m12.75 0c.348.041.696.085 1.043.131M4.5 7.5h15m-15 0a3 3 0 00-3 3v4.5a3 3 0 003 3h1.5l3.75 3v-3h7.5a3 3 0 003-3v-4.5a3 3 0 00-3-3m-15 0h15" />
                            </svg>
                            Lihat Pengumuman
                        </a>
                    </div>
                </div>

                <div class="absolute -right-10 -top-10 h-40 w-40 rounded-full bg-white/10 blur-2xl pointer-events-none"></div>
                <div class="absolute bottom-0 left-0 h-32 w-32 rounded-full bg-white/10 blur-2xl pointer-events-none"></div>
            </div>

            <div class="absolute -right-10 -top-10 h-40 w-40 rounded-full bg-white/10 blur-2xl pointer-events-none"></div>
            <div class="absolute bottom-0 left-0 h-32 w-32 rounded-full bg-white/10 blur-2xl pointer-events-none"></div>
        </div>

        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-4">
            <div class="group relative overflow-hidden rounded-3xl border border-gray-100 bg-white p-6 shadow-sm transition-all hover:-translate-y-1 hover:shadow-md">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">
                            Status Kamar
                        </p>
                        <h2 class="mt-2 text-xl font-bold text-gray-800">
                            {{ $roomTenant ? 'Aktif' : 'Belum ada' }}
                        </h2>
                    </div>

                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-600 transition-colors group-hover:bg-emerald-600 group-hover:text-white">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="group relative overflow-hidden rounded-3xl border border-gray-100 bg-white p-6 shadow-sm transition-all hover:-translate-y-1 hover:shadow-md">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">
                            Tagihan Bulan Ini
                        </p>
                        <h2 class="mt-2 text-xl font-bold text-gray-800">
                            {{ $bill ? 'Rp ' . number_format($bill->amount + ($bill->fine_amount ?? 0), 0, ',', '.') : 'Belum ada' }}
                        </h2>
                    </div>

                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-amber-50 text-amber-600 transition-colors group-hover:bg-amber-500 group-hover:text-white">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.75 0V5.25A60.07 60.07 0 002.25 18.75zM2.25 18.75v-10.5a2.25 2.25 0 012.25-2.25h13.5a2.25 2.25 0 012.25 2.25v10.5m-18 0v-10.5m18 10.5v-10.5" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="group relative overflow-hidden rounded-3xl border border-gray-100 bg-white p-6 shadow-sm transition-all hover:-translate-y-1 hover:shadow-md">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">
                            Jatuh Tempo
                        </p>
                        <h2 class="mt-2 text-xl font-bold text-gray-800">
                            {{ $bill?->due_date?->format('d M Y') ?? 'Belum ada' }}
                        </h2>
                    </div>

                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-rose-50 text-rose-600 transition-colors group-hover:bg-rose-600 group-hover:text-white">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="group relative overflow-hidden rounded-3xl border border-gray-100 bg-white p-6 shadow-sm transition-all hover:-translate-y-1 hover:shadow-md">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">
                            Pembayaran
                        </p>
                        <h2 class="mt-2 text-xl font-bold {{ !$bill ? 'text-gray-800' : ($bill->status === 'paid' ? 'text-emerald-600' : ($bill->status === 'overdue' ? 'text-rose-600' : 'text-amber-600')) }}">
                            @if (!$bill)
                                Belum ada
                            @elseif ($bill->status === 'paid')
                                Lunas
                            @elseif ($bill->status === 'overdue')
                                Terlambat
                            @else
                                Belum dibayar
                            @endif
                        </h2>
                    </div>

                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-50 text-blue-600 transition-colors group-hover:bg-blue-600 group-hover:text-white">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-1 gap-6 xl:grid-cols-3">

        <div class="xl:col-span-2">
            <div class="rounded-3xl bg-white p-6 md:p-8 shadow-sm border border-gray-100 transition-all hover:shadow-md">
                <div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div>
                        <h2 class="text-xl font-bold text-gray-900 tracking-tight">
                            Informasi Kamar
                        </h2>
                        <p class="text-sm text-gray-500 mt-0.5">
                            Detail informasi kamar tenant saat ini
                        </p>
                    </div>

                    <span class="inline-flex items-center gap-1.5 rounded-full px-4 py-1.5 text-xs font-medium {{ $roomTenant ? 'bg-emerald-50 text-emerald-700 border border-emerald-200/60' : 'bg-amber-50 text-amber-700 border border-amber-200/60' }}">
                        <span class="h-1.5 w-1.5 rounded-full {{ $roomTenant ? 'bg-emerald-500' : 'bg-amber-500' }}"></span>
                        {{ $roomTenant ? 'Aktif' : 'Belum ada penyewaan' }}
                    </span>
                </div>

                <div class="grid grid-cols-1 gap-4 sm:gap-5 md:grid-cols-2">
                    <div class="group relative overflow-hidden rounded-2xl bg-gray-50/70 p-5 border border-gray-100 transition-all hover:bg-white hover:border-blue-100 hover:shadow-sm">
                        <div class="flex items-center gap-3">
                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-blue-600 transition-colors group-hover:bg-blue-600 group-hover:text-white">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-gray-400 uppercase tracking-wider">
                                    Nomor Kamar
                                </p>
                                <h3 class="mt-0.5 text-base font-bold text-gray-800">
                                    {{ $roomTenant?->room?->room_number ?? 'Belum ada' }}
                                </h3>
                            </div>
                        </div>
                    </div>

                    <div class="group relative overflow-hidden rounded-2xl bg-gray-50/70 p-5 border border-gray-100 transition-all hover:bg-white hover:border-blue-100 hover:shadow-sm">
                        <div class="flex items-center gap-3">
                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-blue-600 transition-colors group-hover:bg-blue-600 group-hover:text-white">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-gray-400 uppercase tracking-wider">
                                    Batas Sewa
                                </p>
                                <h3 class="mt-0.5 text-base font-bold text-gray-800">
                                    {{ $roomTenant?->end_date?->format('d M Y') ?? 'Belum ada' }}
                                </h3>
                            </div>
                        </div>
                    </div>

                    <div class="group relative overflow-hidden rounded-2xl bg-gray-50/70 p-5 border border-gray-100 transition-all hover:bg-white hover:border-blue-100 hover:shadow-sm">
                        <div class="flex items-center gap-3">
                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-blue-600 transition-colors group-hover:bg-blue-600 group-hover:text-white">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-gray-400 uppercase tracking-wider">
                                    Check In
                                </p>
                                <h3 class="mt-0.5 text-base font-bold text-gray-800">
                                    {{ $roomTenant?->start_date?->format('d M Y') ?? 'Belum ada' }}
                                </h3>
                            </div>
                        </div>
                    </div>

                    <div class="group relative overflow-hidden rounded-2xl bg-gray-50/70 p-5 border border-gray-100 transition-all hover:bg-white hover:border-blue-100 hover:shadow-sm">
                        <div class="flex items-center gap-3">
                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-blue-600 transition-colors group-hover:bg-blue-600 group-hover:text-white">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-gray-400 uppercase tracking-wider">
                                    Durasi Sewa
                                </p>
                                <h3 class="mt-0.5 text-base font-bold text-gray-800">
                                    {{ $roomTenant?->duration_month ? $roomTenant->duration_month . ' Bulan' : 'Belum ada' }}
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <div class="rounded-3xl bg-white p-6 md:p-8 shadow-sm border border-gray-100">
                <div class="mb-6 flex items-center justify-between">
                    <h2 class="text-xl font-bold text-gray-900 tracking-tight">
                        Aktivitas Terbaru
                    </h2>
                   
                </div>

                <div class="space-y-4">
                    @forelse ($recentPayments as $payment)
                        <div class="flex items-center justify-between p-3.5 rounded-2xl bg-gray-50/70 border border-gray-100 transition-all hover:bg-white hover:border-blue-100 hover:shadow-sm">
                            <div class="flex items-center gap-3.5">
                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                    </svg>
                                </div>

                                <div>
                                    <p class="text-sm font-bold text-gray-800">Pembayaran berhasil</p>
                                    <p class="text-xs text-gray-400 mt-0.5">
                                        {{ $payment->paid_at?->format('d M Y') ?? '-' }}
                                    </p>
                                </div>
                            </div>

                            <span class="text-sm font-bold text-emerald-600">
                                Rp {{ number_format($payment->amount, 0, ',', '.') }}
                            </span>
                        </div>
                    @empty
                        <div class="flex flex-col items-center justify-center py-8 text-center">
                            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-gray-50 text-gray-400 mb-3">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                                </svg>
                            </div>
                            <p class="text-sm font-medium text-gray-500">
                                Belum ada aktivitas pembayaran.
                            </p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

    </div>

</div>

@endsection
