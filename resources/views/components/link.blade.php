<a {{ $attributes->merge(['class' => 'text-edblue-500 dark:text-edblue-400 | hover:underline hover:text-edblue-600 dark:hover:text-edblue-300 | focus:underline focus:outline-none focus:text-edblue-600 dark:focus:text-edblue-300 | transition ease-in-out duration-150']) }}>
	{{ $slot }}
</a>