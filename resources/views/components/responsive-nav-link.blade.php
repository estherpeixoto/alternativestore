@props(['active'])

@php
$classes = ($active ?? false)
            ? 'flex items-center py-3 text-sm font-medium focus:outline-none text-white transition duration-150 ease-in-out'
            : 'flex items-center py-3 text-sm font-medium text-gray-100 hover:text-gray-300 focus:outline-none focus:text-gray-400 transition duration-50 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
