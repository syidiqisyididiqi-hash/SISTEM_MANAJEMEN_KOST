@extends('layouts.admin.app')

@section('title', 'User Management')

@section('content')
    <div class="mb-6">
        <div class="flex justify-between items-center">
            <x-ui.page-header title="User Management" subtitle="Kelola akun admin dan tenant" />

            <a href="{{ route('admin.user.create') }}"
                class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-medium transition duration-300">
                + Tambah User
            </a>
        </div>
    </div>

    <x-ui.card>
        @if($users->isEmpty())
            <x-ui.empty-state>
                Belum ada user. <a href="{{ route('admin.user.create') }}" class="text-blue-600 font-medium">Buat user baru</a>
            </x-ui.empty-state>
        @else
            <x-ui.table>
                <thead>
                    <tr class="border-b">
                        <th class="text-left py-3 px-4 font-semibold">Nama</th>
                        <th class="text-left py-3 px-4 font-semibold">Email</th>
                        <th class="text-left py-3 px-4 font-semibold">Role</th>
                        <th class="text-left py-3 px-4 font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr class="border-b hover:bg-gray-50 transition">
                            <td class="py-3 px-4">
                                <span class="font-medium text-gray-800">{{ $user->name }}</span>
                            </td>
                            <td class="py-3 px-4">
                                <span class="text-gray-600">{{ $user->email }}</span>
                            </td>
                            <td class="py-3 px-4">
                                <x-ui.badge color="{{ $user->role === 'admin' ? 'blue' : 'green' }}">
                                    {{ ucfirst($user->role) }}
                                </x-ui.badge>
                            </td>
                            <td class="py-3 px-4">
                                <div class="flex gap-2">
                                    <a href="{{ route('admin.user.edit', $user) }}"
                                        class="px-3 py-1 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg text-sm font-medium transition duration-300">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.user.destroy', $user) }}" method="POST" class="inline"
                                        onsubmit="return confirm('Yakin hapus user ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="px-3 py-1 bg-red-500 hover:bg-red-600 text-white rounded-lg text-sm font-medium transition duration-300">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </x-ui.table>
        @endif
    </x-ui.card>

@endsection