@extends('layouts.tenant.app')

@section('content')

    <div class="container mx-auto px-4 sm:px-6 py-10 max-w-7xl">

        <div class="mb-3 pb-3 border-b border-gray-100">
            <div class="flex items-start gap-4">
                
                <div class="p-3 bg-blue-50 text-blue-600 rounded-2xl hidden sm:block">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5m0 0v-5a2 2 0 012-2h2a2 2 0 012 2v5m-6 0h6" />
                    </svg>
                </div>

                <div>
                    <h1 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
                        Eksplorasi Kamar
                    </h1>
                    <p class="text-gray-500 mt-1.5 text-sm sm:text-base max-w-2xl leading-relaxed">
                        Temukan dan pilih hunian terbaik yang dirancang khusus untuk kenyamanan, fleksibilitas, dan
                        ketenangan Anda.
                    </p>
                </div>
            </div>
        </div>

        <form action="{{ route('tenant.rooms.index') }}" method="GET" class="mb-10">
            <div
                class="bg-white p-4 sm:p-5 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow duration-200">
                <div class="flex flex-col md:flex-row items-center gap-3">

                    <div class="relative flex-1 w-full">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari nomor kamar atau deskripsi..."
                            class="w-full pl-10 pr-4 py-2.5 bg-gray-50/50 hover:bg-white border border-gray-200 rounded-xl text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all">
                    </div>

                    <div class="relative w-full md:w-56">
                        <select name="status"
                            class="w-full px-4 py-2.5 bg-gray-50/50 hover:bg-white border border-gray-200 rounded-xl text-sm text-gray-700 appearance-none cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all">

                            <option value="">Semua Status</option>
                            <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>
                                Tersedia
                            </option>
                            <option value="occupied" {{ request('status') == 'occupied' ? 'selected' : '' }}>
                                Terisi
                            </option>
                            <option value="maintenance" {{ request('status') == 'maintenance' ? 'selected' : '' }}>
                                Perbaikan
                            </option>
                        </select>
                        <div class="absolute inset-y-0 right-0 pr-3.5 flex items-center pointer-events-none text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>

                    <div class="flex items-center gap-2 w-full md:w-auto">
                        <button type="submit"
                            class="flex-1 md:flex-initial inline-flex items-center justify-center px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-medium text-sm rounded-xl shadow-sm hover:shadow active:transform active:scale-[0.98] transition-all duration-150">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                            </svg>
                            Filter
                        </button>

                        @if(request('search') || request('status'))
                            <a href="{{ route('tenant.rooms.index') }}"
                                class="inline-flex items-center justify-center p-2.5 text-gray-500 bg-gray-100 hover:bg-gray-200 hover:text-gray-700 rounded-xl transition-colors"
                                title="Reset Filter">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </a>
                        @endif
                    </div>

                </div>
            </div>
        </form>

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

                                    @if($room->status == 'available')
                                    bg-green-50/90 text-green-700 border border-green-200
                                    @elseif($room->status == 'occupied')
                                    bg-blue-50/90 text-blue-700 border border-blue-200
                                    @else
                                    bg-yellow-50/90 text-yellow-700 border border-yellow-200
                                    @endif
                                    ">

                                    <span class="w-1.5 h-1.5 mr-1.5 rounded-full

                                    @if($room->status == 'available')
                                    bg-green-500
                                    @elseif($room->status == 'occupied')
                                    bg-blue-500
                                    @else
                                    bg-yellow-500
                                    @endif
                                    ">
                                    </span>

                                    @if($room->status == 'available')
                                        Tersedia
                                    @elseif($room->status == 'occupied')
                                        Terisi
                                    @else
                                        Perbaikan
                                    @endif

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

            <div class="mt-10 flex justify-center">
                {{ $rooms->onEachSide(1)->links() }}
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