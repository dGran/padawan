@php
$classes = 'block pl-3 pr-4 py-3 | hover:bg-gray-100 dark:hover:bg-dt-dark-accent hover:text-title-color dark:hover:text-dt-title-color | focus:outline-none focus:bg-gray-100 dark:focus:bg-dt-dark-accent focus:text-title-color dark:focus:text-dt-title-color | transition duration-150 ease-in-out | border-t border-border-color dark:border-dt-border-color | group';
@endphp

<li class="">
    <a {{ $attributes->merge(['class' => $classes]) }}>
        <div class="flex items-center justify-between space-x-1.5">
            <span class="flex-1 text-xs ml-2">
                {{ $slot }}
            </span>
            <i class="icon-arrow-right | text-xs pr-2 opacity-50 dark:opacity-30 group-hover:opacity-100 group-focus:opacity-100"></i>
        </div>
    </a>
</li>
