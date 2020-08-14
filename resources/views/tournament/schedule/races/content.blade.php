<style>

	.ribbon {
	  position: absolute;
	  left: -5px; top: -5px;
	  z-index: 1;
	  overflow: hidden;
	  width: 75px; height: 75px;
	  text-align: right;
	}
	.ribbon span {
	  font-size: 10px;
	  font-weight: bold;
	  color: #FFF;
	  text-transform: uppercase;
	  text-align: center;
	  line-height: 20px;
	  transform: rotate(-45deg);
	  -webkit-transform: rotate(-45deg);
	  width: 100px;
	  display: block;
	  background: #79A70A;
	  background: linear-gradient(#B6BAC9 0%, #808080 100%);
	  box-shadow: 0 3px 10px -5px rgba(0, 0, 0, 1);
	  position: absolute;
	  top: 19px; left: -21px;
	}
	.ribbon span::before {
	  content: "";
	  position: absolute; left: 0px; top: 100%;
	  z-index: -1;
	  border-left: 3px solid #808080;
	  border-right: 3px solid transparent;
	  border-bottom: 3px solid transparent;
	  border-top: 3px solid #808080;
	}
	.ribbon span::after {
	  content: "";
	  position: absolute; right: 0px; top: 100%;
	  z-index: -1;
	  border-left: 3px solid transparent;
	  border-right: 3px solid #808080;
	  border-bottom: 3px solid transparent;
	  border-top: 3px solid #808080;
	}
</style>

<div class="content p-2">
	@if ($racing->nextRace() && \Carbon\Carbon::parse($racing->nextRace()->date) > \Carbon\Carbon::now())
	    <h2>próxima carrera</h2>
	    <div class="races-schedule-content">
	    	<div class="countdown-content">
		    	<p class="race">
		    		{{ $racing->nextRace()->name }}
		    	</p>
		    	<figure>
		    		<img src="{{ $racing->nextRace()->circuit->img() }}" alt="{{ $racing->nextRace()->name }}">
		    	</figure>
		    	<p class="circuit">
		    		CIRCUITO
		    		<span>{{ $racing->nextRace()->circuit->name }}</span>
		    	</p>
		    	<p class="laps">
		    		VUELTAS
		    		<span>{{ $racing->nextRace()->laps }}</span>
		    	</p>
	    		<p class="race-date">{{ $racing->nextRaceDate()->format('l j m Y - h:i') }}</p>
				<ul class="countdown">
					<li><span id="days">-</span>días</li>
					<li><span id="hours">-</span>horas</li>
					<li><span id="minutes">-</span>minutos</li>
					<li><span id="seconds">-</span>segundos</li>
				</ul>
	    	</div>
	    </div>
	@endif

    <h2>calendario</h2>
    <div class="races-schedule-content">
		@if ($racing->races->count() == 0)
		    <div class="empty-view">
				No existen carreras
		    </div>
		@else
			<ul class="races">
				@foreach ($racing->races->sortBy('date') as $race)
	            	<a href="{{ route('tournament.schedule.race', [$tournament, $race->slug]) }}">
			            <li class="race">
			            	@if ($race->finished())
			            		<div class="ribbon"><span>FINALIZADA</span></div>
			            	@endif

			            	<div class="item-header">
			            		<div class="date {{ $race->finished() ? 'text-gray-800' : 'text-' . $tournament->game->platform->color . '-600' }}">
			            			<span class="top">
			            				@if (!is_null($race->date))
			            					{{ date('d', strtotime($race->date)) }}
			            				@else
			            					N/D
			            				@endif
			            			</span>
			            			<div class="bottom">
			            				<span class="month uppercase">
			            					@if (!is_null($race->date))
			            						{{ str_replace(".", "", $race->date->format('M')) }} |
			            					@else
			            						N/D
			            					@endif
			            				</span>
			            				<span class="hour">
			            					@if (!is_null($race->date))
			            						{{ date('H:i', strtotime($race->date)) }}
			            					@else
			            						N/D
			            					@endif
			            				</span>
			            			</div>
			            		</div>
			            		<div class="race-info">
			            			<p class="race-name">{{ $race->name }}</p>
			            			<p class="circuit-name">{{ $race->circuit->name }}</p>
			            		</div>
		            			<span class="counter">{{ $loop->iteration }}</span>
			            	</div>
			            	<div class="item-bottom">
			            		<figure>
			            			<img src="{{ $race->circuit->img() }}" alt="{{ $race->circuit->name }}" class="{{ $race->finished() ? 'finished' : '' }}">
			            		</figure>
			            	</div>
			            </li>
		            </a>
				@endforeach
			</ul>
		@endif
    </div> {{-- races-schedule-content --}}
</div> {{-- content --}}