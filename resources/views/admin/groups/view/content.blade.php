<div class="antialiased font-sans flex px-4 md:px-8 pb-2">

	<div class="view">
		<div class="title">
			<p class="text-lg font-semibold">
				{{ $group->name }}
			</p>
	    	<div class="pt-6 pb-3">
				<a href="{{ route('admin.groups.edit', [$tournament, $season, $competition, $phase, $group->id]) }}" class="edit">
		  			Editar
				</a>
			</div>
		</div>

		<dl>
			<div>
				<dt>ID</dt>
				<dd>{{ $group->id }}</dd>
			</div>
			<div>
				<dt>Fase</dt>
				<dd>{{ $group->phase->name }}</dd>
			</div>
			<div>
				<dt>Nombre</dt>
				<dd>{{ $group->name }}</dd>
			</div>
			<div>
				<dt>Número de participantes</dt>
				<dd>{{ $group->num_participants }}</dd>
			</div>
			<div>
				<dt>Estado</dt>
				<dd class="flex items-center">
					@if ($group->active)
						<i class="icon-toggle-on text-2xl mr-2 text-green-500 text-base"></i>
						<span>Activo</span>
					@else
						<i class="icon-toggle-off text-2xl mr-2 text-gray-500 text-base"></i>
						<span>Inactivo</span>
					@endif
				</dd>
			</div>
	    </dl>

	</div>
</div>