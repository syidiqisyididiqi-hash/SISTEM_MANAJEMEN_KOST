@extends('layouts.admin.app')

@section('title', 'Activity Log')

@section('content')

    <x-ui.page-header title="Activity Log" description="Riwayat aktivitas sistem" />

    <x-ui.card>

        <div class="mb-6">

            <h3 class="text-xl font-semibold text-slate-800">
                Daftar Aktivitas
            </h3>

            <p class="text-sm text-slate-500">
                Menampilkan seluruh aktivitas yang tercatat pada sistem.
            </p>

        </div>

        @if($logs->count())

            <x-ui.table>

                <thead class="bg-slate-50 border-b">

                    <tr>

                        <th class="px-6 py-4 text-left font-semibold">
                            No
                        </th>

                        <th class="px-6 py-4 text-left font-semibold">
                            Aktivitas
                        </th>

                        <th class="px-6 py-4 text-left font-semibold">
                            Tanggal
                        </th>

                        <th class="px-6 py-4 text-left font-semibold">
                            Jam
                        </th>

                        <th class="px-6 py-4 text-center font-semibold">
                            Aksi
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($logs as $log)

                        <tr class="border-b hover:bg-gray-50">

                            <td class="px-6 py-4">
                                {{ $loop->iteration }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $log->description }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $log->created_at->format('d M Y') }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $log->created_at->format('H:i') }}
                            </td>

                            <td class="px-6 py-4">

                                <div class="flex justify-center">

                                    <a href="{{ route('admin.activity-logs.show', $log) }}">
                                        <x-ui.button>
                                            Detail
                                        </x-ui.button>
                                    </a>

                                </div>

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </x-ui.table>

        @else

            <x-ui.empty-state title="Belum Ada Aktivitas" description="Belum ada aktivitas yang tercatat pada sistem." />

        @endif

    </x-ui.card>

@endsection