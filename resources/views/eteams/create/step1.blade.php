<div class="max-w-full md:max-w-2xl mx-auto | my-8">
	<h4 class="text-xl lg:text-2xl text-title-color dark:text-white | font-raleway font-extrabold | tracking-wide | mb-1">
	    Selecciona el juego en el que participa tu equipo
	</h4>

	<x-card class="my-3 lg:my-6 p-6 | text-xs lg:text-sm">
{{-- 		<div>
		    <x-label for="game_id" :value="__('* Juego')" />
		    <x-select class="sm:mt-1 w-full" id="game_id" wire:model="game_id">
		        <option hidden selected>Selecciona el juego</option>
		        @foreach ($games as $game)
		            <option value="{{ $game->id }}">{{ $game->name }}</option>
		        @endforeach
		    </x-select>
		</div> --}}

		@foreach ($games as $game)
			<button class="w-full | flex items-center space-x-3 py-1 p-3 my-2.5 | rounded-md | border border-transparent hover:border-border-color dark:hover:border-dt-border-color | focus:outline-none focus:border-border-color dark:focus:border-dt-border-color | {{ $game_id == $game->id ? 'bg-border-color dark:bg-dt-border-color cursor-not-allowed pointer-events-none' : 'bg-white dark:bg-dt-dark cursor-pointer' }}" wire:click="selectGame({{ $game->id }})">
				<img src="{{ $game->getLogo() }}" alt="" class="w-9 h-9 object-cover rounded-full">
				<p>{{ $game->name }}</p>
			</button>
		@endforeach

		<div class="mt-8 pt-4 flex items-center justify-end | border-t border-border-color dark:border-dt-border-color">
			<x-button class="text-center text-normal lg:text-base" {{-- disabled="{{ $formDisabled }}" --}} wire:click="$set('paso', 2)">
			    {{ __('Siguiente...') }}
			</x-button>
		</div>
	</x-card>

</div>