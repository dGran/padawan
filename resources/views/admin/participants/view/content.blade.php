<div class="antialiased font-sans flex px-4 md:px-8 pb-2">

	<div class="view">
		<div class="title">
			<p class="text-lg font-semibold">
				{{ $participant->name }}
			</p>
	    	<div class="pt-6 pb-3">
				<a href="{{ route('admin.participants.edit', [$tournament, $season, $participant->id]) }}" class="edit">
		  			Editar
				</a>
			</div>
		</div>

		<dl>
			<div>
				<dt>ID</dt>
				<dd>{{ $participant->id }}</dd>
			</div>
			<div>
				<dt>Nombre</dt>
				<dd>{{ $participant->name() }}</dd>
			</div>
{{-- 			<div>
				<dt>Torneo</dt>
				<dd>{{ $participant->tournament->name }}
					<span class="block text-xs text-gray-600">{{ $participant->tournament->game->name }} - {{ $participant->tournament->game->platform->name }}</span>
				</dd>
			</div> --}}
	    </dl>

	</div>
</div>