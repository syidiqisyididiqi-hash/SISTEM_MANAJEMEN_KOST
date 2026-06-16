@extends('layouts.admin.app')

@section('title', 'Data Kamar')

@section('content')

    <x-ui.page-header title="Data Kamar" description="Kelola seluruh data kamar kost" />

    @if(session('success'))
        <x-ui.alert>
            {{ session('success') }}
        </x-ui.alert>
    @endif

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
                            Nomor Kamar
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
                                Rp {{ number_format($room->price_per_month, 0, ',', '.') }}
                            </td>

                            <td class="px-6 py-4">

                                @if($room->status === 'available')

                                    <x-ui.badge class="bg-green-100 text-green-700">
                                        Available
                                    </x-ui.badge>

                                @elseif($room->status === 'occupied')

                                    <x-ui.badge class="bg-blue-100 text-blue-700">
                                        Occupied
                                    </x-ui.badge>

                                @else

                                    <x-ui.badge class="bg-gray-100 text-gray-700">
                                        Maintenance
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

                                    <form action="{{ route('admin.rooms.destroy', $room) }}" method="POST" class="inline"
                                        onsubmit="return confirm('Yakin ingin menghapus kamar ini?');">

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

@endsection