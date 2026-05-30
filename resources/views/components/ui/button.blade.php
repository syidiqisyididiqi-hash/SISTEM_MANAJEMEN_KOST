<button {{ $attributes->merge([
    'class' => 'px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-medium transition duration-300'
]) }}>
    {{ $slot }}
</button>