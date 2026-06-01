@extends('layouts.admin.app')

@section('title', 'Tambah User')

@section('content')

    <div class="bg-white rounded-2xl shadow-sm p-6 max-w-2xl">

        <h2 class="text-2xl font-bold mb-6">
            Tambah User
        </h2>

        <form method="POST" action="{{ route('admin.user.store') }}">
            @csrf

            <div class="mb-4">

                <label for="name" class="block mb-2">
                    Nama
                </label>

                <input id="name" type="text" name="name" value="{{ old('name') }}"
                    class="w-full border rounded-xl px-4 py-3" required>

                @error('name')
                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror

            </div>

            <div class="mb-4">

                <label for="email" class="block mb-2">
                    Email
                </label>

                <input id="email" type="email" name="email" value="{{ old('email') }}" autocomplete="email"
                    class="w-full border rounded-xl px-4 py-3" required>

                @error('email')
                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror

            </div>

            <div class="mb-4">

                <label for="password" class="block mb-2">
                    Password
                </label>

                <input id="password" type="password" name="password" autocomplete="new-password"
                    class="w-full border rounded-xl px-4 py-3" required>

                @error('password')
                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror

            </div>

            <div class="mb-6">

                <label for="role" class="block mb-2">
                    Role
                </label>

                <select id="role" name="role" class="w-full border rounded-xl px-4 py-3" required>
                    <option value="admin">Admin</option>
                    <option value="tenant">Tenant</option>
                </select>

                @error('role')
                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror

            </div>

            <button type="submit" class="px-5 py-3 bg-blue-600 text-white rounded-xl">
                Simpan
            </button>

        </form>

    </div>

@endsection