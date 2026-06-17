@extends('layouts.admin.app')

@section('title', 'Tambah User')

@section('content')

    <x-ui.page-header title="Tambah User" description="Tambahkan akun admin atau tenant baru" />

    <x-ui.card>

        <form method="POST" action="{{ route('admin.user.store') }}">

            @csrf

            <x-ui.form-group label="Nama" name="name" required>

                <x-ui.input id="name" type="text" name="name" placeholder="Masukkan nama" :value="old('name')" />

            </x-ui.form-group>

            <x-ui.form-group label="Email" name="email" required>

                <x-ui.input id="email" type="email" name="email" placeholder="Masukkan email" :value="old('email')" />

            </x-ui.form-group>

            <x-ui.form-group label="Password" name="password" required>

                <x-ui.input id="password" type="password" name="password" placeholder="Masukkan password" />

            </x-ui.form-group>

            <x-ui.form-group label="Role" name="role" required>

                <x-ui.select id="role" name="role">

                    <option value="">
                        Pilih Role
                    </option>

                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>
                        Admin
                    </option>

                    <option value="tenant" {{ old('role') == 'tenant' ? 'selected' : '' }}>
                        Tenant
                    </option>

                </x-ui.select>

            </x-ui.form-group>

            <div class="flex gap-3">

                <x-ui.button type="submit">
                    Simpan
                </x-ui.button>

                <a href="{{ route('admin.user.index') }}"
                    class="px-5 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-lg font-medium inline-block text-center">

                    Kembali

                </a>

            </div>

        </form>

    </x-ui.card>

@endsection