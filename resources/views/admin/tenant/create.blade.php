@extends('layouts.admin.app')

@section('title', 'Tambah Tenant')

@section('content')

    <x-ui.page-header title="Tambah Tenant" description="Tambahkan data tenant baru" />

    <x-ui.card>

        <form action="{{ route('admin.tenants.store') }}" method="POST">

            @csrf

            <x-ui.form-group label="User" name="user_id" required>
                <x-ui.select id="user_id" name="user_id">

                    <option value="">
                        Pilih User
                    </option>

                    @foreach($users as $user)
                        <option value="{{ $user->id }}">
                            {{ $user->name }}
                        </option>
                    @endforeach

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

                <a href="{{ route('admin.tenants.index') }}">
                    <x-ui.button color="secondary">
                        Batal
                    </x-ui.button>
                </a>

            </div>

        </form>

    </x-ui.card>

@endsection