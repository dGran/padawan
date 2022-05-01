<div>

	@include('eteams.list.header')

    <x-container>

		@include('eteams.list.my-teams')

		<div class="mt-8 | flex items-center justify-between">
			<h4 class="font-semibold | text-base md:text-lg | uppercase | text-title-color dark:text-dt-title-color">Equipos e-sports</h4>
			<div>
				<span class="pr-2 | text-xs | text-text-light-color dark:dt-text-light-color">{{ $view == 'table' ? 'Table' : 'Card' }} view</span>
				<x-button-link
					wire:click="toggleView"
					class="text-lg | rounded-full | w-10 h-10 | bg-white dark:bg-dt-dark | focus:outline-none | border border-border-color dark:border-gray-700 | hover:border-gray-300 dark:hover:border-gray-500 | focus:border-gray-300 dark:focus:border-gray-500">
					<i class="text-base fa-solid {{ $view != 'table' ? 'fa-table-list' : 'fa-address-card' }} "></i>
				</x-button-link>
			</div>
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