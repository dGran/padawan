<div class="antialiased font-sans flex px-4 md:px-8 pb-2">

	<div class="view">

		<div class="image original-size">
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
			<div>
				<dt>Longitud</dt>
				<dd>
					@if ($circuit->length)
						{{ number_format($circuit->length, 0, ',', '.') }} km
					@else
						N/D
					@endif
				</dd>
			</div>
			<div>
				<dt>País</dt>
				<dd>
					@if ($circuit->country)
						{{ $circuit->country->name }}
					@else
						N/D
					@endif
				</dd>
			</div>
	    </dl>

	</div>
</div>