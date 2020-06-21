<div class="antialiased font-sans flex px-4 md:px-8 pb-2">

	<div class="view">

		<div class="image">
        	<img src="{{ $circuit->img() }}">
		</div>
		<div class="title">
			<p class="text-lg font-semibold">
				{{ $circuit->name }}
			</p>
	    	<div class="pt-6 pb-3">
				<a href="{{ route('admin.circuits.edit', $circuit->id) }}" class="edit">
		  			Editar
				</a>
			</div>
		</div>

		<dl>
			<div>
				<dt>Juego</dt>
				<dd>{{ $circuit->game->name }} ({{ $circuit->game->platform->name }})</dd>
			</div>
	    </dl>

	</div>
</div>