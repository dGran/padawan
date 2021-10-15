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

@if ($game_id)
	<div class="mt-3 flex items-center justify-end">
		<x-button class="text-center text-normal lg:text-base" disabled="{{ $step2_disabled }}" wire:click="changeStep(1, true)">
		    {{ __('Continuar') }}
		</x-button>
	</div>

	<h4 class="text-base lg:text-lg | font-raleway font-bold | tracking-wide | mt-4">
		Logo & Banner
	</h4>

	<x-card class="my-1.5 p-4 md:p-6 | text-xs lg:text-sm">
		<div class="mt-2 mb-6 rounded-md relative select-none">
			<p class="pb-3">Vista preliminar</p>
			<img src="{{ $banner ? $banner->temporaryUrl() : $banner_preview }}" alt="" class="w-full h-32 sm:h-40 md:h-48 lg:h-64 xl:h-80 object-cover rounded-md | border border-border-color dark:border-dt-border-color">
			<div class="absolute h-full flex items-center" style="top: 50%; left: 50%; transform: translate(-50%, -35%);">
				<img src="{{ $logo ? $logo->temporaryUrl() : $logo_preview }}" alt="" class="w-28 h-28 sm:w-36 sm:h-36 md:w-44 md:h-44 lg:w-60 lg:h-60 xl:w-72 xl:h-72 | rounded-full | bg-white | object-contain | p-0.5 | shadow-2xl">
			</div>
		</div>

		<div class="flex flex-col space-y-6">
		    <div>
		    	<div class="flex items-end justify-between flex-nowrap">
		    		<div>
	    				<x-label for="short_name" :value="__('Logo')" />
		    			<p class="pt-0.5 | text-text-light-color dark:text-dt-text-light-color | text-xxxs md:text-xxs">.png, .jpeg, .jpg, .gif o .svg / máx. 1 MB / Recomendado 256x256px</p>
		    		</div>
					@if ($logo)
		    			<x-link wire:click="deleteLogo" class="cursor-pointer"><i class="fas fa-times"></i></x-link>
					@endif
		    	</div>
			    <label class="w-full | flex items-center justify-center space-x-3 | mt-1.5 px-4 py-2 | border border-border-color dark:border-dt-border-color | rounded-lg | uppercase | cursor-pointer | hover:bg-border-color dark:hover:bg-dt-border-color | hover:text-title-color dark:hover:text-dt-title-color">
			        <svg class="w-8 h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
			            <path d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
			        </svg>
			        <span class="">Selecciona archivo...</span>
			        <input type='file' class="hidden" accept=".jpeg, .png, .jpg, .gif, .svg" wire:model="logo" wire:change="uploadLogo"/>
			    </label>
			    {{-- @error('logo') <p class="text-red-400 | mt-1 | text-xxs md:text-xs">{{ $message }}</p> @enderror --}}
		    </div>

		    <div>
		    	<div class="flex items-end justify-between">
		    		<div>
						<x-label for="short_name" :value="__('Banner')" />
		    			<p class="pt-0.5 | text-text-light-color dark:text-dt-text-light-color | text-xxxs md:text-xxs">.png, .jpeg, .jpg, .gif o .svg / máx. 1 MB / Recomendado 1200x500px</p>
		    		</div>
					@if ($banner)
		    			<x-link wire:click="deleteBanner" class="cursor-pointer"><i class="fas fa-times"></i></x-link>
					@endif
		    	</div>
			    <label class="w-full | flex items-center justify-center space-x-3 | mt-1.5 px-4 py-2 | border border-border-color dark:border-dt-border-color | rounded-lg | uppercase | cursor-pointer | hover:bg-border-color dark:hover:bg-dt-border-color | hover:text-title-color dark:hover:text-dt-title-color">
			        <svg class="w-8 h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
			            <path d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
			        </svg>
			        <span class="">Selecciona archivo...</span>
			        <input type='file' class="hidden" accept=".jpeg, .png, .jpg, .gif, .svg" wire:model="banner" wire:change="uploadBanner"/>
			    </label>
			    {{-- @error('banner') <p class="text-red-400 | mt-1 | text-xxs md:text-xs">{{ $message }}</p> @enderror --}}
		    </div>
		</div>
	</x-card>
@endif

<div class="mt-3 flex items-center justify-end">
	<x-button class="text-center text-normal lg:text-base" disabled="{{ $step2_disabled }}" wire:click="changeStep(1, true)">
	    {{ __('Continuar') }}
	</x-button>
</div>