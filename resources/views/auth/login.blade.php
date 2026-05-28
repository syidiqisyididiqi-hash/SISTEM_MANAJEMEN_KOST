@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-slate-50 to-gray-100 px-4 py-12">
    
    <div class="w-full max-w-md bg-white rounded-2xl shadow-xl border border-gray-100 p-8 sm:p-10 transition-all duration-300 hover:shadow-2xl">

        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">
                Selamat Datang Kembali
            </h1>
            <p class="text-gray-500 mt-2 text-sm">
                Silakan masuk untuk mengakses akun kamu 👋
            </p>
        </div>

        <!-- Form -->
        <form action="{{ route('login') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Email Field -->
            <div>
                <label for="email" class="block mb-2 text-sm font-medium text-gray-700">
                    Alamat Email
                </label>
                <div class="relative">
                    <input 
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="nama@email.com"
                        required
                        autofocus
                        class="w-full border @error('email') border-red-500 focus:ring-red-500 @else border-gray-300 focus:ring-blue-500 focus:border-blue-500 @enderror rounded-xl px-4 py-3 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 transition duration-200"
                    >
                </div>
                @error('email')
                    <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password Field -->
            <div>
                <label for="password" class="block mb-2 text-sm font-medium text-gray-700">
                    Password
                </label>
                <input 
                    type="password"
                    id="password"
                    name="password"
                    placeholder="••••••••"
                    required
                    class="w-full border @error('email') border-red-500 focus:ring-red-500 @else border-gray-300 focus:ring-blue-500 focus:border-blue-500 @enderror rounded-xl px-4 py-3 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 transition duration-200"
                >
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="flex items-center justify-between text-sm">
                <div class="flex items-center">
                    <input 
                        id="remember_me" 
                        name="remember" 
                        type="checkbox" 
                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                    >
                    <label for="remember_me" class="ml-2 block text-sm text-gray-600 select-none cursor-pointer">
                        Ingat saya
                    </label>
                </div>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="font-medium text-blue-600 hover:text-blue-500 transition duration-150 ease-in-out">
                        Lupa Password?
                    </a>
                @endif
            </div>

            <!-- Submit Button -->
            <button 
                type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 px-4 rounded-xl font-semibold shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-200 transform active:scale-[0.98]"
            >
                Masuk ke Akun
            </button>

            <!-- Register Link -->
            <p class="text-center text-sm text-gray-600 pt-2">
                Belum punya akun?
                <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-500 font-semibold transition duration-150 ease-in-out">
                    Daftar sekarang
                </a>
            </p>
        </form>

    </div>

</div>
@endsection