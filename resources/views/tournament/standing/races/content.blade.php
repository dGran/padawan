@if ($tournament->seasons->count() > 1 || $season->competitions->count() > 1)
    @include('tournament.partials.selector', ['route_name' => 'tournament.standing', 'season_selector' => true, 'competition_selector' => true])
@endif

<div class="content p-2">
    @include('tournament.partials.competition_info')

    <h2>clasificación</h2>

    <div class="races-standing-content">
    	<div class="title">
    		clasificacion pilotos
    	</div>
    	<div class="table-wrap">
			<table>
			    <thead>
					<tr>
						<th class="pos">Pos</th>
						<th class="participant">Piloto</th>
						<th class="pts">PTS</th>
						@foreach ($racing->races as $race)
							<th class="pts">
								<a href="{{ route('tournament.schedule.race', [$tournament, $season, $race->slug]) }}">
									@if ($race->racing->show_circuit_flags)
										<img src="{{ $race->circuit->flag() }}" class="w-6 object-cover rounded border m-auto mb-1">
									@endif
									{{ $race->short_name() }}
								</a>
							</th>
						@endforeach
					</tr>
				</thead>
				<tbody>
					@foreach ($positions as $position)
						<tr>
							<td class="pos {{ $loop->iteration == 1 ? 'border-l-4 border-yellow-400' : '' }} {{ $loop->iteration == 2 ? 'border-l-4 border-gray-400' : '' }} {{ $loop->iteration == 3 ? 'border-l-4 border-orange-700' : '' }}">
								<span>{{ $loop->iteration }}</span>
							</td>
			                <td class="participant-name">
			                	<div class="name-container">
				                    <img src="{{ $position['participant']->presenter()['img'] }}">
				                    <div>
					                    <span class="text-name">{{ $position['participant']->presenter()['name'] }}</span>
					                    {{-- <sapn class="text-subname">Mercedes</span> --}}
				                    </div>
			                	</div>
			                </td>
					        <td class="pts-total">
				        		{{ $position['pts'] }}
							</td>
							@foreach ($racing->races as $race)
								<td class="pts">
						        	<span class="{{ $race->position_participant($position['participant']->id) == 1 ? 'border-b-2 border-yellow-400' : '' }} {{ $race->position_participant($position['participant']->id) == 2 ? 'border-b-2 border-gray-400' : '' }} {{ $race->position_participant($position['participant']->id) == 3 ? 'border-b-2 border-orange-700' : '' }}">
						        		{{ $race->score_participant($position['participant']->id) }}
						        	</span>
								</td>
							@endforeach
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>

</div>