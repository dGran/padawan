@props(['width' => 'lg'])
{{-- width
'sm', 'md', 'lg', 'xl', '2xl', '3xl', '4xl', '5xl', '6xl', '7xl' --}}

<div
    x-show="open"
    x-on:close.stop="open = false"
    x-on:keydown.escape.window="open = false"
    x-cloak
    {{-- x-trap="open" --}}
    {{-- x-on:keydown.tab.prevent="$event.shiftKey || nextFocusable().focus()" --}}
    {{-- x-on:keydown.shift.tab.prevent="prevFocusable().focus()" --}}
    class="fixed inset-0 z-50 overflow-y-auto">

	<div class="pt-20 flex items-start justify-center min-h-screen px-4 pt-4 pb-10 text-center sm:block sm:p-0">
        <div
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 transition-all transform">

            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>

        </div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

		<div {{-- role="dialog" aria-labelledby="modalTitle" aria-modal="true" --}}
			class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-{{ $width }} sm:w-full"
			x-on:click.away="open = false"
			x-transition:enter="ease-out duration-300"
			x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
			x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
			x-transition:leave="ease-in duration-200"
			x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
			x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">

			{{ $slot }}

	    </div>
	</div>
</div>
