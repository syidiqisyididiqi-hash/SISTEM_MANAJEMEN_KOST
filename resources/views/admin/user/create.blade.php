@extends('layouts.admin.app')

@section('title', 'Tambah User')

@section('content')

    <x-ui.page-header title="Tambah User" description="Tambahkan akun admin atau tenant baru" />

    <x-ui.card>

        <form method="POST" action="{{ route('admin.users.store') }}"
            data-confirm="Apakah Anda yakin ingin menambahkan pengguna baru ini?"
            data-confirm-title="Konfirmasi Tambah User">

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

                <a href="{{ route('admin.users.index') }}"
                    class="px-5 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-lg font-medium inline-block text-center">
                    Kembali
                </a>
            </div>

        </form>

    </x-ui.card>

    <script>
        document.querySelectorAll('form[data-confirm]').forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault();

                const title = this.getAttribute('data-confirm-title') || 'Konfirmasi';
                const text = this.getAttribute('data-confirm');

                Swal.fire({
                    icon: 'question',
                    title: title,
                    text: text,
                    width: '400px',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Simpan',
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#2563eb',
                    cancelButtonColor: '#6b7280',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit();
                    }
                });
            });
        });
    </script>

@endsection