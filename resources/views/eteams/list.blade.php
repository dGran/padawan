<div>

	@include('eteams.list.header')

    <x-container>

		@include('eteams.list.my-teams')

        <h4 class="mt-8 | font-semibold | font-fjalla | text-lg md:text-xl | tracking-wider | text-title-color dark:text-dt-title-color">Equipos e-sports</h4>

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