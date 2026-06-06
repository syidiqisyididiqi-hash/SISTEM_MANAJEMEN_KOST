@extends('layouts.admin.app')

@section('title', 'Data Tenant')

@section('content')

    <x-ui.page-header title="Data Tenant" description="Kelola data penghuni kost" />

    @if(session('success'))
        <x-ui.alert>
            {{ session('success') }}
        </x-ui.alert>
    @endif

    <x-ui.card>

        <div class="flex flex-col gap-4 mb-6 md:flex-row md:items-center md:justify-between">

            <div>

                <h3 class="text-xl font-semibold text-slate-800">
                    Daftar Tenant
                </h3>

                <p class="text-sm text-slate-500">
                    Menampilkan seluruh data penghuni kost yang terdaftar.
                </p>

            </div>

            <a href="{{ route('admin.tenants.create') }}">
                <x-ui.button>
                    + Tambah Tenant
                </x-ui.button>
            </a>

        </div>

        @if($tenants->count())

            <x-ui.table>

                <thead class="bg-slate-50 border-b">

                    <tr>

                        <th class="px-6 py-4 text-left font-semibold">
                            No
                        </th>

                        <th class="px-6 py-4 text-left font-semibold">
                            Nama Tenant
                        </th>

                        <th class="px-6 py-4 text-left font-semibold">
                            Email
                        </th>

                        <th class="px-6 py-4 text-left font-semibold">
                            Nomor KTP
                        </th>

                        <th class="px-6 py-4 text-left font-semibold">
                            No HP
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

                    @foreach($tenants as $tenant)

                        <tr class="border-b hover:bg-gray-50">

                            <td class="px-6 py-4">
                                {{ $loop->iteration }}
                            </td>

                            <td class="px-6 py-4">

                                <div class="flex items-center gap-3">

                                    <div
                                        class="flex items-center justify-center w-10 h-10 font-semibold text-blue-600 bg-blue-100 rounded-full">
                                        {{ strtoupper(substr($tenant->user->name, 0, 1)) }}
                                    </div>

                                    <div>

                                        <p class="font-medium text-slate-800">
                                            {{ $tenant->user->name }}
                                        </p>

                                        <p class="text-xs text-slate-500">
                                            Tenant Kost
                                        </p>

                                    </div>

                                </div>

                            </td>

                            <td class="px-6 py-4">
                                {{ $tenant->user->email }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $tenant->identity_number }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $tenant->phone }}
                            </td>

                            <td class="px-6 py-4">

                                <x-ui.badge>
                                    Aktif
                                </x-ui.badge>

                            </td>

                            <td class="px-6 py-4">

                                <div class="flex justify-center gap-2">

                                    <a href="{{ route('admin.tenants.show', $tenant) }}">
                                        <x-ui.button>
                                            Detail
                                        </x-ui.button>
                                    </a>

                                    <a href="{{ route('admin.tenants.edit', $tenant) }}">
                                        <x-ui.button>
                                            Edit
                                        </x-ui.button>
                                    </a>

                                    <form action="{{ route('admin.tenants.destroy', $tenant) }}" method="POST" class="inline"
                                        onsubmit="return confirm('Yakin ingin menghapus tenant ini?');">
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

            <x-ui.empty-state title="Belum Ada Tenant" description="Silakan tambahkan tenant terlebih dahulu." />

            <div class="flex justify-center mt-6">

                <a href="{{ route('admin.tenants.create') }}">
                    <x-ui.button>
                        + Tambah Tenant
                    </x-ui.button>
                </a>

            </div>

        @endif

    </x-ui.card>

@endsection