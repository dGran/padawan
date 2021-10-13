<ul class="flex items-center flex-nowrap | space-x-4 | py-2 | overflow-x-auto | scrollbar-thin scrollbar-thumb-sb-thumb-color scrollbar-track-sb-track-color hover:scrollbar-thumb-sb-thumb-color-hover dark:scrollbar-thumb-sb-thumb-dt-color dark:scrollbar-track-sb-track-dt-color dark:hover:scrollbar-thumb-sb-thumb-dt-color-hover scrollbar-thumb-rounded-full">
	<li class="flex-shrink-0">
		<span class="text-base lg:text-lg | font-raleway font-extrabold | tracking-wide | px-2 py-1 | bg-edblue-500 | border border-edblue-500 rounded | text-white | focus:outline-none | select-none">Paso 1</span>
	</li>
	<li class="flex-shrink-0">
		<x-button-link class="text-base lg:text-lg | font-raleway font-extrabold | tracking-wide" disabled="{{ $step2_disabled }}" wire:click="changeStep(1, true)">Paso 2</x-button-link>
	</li>
	<li class="flex-shrink-0">
		<x-button-link class="text-base lg:text-lg | font-raleway font-extrabold | tracking-wide" disabled="{{ $step3_disabled }}" wire:click="changeStep(2, true)">Paso 3</x-button-link>
	</li>
	<li class="flex-shrink-0">
		<x-button-link class="text-base lg:text-lg | font-raleway font-extrabold | tracking-wide" disabled="{{ $step4_disabled }}" wire:click="changeStep(3, true)">Paso 4</x-button-link>
	</li>
</ul>

<h4 class="text-base lg:text-lg | font-raleway font-bold | tracking-wide | mt-4">
	Selecciona el juego en el que participa tu equipo
</h4>

<x-card class="my-1.5 p-4 md:p-6 | text-xs lg:text-sm">
	@foreach ($games as $game)
		<button class="w-full | flex items-center | space-x-3 | py-1.5 px-3 | rounded-md | border border-transparent hover:border-border-color dark:hover:border-dt-border-color | focus:outline-none focus:border-border-color dark:focus:border-dt-border-color | {{ $game_id == $game->id ? 'bg-edblue-500 dark:bg-edblue-400 text-dt-title-color dark:text-title-color cursor-not-allowed pointer-events-none' : 'bg-white dark:bg-dt-dark cursor-pointer' }}" wire:click="selectGame({{ $game->id }})">
			<img src="{{ $game->getLogo() }}" alt="" class="w-9 h-9 object-cover rounded-full">
			<p>{{ $game->name }}</p>
		</button>
	@endforeach
</x-card>

<div class="mt-3 flex items-center justify-end">
	<x-button class="text-center text-normal lg:text-base" disabled="{{ $step2_disabled }}" wire:click="changeStep(1, true)">
	    {{ __('Continuar') }}
	</x-button>
</div>