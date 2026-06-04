@extends('layouts.admin.app')

@section('title', 'Data Tenant')

@section('content')

    <x-ui.page-header title="Data Tenant" description="Kelola data penghuni kost" />

    <x-ui.card>

        <div class="flex justify-between items-center mb-6">
            <h3 class="text-lg font-semibold">
                Daftar Tenant
            </h3>

            <a href="{{ route('admin.tenants.create') }}">
                <x-ui.button>
                    + Tambah Tenant
                </x-ui.button>
            </a>
        </div>

        @if($tenants->count())

            <x-ui.table>

                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>No HP</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($tenants as $tenant)

                        <tr>
                            <td>{{ $tenant->user->name }}</td>
                            <td>{{ $tenant->user->email }}</td>
                            <td>{{ $tenant->phone }}</td>

                            <td class="space-x-2">

                                <a href="{{ route('admin.tenants.show', $tenant) }}">
                                    Detail
                                </a>

                                <a href="{{ route('admin.tenants.edit', $tenant) }}">
                                    Edit
                                </a>

                            </td>
                        </tr>

                    @endforeach

                </tbody>

            </x-ui.table>

        @else

            <x-ui.empty-state title="Belum ada tenant" description="Silakan tambahkan tenant terlebih dahulu." />

        @endif

    </x-ui.card>

@endsection