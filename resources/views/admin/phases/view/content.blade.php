<div class="antialiased font-sans flex px-4 md:px-8 pb-2">

	<div class="view">
		<div class="title">
			<p class="text-lg font-semibold">
				{{ $phase->name }}
			</p>
	    	<div class="pt-6 pb-3">
				<a href="{{ route('admin.phases.edit', [$tournament, $season, $competition, $phase->id]) }}" class="edit">
		  			Editar
				</a>
			</div>
		</div>

		<dl>
			<div>
				<dt>ID</dt>
				<dd>{{ $phase->id }}</dd>
			</div>
			<div>
				<dt>Competición</dt>
				<dd>{{ $phase->competition->name }}</dd>
			</div>
			<div>
				<dt>Nombre</dt>
				<dd>{{ $phase->name }}</dd>
			</div>
			<div>
				<dt>Modo de juego</dt>
				<dd>{{ $phase->mode_name() }}</dd>
			</div>
			<div>
				<dt>Número de participantes</dt>
				<dd>{{ $phase->num_participants }}</dd>
			</div>
			<div>
				<dt>Orden</dt>
				<dd>{{ $phase->order }}</dd>
			</div>
			<div>
				<dt>Estado</dt>
				<dd class="flex items-center">
					@if ($phase->active)
						<i class="icon-toggle-on text-2xl mr-2 text-green-500 text-base"></i>
						<span>Activa</span>
					@else
						<i class="icon-toggle-off text-2xl mr-2 text-gray-500 text-base"></i>
						<span>Inactiva</span>
					@endif
				</dd>
			</div>
	    </dl>

	</div>
</div>