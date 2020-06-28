<div class="antialiased font-sans flex px-4 md:px-8 pb-2">

	<div class="view">
		<div class="title">
			<p class="text-lg font-semibold">
				{{ $season->name }}
			</p>
	    	<div class="pt-6 pb-3">
				<a href="{{ route('admin.seasons.edit', [$tournament->slug, $season->id]) }}" class="edit">
		  			Editar
				</a>
			</div>
		</div>

		<dl>
			<div>
				<dt>ID</dt>
				<dd>{{ $season->id }}</dd>
			</div>
			<div>
				<dt>Nombre</dt>
				<dd>{{ $season->name }}</dd>
			</div>
			<div>
				<dt>Torneo</dt>
				<dd>{{ $season->tournament->name }}
					<span class="block text-xs text-gray-600">{{ $season->tournament->game->name }} - {{ $season->tournament->game->platform->name }}</span>
				</dd>
			</div>
	    </dl>

	</div>
</div>