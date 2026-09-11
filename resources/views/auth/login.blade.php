@extends('layouts.app')

@section('content')

    <div class="min-h-screen flex items-center justify-center bg-[#f3f4f6] px-4 py-12 font-sans">

        <div class="w-full max-w-md relative my-auto">

            <div class="absolute -top-12 left-1/2 -translate-x-1/2 z-20">
                <div class="w-24 h-24 bg-white rounded-full flex items-center justify-center shadow-md ring-4 ring-gray-100 transition-transform duration-300 hover:scale-105">
                    <img src="{{ asset('images/logo_login.png') }}" alt="Logo KOST" class="h-16 w-16 object-contain">
                </div>
            </div>

            <div class="bg-white rounded-3xl px-10 pb-15 pt-15 shadow-lg border border-gray-100 text-gray-800">

                <div class="text-center mb-6 mt-2">
                    <h2 class="text-2xl font-bold tracking-wide text-slate-900">
                        LOGIN KOST
                    </h2>
                    <p class="text-xs text-gray-500 mt-1">
                        Masukkan kredensial Anda untuk masuk 🔑
                    </p>
                </div>

                @if(session('success'))
                    <div class="mb-5 flex items-center gap-3 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 text-xs shadow-sm" role="alert">
                        <svg class="w-4 h-4 text-emerald-600 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block mb-1.5 text-xs font-semibold text-gray-700">
                            Username / Email
                        </label>
                        <input type="text" name="email" value="{{ old('email') }}" placeholder="contoh@gmail.com / username"
                            class="w-full bg-slate-50 text-gray-800 placeholder-gray-400 rounded-xl border border-gray-200 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent px-4 py-3 text-sm transition duration-150"
                            required autofocus>
                    </div>

                    <div>
                        <label class="block mb-1.5 text-xs font-semibold text-gray-700">
                            Password
                        </label>
                        <input type="password" name="password" placeholder="••••••••"
                            class="w-full bg-slate-50 text-gray-800 placeholder-gray-400 rounded-xl border border-gray-200 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent px-4 py-3 text-sm transition duration-150"
                            required>
                    </div>

                    <div class="flex items-center justify-between text-xs pt-2">
                        {{-- <label class="flex items-center gap-2 cursor-pointer group select-none">
                            <input type="checkbox" name="remember" class="w-4 h-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500 cursor-pointer">
                            <span class="text-gray-600 group-hover:text-gray-900 transition">Ingat Saya</span>
                        </label> --}}

                        <a href="{{ route('register') }}" class="font-semibold text-blue-600 hover:text-blue-700 transition hover:underline">
                            Belum punya akun? Register
                        </a>
                    </div>

                    <div class="pt-3.5">
                        <button type="submit" class="w-full py-3 bg-blue-600 hover:bg-blue-700 active:scale-[0.99] text-white font-semibold rounded-xl shadow-md transition-all duration-200 text-sm tracking-wide">
                            Login
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </div>

    @if($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    icon: 'error',
                    title: 'Login Gagal',
                    text: '{{ $errors->first() }}',
                    confirmButtonText: 'Coba Lagi',
                    confirmButtonColor: '#2563eb',
                    customClass: {
                        popup: 'rounded-2xl'
                    }
                });
            });
        </script>
    @endif

@endsection
