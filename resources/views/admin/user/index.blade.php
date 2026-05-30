@extends('layouts.admin.app')

@section('title', 'User Management')

@section('content')

    <div class="bg-white rounded-2xl shadow-sm p-6">

        <div class="flex justify-between items-center mb-6">

            <div>
                <h2 class="text-2xl font-bold text-gray-800">
                    User Management
                </h2>

                <p class="text-gray-500 text-sm">
                    Kelola akun admin dan tenant
                </p>
            </div>

            <a href="{{ route('admin.user.create') }}"
                class="px-4 py-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700">
                + Tambah User
            </a>

        </div>

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead>

                    <tr class="border-b">

                        <th class="text-left py-3">Nama</th>
                        <th class="text-left py-3">Email</th>
                        <th class="text-left py-3">Role</th>
                        <th class="text-left py-3">Aksi</th>

                    </tr>

                </thead>

                <tbody>

                    <tr class="border-b">

                        <td class="py-3">Admin</td>
                        <td>admin@gmail.com</td>

                        <td>
                            <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs">
                                Admin
                            </span>
                        </td>

                        <td>
                            <a href="#" class="text-blue-600">
                                Edit
                            </a>
                        </td>

                    </tr>

                </tbody>

            </table>

        </div>

    </div>

@endsection