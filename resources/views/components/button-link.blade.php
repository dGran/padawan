@props(['disabled' => false, 'color' => 'edblue'])

<button {{ $disabled ? 'disabled' : '' }} {{ $attributes->merge(['type' => 'submit', 'class' => "text-$color-500 dark:text-$color-400 | hover:text-$color-600 dark:hover:text-$color-300 | focus:outline-none focus:text-$color-600 dark:focus:text-$color-300 | transition ease-in-out duration-150 | disabled:opacity-25 disabled:cursor-not-allowed | select-none"]) }}>
    {{ $slot }}
</button>
