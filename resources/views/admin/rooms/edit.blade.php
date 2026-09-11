@extends('layouts.admin.app')

@section('title', 'Edit Kamar')

@section('content')

    <x-ui.page-header title="Edit Kamar" description="Perbarui data kamar kost" />

    <x-ui.card>

        <form action="{{ route('admin.rooms.update', $room) }}" method="POST" enctype="multipart/form-data" id="form-edit">

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
                        Tersedia
                    </option>

                    <option value="occupied" {{ old('status', $room->status) == 'occupied' ? 'selected' : '' }}>
                        Terisi
                    </option>

                    <option value="maintenance" {{ old('status', $room->status) == 'maintenance' ? 'selected' : '' }}>
                        Perbaikan
                    </option>

                </x-ui.select>

            </x-ui.form-group>

            <x-ui.form-group label="Deskripsi / Fasilitas" name="description">
                <textarea name="description" id="description" rows="3"
                    class="w-full px-4 py-2 border rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none text-sm text-slate-700 bg-white">{{ old('description', $room->description) }}</textarea>
            </x-ui.form-group>

            <x-ui.form-group label="Foto Kamar" name="image">

                @if($room->image)
                    <div class="mb-3">
                        <p class="text-xs text-slate-500 mb-1">Foto Saat Ini:</p>
                        <img src="{{ asset('storage/' . $room->image) }}" alt="Foto Kamar"
                            class="object-cover w-32 h-32 rounded-xl border shadow-sm bg-slate-50">
                    </div>
                @endif

                <x-ui.input type="file" name="image" id="image" accept="image/*" />
                <p class="text-xs text-slate-400 mt-1">Biarkan kosong jika tidak ingin mengganti foto lama.</p>

            </x-ui.form-group>

            <div class="flex gap-3 mt-6">

                <x-ui.button type="submit">
                    Update
                </x-ui.button>

                <a href="{{ route('admin.rooms.index') }}"
                    class="px-5 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-lg font-medium inline-block text-center">
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
                text: 'Apakah Anda yakin ingin memperbarui data kamar ini?',
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