<div class="antialiased font-sans flex px-4 md:px-8 pb-2">

	<div class="view">
		<div class="title">
			<p class="text-lg font-semibold">
				{{ $game->name }}
			</p>
		</div>
		<div class="image">
			<p class="text-center font-bold text-11 uppercase">Logo</p>
        	<img src="{{ $game->img() }}">
		</div>
		<div class="mt-3 mx-3">
			<div class="image original-size">
				<p class="text-center font-bold text-11 uppercase">Banner</p>
	        	<img src="{{ $game->banner() }}">
			</div>
		</div>
		<div class="title">
	    	<div class="pt-3 pb-3">
				<a href="{{ route('admin.games.edit', $game->id) }}" class="edit">
		  			Editar
				</a>
			</div>
		</div>

		<dl>
			<div>
				<dt>ID</dt>
				<dd>{{ $game->id }}</dd>
			</div>
			<div>
				<dt>Nombre</dt>
				<dd>{{ $game->name }}</dd>
			</div>
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
					<i class="fas fa-check text-green-500 text mt-1"></i>
				@else
					<i class="fas fa-ban text-red-500 text mt-1"></i>
				@endif
				</dd>
			</div>
			<div>
				<dt>Modo de juego: Playoffs</dt>
				<dd>
				@if ($game->mode_playoffs)
					<i class="fas fa-check text-green-500 text mt-1"></i>
				@else
					<i class="fas fa-ban text-red-500 text mt-1"></i>
				@endif
				</dd>
			</div>
			<div>
				<dt>Modo de juego: Carreras</dt>
				<dd>
				@if ($game->mode_races)
					<i class="fas fa-check text-green-500 text mt-1"></i>
				@else
					<i class="fas fa-ban text-red-500 text mt-1"></i>
				@endif
				</dd>
			</div>
			<div>
				<dt>Plantillas de jugadores</dt>
				<dd>
				@if ($game->rosters)
					<i class="fas fa-check text-green-500 text mt-1"></i>
				@else
					<i class="fas fa-ban text-red-500 text mt-1"></i>
				@endif
				</dd>
			</div>
			<div>
				<dt>Posiciones</dt>
				<dd>
				@if ($game->positions)
					<i class="fas fa-check text-green-500 text mt-1"></i>
				@else
					<i class="fas fa-ban text-red-500 text mt-1"></i>
				@endif
				</dd>
			</div>
			<div>
				<dt>Circuitos</dt>
				<dd>
				@if ($game->circuits)
					<i class="fas fa-check text-green-500 text mt-1"></i>
				@else
					<i class="fas fa-ban text-red-500 text mt-1"></i>
				@endif
				</dd>
			</div>
	    </dl>

	</div>
</div>