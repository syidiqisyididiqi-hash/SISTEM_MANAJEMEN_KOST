@extends('layouts.admin.app')

@section('title', 'Tambah Kamar')

@section('content')

    <x-ui.page-header title="Tambah Kamar" description="Tambahkan data kamar baru" />

    <x-ui.card>

        <form id="formTambahKamar" action="{{ route('admin.rooms.store') }}" method="POST" enctype="multipart/form-data">

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
                        Tersedia
                    </option>

                    <option value="occupied" {{ old('status') == 'occupied' ? 'selected' : '' }}>
                        Terisi
                    </option>

                    <option value="maintenance" {{ old('status') == 'maintenance' ? 'selected' : '' }}>
                        Perbaikan
                    </option>

                </x-ui.select>

            </x-ui.form-group>

            <x-ui.form-group label="Deskripsi Kamar" name="description">

                <textarea name="description" rows="4"
                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Contoh: Kamar luas, kamar mandi dalam, wifi gratis, lemari dan kasur tersedia...">{{ old('description') }}</textarea>

            </x-ui.form-group>

            <x-ui.form-group label="Foto Kamar" name="image">

                <input type="file" name="image" id="image" accept="image/*"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2">

                <p class="mt-2 text-xs text-gray-500">
                    Format: JPG, JPEG, PNG, WEBP (Maksimal 2MB)
                </p>

                <div class="mt-4">
                    <img id="preview-image" src="" alt="Preview"
                        class="hidden w-40 h-40 object-cover rounded-xl border shadow-sm">
                </div>

            </x-ui.form-group>

            <div class="flex gap-3">

                <x-ui.button type="submit">
                    Simpan
                </x-ui.button>

                <a href="{{ route('admin.rooms.index') }}"
                    class="px-5 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-lg font-medium inline-block text-center">

                    Kembali

                </a>

            </div>

        </form>

    </x-ui.card>

    <script>

        document.getElementById('image').addEventListener('change', function (e) {

            const preview = document.getElementById('preview-image');
            const file = e.target.files[0];

            if (file) {
                preview.src = URL.createObjectURL(file);
                preview.classList.remove('hidden');
            }

        });

        document.getElementById('formTambahKamar').addEventListener('submit', function (e) {

            e.preventDefault();

            Swal.fire({
                icon: 'question',
                title: 'Konfirmasi',
                text: 'Apakah Anda yakin ingin menambahkan data kamar ini?',
                showCancelButton: true,
                confirmButtonText: 'Ya, Simpan',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#2563eb',
                cancelButtonColor: '#ef4444',
                reverseButtons: true
            }).then((result) => {

                if (result.isConfirmed) {
                    this.submit();
                }

            });

        });
    </script>
@endsection