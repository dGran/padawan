@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block pl-3 pr-4 py-3 text-sm uppercase font-semibold bg-sky-700 dark:bg-cyan-300 | text-white dark:text-cyan-900 | focus:outline-none | transition duration-150 ease-in-out | pointer-events-none | border-t dark:border-dark-700 | cursor-not-allowed'
            : 'block pl-3 pr-4 py-3 text-sm uppercase font-medium text-gray-500 dark:text-dark-normal | hover:text-gray-700 dark:hover:text-dark-light | focus:outline-none focus:text-gray-700 dark:focus:text-dark-light | transition duration-150 ease-in-out | border-t dark:border-dark-700 | group';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    <div class="flex items-center justify-between">
        <i class="text-md icon-{{ $icon }} mr-2"></i>
        <span class="flex-1">
            {{ $slot }}
        </span>
        <i class="text-md icon-arrow-right ml-2 opacity-20 group-hover:opacity-100 {{ !$active ?: 'hidden' }}"></i>
    </div>
</a>
