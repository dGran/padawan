<a {{ $attributes->merge(['class' => 'text-sky-700 dark:text-cyan-300 | hover:underline hover:text-sky-600 dark:hover:text-cyan-200 | focus:underline focus:outline-none focus:text-sky-600 dark:focus:text-cyan-200 | transition ease-in-out duration-150']) }}>
	{{ $slot }}
</a>