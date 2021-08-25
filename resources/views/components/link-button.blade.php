<a {{ $attributes->merge(['type' => 'submit', 'class' => 'px-4 py-2 | bg-edblue-500 | border border-edblue-500 rounded | font-semibold text-sm text-white | hover:bg-edblue-600 | focus:outline-none focus:bg-edblue-600 | active:bg-edblue-700 disabled:opacity-25 | transition ease-in-out duration-75 | select-none | cursor-pointer']) }}>
    {{ $slot }}
</a>