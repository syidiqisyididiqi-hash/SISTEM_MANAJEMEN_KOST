@extends('layouts.admin.app')

@section('title', 'Data Penyewa')

@section('content')

    <x-ui.page-header title="Data Tenant" description="Kelola data penghuni kost" />

    <x-ui.card>

        <div class="flex flex-col gap-4 mb-6 md:flex-row md:items-center md:justify-between">

            <div>

                <h3 class="text-xl font-semibold text-slate-800">
                    Daftar Penyewa Kost
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

        <form method="GET" class="mb-6">
            <div class="flex items-center gap-2">

                <div class="relative w-80">

                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="absolute w-4 h-4 text-gray-400 left-3 top-1/2 -translate-y-1/2" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">

                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z" />

                    </svg>

                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari tenant..."
                        class="w-full py-2 pl-9 pr-3 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none">

                </div>

                <x-ui.button type="submit" class="px-4 py-2 text-sm">
                    Cari
                </x-ui.button>

                @if(request()->filled('search'))
                    <a href="{{ route('admin.tenants.index') }}">
                        <x-ui.button type="button" class="px-4 py-2 text-sm bg-gray-500 hover:bg-gray-600 text-white">
                            Reset
                        </x-ui.button>
                    </a>
                @endif

            </div>
        </form>

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
                                {{ $tenants->firstItem() + $loop->index }}
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

                                    <a href="{{ route('admin.tenants.edit', $tenant) }}">
                                        <x-ui.button>
                                            Edit
                                        </x-ui.button>
                                    </a>

                                    <form action="{{ route('admin.tenants.destroy', $tenant) }}" method="POST" class="inline"
                                        data-confirm="Apakah Anda yakin ingin menghapus tenant {{ $tenant->user->name }}? Data yang dihapus tidak dapat dikembalikan."
                                        data-confirm-title="Konfirmasi Hapus Tenant" data-confirm-type="warning"
                                        data-confirm-button-color="#dc2626">
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

            <div class="mt-6 flex justify-center">
                {{ $tenants->withQueryString()->links() }}
            </div>

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