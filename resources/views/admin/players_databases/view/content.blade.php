<div class="antialiased font-sans flex px-4 md:px-8 pb-2">

	<div class="view">

		<div class="title">
			<p class="text-lg font-semibold">
				{{ $player_database->name }}
			</p>
			@if ($player_database->category)
				<p class="text-sm text-gray-600">
					{{ $player_database->category }}
				</p>
			@endif
	    	<div class="pt-6 pb-3">
				<a href="{{ route('admin.players_databases.edit', $player_database->id) }}" class="edit">
		  			Editar
				</a>
			</div>
		</div>

		<dl>
			<div>
				<dt>Juego</dt>
				<dd>{{ $player_database->game->name }} ({{ $player_database->game->platform->name }})</dd>
			</div>
	    </dl>

	</div>
</div>