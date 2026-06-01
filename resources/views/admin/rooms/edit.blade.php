@extends('layouts.admin.app')

@section('title', 'Edit Kamar')

@section('content')

    <div class="max-w-3xl mx-auto">

        <div class="bg-white rounded-2xl shadow-sm p-6">

            <h1 class="text-2xl font-bold mb-6">
                Edit Kamar
            </h1>

            <form action="{{ route('admin.rooms.update', $room->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block mb-2 font-medium">
                        Nomor Kamar
                    </label>

                    <input type="text" name="room_number" value="{{ old('room_number', $room->room_number) }}"
                        class="w-full border rounded-lg px-4 py-2 @error('room_number') border-red-500 @enderror">
                    @error('room_number')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block mb-2 font-medium">
                        Harga Per Bulan
                    </label>

                    <input type="number" name="price_per_month" value="{{ old('price_per_month', $room->price_per_month) }}"
                        class="w-full border rounded-lg px-4 py-2 @error('price_per_month') border-red-500 @enderror">
                    @error('price_per_month')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block mb-2 font-medium">
                        Status
                    </label>

                    <select name="status"
                        class="w-full border rounded-lg px-4 py-2 @error('status') border-red-500 @enderror">
                        <option value="available" {{ old('status', $room->status) === 'available' ? 'selected' : '' }}>
                            Available</option>
                        <option value="occupied" {{ old('status', $room->status) === 'occupied' ? 'selected' : '' }}>Occupied
                        </option>
                        <option value="maintenance" {{ old('status', $room->status) === 'maintenance' ? 'selected' : '' }}>
                            Maintenance</option>
                    </select>
                    @error('status')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex gap-3">
                    <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white px-5 py-2 rounded-lg">
                        Update
                    </button>

                    <a href="{{ route('admin.rooms.index') }}" class="bg-gray-200 hover:bg-gray-300 px-5 py-2 rounded-lg">
                        Batal
                    </a>
                </div>

            </form>

        </div>

    </div>

@endsection