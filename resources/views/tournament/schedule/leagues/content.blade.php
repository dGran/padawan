@if ($tournament->seasons->count() > 1 || $season->competitions->count() > 1)
    @include('tournament.partials.selector', ['route_name' => 'tournament.schedule', 'season_selector' => true, 'competition_selector' => true])
@endif

<div class="content p-2">
    @include('tournament.partials.competition_info')

    <h2>calendario</h2>

    <div class="leagues-schedule-content">
		@if ($league->days->count() == 0)
		    <div class="empty-view">
				Configuración del calendario pendiente
		    </div>
		@else
			<ul class="days-list">
				@foreach ($league->days->sortBy('order') as $day)
		            <li class="day">
		            	<h4>
		            		{{ $day->name() }}
		            	</h4>
		            	<div class="matches">
			            	@foreach ($day->matches as $match)
			            		<div class="match">
			            			<div class="local">
			            				<img class="img" src="{{ $match->local_participant->participant->presenter()['img'] }}">
		            					<span class="name">
		            						{{ $match->local_participant->participant->presenter()['name'] }}
		            					</span>
			            			</div>
			            			<div class="result {{ $match->played() ? 'played' : '' }}">
			            				@if ($match->played())
			            					{{ $match->result() }}
			            				@else
			            					Vs
			            				@endif
			            			</div>
			            			<div class="visitor">
			            				<img class="img" src="{{ $match->visitor_participant->participant->presenter()['img'] }}">
		            					<span class="name">
		            						{{ $match->visitor_participant->participant->presenter()['name'] }}
		            					</span>
			            			</div>
			            		</div>
			            	@endforeach
		            	</div>
		            </li>
				@endforeach
			</ul>
		@endif
    </div> {{-- races-schedule-content --}}
</div> {{-- content --}}