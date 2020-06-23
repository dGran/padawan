<div class="antialiased font-sans flex px-4 md:px-8 pb-2">

	<div class="view">

		<div class="image circle">
        	<img src="{{ $player->img() }}">
		</div>
		<div class="title">
			<p class="text-lg font-semibold">
				{{ $player->name }}
			</p>
	    	<div class="pt-6 pb-3">
				<a href="{{ route('admin.players.edit', $player->id) }}" class="edit">
		  			Editar
				</a>
			</div>
		</div>

		<dl>
			<div>
				<dt>Database</dt>
				<dd>{{ $player->player_database->name }}
					<br>
					{{ $player->player_database->game->name }} ({{ $player->player_database->game->platform->name }})
				</dd>
			</div>
			<div>
				<dt>Posición</dt>
				<dd>
					{{ $player->position->name }}
					<br>
					{{ $player->position->game->name }} ({{ $player->position->game->platform->name }})
				</dd>
			</div>
	    </dl>

	</div>
</div>