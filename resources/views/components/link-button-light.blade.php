<a {{ $attributes->merge(['type' => 'submit', 'class' => 'px-4 py-2 | appearance-none | bg-gray-150 dark:bg-edgray-700 | rounded | font-semibold text-sm | hover:bg-gray-200 dark:hover:bg-edgray-600 | focus:outline-none focus:bg-gray-200 dark:focus:bg-edgray-600 | transition ease-in-out duration-75 | select-none | cursor-pointer']) }}>
    {{ $slot }}
</a>