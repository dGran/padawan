@if ($season->competitions->count() > 1)
	<div class="bg-gray-800 text-white p-3">
		<img src="{{ $competition->img() }}" class="h-16 w-16 inline-block mr-4">
		{{ $competition->name }}
	</div>
@endif

@if ($tournament->seasons->count() > 1 || $season->competitions->count() > 1)
    @include('tournament.partials.selector', ['route_name' => 'tournament.standing', 'season_selector' => true, 'competition_selector' => true])
@endif

<div class="content p-2">
    <h2>clasificación</h2>
    <div class="p-3">
    	<ul>
    		<li>Torneo: {{ $tournament->slug }}</li>
    		<li>Temporada: {{ $season->slug }}</li>
    		<li>Competición: {{ $competition->slug }}</li>
    		<li>Fase: {{ $phase->slug }}</li>
    		<li>Grupo: {{ $group->slug }}</li>
    	</ul>
    </div>
</div>