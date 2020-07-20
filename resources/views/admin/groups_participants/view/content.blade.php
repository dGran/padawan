<div class="antialiased font-sans flex px-4 md:px-8 pb-2">

	<div class="view">
		<div class="title">
			<p class="text-lg font-semibold">
				{{ $group_participant->participant->presenter()["name"] }}
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
				<dt>Grupo</dt>
				<dd>{{ $group_participant->group->name }}</dd>
			</div>
			<div>
				<dt>Participante</dt>
				<dd>{{ $group_participant->participant->presenter()['name'] }}</dd>
			</div>
	    </dl>

	</div>
</div>