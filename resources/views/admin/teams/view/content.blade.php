<div class="antialiased font-sans flex px-4 md:px-8 pb-2">

	<div class="view">

		<div class="image circle">
        	<img src="{{ $team->img() }}">
		</div>
		<div class="title">
			<p class="text-lg font-semibold">
				{{ $team->name }}
			</p>
	    	<div class="pt-6 pb-3">
				<a href="{{ route('admin.teams.edit', $team->id) }}" class="edit">
		  			Editar
				</a>
			</div>
		</div>

		<dl>
			<div>
				<dt>Juego</dt>
				<dd>{{ $team->game->name }} ({{ $team->game->platform->name }})</dd>
			</div>
			<div>
				<dt>Liga</dt>
				<dd>{{ $team->league_name }}</dd>
			</div>
	    </dl>

	</div>
</div>