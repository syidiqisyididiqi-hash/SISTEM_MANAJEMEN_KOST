@extends('layouts.admin.app')

@section('title', 'Activity Log')

@section('content')

    <x-ui.page-header title="Activity Log" description="Riwayat aktivitas sistem" />

    <x-ui.card>

        <div class="flex flex-col gap-4 mb-6 md:flex-row md:items-center md:justify-between">
            <div>
                <h3 class="text-xl font-semibold text-slate-800">
                    Daftar Aktivitas
                </h3>
                <p class="text-sm text-slate-500">
                    Menampilkan seluruh aktivitas yang tercatat pada sistem.
                </p>
            </div>

            <button type="button" onclick="openClearLogModal()"
                class="inline-flex items-center gap-2 rounded-lg bg-red-600 px-4 py-2 text-sm font-medium text-white transition hover:bg-red-700">
                🗑 Clear Logs
            </button>
        </div>

        @if ($logs->count())

            <x-ui.table>
                <thead class="border-b bg-slate-50">
                    <tr>
                        <th class="px-6 py-4 text-left font-semibold">No</th>
                        <th class="px-6 py-4 text-left font-semibold">Aktivitas</th>
                        <th class="px-6 py-4 text-left font-semibold">Tanggal</th>
                        <th class="px-6 py-4 text-left font-semibold">Jam</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($logs as $log)
                        <tr class="border-b hover:bg-slate-50">
                            <td class="px-6 py-4">
                                {{ $logs instanceof \Illuminate\Pagination\LengthAwarePaginator ? $logs->firstItem() + $loop->index : $loop->iteration }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $log->description ?? '-' }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $log->created_at ? $log->created_at->format('d M Y') : '-' }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $log->created_at ? $log->created_at->format('H:i') : '-' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </x-ui.table>

            @if($logs instanceof \Illuminate\Pagination\LengthAwarePaginator)
                <div class="mt-4">
                    {{ $logs->links() }}
                </div>
            @endif

        @else

            <x-ui.empty-state title="Belum Ada Aktivitas" description="Belum ada aktivitas yang tercatat pada sistem." />

        @endif

    </x-ui.card>

    <div id="clearLogModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50">
        <div class="w-full max-w-md rounded-xl bg-white p-6 shadow-xl">
            <h2 class="text-lg font-semibold text-slate-800">
                Clear Logs
            </h2>

            <p class="mt-2 text-sm text-slate-500">
                Hapus activity log yang lebih lama dari:
            </p>

            <form id="formClearLog" action="{{ route('admin.activity-log.clear') }}" method="POST" class="mt-5">
                @csrf
                @method('DELETE')

                <select name="days" id="selectDays"
                    class="mt-2 w-full rounded-lg border border-slate-300 px-3 py-2 focus:border-red-500 focus:outline-none">

                    <option value="0">Semua Log (Hapus Total)</option>

                    <option value="7">Lebih dari 7 Hari</option>
                    <option value="30" selected>Lebih dari 30 Hari</option>
                    <option value="90">Lebih dari 90 Hari</option>
                    <option value="180">Lebih dari 180 Hari</option>
                    <option value="365">Lebih dari 1 Tahun</option>
                </select>

                <div class="mt-6 flex justify-end gap-3">
                    <button type="button" onclick="closeClearLogModal()"
                        class="rounded-lg border border-slate-300 px-4 py-2 text-slate-700 hover:bg-slate-100">
                        Batal
                    </button>

                    <button type="submit" class="rounded-lg bg-red-600 px-4 py-2 text-white transition hover:bg-red-700">
                        Hapus Log
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openClearLogModal() {
            const clearLogModal = document.getElementById('clearLogModal');
            clearLogModal.classList.remove('hidden');
            clearLogModal.classList.add('flex');
        }

        function closeClearLogModal() {
            const clearLogModal = document.getElementById('clearLogModal');
            clearLogModal.classList.add('hidden');
            clearLogModal.classList.remove('flex');
        }

        document.getElementById('formClearLog')?.addEventListener('submit', function (e) {
            e.preventDefault();

            const selectedOption = document.getElementById('selectDays');
            const selectedText = selectedOption.options[selectedOption.selectedIndex].text;

            closeClearLogModal();

            Swal.fire({
                icon: 'warning',
                title: 'Hapus Activity Log?',
                text: `Apakah Anda yakin ingin menghapus log aktivitas yang lebih lama dari ${selectedText}? Tindakan ini tidak dapat dibatalkan!`,
                width: '400px',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus Log',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#6b7280',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                } else {
                    openClearLogModal();
                }
            });
        });
    </script>

@endsection