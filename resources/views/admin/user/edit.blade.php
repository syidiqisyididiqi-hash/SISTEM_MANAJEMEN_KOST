@extends('layouts.admin.app')

@section('title', 'Edit User')

@section('content')

    <x-ui.page-header title="Edit User" description="Perbarui data akun pengguna" />

    <x-ui.card>

        <form method="POST" action="{{ route('admin.users.update', $user) }}"
            data-confirm="Apakah Anda yakin ingin memperbarui data pengguna ini?" data-confirm-title="Simpan Perubahan?">

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