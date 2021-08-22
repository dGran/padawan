@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 text-sm uppercase font-semibold text-gray-900 dark:text-white | focus:outline-none | transition duration-150 ease-in-out | pointer-events-none'
            : 'inline-flex items-center px-1 pt-1 text-sm uppercase font-medium | text-gray-500 dark:text-dark-normal | hover:text-gray-700 dark:hover:text-dark-light | focus:outline-none focus:text-gray-700 dark:focus:text-dark-light | transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>