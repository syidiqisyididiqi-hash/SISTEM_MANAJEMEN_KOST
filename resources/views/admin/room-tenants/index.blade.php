@extends('layouts.admin.app')

@section('title', 'Data Room Tenant')

@section('content')

    <x-ui.page-header title="Data Room Tenant" description="Kelola data penempatan kamar tenant" />

    @if(session('success'))
        <x-ui.alert>
            {{ session('success') }}
        </x-ui.alert>
    @endif

    <x-ui.card>

        <div class="flex flex-col gap-4 mb-6 md:flex-row md:items-center md:justify-between">

            <div>

                <h3 class="text-xl font-semibold text-slate-800">
                    Daftar Room Tenant
                </h3>

                <p class="text-sm text-slate-500">
                    Menampilkan seluruh data penempatan kamar tenant.
                </p>

            </div>

            <a href="{{ route('admin.room-tenants.create') }}">
                <x-ui.button>
                    + Tambah Data
                </x-ui.button>
            </a>

        </div>

        @if($roomTenants->count())

            <x-ui.table>

                <thead class="bg-slate-50 border-b">

                    <tr>

                        <th class="px-6 py-4 text-left font-semibold">
                            No
                        </th>

                        <th class="px-6 py-4 text-left font-semibold">
                            Kamar
                        </th>

                        <th class="px-6 py-4 text-left font-semibold">
                            Tenant
                        </th>

                        <th class="px-6 py-4 text-left font-semibold">
                            Tanggal Masuk
                        </th>

                        <th class="px-6 py-4 text-left font-semibold">
                            Tanggal Keluar
                        </th>

                        <th class="px-6 py-4 text-left font-semibold">
                            Status
                        </th>

                        <th class="px-6 py-4 text-center font-semibold">
                            Aksi
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($roomTenants as $item)

                        <tr class="border-b hover:bg-gray-50">

                            <td class="px-6 py-4">
                                {{ $loop->iteration }}
                            </td>

                            <td class="px-6 py-4">

                                <div class="flex items-center gap-3">

                                    <div
                                        class="flex items-center justify-center w-10 h-10 font-semibold text-blue-600 bg-blue-100 rounded-full">
                                        {{ strtoupper(substr($item->room->room_number, 0, 1)) }}
                                    </div>

                                    <div>

                                        <p class="font-medium text-slate-800">
                                            Kamar {{ $item->room->room_number }}
                                        </p>

                                        <p class="text-xs text-slate-500">
                                            Room
                                        </p>

                                    </div>

                                </div>

                            </td>

                            <td class="px-6 py-4">
                                {{ $item->tenant->user->name ?? '-' }}
                            </td>

                            <td class="px-6 py-4">
                                {{ \Carbon\Carbon::parse($item->start_date)->format('d/m/Y') }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $item->end_date
                        ? \Carbon\Carbon::parse($item->end_date)->format('d/m/Y')
                        : '-' }}
                            </td>

                            <td class="px-6 py-4">

                                @if($item->status === 'active')
                                    <x-ui.badge>
                                        Active
                                    </x-ui.badge>
                                @else
                                    <x-ui.badge color="secondary">
                                        Inactive
                                    </x-ui.badge>
                                @endif

                            </td>

                            <td class="px-6 py-4">

                                <div class="flex justify-center gap-2">

                                    <a href="{{ route('admin.room-tenants.edit', $item) }}">
                                        <x-ui.button>
                                            Edit
                                        </x-ui.button>
                                    </a>

                                    <form action="{{ route('admin.room-tenants.destroy', $item) }}" method="POST" class="inline"
                                        onsubmit="return confirm('Yakin ingin menghapus data ini?');">

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

            <x-ui.empty-state title="Belum Ada Data Room Tenant"
                description="Silakan tambahkan data penempatan kamar terlebih dahulu." />

            <div class="flex justify-center mt-6">

                <a href="{{ route('admin.room-tenants.create') }}">
                    <x-ui.button>
                        + Tambah Data
                    </x-ui.button>
                </a>

            </div>

        @endif

    </x-ui.card>

@endsection