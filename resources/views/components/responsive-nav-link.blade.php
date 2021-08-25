@php
$classes = 'block pl-3 pr-4 py-3 | hover:bg-gray-50 dark:hover:bg-dt-dark-black hover:text-title-color dark:hover:text-dt-title-color | focus:outline-none focus:bg-gray-50 dark:focus:bg-dt-dark-black focus:text-title-color dark:focus:text-dt-title-color | transition duration-150 ease-in-out | border-t border-border-color dark:border-dt-darker | group';
@endphp

<li class="">
    <a {{ $attributes->merge(['class' => $classes]) }}>
        <div class="flex items-center justify-between">
            <i class="text-md icon-{{ $icon }} mr-2"></i>
            <span class="flex-1 text-xs">
                {{ $slot }}
            </span>
            <i class="text-md icon-arrow-right ml-2 opacity-30 group-hover:opacity-100 group-focus:opacity-100"></i>
        </div>
    </a>
</li>
