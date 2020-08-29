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
							<i class="fas fa-dot-circle mr-2 text-{{ $tournament->game->platform->color }}-700"></i><b>País: </b> {{ $race->circuit->country_name() }}
		    			</li>
		    			<li>
							<i class="fas fa-dot-circle mr-2 text-{{ $tournament->game->platform->color }}-700"></i><b>Longitud: </b> {{ $race->circuit->length() }}
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