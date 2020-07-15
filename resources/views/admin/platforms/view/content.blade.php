<div class="antialiased font-sans flex px-4 md:px-8 pb-2">

	<div class="view">

		<div class="image circle">
        	<img src="{{ $platform->img() }}">
		</div>
		<div class="title">
			<p class="text-lg font-semibold">
				{{ $platform->name }}
			</p>
	    	<div class="pt-6 pb-3">
				<a href="{{ route('admin.platforms.edit', $platform->id) }}" class="edit">
		  			Editar
				</a>
			</div>
		</div>

		<dl>
			<div>
				<dt>ID</dt>
				<dd>{{ $platform->id }}</dd>
			</div>
			<div>
				<dt>Nombre</dt>
				<dd>{{ $platform->name }}</dd>
			</div>
			<div>
				<dt>Color</dt>
				<dd>
					<span class="bg-{{ $platform->color }}-500 py-2 px-4 text-white rounded">
						{{ $platform->color_name() }}
					</span>
				</dd>
			</div>
	    </dl>

	</div>
</div>