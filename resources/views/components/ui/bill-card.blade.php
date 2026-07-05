@props(['bill'])

<div
    class="bg-white rounded-xl border-l-4 border-rose-500 shadow-sm p-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
    <div class="space-y-1">
        <div class="flex items-center gap-2">
            <h4 class="font-bold text-slate-800 text-lg">{{ $bill->title ?? 'Tagihan Bulan Ini' }}</h4>
            <span class="bg-rose-50 text-rose-700 text-xs px-2 py-0.5 rounded-full font-medium">Belum Bayar</span>
        </div>
        <p class="text-sm text-slate-500">Jatuh tempo pada {{ $bill->due_date ?? '-' }}</p>
        <p class="text-2xl font-extrabold text-slate-900 mt-2">
            Rp {{ number_format($bill->amount ?? 0, 0, ',', '.') }}
        </p>
    </div>

    <div class="flex items-center gap-3 self-end md:self-center">
        <a href="{{ route('tenant.billing.show', $bill->id ?? 1) }}"
            class="px-4 py-2 text-sm font-medium text-slate-700 bg-slate-100 rounded-lg hover:bg-slate-200 transition">
            Detail
        </a>
        <a href="{{ route('tenant.payment.create', ['bill_id' => $bill->id ?? 1]) }}"
            class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 shadow-sm shadow-indigo-100 transition">
            Bayar Sekarang
        </a>
    </div>
</div>