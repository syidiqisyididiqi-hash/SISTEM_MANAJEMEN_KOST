@extends('layouts.admin.app')

@section('title', 'Edit User')

@section('content')

    <x-ui.page-header title="Edit User" description="Perbarui data akun pengguna" />

    <x-ui.card>

        <form method="POST" action="{{ route('admin.user.update', $user) }}">

            @csrf
            @method('PUT')

            <x-ui.form-group label="Nama" name="name" required>

                <x-ui.input type="text" name="name" :value="old('name', $user->name)" />

            </x-ui.form-group>

            <x-ui.form-group label="Email" name="email" required>

                <x-ui.input type="email" name="email" :value="old('email', $user->email)" />

            </x-ui.form-group>

            <x-ui.form-group label="Role" name="role" required>

                <x-ui.select name="role">

                    <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>
                        Admin
                    </option>

                    <option value="tenant" {{ old('role', $user->role) === 'tenant' ? 'selected' : '' }}>
                        Tenant
                    </option>

                </x-ui.select>

                @error('role')
                    <p class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror

            </x-ui.form-group>

            <div class="flex gap-3 mt-6">

                <x-ui.button type="submit">
                    Update
                </x-ui.button>

                <a href="{{ route('admin.user.index') }}"
                    class="px-5 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-lg font-medium inline-block text-center">
                    Kembali
                </a>

            </div>

        </form>

    </x-ui.card>

@endsection