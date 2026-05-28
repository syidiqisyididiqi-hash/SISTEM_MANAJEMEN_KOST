@extends('layouts.app')

@section('content')

<div class="min-h-screen flex items-center justify-center bg-gray-100 px-4">

    <div class="w-full max-w-lg bg-white rounded-3xl shadow-lg p-8 text-center">

        <div class="text-5xl mb-4">
            📩
        </div>

        <h1 class="text-3xl font-bold mb-3">
            Verify Email
        </h1>

        <p class="text-gray-500 mb-6">
            Silakan cek email kamu untuk verifikasi akun.
        </p>

        <button class="bg-blue-600 text-white px-6 py-3 rounded-xl">
            Kirim Ulang Email
        </button>

    </div>

</div>

@endsection