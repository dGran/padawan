<div class="antialiased font-sans flex px-4 md:px-8 pb-2">

	<div class="view">
		<div class="image">
        	<img src="{{ $reserve->presenter()['img'] }}">
		</div>
		<div class="title">
			<p class="text-lg font-semibold">
				{{ $reserve->presenter()['name'] }}
			</p>
	    	<div class="pt-6 pb-3">
				<a href="{{ route('admin.reserves.edit', [$tournament, $season->slug, $reserve->id]) }}" class="edit">
		  			Editar
				</a>
			</div>
		</div>

		<dl>
			<div>
				<dt>ID</dt>
				<dd>{{ $reserve->id }}</dd>
			</div>
			<div>
				<dt>Temporada</dt>
				<dd>{{ $reserve->season->name }}</dd>
			</div>
			<div>
				<dt>Usuario</dt>
				<dd>
					@if ($reserve->user)
						{{ $reserve->user->name }}
					@endif
				</dd>
			</div>
			<div>
				<dt>E-Team</dt>
				<dd>
					@if ($reserve->eteam)
						{{ $reserve->eteam->name }}
					@endif
				</dd>
			</div>
	    </dl>

	</div>
</div>