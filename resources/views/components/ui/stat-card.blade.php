@props([
    'title',
    'value',
    'icon' => '📊'
])

<div class="bg-white rounded-2xl shadow-sm p-5">

    <div class="flex items-center justify-between">

        <div>

            <p class="text-gray-500 text-sm">
                {{ $title }}
            </p>

            <h3 class="text-3xl font-bold mt-2">
                {{ $value }}
            </h3>

        </div>

        <span class="text-3xl">
            {{ $icon }}
        </span>

    </div>

</div>