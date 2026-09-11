@extends('layouts.tenant.app')

@section('content')

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

<div class="mb-6 flex items-center justify-between">
    <div>
        <h1 class="text-2xl font-bold text-gray-900 tracking-tight">
            Edit Profile
        </h1>

        <p class="text-sm text-gray-500 mt-1">
            Perbarui informasi data pribadi dan akun tenant Anda.
        </p>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8">

    <form
        id="updateProfileForm"
        action="{{ route('tenant.profile.update') }}"
        method="POST"
    >

        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <div>
                <label
                    for="name"
                    class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-2"
                >
                    Nama Lengkap
                </label>

                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                            />
                        </svg>
                    </span>

                    <input
                        id="name"
                        type="text"
                        name="name"
                        value="{{ old('name', $user->name) }}"
                        class="w-full rounded-xl border border-gray-300 pl-11 pr-4 py-3 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all @error('name') border-red-500 focus:ring-red-500 @enderror"
                    >
                </div>

                @error('name')
                    <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1">
                        <span>⚠️</span> {{ $message }}
                    </p>
                @enderror
            </div>

            <div>
                <label
                    for="email"
                    class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-2"
                >
                    Email
                </label>

                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                            />
                        </svg>
                    </span>

                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email', $user->email) }}"
                        class="w-full rounded-xl border border-gray-300 pl-11 pr-4 py-3 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all @error('email') border-red-500 focus:ring-red-500 @enderror"
                    >
                </div>

                @error('email')
                    <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1">
                        <span>⚠️</span> {{ $message }}
                    </p>
                @enderror
            </div>

            <div>
                <label
                    for="phone"
                    class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-2"
                >
                    Nomor Telepon
                </label>

                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"
                            />
                        </svg>
                    </span>

                    <input
                        id="phone"
                        type="text"
                        name="phone"
                        value="{{ old('phone', $user->tenant?->phone) }}"
                        class="w-full rounded-xl border border-gray-300 pl-11 pr-4 py-3 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all @error('phone') border-red-500 focus:ring-red-500 @enderror"
                    >
                </div>

                @error('phone')
                    <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1">
                        <span>⚠️</span> {{ $message }}
                    </p>
                @enderror
            </div>

            <div>
                <label
                    for="identity_number"
                    class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-2"
                >
                    Nomor KTP (NIK)
                </label>

                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"
                            />
                        </svg>
                    </span>

                    <input
                        id="identity_number"
                        type="text"
                        name="identity_number"
                        value="{{ old('identity_number', $user->tenant?->identity_number) }}"
                        class="w-full rounded-xl border border-gray-300 pl-11 pr-4 py-3 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all @error('identity_number') border-red-500 focus:ring-red-500 @enderror"
                    >
                </div>

                @error('identity_number')
                    <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1">
                        <span>⚠️</span> {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="md:col-span-2">

                <label
                    for="address"
                    class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-2"
                >
                    Alamat Lengkap
                </label>

                <div class="relative">

                    <span class="absolute top-3.5 left-3.5 pointer-events-none text-gray-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"
                            />
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"
                            />
                        </svg>
                    </span>

                    <textarea
                        id="address"
                        name="address"
                        rows="3"
                        class="w-full rounded-xl border border-gray-300 pl-11 pr-4 py-3 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all @error('address') border-red-500 focus:ring-red-500 @enderror"
                    >{{ old('address', $user->tenant?->address) }}</textarea>

                </div>

                @error('address')
                    <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1">
                        <span>⚠️</span> {{ $message }}
                    </p>
                @enderror

            </div>

        </div>


        <div class="border-t border-gray-100 my-8"></div>


        <div class="flex items-center justify-end gap-3">

            <a
                href="{{ route('tenant.profile.index') }}"
                class="px-5 py-2.5 rounded-xl text-sm font-medium bg-gray-100 text-gray-700 hover:bg-gray-200 transition-all"
            >
                Batal
            </a>

                  <button type="submit" class="px-5 py-2.5 rounded-xl text-sm font-medium bg-indigo-600 text-white hover:bg-indigo-700 shadow-sm transition-all">
                    Simpan Perubahan
                </button>
        </div>

    </form>

</div>
</div>

<script>
    document.getElementById('updateProfileForm').addEventListener('submit', function (e) {

        e.preventDefault();

        Swal.fire({
            icon: 'question',
            title: 'Simpan Perubahan?',
            text: 'Apakah Anda yakin ingin memperbarui informasi data profil ini?',
            width: '320px',
            padding: '1.25em',
            customClass: { popup: 'tenant-alert-popup' },
            showCancelButton: true,
            confirmButtonText: 'Ya, Simpan',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#4f46e5',
            cancelButtonColor: '#6b7280',
            reverseButtons: true
        }).then((result) => {

            if (result.isConfirmed) {
                this.submit();
            }

        });

    });
</script>

@endsection
