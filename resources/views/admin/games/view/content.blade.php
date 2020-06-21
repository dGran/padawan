<div class="antialiased font-sans flex px-4 md:px-8 pb-2">

	<div class="view">
		<div class="image">
        	<img src="{{ $game->img() }}">
		</div>
		<div class="title">
			<p class="text-lg font-semibold">
				{{ $game->name }}
			</p>
	    	<div class="pt-6 pb-3">
				<a href="{{ route('admin.games.edit', $game->id) }}" class="edit">
		  			Editar
				</a>
			</div>
		</div>

		<dl>
			<div>
				<dt>Plataforma</dt>
				<dd>
					{{ $game->platform->name }}
				</dd>
			</div>
			<div>
				<dt>Modo de juego: Liga</dt>
				<dd>
				@if ($game->mode_league)
					<i class="fas fa-check text-green-500 text-xl mt-1"></i>
				@else
					<i class="fas fa-ban text-red-500 text-xl mt-1"></i>
				@endif
				</dd>
			</div>
			<div>
				<dt>Modo de juego: Playoffs</dt>
				<dd>
				@if ($game->mode_playoffs)
					<i class="fas fa-check text-green-500 text-xl mt-1"></i>
				@else
					<i class="fas fa-ban text-red-500 text-xl mt-1"></i>
				@endif
				</dd>
			</div>
			<div>
				<dt>Modo de juego: Carreras</dt>
				<dd>
				@if ($game->mode_races)
					<i class="fas fa-check text-green-500 text-xl mt-1"></i>
				@else
					<i class="fas fa-ban text-red-500 text-xl mt-1"></i>
				@endif
				</dd>
			</div>
			<div>
				<dt>Plantillas de jugadores</dt>
				<dd>
				@if ($game->rosters)
					<i class="fas fa-check text-green-500 text-xl mt-1"></i>
				@else
					<i class="fas fa-ban text-red-500 text-xl mt-1"></i>
				@endif
				</dd>
			</div>
			<div>
				<dt>Posiciones</dt>
				<dd>
				@if ($game->positions)
					<i class="fas fa-check text-green-500 text-xl mt-1"></i>
				@else
					<i class="fas fa-ban text-red-500 text-xl mt-1"></i>
				@endif
				</dd>
			</div>
			<div>
				<dt>Circuitos</dt>
				<dd>
				@if ($game->circuits)
					<i class="fas fa-check text-green-500 text-xl mt-1"></i>
				@else
					<i class="fas fa-ban text-red-500 text-xl mt-1"></i>
				@endif
				</dd>
			</div>
	    </dl>

	</div>
</div>