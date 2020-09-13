@if ($tournament->seasons->count() > 1 || $season->competitions->count() > 1)
    @include('tournament.partials.selector', ['route_name' => 'tournament.standing', 'season_selector' => true, 'competition_selector' => true])
@endif

<div class="content p-2">
    @include('tournament.partials.competition_info')

    <h2>clasificación</h2>


    <div class="leagues-standing-content">
    	<div class="title">
    		clasificación {{ $phase->groups->count() > 1 ? $group->name : '' }}
    	</div>
    	<div class="table-wrap">
			<table>
			    <thead>
					<tr>
						<th class="pos">Pos</th>
						<th class="participant">Participante</th>
						<th class="pts">PTS</th>
						<th class="pts">PJ</th>
						<th class="pts">PG</th>
						<th class="pts">PE</th>
						<th class="pts">PP</th>
						<th class="pts">GF</th>
						<th class="pts">GC</th>
						<th class="pts">+/-</th>
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
				                    <img src="{{ $position['participant']->participant->presenter()['img'] }}">
				                    <div>
					                    <span class="text-name">{{ $position['participant']->participant->presenter()['name'] }}</span>
					                    {{-- <sapn class="text-subname">Mercedes</span> --}}
				                    </div>
			                	</div>
			                </td>
					        <td class="pts-total">
				        		{{ $position['pts'] }}
							</td>
					        <td class="pts">
				        		{{ $position['pj'] }}
							</td>
					        <td class="pts">
				        		{{ $position['pg'] }}
							</td>
					        <td class="pts">
				        		{{ $position['pe'] }}
							</td>
					        <td class="pts">
				        		{{ $position['pp'] }}
							</td>
					        <td class="pts">
				        		{{ $position['gf'] }}
							</td>
					        <td class="pts">
				        		{{ $position['gc'] }}
							</td>
					        <td class="pts">
				        		{{ $position['avg'] }}
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>

</div>
