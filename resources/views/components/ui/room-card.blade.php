@props(['room'])

<div class="overflow-hidden bg-white rounded-xl border border-slate-100 shadow-sm transition hover:shadow-md">
    <div class="p-6">
        <div class="flex justify-between items-start mb-4">
            <div>
                <span
                    class="text-xs font-semibold uppercase tracking-wider text-indigo-600 bg-indigo-50 px-2.5 py-1 rounded-full">
                    {{ $room->type ?? 'Standard' }}
                </span>
                <h3 class="mt-2 text-xl font-bold text-slate-800">Kamar {{ $room->number ?? 'N/A' }}</h3>
            </div>
            <span
                class="inline-flex items-center rounded-md bg-emerald-50 px-2 py-1 text-xs font-medium text-emerald-700 ring-1 ring-inset ring-emerald-600/20">
                Aktif
            </span>
        </div>

        <div class="space-y-3 border-t border-slate-50 pt-4 text-sm text-slate-600">
            <div class="flex justify-between">
                <span>Lantai</span>
                <span class="font-medium text-slate-800">{{ $room->floor ?? '-' }}</span>
            </div>
            <div class="flex justify-between">
                <span>Harga Sewa</span>
                <span class="font-semibold text-slate-800">Rp
                    {{ number_format($room->price ?? 0, 0, ',', '.') }}/bln</span>
            </div>
            <div class="flex justify-between">
                <span>Mulai Sewa</span>
                <span class="font-medium text-slate-800">{{ $room->start_date ?? '-' }}</span>
            </div>
        </div>
    </div>
    <div class="bg-slate-50 px-6 py-3 border-t border-slate-100 flex justify-end">
        <a href="{{ route('tenant.room.show', $room->id ?? 1) }}"
            class="text-sm font-medium text-indigo-600 hover:text-indigo-700 flex items-center gap-1">
            Lihat Detail Kamar &rarr;
        </a>
    </div>
</div>