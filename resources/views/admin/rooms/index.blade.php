@extends('layouts.admin.app')

@section('title', 'Data Kamar')

@section('content')

    <x-ui.page-header title="Data Kamar" description="Kelola seluruh data kamar kost" />

    <x-ui.card>

        <div class="flex flex-col gap-4 mb-6 md:flex-row md:items-center md:justify-between">

            <div>

                <h3 class="text-xl font-semibold text-slate-800">
                    Daftar Kamar
                </h3>

                <p class="text-sm text-slate-500">
                    Menampilkan seluruh kamar yang tersedia pada kost.
                </p>

            </div>

            <a href="{{ route('admin.rooms.create') }}">
                <x-ui.button>
                    + Tambah Kamar
                </x-ui.button>
            </a>

        </div>

        @if($rooms->count())

            <x-ui.table>

                <thead class="bg-slate-50 border-b">

                    <tr>

                        <th class="px-6 py-4 text-left font-semibold">
                            No
                        </th>

                        <th class="px-6 py-4 text-left font-semibold">
                            Foto
                        </th>

                        <th class="px-6 py-4 text-left font-semibold">
                            Nomor Kamar
                        </th>

                        <th class="px-6 py-4 text-left font-semibold">
                            Deskripsi
                        </th>

                        <th class="px-6 py-4 text-left font-semibold">
                            Harga/Bulan
                        </th>

                        <th class="px-6 py-4 text-left font-semibold">
                            Status
                        </th>

                        <th class="px-6 py-4 text-left font-semibold">
                            Penghuni
                        </th>

                        <th class="px-6 py-4 text-center font-semibold">
                            Aksi
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($rooms as $room)

                        @php
                            $activeRoomTenant = $room->roomTenants->first();
                            $occupantName = $activeRoomTenant?->tenant?->user?->name ?? '-';
                        @endphp
                        <tr class="border-b hover:bg-gray-50">

                            <td class="px-6 py-4">
                                {{ $loop->iteration }}
                            </td>

                            <td class="px-6 py-4">

                                @if($room->image)

                                    <img src="{{ asset('storage/' . $room->image) }}" alt="{{ $room->room_number }}"
                                        class="object-cover w-16 h-16 rounded-xl border shadow-sm">

                                @else

                                    <div
                                        class="flex items-center justify-center w-16 h-16 text-xs text-gray-400 bg-gray-100 border rounded-xl">

                                        No Image

                                    </div>

                                @endif

                            </td>

                            <td class="px-6 py-4">

                                <div class="flex items-center gap-3">

                                    <div
                                        class="flex items-center justify-center w-10 h-10 font-semibold text-blue-600 bg-blue-100 rounded-full">

                                        {{ strtoupper(substr($room->room_number, 0, 1)) }}

                                    </div>

                                    <div>

                                        <p class="font-medium text-slate-800">
                                            {{ $room->room_number }}
                                        </p>

                                        <p class="text-xs text-slate-500">
                                            Nomor Kamar
                                        </p>

                                    </div>

                                </div>

                            </td>

                            <td class="px-6 py-4">

                                @if($room->description)

                                    <div class="max-w-xs">

                                        <p class="text-sm text-slate-600 line-clamp-2">
                                            {{ $room->description }}
                                        </p>

                                    </div>

                                @else

                                    <span class="text-slate-400 italic">
                                        Tidak ada deskripsi
                                    </span>

                                @endif

                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                Rp {{ number_format($room->price_per_month, 0, ',', '.') }}
                            </td>

                            <td class="px-6 py-4">

                                @if($room->status === 'available')

                                    <x-ui.badge class="bg-green-100 text-green-700">
                                        Tersedia
                                    </x-ui.badge>

                                @elseif($room->status === 'occupied')

                                    <x-ui.badge class="bg-blue-100 text-blue-700">
                                        Terisi
                                    </x-ui.badge>

                                @else

                                    <x-ui.badge class="bg-gray-100 text-gray-700">
                                        Perbaikan
                                    </x-ui.badge>

                                @endif

                            </td>

                            <td class="px-6 py-4">
                                {{ $occupantName }}
                            </td>

                            <td class="px-6 py-4">

                                <div class="flex justify-center gap-2">

                                    <a href="{{ route('admin.rooms.edit', $room) }}">

                                        <x-ui.button>
                                            Edit
                                        </x-ui.button>

                                    </a>

                                    <form action="{{ route('admin.rooms.destroy', $room) }}" method="POST"
                                        class="inline form-delete">

                                        @csrf
                                        @method('DELETE')

                                        <x-ui.button type="submit" color="secondary" class="bg-red-500 hover:bg-red-600 text-white">

                                            Hapus

                                        </x-ui.button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </x-ui.table>

        @else

            <x-ui.empty-state title="Belum Ada Kamar" description="Silakan tambahkan kamar terlebih dahulu." />

            <div class="flex justify-center mt-6">

                <a href="{{ route('admin.rooms.create') }}">
                    <x-ui.button>
                        + Tambah Kamar
                    </x-ui.button>
                </a>

            </div>

        @endif

    </x-ui.card>

    <script>
        document.querySelectorAll('.form-delete').forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault();

                Swal.fire({
                    icon: 'warning',
                    title: 'Hapus Data?',
                    text: 'Apakah Anda yakin ingin menghapus data kamar ini? Tindakan ini tidak bisa dibatalkan!',
                    width: '400px',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Hapus',
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#dc2626',
                    cancelButtonColor: '#6b7280',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit();
                    }
                });
            });
        });
    </script>

@endsection