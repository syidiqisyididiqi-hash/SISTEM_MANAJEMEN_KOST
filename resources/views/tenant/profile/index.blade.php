@extends('layouts.tenant.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8 gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Profile Saya</h1>
            <p class="text-sm text-gray-500 mt-1">Kelola informasi akun dan data pribadi Anda secara berkala.</p>
        </div>
        <a href="{{ route('tenant.profile.edit') }}" class="inline-flex items-center justify-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium px-4 py-2.5 rounded-xl shadow-sm transition-all">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
            Edit Profile
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        <div class="lg:col-span-4">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex flex-col justify-between h-full">
                <div class="text-center">
                    <div class="w-24 h-24 bg-indigo-600 text-white rounded-full flex items-center justify-center text-3xl font-bold mx-auto shadow-inner mb-4">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>

                    <h3 class="text-lg font-bold text-gray-900">{{ auth()->user()->name }}</h3>
                    <p class="text-sm text-gray-500 mt-0.5 mb-3">{{ auth()->user()->email }}</p>
                    <span class="inline-block bg-indigo-50 text-indigo-700 text-xs font-semibold px-3 py-1 rounded-full">Tenant Account</span>
                </div>

                <div class="border-t border-gray-100 my-6"></div>

                <div class="space-y-3 text-sm">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-500">Status Akun</span>
                        <span class="bg-emerald-50 text-emerald-700 text-xs font-medium px-2.5 py-1 rounded-md">Aktif</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-500">Hak Akses</span>
                        <span class="font-semibold text-gray-900 capitalize">{{ auth()->user()->role }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-500">Bergabung</span>
                        <span class="font-semibold text-gray-900">{{ auth()->user()->created_at?->format('d M Y') ?? '-' }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="lg:col-span-8">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8">
                <h3 class="text-lg font-bold text-gray-900 mb-6">Informasi Pribadi</h3>

                @php
                    $user = auth()->user();
                    $fields = [
                        ['label' => 'Nama Lengkap', 'value' => $user->name, 'icon' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z'],
                        ['label' => 'Alamat Email', 'value' => $user->email, 'icon' => 'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z'],
                        ['label' => 'Nomor Telepon', 'value' => $user->tenant?->phone ?? '-', 'icon' => 'M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z'],
                        ['label' => 'Role Akses', 'value' => ucfirst($user->role), 'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z'],
                    ];
                @endphp

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @foreach($fields as $field)
                    <div class="bg-gray-50/70 border border-gray-100 rounded-xl p-4 flex items-center gap-4">
                        <div class="w-10 h-10 bg-white text-indigo-600 rounded-lg shadow-sm flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $field['icon'] }}"/></svg>
                        </div>
                        <div class="min-w-0">
                            <span class="text-[11px] font-semibold tracking-wider text-gray-400 uppercase block">{{ $field['label'] }}</span>
                            <span class="text-sm font-semibold text-gray-800 truncate block">{{ $field['value'] }}</span>
                        </div>
                    </div>
                    @endforeach

                    <div class="sm:col-span-2 bg-gray-50/70 border border-gray-100 rounded-xl p-4 flex items-start gap-4">
                        <div class="w-10 h-10 bg-white text-indigo-600 rounded-lg shadow-sm flex items-center justify-center flex-shrink-0 mt-0.5">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </div>
                        <div>
                            <span class="text-[11px] font-semibold tracking-wider text-gray-400 uppercase block">Alamat Domisili</span>
                            <span class="text-sm font-semibold text-gray-800">{{ $user->tenant?->address ?? '-' }}</span>
                        </div>
                    </div>
                </div>

                <div class="border-t border-gray-100 my-6"></div>

                <div class="flex flex-col sm:flex-row justify-between text-xs text-gray-400 gap-2">
                    <div>Akun dibuat: <span class="font-medium text-gray-600">{{ $user->created_at?->format('d M Y, H:i') ?? '-' }}</span></div>
                    <div>Terakhir diperbarui: <span class="font-medium text-gray-600">{{ $user->updated_at?->format('d M Y, H:i') ?? '-' }}</span></div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
