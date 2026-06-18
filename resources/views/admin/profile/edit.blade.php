@extends('layouts.admin.app')

@section('title', 'Edit Profile')

@section('content')

    <x-ui.page-header title="Edit Profile" description="Perbarui informasi akun administrator" />

    <div class="bg-white rounded-2xl shadow-sm p-6 mt-6">

        <form>

            <div class="grid md:grid-cols-2 gap-5">

                <div>
                    <label class="block mb-2 text-sm font-medium">
                        Nama Lengkap
                    </label>

                    <input type="text" value="Muhammad Syahid" class="w-full rounded-xl border border-slate-300 px-4 py-3">
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium">
                        Email
                    </label>

                    <input type="email" value="admin@kost.com" class="w-full rounded-xl border border-slate-300 px-4 py-3">
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium">
                        Nomor Telepon
                    </label>

                    <input type="text" value="081234567890" class="w-full rounded-xl border border-slate-300 px-4 py-3">
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium">
                        Role
                    </label>

                    <input type="text" value="Administrator" readonly
                        class="w-full rounded-xl border border-slate-300 px-4 py-3 bg-slate-100">
                </div>

            </div>

            <div class="mt-6 flex gap-3">

                <button type="submit" class="px-5 py-3 rounded-xl bg-blue-600 text-white hover:bg-blue-700">

                    Simpan Perubahan

                </button>

                <a href="{{ route('admin.profile.index') }}" class="px-5 py-3 rounded-xl bg-slate-200 hover:bg-slate-300">

                    Batal

                </a>

            </div>

        </form>

    </div>

@endsection