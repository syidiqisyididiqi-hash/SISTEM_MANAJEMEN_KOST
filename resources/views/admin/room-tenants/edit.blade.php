@extends('layouts.admin.app')

@section('title', 'Edit Room Tenant')

@section('content')

    <x-ui.page-header title="Edit Room Tenant" description="Perbarui data penempatan kamar tenant" />

    <x-ui.card>

        <form action="{{ route('admin.room-tenants.update', $roomTenant) }}" method="POST">

            @csrf
            @method('PUT')

            <x-ui.form-group label="Kamar" name="room_id" required>

                <x-ui.select id="room_id" name="room_id">

                    @foreach($rooms as $room)
                        <option value="{{ $room->id }}" {{ old('room_id', $roomTenant->room_id) == $room->id ? 'selected' : '' }}>
                            {{ $room->room_number }}
                        </option>
                    @endforeach

                </x-ui.select>

            </x-ui.form-group>

            <x-ui.form-group label="Tenant" name="tenant_id" required>

                <x-ui.select id="tenant_id" name="tenant_id">

                    @foreach($tenants as $tenant)
                        <option value="{{ $tenant->id }}" {{ old('tenant_id', $roomTenant->tenant_id) == $tenant->id ? 'selected' : '' }}>
                            {{ $tenant->user->name ?? $tenant->name }}
                        </option>
                    @endforeach

                </x-ui.select>

            </x-ui.form-group>

            <x-ui.form-group label="Tanggal Masuk" name="start_date" required>

                <x-ui.input type="date" id="start_date" name="start_date" :value="old(
            'start_date',
            $roomTenant->start_date
            ? \Carbon\Carbon::parse($roomTenant->start_date)->format('Y-m-d')
            : ''
        )" />

            </x-ui.form-group>

            <x-ui.form-group label="Tanggal Keluar" name="end_date">

                <x-ui.input type="date" id="end_date" name="end_date" :value="old(
            'end_date',
            $roomTenant->end_date
            ? \Carbon\Carbon::parse($roomTenant->end_date)->format('Y-m-d')
            : ''
        )" />

            </x-ui.form-group>

            <x-ui.form-group label="Status" name="status" required>

                <x-ui.select id="status" name="status">

                    <option value="active" {{ old('status', $roomTenant->status) == 'active' ? 'selected' : '' }}>
                        Active
                    </option>

                    <option value="inactive" {{ old('status', $roomTenant->status) == 'inactive' ? 'selected' : '' }}>
                        Inactive
                    </option>

                </x-ui.select>

            </x-ui.form-group>

            <div class="flex gap-3">

                <x-ui.button type="submit">
                    Update
                </x-ui.button>

                    <a href="{{ route('admin.room-tenants.index') }}"
                        class="px-5 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-lg font-medium inline-block text-center">
                        Batal
                    </a>

            </div>

        </form>

    </x-ui.card>

@endsection




