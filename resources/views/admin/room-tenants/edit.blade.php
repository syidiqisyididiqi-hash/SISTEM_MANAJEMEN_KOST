@extends('layouts.admin.app')

@section('title', 'Edit Room Tenant')

@section('content')

    <div class="max-w-3xl mx-auto">

        <div class="bg-white rounded-2xl shadow-sm p-6">

            <h1 class="text-2xl font-bold mb-6">
                Edit Room Tenant
            </h1>

            <form action="{{ route('admin.room-tenants.update', $roomTenant->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block mb-2 font-medium">
                        Kamar
                    </label>

                    <select name="room_id"
                        class="w-full border rounded-lg px-4 py-2 @error('room_id') border-red-500 @enderror">
                        @foreach($rooms as $room)
                            <option value="{{ $room->id }}" {{ $roomTenant->room_id == $room->id ? 'selected' : '' }}>
                                {{ $room->room_number }}
                            </option>
                        @endforeach
                    </select>
                    @error('room_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block mb-2 font-medium">
                        Tenant
                    </label>

                    <select name="tenant_id"
                        class="w-full border rounded-lg px-4 py-2 @error('tenant_id') border-red-500 @enderror">
                        @foreach($tenants as $tenant)
                            <option value="{{ $tenant->id }}" {{ $roomTenant->tenant_id == $tenant->id ? 'selected' : '' }}>
                                {{ $tenant->user->name ?? $tenant->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('tenant_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block mb-2 font-medium">
                        Tanggal Masuk
                    </label>

                    <input type="date" name="start_date"
                        class="w-full border rounded-lg px-4 py-2 @error('start_date') border-red-500 @enderror"
                        value="{{ is_string($roomTenant->start_date) ? $roomTenant->start_date : ($roomTenant->start_date ? $roomTenant->start_date->format('Y-m-d') : '') }}">
                    @error('start_date')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block mb-2 font-medium">
                        Tanggal Keluar
                    </label>

                    <input type="date" name="end_date"
                        class="w-full border rounded-lg px-4 py-2 @error('end_date') border-red-500 @enderror"
                        value="{{ is_string($roomTenant->end_date) ? $roomTenant->end_date : ($roomTenant->end_date ? $roomTenant->end_date->format('Y-m-d') : '') }}">
                    @error('end_date')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block mb-2 font-medium">
                        Status
                    </label>

                    <select name="status"
                        class="w-full border rounded-lg px-4 py-2 @error('status') border-red-500 @enderror">
                        <option value="active" {{ $roomTenant->status == 'active' ? 'selected' : '' }}>
                            Active
                        </option>

                        <option value="inactive" {{ $roomTenant->status == 'inactive' ? 'selected' : '' }}>
                            Inactive
                        </option>
                    </select>
                    @error('status')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex gap-3">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg">
                        Update
                    </button>

                    <a href="{{ route('admin.room-tenant') }}" class="bg-gray-200 hover:bg-gray-300 px-5 py-2 rounded-lg">
                        Batal
                    </a>
                </div>
            </form>
        </div>

@endsection