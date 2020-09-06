<div class="content p-2">
    <h2>calendario</h2>
    <div class="races-schedule-content">
		@if ($league->days->count() == 0)
		    <div class="empty-view">
				Configuración del calendario pendiente
		    </div>
		@else
			<ul class="races">
				@foreach ($league->days->sortBy('date') as $day)
	            	<a href="{{ route('tournament.schedule.race', [$tournament, $race->slug]) }}">
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