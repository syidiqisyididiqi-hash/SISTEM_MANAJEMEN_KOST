@extends('layouts.admin.app')

@section('title', 'Detail Activity Log')

@section('content')

    <x-ui.page-header title="Detail Activity Log" description="Informasi lengkap aktivitas sistem" />

    <x-ui.card>

        <div class="grid gap-6">

            <div>
                <p class="text-sm text-slate-500 mb-1">Deskripsi Aktivitas</p>
                <h3 class="text-lg font-semibold text-slate-800">{{ $log->description }}</h3>
            </div>

            <div class="grid grid-cols-2 gap-6">
                <div>
                    <p class="text-sm text-slate-500 mb-1">Tanggal</p>
                    <p class="font-medium text-slate-700">{{ $log->created_at->format('d F Y') }}</p>
                </div>

                <div>
                    <p class="text-sm text-slate-500 mb-1">Jam</p>
                    <p class="font-medium text-slate-700">{{ $log->created_at->format('H:i') }}</p>
                </div>
            </div>

            <div>
                <p class="text-sm text-slate-500 mb-1">ID Log</p>
                <p class="font-medium text-slate-700">{{ $log->id }}</p>
            </div>

            <div class="mt-6">
                <a href="{{ route('admin.activity-log') }}"
                    class="inline-flex items-center rounded-lg bg-slate-100 px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-200">
                    Kembali
                </a>
            </div>

        </div>

    </x-ui.card>

@endsection