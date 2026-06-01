@extends('layouts.admin.app')

@section('title', 'Data Kamar')

@section('content')

    <div class="bg-white rounded-2xl shadow-sm p-6">

        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-bold">Data Kamar</h1>
                <p class="text-gray-500">Daftar seluruh kamar kost</p>
            </div>

            <a href="{{ route('admin.rooms.create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                + Tambah Kamar
            </a>
        </div>

        @if(count($rooms) > 0)
            <div class="overflow-x-auto">
                <table class="w-full">

                    <thead>
                        <tr class="bg-gray-100">
                            <th class="p-3 text-left">No</th>
                            <th class="p-3 text-left">Nomor Kamar</th>
                            <th class="p-3 text-left">Harga/Bulan</th>
                            <th class="p-3 text-left">Status</th>
                            <th class="p-3 text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($rooms as $index => $room)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="p-3">{{ $index + 1 }}</td>
                                <td class="p-3 font-semibold">{{ $room->room_number }}</td>
                                <td class="p-3">Rp {{ number_format($room->price_per_month, 0, ',', '.') }}</td>

                                <td class="p-3">
                                    @if($room->status === 'available')
                                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">Available</span>
                                    @elseif($room->status === 'occupied')
                                        <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm">Occupied</span>
                                    @else
                                        <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm">Maintenance</span>
                                    @endif
                                </td>

                                <td class="p-3 text-center space-x-2">
                                    <a href="{{ route('admin.rooms.show', $room->id) }}"
                                        class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm">
                                        Detail
                                    </a>

                                    <a href="{{ route('admin.rooms.edit', $room->id) }}"
                                        class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.rooms.destroy', $room->id) }}" method="POST" class="inline"
                                        onsubmit="return confirm('Yakin ingin menghapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        @else
            <div class="text-center py-8">
                <p class="text-gray-500">Tidak ada data kamar</p>
            </div>
        @endif

    </div>

@endsection