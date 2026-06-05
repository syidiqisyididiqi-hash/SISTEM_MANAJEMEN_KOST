<div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

    <div class="overflow-x-auto">

        <table {{ $attributes->merge([
            'class' => 'w-full text-sm text-left text-slate-600'
        ]) }}>
            {{ $slot }}
        </table>

    </div>

</div>