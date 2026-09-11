@extends('layouts.app')

@section('content')

    <div class="min-h-screen flex items-center justify-center bg-gray-100 px-4">

        <x-ui.card class="w-full max-w-md">

            <div class="text-center mb-8">

                <h1 class="text-3xl font-bold text-gray-800">
                    Register
                </h1>

                <p class="text-gray-500 mt-2">
                    Buat akun baru 🚀
                </p>

            </div>

            @if(session('success'))
                <div class="mb-4 rounded-lg bg-green-100 border border-green-300 text-green-700 px-4 py-3">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-4 rounded-lg bg-red-100 border border-red-300 text-red-700 px-4 py-3">
                    <ul class="list-disc list-inside text-sm">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register.post') }}" method="POST" class="space-y-5">

                @csrf

                <div>

                    <label class="block mb-2 text-sm font-semibold">
                        Nama
                    </label>

                    <x-ui.input type="text" name="name" value="{{ old('name') }}" placeholder="Masukkan nama" />

                </div>

                <div>

                    <label class="block mb-2 text-sm font-semibold">
                        Email
                    </label>

                    <x-ui.input type="email" name="email" value="{{ old('email') }}" placeholder="Masukkan email" />

                </div>

                <div>

                    <label class="block mb-2 text-sm font-semibold">
                        Password
                    </label>

                    <x-ui.input type="password" name="password" placeholder="Masukkan password" />

                </div>

                <div>

                    <label class="block mb-2 text-sm font-semibold">
                        Konfirmasi Password
                    </label>

                    <x-ui.input type="password" name="password_confirmation" placeholder="Ulangi password" />

                </div>

                <x-ui.button class="w-full">
                    Register
                </x-ui.button>

                <p class="text-center text-sm text-gray-500">

                    Sudah punya akun?

                    <a href="{{ route('login') }}" class="text-blue-600 font-semibold hover:text-blue-700">

                        Login

                    </a>

                </p>

            </form>

        </x-ui.card>

    </div>

@endsection