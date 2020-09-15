<div class="content">

	<div class="race-content">

		<div class="race-title">
			<div class="race-title-banner" style="background: url('{{ asset('img/tournaments/other/race_banner.png') }}') no-repeat 0 0;">
				<div class="race-title-container">
					@if ($race->racing->show_circuit_flags)
						<figure class="circuit-flag">
							<img src="{{ $race->circuit->flag() }}">
						</figure>
					@endif
					<div class="bloql flex-1">
						<div>
							<span class="race-name">
								{{ $race->name }}
							</span>
							<span class="circuit-name">
								{{ $race->circuit->name }}
							</span>
						</div>
					</div>
					<div class="bloqr flex-inital">
						<div>
							@if (!$race->finished())
		        				@if (!is_null($race->date))
		        					<p class="date">
					            		<span>{{ $race->date->format('l, j') }}</span>
					            		<span>{{ str_replace(".", "", $race->date->format('M')) }}</span>
					            		<span>{{ $race->date->format('Y') }}</span>
		        					</p>
		        					<p class="hour">
										<span>{{ $race->date->format('H:i') }}</span>
		        					</p>
		        				@endif
		        			@else
	        					<p class="race-word">
									CARRERA
	        					</p>
	        					<p class="finished-word">
									FINALIZADA
	        					</p>
		        			@endif
						</div>
					</div>
				</div>
			</div>
		</div> {{-- race-title --}}

		<div class="race-menu {{ $tournament->game->platform->color }}">
			<ul>
				<li class="{{ Request::route()->getName() == 'tournament.schedule.race.circuit' ? 'current' : '' }}">
					<a href="{{ route('tournament.schedule.race.circuit', [$tournament, $season, $race->slug]) }}">
						<i class="icon-circuit"></i>
						<span>Circuito</span>
					</a>
				</li>
				<li class="{{ !$race->qualys_finished() ? 'disable' : '' }} {{ Request::route()->getName() == 'tournament.schedule.race.qualy' ? 'current' : '' }}">
					<a href="{{ route('tournament.schedule.race.qualy', [$tournament, $season, $race->slug]) }}">
						<i class="icon-qualy"></i>
						<span>Calificación</span>
					</a>
				</li>
				<li class="{{ !$race->finished() ? 'disable' : '' }} {{ Request::route()->getName() == 'tournament.schedule.race.result' ? 'current' : '' }}">
					<a href="{{ route('tournament.schedule.race.result', [$tournament, $season, $race->slug]) }}">
						<i class="icon-race"></i>
						<span>Carrera</span>
					</a>
				</li>
				<li class="{{ !$race->has_media() ? 'disable' : '' }} {{ Request::route()->getName() == 'tournament.schedule.race.multimedia' ? 'current' : '' }}">
					<a href="{{ route('tournament.schedule.race.multimedia', [$tournament, $season, $race->slug]) }}">
						<i class="icon-multimedia"></i>
						<span>Multimedia</span>
					</a>
				</li>
			</ul>
		</div> {{-- race-menu --}}

	</div> {{-- race-content --}}

</div> {{-- content --}}