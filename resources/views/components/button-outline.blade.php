<button {{ $attributes->merge(['type' => 'submit', 'class' => 'px-4 py-2 | border border-transparent rounded | font-semibold text-sm text-white | hover:border-cblue-500 | focus:outline-none focus:border-cblue-500 | active:border-cblue-700 disabled:opacity-25 | transition ease-in-out duration-75 | select-none | cursor-pointer']) }}>
    {{ $slot }}
</button>