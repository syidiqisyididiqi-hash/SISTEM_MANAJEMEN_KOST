@props([
    'title',
    'subtitle' => null
])

<div class="mb-6">

    <h2 class="text-2xl font-bold text-gray-800">
        {{ $title }}
    </h2>

  @if($subtitle)
    <p class="text-gray-500 text-sm mt-1">
        {{ $subtitle }}
    </p>

@endif

</div>