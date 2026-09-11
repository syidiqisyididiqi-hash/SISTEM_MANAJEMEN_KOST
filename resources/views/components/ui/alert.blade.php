@props([
    'type' => 'success'
])

@php

$classes = match($type) {

    'success' => 'bg-green-100 text-green-700 border-green-200',

    'danger' => 'bg-red-100 text-red-700 border-red-200',

    'warning' => 'bg-yellow-100 text-yellow-700 border-yellow-200',

    'info' => 'bg-blue-100 text-blue-700 border-blue-200',

    default => 'bg-gray-100 text-gray-700 border-gray-200'

};

@endphp

<div
    {{ $attributes->merge([
        'class' => "border px-4 py-3 rounded-xl $classes"
    ]) }}>

    {{ $slot }}

</div>