@extends('layouts.admin.app')

@section('title', 'Data Room Tenant')

@section('content')

    <div class="bg-white rounded-2xl shadow-sm p-6">

        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-bold">Data Room Tenant</h1>
                <p class="text-gray-500">Daftar penempatan kamar untuk tenant</p>
            </div>

            <a href="{{ route('admin.room-tenants.create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                + Tambah Data
            </a>
        </div>

        @if(count($roomTenants) > 0)
            <div class="overflow-x-auto">
                <table class="w-full">

                    <thead>
                        <tr class="bg-gray-100">
                            <th class="p-3 text-left">No</th>
                            <th class="p-3 text-left">Kamar</th>
                            <th class="p-3 text-left">Tenant</th>
                            <th class="p-3 text-left">Tanggal Masuk</th>
                            <th class="p-3 text-left">Tanggal Keluar</th>
                            <th class="p-3 text-left">Status</th>
                            <th class="p-3 text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($roomTenants as $index => $item)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="p-3">{{ $index + 1 }}</td>
                                <td class="p-3 font-semibold">{{ $item->room->room_number }}</td>
                                <td class="p-3">{{ $item->tenant->user->name ?? $item->tenant->name }}</td>
                                <td class="p-3">{{ is_string($item->start_date) ? \Carbon\Carbon::parse($item->start_date)->format('d/m/Y') : ($item->start_date ? $item->start_date->format('d/m/Y') : '-') }}</td>
                                <td class="p-3">{{ is_string($item->end_date) ? \Carbon\Carbon::parse($item->end_date)->format('d/m/Y') : ($item->end_date ? $item->end_date->format('d/m/Y') : '-') }}</td>
                                <td class="p-3">
                                    @if($item->status === 'active')
                                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">Active</span>
                                    @else
                                        <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm">Inactive</span>
                                    @endif
                                </td>
                                <td class="p-3 text-center space-x-2">
                                    <a href="{{ route('admin.room-tenants.edit', $item->id) }}"
                                        class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.room-tenants.destroy', $item->id) }}" method="POST" class="inline"
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
            <div class="text-center py-12">
                <p class="text-gray-500 text-lg">Data belum tersedia</p>
            </div>
        @endif
    </div>

@endsection