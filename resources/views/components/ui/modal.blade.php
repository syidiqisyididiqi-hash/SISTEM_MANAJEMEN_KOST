@props([
    'id' => 'modal'
])

<div
    id="{{ $id }}"
    class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">

    <div class="bg-white rounded-2xl shadow-lg p-6 w-full max-w-md">

        {{ $slot }}

    </div>

</div>