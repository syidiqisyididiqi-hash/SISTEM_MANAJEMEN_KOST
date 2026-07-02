@extends('layouts.tenant.app')

@section('content')

    <div class="container mx-auto px-6 py-8">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">

            <div>
                <h1 class="text-3xl font-bold text-gray-800">
                    Detail Kamar
                </h1>

                <p class="text-gray-500 mt-2">
                    Informasi lengkap kamar tenant
                </p>
            </div>

            <a href="{{ route('tenant.rooms.index') }}"
                class="inline-flex items-center justify-center px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-xl transition duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">

                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />

                </svg>

                Kembali

            </a>

        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <div class="lg:col-span-2">

                <div class="bg-white rounded-3xl shadow-sm overflow-hidden">

                    <div class="h-96 overflow-hidden">
                        <img src="{{ $room->image_url }}" alt="Kamar {{ $room->room_number }}"
                            class="w-full h-full object-cover">
                    </div>

                    <div class="p-8">

                        <div class="flex items-center justify-between">

                            <div>
                                <h2 class="text-2xl font-bold text-gray-800">
                                    Kamar {{ $room->room_number }}
                                </h2>

                                @if(isset($room->floor))
                                    <p class="text-gray-500 mt-2">
                                        Lantai {{ $room->floor }}
                                    </p>
                                @endif
                            </div>

                            <span class="px-4 py-2 rounded-full text-sm font-semibold
                                @if($room->status == 'available')
                                bg-green-100 text-green-700
                                @elseif($room->status == 'occupied')
                                bg-blue-100 text-blue-700
                                @else
                                bg-yellow-100 text-yellow-700
                                @endif">

                                @if($room->status == 'available')
                                    Tersedia
                                @elseif($room->status == 'occupied')
                                    Terisi
                                @else
                                    Perbaikan
                                @endif

                            </span>

                        </div>

                        <div class="mt-10">

                            <h3 class="text-lg font-semibold text-gray-800 mb-5">
                                Fasilitas
                            </h3>

                            @if(!empty($room->facilities))

                                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">

                                    @foreach(explode(',', $room->facilities) as $facility)

                                        <div class="bg-gray-50 p-4 rounded-2xl border">
                                            {{ trim($facility) }}
                                        </div>

                                    @endforeach

                                </div>

                            @else

                                <div class="bg-gray-50 rounded-2xl p-5 text-gray-500">
                                    Belum ada informasi fasilitas.
                                </div>

                            @endif

                        </div>

                        <div class="mt-10">

                            <h3 class="text-lg font-semibold text-gray-800 mb-4">
                                Deskripsi
                            </h3>

                            <p class="text-gray-600 leading-relaxed">
                                {{ $room->description ?? 'Belum ada deskripsi untuk kamar ini.' }}
                            </p>

                        </div>

                    </div>

                </div>

            </div>

            <div>

                <div class="bg-white rounded-3xl shadow-sm p-6 sticky top-6">

                    <h3 class="text-xl font-bold text-gray-800 mb-6">
                        Informasi Kamar
                    </h3>

                    <div class="space-y-6">

                        <div>
                            <p class="text-sm text-gray-500">
                                Harga Sewa
                            </p>

                            <h4 class="text-2xl font-bold text-blue-600 mt-1">
                                Rp {{ number_format($room->price_per_month, 0, ',', '.') }}
                                <span class="text-base font-medium text-gray-500">/ bulan</span>
                            </h4>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">
                                Nomor Kamar
                            </p>

                            <h4 class="text-lg font-semibold text-gray-800 mt-1">
                                {{ $room->room_number }}
                            </h4>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">
                                Status
                            </p>

                            <span class="inline-flex mt-2 px-4 py-2 rounded-full text-sm font-semibold
                                                @if($room->status == 'available')
                                                    bg-green-100 text-green-700
                                                @elseif($room->status == 'occupied')
                                                    bg-blue-100 text-blue-700
                                                @else
                                                    bg-yellow-100 text-yellow-700
                                                @endif">

                                @if($room->status == 'available')
                                    Tersedia
                                @elseif($room->status == 'occupied')
                                    Terisi
                                @else
                                    Perbaikan
                                @endif

                            </span>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">
                                Deskripsi Singkat
                            </p>

                            <p class="text-gray-700 mt-2">
                                {{ Str::limit($room->description, 120) }}
                            </p>
                        </div>

                    </div>

                    <div class="mt-8">

                        @if($room->status == 'available')

                            <button
                                class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-2xl font-semibold transition duration-300">
                                Ajukan Sewa
                            </button>

                        @elseif($room->status == 'occupied')

                            <button disabled class="w-full bg-gray-300 text-gray-600 py-3 rounded-2xl cursor-not-allowed">
                                Kamar Sedang Terisi
                            </button>

                        @else

                            <button disabled class="w-full bg-yellow-200 text-yellow-700 py-3 rounded-2xl cursor-not-allowed">
                                Dalam Perbaikan
                            </button>

                        @endif

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection