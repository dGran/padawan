<h4 class="text-lg lg:text-xl | font-raleway font-extrabold | tracking-wide | mb-1">
    <span class="text-edblue-500 dark:text-edblue-400">Paso 1.</span> Selecciona el juego en el que participa tu equipo
</h4>

<x-card class="my-1.5 p-4 | text-xs lg:text-sm">
	@foreach ($games as $game)
		<button class="w-full | flex items-center space-x-3 py-1 p-3 my-2.5 | rounded-md | border border-transparent hover:border-border-color dark:hover:border-dt-border-color | focus:outline-none focus:border-border-color dark:focus:border-dt-border-color | {{ $game_id == $game->id ? 'bg-border-color dark:bg-dt-border-color cursor-not-allowed pointer-events-none' : 'bg-white dark:bg-dt-dark cursor-pointer' }}" wire:click="selectGame({{ $game->id }})">
			<img src="{{ $game->getLogo() }}" alt="" class="w-9 h-9 object-cover rounded-full">
			<p>{{ $game->name }}</p>
		</button>
	@endforeach

	<div class="mt-8 pt-4 flex items-center justify-end | border-t border-border-color dark:border-dt-border-color">
		<x-button class="text-center text-normal lg:text-base" {{-- disabled="{{ $formDisabled }}" --}} wire:click="changeStep(1, true)">
		    {{ __('Paso 2') }}
		</x-button>
	</div>
</x-card>