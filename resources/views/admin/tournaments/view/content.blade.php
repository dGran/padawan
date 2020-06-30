<div class="antialiased font-sans flex px-4 md:px-8 pb-2">

	<div class="view">
		<div class="image">
        	<img src="{{ $tournament->img() }}">
		</div>
		<div class="title">
			<p class="text-lg font-semibold">
				{{ $tournament->name }}
			</p>
	    	<div class="pt-6 pb-3">
				<a href="{{ route('admin.tournaments.edit', $tournament->id) }}" class="edit">
		  			Editar
				</a>
			</div>
		</div>

		<dl>
			<div>
				<dt>ID</dt>
				<dd>{{ $tournament->id }}</dd>
			</div>
			<div>
				<dt>Nombre</dt>
				<dd>{{ $tournament->name }}</dd>
			</div>
			<div>
				<dt>Juego</dt>
				<dd>{{ $tournament->game->name }}
					<span class="block text-xs text-gray-600">{{ $tournament->game->platform->name }}</span>
				</dd>
			</div>
			<div>
				<dt>Tipo Participante</dt>
				<dd>
					@if ($tournament->participant_type == "individual")
						Individual
					@else
						e-Teams
					@endif
				</dd>
			</div>
			<div>
				<dt>Usa Equipos</dt>
				<dd>
				@if ($tournament->use_teams)
					<i class="fas fa-check text-green-500 text mt-1"></i>
				@else
					<i class="fas fa-ban text-red-500 text mt-1"></i>
				@endif
				</dd>
			</div>
			<div>
				<dt>Usa Plantillas de jugadores</dt>
				<dd>
				@if ($tournament->use_rosters)
					<i class="fas fa-check text-green-500 text mt-1"></i>
				@else
					<i class="fas fa-ban text-red-500 text mt-1"></i>
				@endif
				</dd>
			</div>
			<div>
				<dt>Mercado: Presupuestos</dt>
				<dd>
				@if ($tournament->use_economy)
					<i class="fas fa-check text-green-500 text mt-1"></i>
				@else
					<i class="fas fa-ban text-red-500 text mt-1"></i>
				@endif
				</dd>
			</div>
			<div>
				<dt>Mercado: Salarios</dt>
				<dd>
				@if ($tournament->use_salaries)
					<i class="fas fa-check text-green-500 text mt-1"></i>
				@else
					<i class="fas fa-ban text-red-500 text mt-1"></i>
				@endif
				</dd>
			</div>
			<div>
				<dt>Mercado: Fichajes</dt>
				<dd>
				@if ($tournament->use_transfers)
					<i class="fas fa-check text-green-500 text mt-1"></i>
				@else
					<i class="fas fa-ban text-red-500 text mt-1"></i>
				@endif
				</dd>
			</div>
			<div>
				<dt>Mercado: Claúsulas</dt>
				<dd>
				@if ($tournament->use_clauses)
					<i class="fas fa-check text-green-500 text mt-1"></i>
				@else
					<i class="fas fa-ban text-red-500 text mt-1"></i>
				@endif
				</dd>
			</div>
			<div>
				<dt>Mercado: Agentes Libres</dt>
				<dd>
				@if ($tournament->use_free_agents)
					<i class="fas fa-check text-green-500 text mt-1"></i>
				@else
					<i class="fas fa-ban text-red-500 text mt-1"></i>
				@endif
				</dd>
			</div>
			<div>
				<dt>Reglas</dt>
				<dd>
					<textarea class="appearance-none block w-full border border-gray-300 rounded py-2 px-3 focus:border-gray-500" rows="10">{{ $tournament->rules }}</textarea>
				</dd>
			</div>
	    </dl>

	</div>
</div>