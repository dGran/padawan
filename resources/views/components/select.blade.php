@props(['disabled' => false])

<div class="relative">
	<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'appearance-none | rounded | px-4 py-2 | bg-white dark:bg-dt-dark | border border-border-color dark:border-gray-700 | placeholder-gray-400 dark:placeholder-gray-500 | hover:border-gray-300 dark:hover:border-gray-600 | focus:outline-none focus:border-gray-300 dark:focus:border-gray-600 | autofill:border-border-color dark:autofill:border-gray-700 | autofill:text-fill-text-color dark:autofill:text-fill-dt-text-color | autofill:shadow-fill-white dark:autofill:shadow-fill-dt-dark']) !!} style="padding-right: 2.25em">{{ $slot }}</select>
	<span class="fas fa-sort | text-normal | text-light-color dark:dt-text-light-color | absolute right-0 pr-4" style="top: 50%; transform: translate(0%, -50%);"></span>
</div>
