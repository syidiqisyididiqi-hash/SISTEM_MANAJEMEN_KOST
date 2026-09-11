@props(['payment'])

<div class="bg-white rounded-xl border border-slate-100 shadow-sm p-5 flex items-center justify-between">
    <div class="flex items-center gap-4">
        <div class="p-3 bg-slate-50 rounded-lg text-slate-500">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                </path>
            </svg>
        </div>
        <div>
            <p class="text-sm font-semibold text-slate-800">Metode: {{ $payment->method ?? 'Transfer Bank' }}</p>
            <p class="text-xs text-slate-400">{{ $payment->date ?? 'Hari ini' }}</p>
            <p class="text-sm font-bold text-slate-700 mt-1">Rp {{ number_format($payment->amount ?? 0, 0, ',', '.') }}
            </p>
        </div>
    </div>

    <div>
        @if(($payment->status ?? 'pending') === 'success')
            <span
                class="bg-emerald-50 text-emerald-700 text-xs px-2.5 py-1 rounded-full font-medium inline-block">Berhasil</span>
        @elseif(($payment->status ?? 'pending') === 'pending')
            <span
                class="bg-amber-50 text-amber-700 text-xs px-2.5 py-1 rounded-full font-medium inline-block">Diproses</span>
        @else
            <span class="bg-rose-50 text-rose-700 text-xs px-2.5 py-1 rounded-full font-medium inline-block">Gagal</span>
        @endif
    </div>
</div>