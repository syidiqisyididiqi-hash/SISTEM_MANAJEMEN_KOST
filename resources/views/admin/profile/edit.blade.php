@extends('layouts.admin.app')

@section('title', 'Edit Profile')

@section('content')

    <x-ui.page-header title="Edit Profile" description="Perbarui informasi akun" />

    <div class="bg-white rounded-2xl shadow-sm p-6 mt-6">

        <form action="{{ route('admin.profile.update') }}" method="POST">

            @csrf
            @method('PUT')

            <div class="grid md:grid-cols-2 gap-5">

                <div>

                    <label class="block mb-2 text-sm font-medium">
                        Nama Lengkap
                    </label>

                    <input type="text" name="name" value="{{ old('name', $user->name) }}"
                        class="w-full rounded-xl border border-slate-300 px-4 py-3">

                    @error('name')
                        <p class="text-red-500 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

                <div>

                    <label class="block mb-2 text-sm font-medium">
                        Email
                    </label>

                    <input type="email" name="email" value="{{ old('email', $user->email) }}"
                        class="w-full rounded-xl border border-slate-300 px-4 py-3">

                    @error('email')
                        <p class="text-red-500 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

                <div>

                    <label class="block mb-2 text-sm font-medium">
                        Nomor Telepon
                    </label>

                    <input type="text" name="phone" value="{{ old('phone', $user->phone ?? '') }}"
                        class="w-full rounded-xl border border-slate-300 px-4 py-3">

                </div>

                <div>

                    <label class="block mb-2 text-sm font-medium">
                        Role
                    </label>

                    <input type="text" value="{{ ucfirst($user->role) }}" readonly
                        class="w-full rounded-xl border border-slate-300 bg-slate-100 px-4 py-3">

                </div>

            </div>

            <div class="mt-6 flex gap-3">

                <button type="submit" class="px-5 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white">

                    Simpan Perubahan

                </button>

                <a href="{{ route('admin.profile.index') }}" class="px-5 py-3 rounded-xl bg-slate-200 hover:bg-slate-300">

                    Batal

                </a>

            </div>

        </form>

    </div>

@endsection