@extends('layouts.admin.app')

@section('title', 'Tambah Room Tenant')

@section('content')

    <x-ui.page-header title="Tambah Room Tenant" description="Tambahkan data penempatan kamar untuk tenant" />

    <x-ui.card>

        <form id="formTambahRoomTenant" action="{{ route('admin.room-tenants.store') }}" method="POST">
            @csrf

            <x-ui.form-group label="Kamar" name="room_id" required>

                <x-ui.select id="room_id" name="room_id">

                    <option value="">
                        Pilih Kamar
                    </option>

                    @foreach($rooms as $room)
                        <option value="{{ $room->id }}" {{ old('room_id') == $room->id ? 'selected' : '' }}>
                            {{ $room->room_number }}
                        </option>
                    @endforeach

                </x-ui.select>

            </x-ui.form-group>

            <x-ui.form-group label="Tenant" name="tenant_id" required>

                <x-ui.select id="tenant_id" name="tenant_id">

                    <option value="">
                        Pilih Tenant
                    </option>

                    @foreach($tenants as $tenant)
                        <option value="{{ $tenant->id }}" {{ old('tenant_id') == $tenant->id ? 'selected' : '' }}>
                            {{ $tenant->user->name ?? $tenant->name }}
                        </option>
                    @endforeach

                </x-ui.select>

            </x-ui.form-group>

            <x-ui.form-group label="Tanggal Masuk" name="start_date" required>

                <x-ui.input type="date" id="start_date" name="start_date" :value="old('start_date', now()->format('Y-m-d'))" />

            </x-ui.form-group>

            <x-ui.form-group label="Durasi Kontrak" name="duration_month" required>

                <x-ui.select id="duration_month" name="duration_month">

                    <option value="1">1 Bulan</option>
                    <option value="3">3 Bulan</option>
                    <option value="6">6 Bulan</option>
                    <option value="12">12 Bulan</option>
                    <option value="custom">Custom</option>

                </x-ui.select>

            </x-ui.form-group>

            <div id="customDuration" class="hidden">

                <x-ui.form-group label="Durasi Custom (Bulan)" name="custom_month">

                    <x-ui.input type="number" id="custom_month" min="1" placeholder="Contoh: 18" />

                </x-ui.form-group>

            </div>

            <x-ui.form-group label="Tanggal Keluar" name="end_date">

                <x-ui.input type="date" id="end_date" name="end_date" readonly />

                <small class="text-gray-500">
                    Tanggal keluar dihitung otomatis berdasarkan tanggal masuk dan durasi kontrak.
                </small>

            </x-ui.form-group>

            <x-ui.form-group label="Status" name="status" required>

                <x-ui.select id="status" name="status">

                    <option value="active" {{ old('status', 'active') == 'active' ? 'selected' : '' }}>
                        Active
                    </option>

                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>
                        Inactive
                    </option>

                </x-ui.select>

            </x-ui.form-group>

            <div class="flex gap-3">

                <x-ui.button type="submit">
                    Simpan
                </x-ui.button>

                <a href="{{ route('admin.room-tenants.index') }}"
                    class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-lg font-medium inline-block text-center">
                    Kembali
                </a>

            </div>

        </form>

    </x-ui.card>

    <script>
        const startDate = document.getElementById('start_date');
        const duration = document.getElementById('duration_month');
        const customDiv = document.getElementById('customDuration');
        const customMonth = document.getElementById('custom_month');
        const endDate = document.getElementById('end_date');

        function calculateEndDate() {

            if (!startDate.value) return;

            let month = duration.value;

            if (month === 'custom') {

                customDiv.classList.remove('hidden');

                month = customMonth.value;

            } else {

                customDiv.classList.add('hidden');

            }

            if (!month || month <= 0) return;

            const date = new Date(startDate.value);

            date.setMonth(date.getMonth() + parseInt(month));

            endDate.value = date.toISOString().split('T')[0];

        }

        startDate.addEventListener('change', calculateEndDate);
        duration.addEventListener('change', calculateEndDate);
        customMonth.addEventListener('input', calculateEndDate);

        calculateEndDate();

        document.getElementById('formTambahRoomTenant').addEventListener('submit', function (e) {

            e.preventDefault();

            Swal.fire({
                icon: 'question',
                title: 'Konfirmasi',
                text: 'Apakah Anda yakin ingin menambahkan data room tenant ini?',
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