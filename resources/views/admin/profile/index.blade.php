@extends('layouts.admin.app')

@section('title', 'My Profile')

@section('content')

    <div class="space-y-6">

        <x-ui.page-header title="My Profile" description="Kelola informasi akun administrator" />

        <x-ui.profile-card />

        <x-ui.profile-info />

        <!-- Action Button -->
        <div class="flex flex-wrap gap-3">

            <a href="{{ route('admin.profile.edit') }}"
                class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-medium transition">

                ✏️ Edit Profile

            </a>

            <a href="{{ route('admin.profile.change-password') }}"
                class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-slate-700 hover:bg-slate-800 text-white font-medium transition">

                🔒 Ganti Password

            </a>

        </div>

    </div>

@endsection