@if ($tournament->seasons->count() > 1 || $season->competitions->count() > 1)
    @include('tournament.partials.selector', ['route_name' => 'tournament.schedule', 'season_selector' => true, 'competition_selector' => true])
@endif

<div class="content p-2">
    @include('tournament.partials.competition_info')

	@if ($racing->nextRace() && \Carbon\Carbon::parse($racing->nextRace()->date) > \Carbon\Carbon::now())
	    <h2>próxima carrera</h2>
	    <div class="races-schedule-content">
	    	<div class="countdown-content">
		    	<p class="race">
		    		<img src="{{ asset('img/tournaments/other/race_flag.png') }}" alt="" width="32" class="m-auto">
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
	    		<p class="race-date">
	    			FECHA
	    			<span>{{ $racing->nextRaceDate()->format('l, j \d\e F \d\e Y - H:i') }}</span>
	    		</p>
	    		<p class="countdown-title text-{{$tournament->game->platform->color}}-600">
					Inicio de carrera en...
	    		</p>
				<ul class="countdown">
					<li><span id="days">-</span>días</li>
					<li><span id="hours">-</span>horas</li>
					<li><span id="minutes">-</span>minutos</li>
					<li><span id="seconds">-</span>segundos</li>
				</ul>
				<p class="race-link">
					<button type="button" class="bg-{{$tournament->game->platform->color}}-500 active:bg-{{$tournament->game->platform->color}}-600 hover:bg-{{$tournament->game->platform->color}}-600" onclick="window.location.href = '{{ route('tournament.schedule.race', [$tournament, $season, $racing->nextRace()->slug]) }}'">
						Accede a la carrera
					</button>
				</p>
	    	</div>
	    </div>
	@endif

    <h2>calendario</h2>
    <div class="races-schedule-content">
		@if ($racing->races->count() == 0)
		    <div class="empty-view">
				Configuración del calendario pendiente
		    </div>
		@else
			<ul class="races">
				@foreach ($racing->races->sortBy('date') as $race)
	            	<a href="{{ route('tournament.schedule.race', [$tournament, $season, $race->slug]) }}">
			            <li class="race">
			            	@if ($race->finished())
			            		<div class="ribbon gray"><span>FINALIZADA</span></div>
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
			            				<span class="month">
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