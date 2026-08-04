@extends('layouts.admin.app')

@section('title', 'Bills')

@section('content')

    <x-ui.page-header
        title="Data Bills"
        description="Kelola data tagihan tenant" />

    <x-ui.card>

        <div class="flex flex-col gap-4 mb-6 md:flex-row md:items-center md:justify-between">

            <div>

                <h3 class="text-xl font-semibold text-slate-800">
                    Daftar Bills
                </h3>

                <p class="text-sm text-slate-500">
                    Menampilkan seluruh data tagihan tenant.
                </p>

            </div>

            <a href="{{ route('admin.bills.create') }}">
                <x-ui.button>
                    + Tambah Bill
                </x-ui.button>
            </a>

        </div>

        <form method="GET" class="mb-6">
            <div class="flex items-center gap-2">

                <div class="relative w-80">

                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="absolute w-4 h-4 text-gray-400 left-3 top-1/2 -translate-y-1/2"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">

                        <path stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2"
                            d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z" />

                    </svg>

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Cari penyewa..."
                        class="w-full py-2 pl-9 pr-3 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none">

                </div>

                <x-ui.button type="submit" class="px-4 py-2 text-sm">
                    Cari
                </x-ui.button>

                @if(request()->filled('search'))
                    <a href="{{ route('admin.bills.index') }}">
                        <x-ui.button
                            type="button"
                            class="px-4 py-2 text-sm bg-gray-500 hover:bg-gray-600 text-white">
                            Reset
                        </x-ui.button>
                    </a>
                @endif

            </div>
        </form>

        @if($bills->count())

            <x-ui.table>

                <thead class="bg-slate-50 border-b">

                    <tr>

                        <th class="px-6 py-4 text-left font-semibold">
                            No
                        </th>

                        <th class="px-6 py-4 text-left font-semibold">
                            Penyewa Kamar
                        </th>

                        <th class="px-6 py-4 text-left font-semibold">
                            Bulan
                        </th>

                        <th class="px-6 py-4 text-left font-semibold">
                            Jumlah Tagihan
                        </th>

                        <th class="px-6 py-4 text-left font-semibold">
                            Tanggal Jatuh Tempo
                        </th>

                        <th class="px-6 py-4 text-left font-semibold">
                            Denda
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

                    @foreach($bills as $bill)

                        <tr class="border-b hover:bg-gray-50">

                            <td class="px-6 py-4">
                                {{ $bills->firstItem() + $loop->index }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $bill->roomTenant->tenant->user->name ?? '-' }}
                            </td>

                            <td class="px-6 py-4">
                                {{ \Carbon\Carbon::parse($bill->bill_month)->format('F Y') }}
                            </td>

                            <td class="px-6 py-4">
                                Rp {{ number_format($bill->amount, 0, ',', '.') }}
                            </td>

                            <td class="px-6 py-4">
                                {{ \Carbon\Carbon::parse($bill->due_date)->format('d/m/Y') }}
                            </td>

                            <td class="px-6 py-4">
                                Rp {{ number_format($bill->fine_amount, 0, ',', '.') }}
                            </td>

                            <td class="px-6 py-4">

                                @if($bill->status == 'paid')
                                    <x-ui.badge>
                                        Lunas
                                    </x-ui.badge>

                                @elseif($bill->status == 'overdue')
                                    <x-ui.badge color="secondary">
                                        Tunggakan
                                    </x-ui.badge>

                                @else
                                    <span class="inline-flex items-center px-3 py-1 text-xs font-medium text-yellow-700 bg-yellow-100 rounded-full">
                                        Belum Dibayar
                                    </span>
                                @endif

                            </td>

                            <td class="px-6 py-4">

                                <div class="flex justify-center gap-2">

                                    <a href="{{ route('admin.bills.edit', $bill) }}">
                                        <x-ui.button>
                                            Edit
                                        </x-ui.button>
                                    </a>
                                    <form action="{{ route('admin.bills.destroy', $bill) }}" method="POST" class="inline form-delete">
                                        @csrf
                                        @method('DELETE')

                                        <x-ui.button
                                            type="submit"
                                            color="secondary"
                                            class="bg-red-500 hover:bg-red-600 text-white">
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
                {{ $bills->withQueryString()->links() }}
            </div>

        @else

            <x-ui.empty-state
                title="Belum Ada Data Bills"
                description="Silakan tambahkan data tagihan terlebih dahulu." />

            <div class="flex justify-center mt-6">

                <a href="{{ route('admin.bills.create') }}">
                    <x-ui.button>
                        + Tambah Bill
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
                    title: 'Hapus Tagihan?',
                    text: 'Apakah Anda yakin ingin menghapus data tagihan ini? Aksi ini tidak dapat dibatalkan!',
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

    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                timer: 2500,
                showConfirmButton: false
            });
        </script>
    @endif
@endsection