@extends('layouts.admin.app')

@section('title', 'Tambah Kamar')

@section('content')

    <x-ui.page-header title="Tambah Kamar" description="Tambahkan data kamar baru" />

    <x-ui.card>

        <form action="{{ route('admin.rooms.store') }}" method="POST">

            @csrf

            <x-ui.form-group label="Nomor Kamar" name="room_number" required>

                <x-ui.input name="room_number" placeholder="Contoh : A01" :value="old('room_number')" />

            </x-ui.form-group>

            <x-ui.form-group label="Harga Per Bulan" name="price_per_month" required>

                <x-ui.input type="number" name="price_per_month" placeholder="750000" :value="old('price_per_month')" />

            </x-ui.form-group>

            <x-ui.form-group label="Status" name="status" required>

                <x-ui.select id="status" name="status">

                    <option value="">
                        Pilih Status
                    </option>

                    <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>
                        Available
                    </option>

                    <option value="occupied" {{ old('status') == 'occupied' ? 'selected' : '' }}>
                        Occupied
                    </option>

                    <option value="maintenance" {{ old('status') == 'maintenance' ? 'selected' : '' }}>
                        Maintenance
                    </option>

                </x-ui.select>

            </x-ui.form-group>

            <div class="flex gap-3">

                <x-ui.button type="submit">
                    Simpan
                </x-ui.button>

                <!-- <a href="{{ route('admin.rooms.index') }}">

                        <x-ui.button color="secondary">
                            Batal
                        </x-ui.button>

                    </a> -->

                <a href="{{ route('admin.rooms.index') }}"
                    class="px-5 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-lg font-medium inline-block text-center">
                    Kembali
                </a>

            </div>

        </form>

    </x-ui.card>

@endsection