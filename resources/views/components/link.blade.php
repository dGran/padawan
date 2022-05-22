@props(['color' => 'edblue'])

@if ($color)
	<a {{ $attributes->merge(["class" => "text-$color-500 dark:text-$color-400 | hover:text-$color-600 dark:hover:text-$color-300 | focus:outline-none focus:text-$color-600 dark:focus:text-$color-300 | transition ease-in-out duration-150 | cursor-pointer"]) }}>{{ $slot }}</a>
@else
	<a {{ $attributes->merge(["class" => "focus:outline-none | transition ease-in-out duration-150 | cursor-pointer"]) }}>{{ $slot }}</a>
@endif