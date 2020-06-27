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
				<dt>ID</dt>
				<dd>{{ $circuit->id }}</dd>
			</div>
			<div>
				<dt>Nombre</dt>
				<dd>{{ $circuit->name }}</dd>
			</div>
			<div>
				<dt>Juego</dt>
				<dd>{{ $circuit->game->name }}
					<span class="block text-xs text-gray-600">{{ $circuit->game->platform->name }}</span>
				</dd>
			</div>
	    </dl>

	</div>
</div>