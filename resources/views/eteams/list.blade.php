<div>
	@include('eteams.list.header')

	<x-container>

		<div class="mt-8 | flex items-end justify-between space-x-3">
			<div class="flex-1 flex items-baseline justify-between sm:justify-start space-x-4">
				<h4 class="font-medium | text-xl md:text-2xl | font-koulen uppercase | text-title-color dark:text-dt-title-color | tracking-wide">Equipos e-sports</h4>
				<a href="{{ route('my-teams') }}" class="dark:text-dt-text-light-color hover:underline focus:underline focus:outline-none">Mis equipos</a>
			</div>
			<x-link-button class="hidden sm:block | flex-initial | hover:scale-105 focus:scale-105 | transition transform ease-in-out duration-50" href="{{ route('eteams.create') }}">
				Registra tu equipo e-sport!
			</x-link-button>
		</div>

        <section class="mt-1.5 sm:mt-3 mb-6">

			@include('eteams.list.filters')

			<div class="sm:hidden | flex items-center justify-center my-6">
				<x-link-button class="mx-auto | hover:scale-105 focus:scale-105 | transition transform ease-in-out duration-50" href="{{ route('eteams.create') }}">
					Registra tu equipo e-sport!
				</x-link-button>
			</div>

			@include('eteams.list.table.navigation')

			@if ($view == "table")
				@include('eteams.list.table.index')
			@elseif ($view == "card")
				@include('eteams.list.card.index')
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
