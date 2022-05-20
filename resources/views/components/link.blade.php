@props(['color' => 'edblue'])

@if ($color)
	<a {{ $attributes->merge(["class" => "text-$color-500 dark:text-$color-400 | hover:underline hover:text-$color-600 dark:hover:text-$color-300 | focus:underline focus:outline-none focus:text-$color-600 dark:focus:text-$color-300 | transition ease-in-out duration-150 | cursor-pointer"]) }}>{{ $slot }}</a>
@else
	<a {{ $attributes->merge(["class" => "hover:underline | focus:underline focus:outline-none | transition ease-in-out duration-150 | cursor-pointer"]) }}>{{ $slot }}</a>
@endif