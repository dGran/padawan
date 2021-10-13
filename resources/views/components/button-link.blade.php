@props(['disabled' => false])

<button {{ $disabled ? 'disabled' : '' }} {{ $attributes->merge(['type' => 'submit', 'class' => 'text-edblue-500 dark:text-edblue-400 | hover:text-edblue-600 dark:hover:text-edblue-300 | focus:outline-none focus:text-edblue-600 dark:focus:text-edblue-300 | transition ease-in-out duration-150 | disabled:opacity-25 disabled:cursor-not-allowed | select-none | cursor-pointer']) }}>
    {{ $slot }}
</button>
