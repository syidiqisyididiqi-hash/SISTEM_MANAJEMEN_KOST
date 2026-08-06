@extends('layouts.tenant.app')

@section('content')

    <div class="container mx-auto px-4 sm:px-6 py-10 max-w-7xl">

        <div class="mb-8 border-b border-gray-200 pb-5">
            <h1 class="text-3xl font-bold text-gray-900">
                Tagihan Saya
            </h1>
            <p class="text-gray-500 mt-2">
                Lihat seluruh tagihan kamar Anda di sini.
            </p>
        </div>

        {{-- Search & Filter --}}
        <form method="GET" class="mb-8">
            <div class="flex flex-col md:flex-row gap-3">

                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari bulan tagihan..."
                    class="flex-1 rounded-xl border-gray-300">

                <select name="status" class="rounded-xl border-gray-300">

                    <option value="">Semua Status</option>
                    <option value="unpaid">Belum Dibayar</option>
                    <option value="paid">Sudah Dibayar</option>
                    <option value="overdue">Terlambat</option>

                </select>

                <button class="bg-gray-900 text-white px-5 rounded-xl hover:bg-blue-600">
                    Cari
                </button>

            </div>
        </form>

        @forelse($bills as $bill)

            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6 mb-5">

                <div class="flex justify-between items-start">

                    <div>

                        <h2 class="text-xl font-bold">
                            {{ $bill->bill_month->translatedFormat('F Y') }}
                        </h2>

                        <p class="text-gray-500 mt-2">
                            Kamar {{ $bill->roomTenant->room->room_number }}
                        </p>

                        <p class="mt-1">
                            Jatuh Tempo :
                            {{ $bill->due_date->format('d M Y') }}
                        </p>

                        <h3 class="text-2xl font-bold mt-4">
                            Rp {{ number_format($bill->amount, 0, ',', '.') }}
                        </h3>

                    </div>

                    <div class="text-right">

                        @if($bill->status == 'paid')

                            <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-sm">
                                Sudah Dibayar
                            </span>

                        @elseif($bill->status == 'overdue')

                            <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-sm">
                                Terlambat
                            </span>

                        @else

                            <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-sm">
                                Belum Dibayar
                            </span>

                        @endif

                        <div class="mt-5">

                            <a href="{{ route('tenant.bills.show', $bill->id) }}"
                                class="bg-gray-900 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                                Detail
                            </a>

                        </div>

                    </div>

                </div>

            </div>

        @empty

            <div class="bg-white rounded-2xl border border-dashed border-gray-300 p-10 text-center">

                <h2 class="text-xl font-semibold">
                    Belum Ada Tagihan
                </h2>

                <p class="text-gray-500 mt-2">
                    Semua tagihan Anda akan muncul di halaman ini.
                </p>

            </div>

        @endforelse

        <div class="mt-8">
            {{ $bills->links() }}
        </div>

    </div>

@endsection