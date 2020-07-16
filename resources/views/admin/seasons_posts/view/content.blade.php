<div class="antialiased font-sans flex px-4 md:px-8 pb-2">

	<div class="view">
		<div class="image">
        	<img src="{{ $season_post->img() }}">
		</div>
		<div class="title">
			<p class="text-lg font-semibold">
				{{ $season_post->title }}
			</p>
	    	<div class="pt-6 pb-3">
				<a href="{{ route('admin.seasons_posts.edit', [$tournament, $season, $season_post->id]) }}" class="edit">
		  			Editar
				</a>
			</div>
		</div>

		<dl>
			<div>
				<dt>ID</dt>
				<dd>{{ $season_post->id }}</dd>
			</div>
			<div>
				<dt>Temporada</dt>
				<dd>{{ $season_post->season->name }}</dd>
			</div>
			<div>
				<dt>Tipo</dt>
				<dd>{{ $season_post->type_name() }}</dd>
			</div>
			<div>
				<dt>Título</dt>
				<dd>{{ $season_post->title }}</dd>
			</div>
			<div>
				<dt>Contenido</dt>
				<dd>
					<textarea readonly class="appearance-none block w-full border border-gray-300 rounded py-2 px-3 focus:border-gray-500" rows="10">{{ $season_post->content }}</textarea>
				</dd>
			</div>
	    </dl>

	</div>
</div>