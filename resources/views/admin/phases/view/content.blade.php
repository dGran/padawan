<div class="antialiased font-sans flex px-4 md:px-8 pb-2">

	<div class="view">
		<div class="image">
        	<img src="{{ $competition->img() }}">
		</div>
		<div class="title">
			<p class="text-lg font-semibold">
				{{ $competition->name }}
			</p>
	    	<div class="pt-6 pb-3">
				<a href="{{ route('admin.competitions.edit', [$tournament, $season->slug, $competition->id]) }}" class="edit">
		  			Editar
				</a>
			</div>
		</div>

		<dl>
			<div>
				<dt>ID</dt>
				<dd>{{ $competition->id }}</dd>
			</div>
			<div>
				<dt>Temporada</dt>
				<dd>{{ $competition->season->name }}</dd>
			</div>
			<div>
				<dt>Nombre</dt>
				<dd>{{ $competition->name }}</dd>
			</div>
	    </dl>

	</div>
</div>