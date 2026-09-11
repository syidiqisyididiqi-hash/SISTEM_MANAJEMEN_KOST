@extends('layouts.admin.app')

@section('title', 'Edit Tenant')

@section('content')

    <x-ui.page-header title="Edit Tenant" description="Perbarui data tenant" />

    <x-ui.card>

        <form action="{{ route('admin.tenants.update', $tenant) }}" method="POST" id="form-edit">
            @csrf
            @method('PUT')

            <x-ui.form-group label="Nomor HP" name="phone">
                <x-ui.input name="phone" :value="old('phone', $tenant->phone)" />
            </x-ui.form-group>

            <x-ui.form-group label="Nomor KTP" name="identity_number">
                <x-ui.input name="identity_number" :value="old('identity_number', $tenant->identity_number)" />
            </x-ui.form-group>

            <x-ui.form-group label="Alamat" name="address">
                <x-ui.textarea name="address">{{ old('address', $tenant->address) }}</x-ui.textarea>
            </x-ui.form-group>

            <div class="flex gap-3">

                <x-ui.button type="submit">
                    Update
                </x-ui.button>

                <a href="{{ route('admin.tenants.index') }}"
                    class="px-5 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-lg font-medium inline-block text-center transition-colors">
                    Kembali
                </a>

            </div>

        </form>

    </x-ui.card>

    <script>
        document.getElementById('form-edit').addEventListener('submit', function (e) {
            e.preventDefault();

            Swal.fire({
                icon: 'question',
                title: 'Simpan Perubahan?',
                text: 'Apakah Anda yakin ingin memperbarui data tenant ini?',
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
    </script>
@endsection