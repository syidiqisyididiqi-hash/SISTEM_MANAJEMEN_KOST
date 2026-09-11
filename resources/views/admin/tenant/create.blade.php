@extends('layouts.admin.app')

@section('title', 'Tambah Tenant')

@section('content')

    <x-ui.page-header title="Tambah Tenant" description="Tambahkan data tenant baru" />

    <x-ui.card>

        <form id="formTambahTenant" action="{{ route('admin.tenants.store') }}" method="POST">
            @csrf

            <x-ui.form-group label="User" name="user_id" required>
                <x-ui.select id="user_id" name="user_id">

                    <option value="">
                        Pilih User
                    </option>

                    @if(isset($users))
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">
                                {{ $user->name }}
                            </option>
                        @endforeach
                    @endif

                </x-ui.select>
            </x-ui.form-group>

            <x-ui.form-group label="Nomor HP" name="phone">
                <x-ui.input id="phone" name="phone" :value="old('phone')" />
            </x-ui.form-group>

            <x-ui.form-group label="Nomor KTP" name="identity_number">
                <x-ui.input id="identity_number" name="identity_number" :value="old('identity_number')" />
            </x-ui.form-group>

            <x-ui.form-group label="Alamat" name="address">
                <x-ui.textarea id="address" name="address">{{ old('address') }}</x-ui.textarea>
            </x-ui.form-group>

            <div class="flex gap-3">

                <x-ui.button type="submit">
                    Simpan
                </x-ui.button>

                <a href="{{ route('admin.tenants.index') }}"
                    class="px-5 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-lg font-medium inline-block text-center transition-colors">
                    Kembali
                </a>

            </div>

        </form>

    </x-ui.card>

    <script>
        document.getElementById('formTambahTenant').addEventListener('submit', function (e) {
            e.preventDefault();

            Swal.fire({
                icon: 'question',
                title: 'Konfirmasi',
                text: 'Apakah Anda yakin ingin menambahkan data tenant ini?',
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