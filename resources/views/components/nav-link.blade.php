@php
$classes = 'focus:outline-none | transition duration-150 ease-in-out';
@endphp

<li class="menu-item inline-flex items-center px-1 text-sm ">
    <a {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
</li>