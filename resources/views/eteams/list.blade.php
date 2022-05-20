<div>

	@include('eteams.list.header')

    <x-container>

		@include('eteams.list.my-teams')

		<div class="mt-8 | flex items-center justify-between space-x-3">
			<h4 class="flex-1 | font-semibold | text-base md:text-lg | uppercase | text-title-color dark:text-dt-title-color | underline decoration-sky-500 underline-offset-8">Equipos e-sports</h4>
			<a class='flex-initial | mx-auto md:mx-0 px-4 py-2 w-max text-center | bg-white | border border-white rounded | font-semibold text-teal-700 | hover:scale-105 | focus:outline-none focus:scale-105 | transition transform ease-in-out duration-50 | select-none | cursor-pointer' href="{{ route('eteams.create') }}">
				Registra tu equipo e-sport!
			</a>
			<x-button-link
				wire:click="toggleView"
				class="flex-initial | text-lg | rounded-full | w-12 h-12 | bg-white dark:bg-dt-dark | focus:outline-none | border border-border-color dark:border-gray-700 | hover:border-gray-300 dark:hover:border-gray-500 | focus:border-gray-300 dark:focus:border-gray-500">
				<i class="fa-solid {{ $view != 'table' ? 'fa-address-card' : 'fa-table-list' }}" title="{{ $view != 'table' ? 'Cambiar vista Tabla' : 'Cambiar vista Card' }}"></i>
			</x-button-link>
		</div>

        <section class="mt-4 mb-6 md:mt-6 md:mb-8">

			@include('eteams.list.filters')

			@if ($view == "table")
				@include('eteams.list.table')
			@elseif ($view == "card")
				@include('eteams.list.card')
			@endif

        </section>

    </x-container>
</div>