@props(['announcement'])

<div
    class="bg-gradient-to-r from-amber-50 to-orange-50 border border-amber-100 rounded-xl p-5 relative overflow-hidden">
    <div class="absolute -right-4 -bottom-4 text-amber-200/40 pointer-events-none">
        <svg class="w-24 h-24" fill="currentColor" viewBox="0 0 20 20">
            <path
                d="M18 3a1 1 0 00-1.447-.894L8.763 6H5a3 3 0 000 6h.28l1.771 5.316A1 1 0 008 18h1a1 1 0 001-1v-4.382l6.553 3.276A1 1 0 0018 15V3z">
            </path>
        </svg>
    </div>

    <div class="relative z-10">
        <div class="flex items-center gap-2 mb-2">
            <span
                class="bg-amber-500 text-white text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded">Penting</span>
            <span class="text-xs text-slate-500">{{ $announcement->date ?? 'Baru saja' }}</span>
        </div>
        <h4 class="font-bold text-slate-800 text-base mb-1">{{ $announcement->title ?? 'Judul Pengumuman' }}</h4>
        <p class="text-sm text-slate-600 line-clamp-2 mb-3">
            {{ $announcement->content ?? 'Isi pengumuman singkat yang diposting oleh admin/pemilik.' }}
        </p>
        <a href="{{ route('tenant.announcement.show', $announcement->id ?? 1) }}"
            class="text-xs font-semibold text-amber-700 hover:text-amber-800 flex items-center gap-1">
            Baca Selengkapnya &rarr;
        </a>
    </div>
</div>