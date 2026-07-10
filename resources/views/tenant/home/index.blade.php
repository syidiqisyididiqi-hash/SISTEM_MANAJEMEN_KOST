@extends('layouts.tenant.app')

@section('title', 'Home')

@section('content')

    <div class="relative bg-gradient-to-b from-blue-50/50 via-white to-white overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-20 pb-16 text-center relative z-10">
            <span
                class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold bg-blue-50 text-blue-600 mb-4 tracking-wide uppercase">
                ✨ Hunian Nyaman & Strategis
            </span>
            <h1
                class="text-4xl sm:text-5xl font-black text-gray-900 tracking-tight max-w-3xl mx-auto leading-tight sm:leading-none mb-6">
                Selamat Datang di <span
                    class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600">Sistem Penyewaan
                    Kos</span>
            </h1>
            <p class="text-base sm:text-lg text-gray-500 max-w-2xl mx-auto mb-10 leading-relaxed">
                Temukan kamar kost yang nyaman, aman, dan telah dilengkapi fasilitas terbaik untuk mendukung produktivitas
                dan kenyamanan hidup Anda.
            </p>
            <div class="flex justify-center">
                <a href="{{ route('tenant.rooms.index') }}"
                    class="px-8 py-3.5 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl shadow-lg shadow-blue-200 transition-all transform hover:-translate-y-0.5">
                    Lihat Kamar Tersedia
                </a>
            </div>
        </div>
        <div
            class="absolute inset-x-0 top-0 h-40 bg-gradient-to-b from-blue-100/20 to-transparent blur-3xl pointer-events-none">
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center mb-24">
            <div class="lg:col-span-5">
                <span class="text-xs font-bold text-blue-600 tracking-widest uppercase block mb-2">Siapa Kami</span>
                <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight mb-4">Tentang Kami</h2>
                <p class="text-gray-500 leading-relaxed">
                    Kami berkomitmen menyediakan berbagai pilihan kamar kost dengan standar fasilitas lengkap, jaminan
                    keamanan tinggi, serta lokasi yang sangat strategis dekat dengan pusat aktivitas Anda, namun tetap
                    mempertahankan harga yang kompetitif dan terjangkau.
                </p>
            </div>
            <div
                class="lg:col-span-7 bg-gradient-to-br from-gray-50 to-gray-100/50 border border-gray-100 p-8 rounded-3xl grid grid-cols-1 sm:grid-cols-2 gap-6 shadow-sm">
                <div class="p-5 bg-white rounded-2xl shadow-sm border border-gray-50">
                    <div class="text-xl mb-3">📍</div>
                    <h3 class="font-bold text-gray-900 text-sm mb-1">Lokasi Strategis</h3>
                    <p class="text-xs text-gray-400">Akses mudah ke transportasi publik, kampus, dan pusat kuliner.</p>
                </div>
                <div class="p-5 bg-white rounded-2xl shadow-sm border border-gray-50">
                    <div class="text-xl mb-3">🔒</div>
                    <h3 class="font-bold text-gray-900 text-sm mb-1">Aman & Terjaga</h3>
                    <p class="text-xs text-gray-400">Sistem keamanan mumpuni demi ketenangan tinggal Anda.</p>
                </div>
            </div>
        </div>

        <div class="mb-24">
            <div class="text-center max-w-2xl mx-auto mb-12">
                <span class="text-xs font-bold text-blue-600 tracking-widest uppercase block mb-2">Kenyamanan
                    Prioritas</span>
                <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Fasilitas Utama</h2>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                <div
                    class="flex flex-col items-center text-center p-6 bg-white border border-gray-100 rounded-2xl shadow-sm hover:shadow-md transition-shadow">
                    <div
                        class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center text-xl font-bold mb-4">
                        🌐</div>
                    <span class="font-semibold text-gray-800 text-sm">WiFi Gratis</span>
                </div>
                <div
                    class="flex flex-col items-center text-center p-6 bg-white border border-gray-100 rounded-2xl shadow-sm hover:shadow-md transition-shadow">
                    <div
                        class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center text-xl font-bold mb-4">
                        🚗</div>
                    <span class="font-semibold text-gray-800 text-sm">Parkiran Luas</span>
                </div>
                <div
                    class="flex flex-col items-center text-center p-6 bg-white border border-gray-100 rounded-2xl shadow-sm hover:shadow-md transition-shadow">
                    <div
                        class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center text-xl font-bold mb-4">
                        🚿</div>
                    <span class="font-semibold text-gray-800 text-sm">Kamar Mandi Dalam</span>
                </div>
                <div
                    class="flex flex-col items-center text-center p-6 bg-white border border-gray-100 rounded-2xl shadow-sm hover:shadow-md transition-shadow">
                    <div
                        class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center text-xl font-bold mb-4">
                        🧺</div>
                    <span class="font-semibold text-gray-800 text-sm">Laundry</span>
                </div>
                <div
                    class="flex flex-col items-center text-center p-6 bg-white border border-gray-100 rounded-2xl shadow-sm hover:shadow-md transition-shadow col-span-2 md:col-span-1 mx-auto w-full max-w-xs md:max-w-none">
                    <div
                        class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center text-xl font-bold mb-4">
                        🛡️</div>
                    <span class="font-semibold text-gray-800 text-sm">Keamanan 24 Jam</span>
                </div>
            </div>
        </div>

        <div
            class="bg-gradient-to-r from-blue-600 to-indigo-600 rounded-3xl p-8 sm:p-12 text-white shadow-xl shadow-blue-100 flex flex-col md:flex-between md:items-center gap-8 md:grid md:grid-cols-12 mb-24">
            <div class="md:col-span-8">
                <h2 class="text-2xl sm:text-3xl font-extrabold tracking-tight mb-3">Informasi Ketersediaan Kamar</h2>
                <p class="text-blue-100 text-sm sm:text-base max-w-xl leading-relaxed">
                    Jangan sampai kehabisan. Akses halaman daftar kamar sekarang juga untuk memantau variasi harga,
                    kelengkapan fasilitas, dan ketersediaan unit secara langsung.
                </p>
            </div>
            <div class="md:col-span-4 flex md:justify-end items-center">
                <a href="{{ route('tenant.rooms.index') }}"
                    class="px-6 py-3.5 bg-white text-blue-600 font-bold rounded-xl shadow-md hover:bg-blue-50 transition-colors text-sm w-full md:w-auto text-center">
                    Lihat Semua Kamar
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-stretch">
            <div class="bg-white border border-gray-100 shadow-sm p-8 rounded-3xl flex flex-col justify-between">
                <div>
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-8 h-8 bg-amber-50 text-amber-600 rounded-lg flex items-center justify-center text-sm">
                            📢</div>
                        <h2 class="text-xl font-bold text-gray-900 tracking-tight">Pengumuman Terbaru</h2>
                    </div>
                    <div class="bg-gray-50/50 border border-dashed border-gray-200 rounded-2xl p-6 text-center py-10">
                        <p class="text-gray-400 text-sm font-medium">Belum ada pengumuman terbaru saat ini.</p>
                    </div>
                </div>
            </div>

            <div class="bg-white border border-gray-100 shadow-sm p-8 rounded-3xl">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-8 h-8 bg-blue-50 text-blue-600 rounded-lg flex items-center justify-center text-sm">📞
                    </div>
                    <h2 class="text-xl font-bold text-gray-900 tracking-tight">Hubungi Kontak</h2>
                </div>
                <div class="flex flex-col gap-4">
                    <div class="flex items-start gap-4 p-4 rounded-2xl hover:bg-gray-50 transition-colors">
                        <div class="text-lg mt-0.5">✉️</div>
                        <div>
                            <span class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-0.5">Email
                                Resmi</span>
                            <span class="text-sm font-medium text-gray-800">admin@kost.com</span>
                        </div>
                    </div>
                    <div class="flex items-start gap-4 p-4 rounded-2xl hover:bg-gray-50 transition-colors">
                        <div class="text-lg mt-0.5">📞</div>
                        <div>
                            <span class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-0.5">Telepon /
                                WhatsApp</span>
                            <span class="text-sm font-medium text-gray-800">0812-3456-7890</span>
                        </div>
                    </div>
                    <div class="flex items-start gap-4 p-4 rounded-2xl hover:bg-gray-50 transition-colors">
                        <div class="text-lg mt-0.5">📍</div>
                        <div>
                            <span class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-0.5">Alamat
                                Lengkap</span>
                            <span class="text-sm font-medium text-gray-800">Bandung, Jawa Barat</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection