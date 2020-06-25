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
					<span class="block text-xs text-gray-600">{{ $player->player_database->game->name }} ({{ $player->player_database->game->platform->name }})</span>
				</dd>
			</div>
			<div>
				<dt>Posición</dt>
				<dd>
					@if ($player->position_id)
						{{ $player->position->name }}
					@endif
				</dd>
			</div>
			<div>
				<dt>Nacionalidad</dt>
				<dd>
					{{ $player->nation_name }}
				</dd>
			</div>
			<div>
				<dt>Altura</dt>
				<dd>
					@if ($player->height)
						{{ $player->height }} cm
					@endif
				</dd>
			</div>
			<div>
				<dt>Edad</dt>
				<dd>
					@if ($player->age)
						{{ $player->age }} años
					@endif
				</dd>
			</div>
			<div>
				<dt>Pie</dt>
				<dd>
					@if ($player->foot == 'left')
						Izquierdo
					@endif
					@if ($player->foot == 'right')
						Derecho
					@endif
				</dd>
			</div>
			<div>
				<dt>Liga</dt>
				<dd>
					{{ $player->league_name }}
				</dd>
			</div>
			<div>
				<dt>Equipo</dt>
				<dd>
					{{ $player->team_name }}
				</dd>
			</div>
			<div>
				<dt>Media</dt>
				<dd>
					{{ $player->overall_rating }}
				</dd>
			</div>
			<div>
				<dt>{{ $player->player_database->game->name }} ID</dt>
				<dd>
					{{ $player->game_id }}
				</dd>
			</div>
	    </dl>

	</div>
</div>