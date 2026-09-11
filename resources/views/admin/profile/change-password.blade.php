@extends('layouts.admin.app')

@section('title', 'Change Password')

@section('content')

    <x-ui.page-header title="Change Password" description="Perbarui password akun administrator" />

    <div class="bg-white rounded-2xl shadow-sm p-6 mt-6">

        <form>

            <div class="space-y-5">

                <div>
                    <label class="block mb-2 text-sm font-medium">
                        Password Lama
                    </label>

                    <input type="password" class="w-full rounded-xl border border-slate-300 px-4 py-3">
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium">
                        Password Baru
                    </label>

                    <input type="password" class="w-full rounded-xl border border-slate-300 px-4 py-3">
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium">
                        Konfirmasi Password Baru
                    </label>

                    <input type="password" class="w-full rounded-xl border border-slate-300 px-4 py-3">
                </div>

            </div>

            <div class="mt-6 flex gap-3">

                <button type="submit" class="px-5 py-3 rounded-xl bg-green-600 text-white hover:bg-green-700">

                    Simpan Password

                </button>

                <a href="{{ route('admin.profile.index') }}" class="px-5 py-3 rounded-xl bg-slate-200 hover:bg-slate-300">

                    Kembali

                </a>

            </div>

        </form>

    </div>

@endsection