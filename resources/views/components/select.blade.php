@props(['disabled' => false])

<div class="relative">
	<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'appearance-none | rounded | px-4 py-2 | bg-white dark:bg-dt-dark | border border-border-color dark:border-gray-700 | placeholder-gray-400 dark:placeholder-gray-500 | hover:border-gray-200 dark:hover:border-gray-600 | focus:outline-none focus:border-gray-300 dark:focus:border-gray-500 | autofill:border-border-color dark:autofill:border-gray-700 | autofill:text-fill-text-color dark:autofill:text-fill-dt-text-color | autofill:shadow-fill-white dark:autofill:shadow-fill-dt-dark']) !!}>{{ $slot }}</select>
	<span class="fas fa-sort | text-normal | text-light-color dark:dt-text-light-color | absolute right-0 pr-3" style="top: 50%; transform: translate(0%, -50%);"></span>
</div>
