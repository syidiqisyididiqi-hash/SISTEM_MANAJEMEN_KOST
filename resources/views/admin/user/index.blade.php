@extends('layouts.admin.app')

@section('title', 'User Management')

@section('content')

    <x-ui.page-header title="User Management" description="Kelola akun admin dan tenant" />

    @if(session('success'))
        <x-ui.alert>
            {{ session('success') }}
        </x-ui.alert>
    @endif

    <x-ui.card>

        <div class="flex flex-col gap-4 mb-6 md:flex-row md:items-center md:justify-between">

            <div>

                <h3 class="text-xl font-semibold text-slate-800">
                    Daftar User
                </h3>

                <p class="text-sm text-slate-500">
                    Menampilkan seluruh akun admin dan tenant yang terdaftar.
                </p>

            </div>

            <a href="{{ route('admin.user.create') }}">
                <x-ui.button>
                    + Tambah User
                </x-ui.button>
            </a>

        </div>

        @if($users->count())

            <x-ui.table>

                <thead class="bg-slate-50 border-b">

                    <tr>

                        <th class="px-6 py-4 text-left font-semibold">
                            No
                        </th>

                        <th class="px-6 py-4 text-left font-semibold">
                            Nama
                        </th>

                        <th class="px-6 py-4 text-left font-semibold">
                            Email
                        </th>

                        <th class="px-6 py-4 text-left font-semibold">
                            Role
                        </th>

                        <th class="px-6 py-4 text-center font-semibold">
                            Aksi
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($users as $user)

                        <tr class="border-b hover:bg-gray-50">

                            <td class="px-6 py-4">
                                {{ $loop->iteration }}
                            </td>

                            <td class="px-6 py-4">

                                <div class="flex items-center gap-3">

                                    <div
                                        class="flex items-center justify-center w-10 h-10 font-semibold text-blue-600 bg-blue-100 rounded-full">

                                        {{ strtoupper(substr($user->name, 0, 1)) }}

                                    </div>

                                    <div>

                                        <p class="font-medium text-slate-800">
                                            {{ $user->name }}
                                        </p>

                                        <p class="text-xs text-slate-500">
                                            Nama User
                                        </p>

                                    </div>

                                </div>

                            </td>

                            <td class="px-6 py-4">
                                {{ $user->email }}
                            </td>

                            <td class="px-6 py-4">

                                @if($user->role === 'admin')

                                    <x-ui.badge class="bg-blue-100 text-blue-700">
                                        Admin
                                    </x-ui.badge>

                                @else

                                    <x-ui.badge class="bg-green-100 text-green-700">
                                        Tenant
                                    </x-ui.badge>

                                @endif

                            </td>

                            <td class="px-6 py-4">

                                <div class="flex justify-center gap-2">

                                    <a href="{{ route('admin.user.edit', $user) }}">
                                        <x-ui.button>
                                            Edit
                                        </x-ui.button>
                                    </a>

                                    <form action="{{ route('admin.user.destroy', $user) }}" method="POST" class="inline"
                                        onsubmit="return confirm('Yakin ingin menghapus user ini?');">

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

            <x-ui.empty-state title="Belum Ada User" description="Silakan tambahkan user terlebih dahulu." />

            <div class="flex justify-center mt-6">

                <a href="{{ route('admin.user.create') }}">
                    <x-ui.button>
                        + Tambah User
                    </x-ui.button>
                </a>

            </div>

        @endif

    </x-ui.card>

@endsection