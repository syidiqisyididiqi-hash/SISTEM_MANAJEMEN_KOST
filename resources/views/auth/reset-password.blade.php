@extends('layouts.app')

@section('content')

<div class="min-h-screen flex items-center justify-center bg-gray-100 px-4">

    <div class="w-full max-w-md bg-white rounded-3xl shadow-lg p-8">

        <h1 class="text-3xl font-bold text-center mb-6">
            Reset Password
        </h1>

        <form action="#" method="POST" class="space-y-5">
            @csrf

            <input 
                type="password"
                name="password"
                placeholder="Password baru"
                class="w-full border rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-blue-500"
            >

            <input 
                type="password"
                name="password_confirmation"
                placeholder="Konfirmasi password"
                class="w-full border rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-blue-500"
            >

            <button 
                type="submit"
                class="w-full bg-blue-600 text-white py-3 rounded-xl"
            >
                Reset Password
            </button>
        </form>

    </div>

</div>

@endsection