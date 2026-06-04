@extends('layouts.admin.app')

@section('title', 'Detail Kamar')

@section('content')

    <div class="max-w-3xl mx-auto">

        <div class="bg-white rounded-2xl shadow-sm p-6">

            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold">
                    Detail Kamar
                </h1>
            </div>

            <div class="grid grid-cols-2 gap-6">
                <div>
                    <p class="text-gray-500 text-sm mb-1">
                        Nomor Kamar
                    </p>
                    <h3 class="font-semibold text-lg">
                        {{ $room->room_number }}
                    </h3>
                </div>

                <div>
                    <p class="text-gray-500 text-sm mb-1">
                        Harga Per Bulan
                    </p>
                    <h3 class="font-semibold text-lg">
                        Rp {{ number_format($room->price_per_month, 0, ',', '.') }}
                    </h3>
                </div>

                <div>
                    <p class="text-gray-500 text-sm mb-1">
                        Status
                    </p>
                    @if($room->status === 'available')
                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">Available</span>
                    @elseif($room->status === 'occupied')
                        <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm">Occupied</span>
                    @else
                        <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm">Maintenance</span>
                    @endif
                </div>

                <div>
                    <p class="text-gray-500 text-sm mb-1">
                        Dibuat
                    </p>
                    <h3 class="font-semibold">
                        {{ $room->created_at->format('d F Y') }}
                    </h3>
                </div>
            </div>

            <div class="mt-6">
                <a href="{{ route('admin.rooms.index') }}"
                    class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-lg">
                    ← Kembali
                </a>
            </div>

        </div>

    </div>

@endsection