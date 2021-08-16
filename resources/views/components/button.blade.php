<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center | px-4 py-2 | bg-sky-700 dark:bg-cyan-300 | border border-transparent rounded | font-semibold text-xs text-white dark:text-cyan-900 uppercase tracking-widest | hover:bg-sky-600 dark:hover:bg-cyan-200 | focus:outline-none focus:bg-sky-600 dark:focus:bg-cyan-200 | active:bg-sky-800 disabled:opacity-25 | transition ease-in-out duration-150']) }}>
    {{ $slot }}

    {{-- text-sky-600 dark:text-cyan-300 | hover:underline hover:text-sky-700 dark:hover:text-cyan-200 | focus:underline focus:outline-none focus:text-sky-700 dark:focus:text-cyan-200 | transition ease-in-out duration-150 --}}
</button>
