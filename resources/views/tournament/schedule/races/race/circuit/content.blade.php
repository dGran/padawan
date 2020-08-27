@include('tournament.schedule.races.race.menu')

<div class="content">
	<div class="race-content">

		<div class="race-circuit-content pt-4">
			<div class="race-circuit-wrapper">
		    	<div class="title">
		    		{{ $race->circuit->name }}
		    	</div>
		    	<div class="content">
		    		<ul>
		    			<li>
							<i class="fas fa-dot-circle mr-2 text-{{ $tournament->game->platform->color }}-700"></i><b>País:</b><img class="mx-1 h-6 w-6 inline-block" src="https://as01.epimg.net/img/comunes/fotos/fichas/paises/svg/aut.svg">Japón
		    			</li>
		    			<li>
							<i class="fas fa-dot-circle mr-2 text-{{ $tournament->game->platform->color }}-700"></i><b>Longitud: </b> 1300 m.
		    			</li>
		    			<li>
							<i class="fas fa-dot-circle mr-2 text-{{ $tournament->game->platform->color }}-700"></i><b>Vueltas: </b> {{ $race->laps }}
		    			</li>
		    		</ul>
			    	<figure>
			    		<img src="{{ $race->circuit->img() }}">
			    	</figure>
		    	</div>
			</div>
		</div>

	</div> {{-- race-content --}}

</div> {{-- content --}}