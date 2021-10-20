@props(['disabled' => false, 'color' => 'edblue'])

@if ($color)
    <button {{ $disabled ? 'disabled' : '' }} {{ $attributes->merge(["type" => "submit", "class" => "px-4 py-2 | bg-$color-500 | border border-$color-500 | rounded-md | font-medium text-xs md:text-sm text-white | hover:bg-$color-600 | focus:outline-none focus:bg-$color-600 | active:bg-$color-700 | disabled:opacity-25 disabled:cursor-not-allowed | transition ease-in-out duration-75 | select-none | cursor-pointer"]) }}>
        {{ $slot }}
    </button>
@else
    <button {{ $disabled ? 'disabled' : '' }} {{ $attributes->merge(["type" => "submit", "class" => "px-4 py-2 | border border-transparent | rounded-md | font-medium text-xs md:text-sm | hover:text-title-color dark:hover:text-dt-title-color hover:border-border-color dark:hover:border-dt-border-color | focus:outline-none focus:text-title-color dark:focus:text-dt-title-color focus:border-border-color dark:focus:border-dt-border-color | disabled:opacity-25 disabled:cursor-not-allowed | transition ease-in-out duration-75 | select-none | cursor-pointer"]) }}>
        {{ $slot }}
    </button>
@endif
