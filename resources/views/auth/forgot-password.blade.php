@extends('layouts.app')

@section('content')

<div class="min-h-screen flex items-center justify-center bg-gray-100 px-4">

    <div class="w-full max-w-md bg-white rounded-3xl shadow-lg p-8">

        <h1 class="text-3xl font-bold text-center mb-3">
            Forgot Password
        </h1>

        <p class="text-center text-gray-500 mb-6">
            Masukkan email untuk reset password
        </p>

        <form action="#" method="POST" class="space-y-5">
            @csrf

            <input 
                type="email"
                name="email"
                placeholder="Masukkan email"
                class="w-full border rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-blue-500"
            >

            <button 
                type="submit"
                class="w-full bg-blue-600 text-white py-3 rounded-xl"
            >
                Kirim Link Reset
            </button>
        </form>

    </div>

</div>

@endsection