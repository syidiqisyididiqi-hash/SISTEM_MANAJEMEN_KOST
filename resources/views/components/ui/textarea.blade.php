@props([
    'name',
    'rows' => 4
])

<textarea
    name="{{ $name }}"
    rows="{{ $rows }}"
    {{ $attributes->merge([
        'class' => 'w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500'
    ]) }}>{{ $slot }}</textarea>