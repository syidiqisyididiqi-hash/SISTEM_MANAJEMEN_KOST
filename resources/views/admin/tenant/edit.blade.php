@extends('layouts.admin.app')

@section('title', 'Edit Tenant')

@section('content')

    <x-ui.page-header title="Edit Tenant" description="Perbarui data tenant" />

    <x-ui.card>

        <form action="{{ route('admin.tenants.update', $tenant) }}" method="POST">

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

                <a href="{{ route('admin.tenants.index') }}">
                    <x-ui.button color="secondary">
                        Batal
                    </x-ui.button>
                </a>

            </div>

        </form>

    </x-ui.card>

@endsection