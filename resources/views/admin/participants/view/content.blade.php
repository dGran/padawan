<div class="antialiased font-sans flex px-4 md:px-8 pb-2">

	<div class="view">
		<div class="image">
        	<img src="{{ $participant->presenter()['img'] }}">
		</div>
		<div class="title">
			<p class="text-lg font-semibold">
				{{ $participant->presenter()['name'] }}
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
				<dt>Temporada</dt>
				<dd>{{ $participant->season->name }}</dd>
			</div>
			<div>
				<dt>Usuario</dt>
				<dd>
					@if ($participant->user)
						{{ $participant->user->name }}
					@endif
				</dd>
			</div>
			<div>
				<dt>E-Team</dt>
				<dd>
					@if ($participant->eteam)
						{{ $participant->eteam->name }}
					@endif
				</dd>
			</div>
			<div>
				<dt>Equipo</dt>
				<dd>
					@if ($participant->team)
						{{ $participant->team->name }}
					@endif
				</dd>
			</div>
	    </dl>

	</div>
</div>