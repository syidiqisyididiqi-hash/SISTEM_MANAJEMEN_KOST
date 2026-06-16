@extends('layouts.admin.app')

@section('title', 'Edit Kamar')

@section('content')

    <x-ui.page-header title="Edit Kamar" description="Perbarui data kamar kost" />

    <x-ui.card>

        <form action="{{ route('admin.rooms.update', $room) }}" method="POST">

            @csrf
            @method('PUT')

            <x-ui.form-group label="Nomor Kamar" name="room_number" required>

                <x-ui.input name="room_number" :value="old('room_number', $room->room_number)" />

            </x-ui.form-group>

            <x-ui.form-group label="Harga Per Bulan" name="price_per_month" required>

                <x-ui.input type="number" name="price_per_month" :value="old('price_per_month', $room->price_per_month)" />

            </x-ui.form-group>

            <x-ui.form-group label="Status" name="status" required>

                <x-ui.select name="status" id="status">

                    <option value="available" {{ old('status', $room->status) == 'available' ? 'selected' : '' }}>
                        Available
                    </option>

                    <option value="occupied" {{ old('status', $room->status) == 'occupied' ? 'selected' : '' }}>
                        Occupied
                    </option>

                    <option value="maintenance" {{ old('status', $room->status) == 'maintenance' ? 'selected' : '' }}>
                        Maintenance
                    </option>

                </x-ui.select>

            </x-ui.form-group>

            <div class="flex gap-3 mt-6">

                <x-ui.button type="submit">
                    Update
                </x-ui.button>

                <a href="{{ route('admin.rooms.index') }}"
                    class=" px-5 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-lg font-medium inline-block text-center">
                    Kembali
                </a>

            </div>

        </form>

    </x-ui.card>

@endsection