<select {{ $attributes->merge([
    'class' => 'w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500'
]) }}>
    {{ $slot }}
</select>