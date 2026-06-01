@extends('layouts.admin.app')

@section('title', 'Edit User')

@section('content')

    <div class="bg-white rounded-2xl shadow-sm p-6 max-w-2xl">

        <h2 class="text-2xl font-bold mb-6">
            Edit User
        </h2>

        <form method="POST" action="{{ route('admin.user.update', $user->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">

                <label class="block mb-2">
                    Nama
                </label>

                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                    class="w-full border rounded-xl px-4 py-3">

            </div>

            <div class="mb-4">

                <label class="block mb-2">
                    Email
                </label>

                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                    class="w-full border rounded-xl px-4 py-3">

            </div>

            <div class="mb-4">

                <label class="block mb-2">
                    Role
                </label>

                @if($errors->has('role'))
                    <p class="text-red-600 text-sm mb-2">{{ $errors->first('role') }}</p>
                @endif
                <select name="role" class="w-full border rounded-xl px-4 py-3">
                    <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>
                        Admin
                    </option>

                    <option value="tenant" {{ old('role', $user->role) === 'tenant' ? 'selected' : '' }}>
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