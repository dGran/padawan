<a {{ $attributes->merge(['class' => 'text-cblue-500 dark:text-cblue-400 | hover:underline hover:text-cblue-600 dark:hover:text-cblue-400 | focus:underline focus:outline-none focus:text-cblue-600 dark:focus:text-cblue-400 | transition ease-in-out duration-150']) }}>
	{{ $slot }}
</a>