@props([
    'items' => []
])

<nav class="mb-4 text-sm text-gray-500">

    @foreach($items as $item)

        <span>{{ $item }}</span>
        @if(!$loop->last)
            <span class="mx-2">/</span>
        @endif

    @endforeach

</nav>