<div class="antialiased font-sans flex px-4 md:px-8 pb-2">

	<div class="view">
		<div class="title">
			<p class="text-lg font-semibold">
				{{ $group_participant->name }}
			</p>
	    	<div class="pt-6 pb-3">
				<a href="{{ route('admin.groups_participants.edit', [$tournament, $season, $competition, $phase, $group, $group_participant->id]) }}" class="edit">
		  			Editar
				</a>
			</div>
		</div>

		<dl>
			<div>
				<dt>ID</dt>
				<dd>{{ $group_participant->id }}</dd>
			</div>
			<div>
				<dt>Fase</dt>
				<dd>{{ $group_participant->phase->name }}</dd>
			</div>
			<div>
				<dt>Nombre</dt>
				<dd>{{ $group_participant->name }}</dd>
			</div>
			<div>
				<dt>Número de participantes</dt>
				<dd>{{ $group_participant->num_participants }}</dd>
			</div>
			<div>
				<dt>Estado</dt>
				<dd>
					@if ($group_participant->active)
						<i class="fas fa-toggle-on mr-2 text-green-500 text-base"></i>Activo
					@else
						<i class="fas fa-toggle-off mr-2 text-gray-500 text-base"></i>Inactivo
					@endif
				</dd>
			</div>
	    </dl>

	</div>
</div>