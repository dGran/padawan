<div class="antialiased font-sans flex px-4 md:px-8 pb-2">

	<div class="view">

        <div class="image circle flex items-center justify-center">
            <i class="text-5xl text-gray-600 {{ $position->font_icon }}"></i>
        </div>
		<div class="title">
			<p class="text-lg font-semibold">
				{{ $position->name }}
			</p>
			@if ($position->category)
				<p class="text-sm text-gray-600">
					{{ $position->category }}
				</p>
			@endif
	    	<div class="pt-6 pb-3">
				<a href="{{ route('admin.positions.edit', $position->id) }}" class="edit">
		  			Editar
				</a>
			</div>
		</div>

		<dl>
			<div>
				<dt>Juego</dt>
				<dd>{{ $position->game->name }} ({{ $position->game->platform->name }})</dd>
			</div>
			<div>
				<dt>Orden</dt>
				<dd>{{ $position->order }}</dd>
			</div>
	    </dl>

	</div>
</div>