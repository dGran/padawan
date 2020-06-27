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
				<dt>ID</dt>
				<dd>{{ $player_database->id }}</dd>
			</div>
			<div>
				<dt>Nombre</dt>
				<dd>{{ $player_database->name }}</dd>
			</div>
			<div>
				<dt>Juego</dt>
				<dd>{{ $player_database->game->name }}
				 	<span class="block text-xs text-gray-600">{{ $player_database->game->platform->name }}</span>
				</dd>
			</div>
	    </dl>

	</div>
</div>