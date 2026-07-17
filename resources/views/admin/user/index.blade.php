@extends('layouts.admin.app')

@section('title', 'User Management')

@section('content')

    <x-ui.page-header title="User Management" description="Kelola akun admin dan tenant" />

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

            <a href="{{ route('admin.users.create') }}">
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

                                    <a href="{{ route('admin.users.edit', $user) }}">
                                        <x-ui.button>
                                            Edit
                                        </x-ui.button>
                                    </a>

                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline"
                                        data-confirm="Apakah Anda yakin ingin menghapus user {{ $user->name }}? Data yang dihapus tidak dapat dikembalikan."
                                        data-confirm-title="Konfirmasi Hapus User" data-confirm-type="warning"
                                        data-confirm-button-color="#dc2626">

                                        @csrf
                                        @method('DELETE')

                                        <x-ui.button type="submit" class="bg-red-500 hover:bg-red-600 text-white">
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

                <a href="{{ route('admin.users.create') }}">
                    <x-ui.button>
                        + Tambah User
                    </x-ui.button>
                </a>

            </div>

        @endif

    </x-ui.card>
    <script>
        document.addEventListener('submit', function (e) {
            const form = e.target;

            if (form.hasAttribute('data-confirm')) {
                e.preventDefault();

                const title = form.getAttribute('data-confirm-title') || 'Konfirmasi';
                const message = form.getAttribute('data-confirm') || 'Apakah Anda yakin ingin melanjutkan tindakan ini?';

                const iconType = form.getAttribute('data-confirm-type') || 'question';
                const confirmColor = form.getAttribute('data-confirm-button-color') || '#2563eb';

                Swal.fire({
                    icon: iconType,
                    title: title,
                    text: message,
                    width: '400px',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Lanjutkan',
                    cancelButtonText: 'Batal',
                    confirmButtonColor: confirmColor,
                    cancelButtonColor: '#6b7280',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            }
        });
    </script>
@endsection