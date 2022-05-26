<div>
	@include('eteams.list.header')

	<x-container>
		@include('eteams.list.my-teams')

		<div class="mt-8 | flex items-baseline justify-between space-x-3">
			<h4 class="flex-1 | font-medium | text-xl md:text-2xl | font-koulen uppercase | text-title-color dark:text-dt-title-color | tracking-wide">Equipos e-sports</h4>
			<a class='hidden sm:block flex-initial | mx-auto md:mx-0 px-4 py-2 w-max text-center | bg-green-600 dark:bg-green-400 | border border-green-700 dark:border-green-300 rounded | font-semibold text-white dark:text-black | hover:scale-105 | focus:outline-none focus:scale-105 | transition transform ease-in-out duration-50 | select-none | cursor-pointer' href="{{ route('eteams.create') }}">
				Registra tu equipo e-sport!
			</a>
		</div>

        <section class="mt-1.5 sm:mt-3 mb-6">

			@include('eteams.list.filters')

			<div class="sm:hidden | flex items-center justify-center my-6">
				<a class='mx-auto md:mx-0 px-4 py-2 w-max text-center | bg-green-600 dark:bg-green-400 | border border-green-700 dark:border-green-300 rounded | font-semibold text-white dark:text-black | hover:scale-105 | focus:outline-none focus:scale-105 | transition transform ease-in-out duration-50 | select-none | cursor-pointer' href="{{ route('eteams.create') }}">
					Registra tu equipo e-sport!
				</a>
			</div>
			
			@include('eteams.list.table.navigation')

			@if ($view == "table")
				@include('eteams.list.table.index')
			@elseif ($view == "card")
				@include('eteams.list.card')
			@endif

			@include('eteams.list.table.navigation')

        </section>
    </x-container>
</div>

@section('js')
	<script>
		document.addEventListener('livewire:load', function () {
			Mousetrap.bind("right", function() {
				@this.nextPage({{ $eteams->lastPage() }});
				return false;
			});
			Mousetrap.bind("left", function() {
				@this.previousPage({{ $eteams->lastPage() }});
				return false;
			});
			Mousetrap.bind(['ctrl+right', 'command+right'], function() {
				@this.toPage({{ $eteams->lastPage() }});
				return false;
			});
			Mousetrap.bind(['ctrl+left', 'command+left'], function() {
				@this.toPage(1);
				return false;
			});
			Mousetrap.bind('/', function() {
				$('.search-input').focus();
				$('.search-input').select();
				return false;
			});
		});
	</script>
@endsection