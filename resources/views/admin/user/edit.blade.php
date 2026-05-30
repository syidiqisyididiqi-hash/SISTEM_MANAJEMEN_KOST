@extends('layouts.admin.app')

@section('title', 'Edit User')

@section('content')

    <div class="bg-white rounded-2xl shadow-sm p-6 max-w-2xl">

        <h2 class="text-2xl font-bold mb-6">
            Edit User
        </h2>

        <form>

            <div class="mb-4">

                <label class="block mb-2">
                    Nama
                </label>

                <input type="text" value="Admin" class="w-full border rounded-xl px-4 py-3">

            </div>

            <div class="mb-4">

                <label class="block mb-2">
                    Email
                </label>

                <input type="email" value="admin@gmail.com" class="w-full border rounded-xl px-4 py-3">

            </div>

            <div class="mb-4">

                <label class="block mb-2">
                    Role
                </label>

                <select class="w-full border rounded-xl px-4 py-3">

                    <option selected>
                        Admin
                    </option>

                    <option>
                        Tenant
                    </option>

                </select>

            </div>

            <button class="px-5 py-3 bg-blue-600 text-white rounded-xl">
                Update
            </button>

        </form>

    </div>

@endsection