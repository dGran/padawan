<button {{ $attributes->merge(['type' => 'submit', 'class' => 'px-4 py-2 | bg-cblue-500 | border border-cblue-500 rounded | font-semibold text-sm text-white | hover:bg-cblue-600 | focus:outline-none focus:bg-cblue-600 | active:bg-cblue-700 disabled:opacity-25 | transition ease-in-out duration-75 | select-none | cursor-pointer']) }}>
    {{ $slot }}
</button>
