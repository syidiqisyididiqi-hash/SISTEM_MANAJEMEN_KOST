@extends('layouts.app')

@section('content')

<div class="min-h-screen flex items-center justify-center bg-gray-100 px-4">

    <div class="w-full max-w-md bg-white rounded-3xl shadow-lg p-8">

        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">
                Register
            </h1>

            <p class="text-gray-500 mt-2">
                Buat akun baru 🚀
            </p>
        </div>

        <form action="#" method="POST" class="space-y-5">
            @csrf

            <div>
                <label class="block mb-2 text-sm font-semibold">
                    Nama
                </label>

                <input 
                    type="text"
                    name="name"
                    placeholder="Masukkan nama"
                    class="w-full border rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-blue-500"
                >
            </div>

            <div>
                <label class="block mb-2 text-sm font-semibold">
                    Email
                </label>

                <input 
                    type="email"
                    name="email"
                    placeholder="Masukkan email"
                    class="w-full border rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-blue-500"
                >
            </div>

            <div>
                <label class="block mb-2 text-sm font-semibold">
                    Password
                </label>

                <input 
                    type="password"
                    name="password"
                    placeholder="Masukkan password"
                    class="w-full border rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-blue-500"
                >
            </div>

            <button 
                type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-xl font-semibold transition"
            >
                Register
            </button>

            <p class="text-center text-sm text-gray-500">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="text-blue-600 font-semibold">
                    Login
                </a>
            </p>
        </form>

    </div>

</div>

@endsection