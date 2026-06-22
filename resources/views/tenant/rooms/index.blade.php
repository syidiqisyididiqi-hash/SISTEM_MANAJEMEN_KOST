@extends('layouts.tenant.app')

@section('content')

    <div class="container mx-auto px-4 sm:px-6 py-10 max-w-7xl">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-10 border-b border-gray-100 pb-6">
            <div>
                <h1 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    Eksplorasi Kamar
                </h1>
                <p class="text-gray-500 mt-2 text-base">
                    Temukan dan pilih hunian terbaik yang sesuai dengan kenyamanan Anda.
                </p>
            </div>
        </div>

        @if($rooms->count())

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

                @foreach($rooms as $room)

                    <div
                        class="group bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col overflow-hidden">

                        <div class="relative h-64 overflow-hidden bg-gray-100">
                            <img src="{{ $room->image_url }}" alt="Kamar {{ $room->room_number }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition duration-500">

                            <div class="absolute top-4 right-4">
                                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold tracking-wide backdrop-blur-md shadow-sm
                                                        {{ $room->status == 'available'
                        ? 'bg-green-50/90 text-green-700 border border-green-200'
                        : 'bg-red-50/90 text-red-700 border border-red-200' }}">
                                    <span
                                        class="w-1.5 h-1.5 mr-1.5 rounded-full {{ $room->status == 'available' ? 'bg-green-500' : 'bg-red-500' }}"></span>
                                    {{ $room->status == 'available' ? 'Tersedia' : 'Penuh' }}
                                </span>
                            </div>
                        </div>

                        <div class="p-6 flex flex-col flex-1 justify-between">

                            <div>
                                <h2 class="text-xl font-bold text-gray-900 group-hover:text-blue-600 transition duration-200 mb-2">
                                    Kamar {{ $room->room_number }}
                                </h2>

                                <p class="text-gray-600 text-sm leading-relaxed mb-6 line-clamp-2">
                                    {{ $room->description ?? 'Tidak ada deskripsi mengenai fasilitas kamar ini.' }}
                                </p>
                            </div>

                            <div class="pt-4 border-t border-gray-50 flex items-center justify-between gap-4">
                                <div>
                                    <p class="text-xs text-gray-400 uppercase tracking-wider font-medium">
                                        Harga / Bulan
                                    </p>
                                    <h3 class="text-lg font-extrabold text-gray-900 mt-0.5">
                                        Rp {{ number_format($room->price_per_month, 0, ',', '.') }}
                                    </h3>
                                </div>

                                <a href="{{ route('tenant.rooms.show', $room->id) }}"
                                    class="inline-flex items-center justify-center px-4 py-2.5 bg-gray-900 hover:bg-blue-600 text-white text-sm font-semibold rounded-xl shadow-sm hover:shadow-md transition-all duration-200 group-hover:translate-x-0">
                                    Detail
                                    <svg class="w-4 h-4 ml-1.5 transform group-hover:translate-x-1 transition-transform" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                        </path>
                                    </svg>
                                </a>
                            </div>

                        </div>

                    </div>

                @endforeach

            </div>

        @else

            <div class="max-w-md mx-auto my-16 text-center bg-gray-50 rounded-2xl p-8 border border-dashed border-gray-200">
                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-400">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                        </path>
                    </svg>
                </div>
                <h2 class="text-lg font-bold text-gray-900">
                    Belum Ada Kamar Tersedia
                </h2>
                <p class="text-gray-500 text-sm mt-2 max-w-sm mx-auto">
                    Saat ini semua kamar sedang penuh atau belum ditambahkan oleh pengelola. Silakan cek kembali beberapa saat
                    lagi.
                </p>
            </div>

        @endif

    </div>

@endsection