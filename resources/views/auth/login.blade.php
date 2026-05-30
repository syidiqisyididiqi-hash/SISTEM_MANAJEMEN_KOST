@extends('layouts.app')

@section('content')

    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-slate-50 to-gray-100 px-4 py-12">

        <x-ui.card class="w-full max-w-md border border-gray-100 shadow-xl">

            <div class="text-center mb-8">

                <h1 class="text-3xl font-extrabold text-gray-900">
                    Silahkan Login
                </h1>

                <p class="text-gray-500 mt-2 text-sm">
                    Silakan masuk untuk mengakses akun kamu 👋
                </p>

            </div>

            <form action="{{ route('login') }}" method="POST" class="space-y-6">

                @csrf

                <div>

                    <label class="block mb-2 text-sm font-medium text-gray-700">
                        Alamat Email
                    </label>

                    <x-ui.input type="email" name="email" :value="old('email')" placeholder="nama@email.com" required
                        autofocus />

                    @error('email')
                        <p class="mt-1 text-xs text-red-500">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

                <div>

                    <label class="block mb-2 text-sm font-medium text-gray-700">
                        Password
                    </label>

                    <x-ui.input type="password" name="password" placeholder="••••••••" required />

                </div>

                <div class="flex items-center justify-between text-sm">

                    <label class="flex items-center gap-2">

                        <input type="checkbox" name="remember" class="rounded border-gray-300">

                        <span class="text-gray-600">
                            Ingat Saya
                        </span>

                    </label>

                    <a href="{{ route('password.request') }}" class="text-blue-600 hover:text-blue-700">

                        Lupa Password?

                    </a>

                </div>

                <x-ui.button class="w-full">
                    Masuk ke Akun
                </x-ui.button>

                <p class="text-center text-sm text-gray-600">

                    Belum punya akun?

                    <a href="{{ route('register') }}" class="font-semibold text-blue-600">

                        Daftar sekarang

                    </a>

                </p>

            </form>

        </x-ui.card>

    </div>

@endsection