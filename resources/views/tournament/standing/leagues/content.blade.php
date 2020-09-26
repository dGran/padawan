@if ($tournament->seasons->count() > 1 || $season->competitions->count() > 1)
    @include('tournament.partials.selector', ['route_name' => 'tournament.standing', 'season_selector' => true, 'competition_selector' => true])
@endif

<div class="content p-2">
    @include('tournament.partials.competition_info')

	<h2>clasificación</h2>

	<div class="grid grid-cols-1 md:grid-cols-3">

	    <div class="leagues-standing-content md:col-span-2">
	    	<div class="title">
	    		clasificación {{ $phase->groups->count() > 1 ? $group->name : '' }}
	    	</div>
	    	<div class="table-wrap">
				<table>
				    <thead>
						<tr>
							<th class="w-auto"></th>
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
								<td class="">
									@if ($loop->iteration < 5)
										<img src="https://upload.wikimedia.org/wikipedia/commons/5/52/Uefa_champions_league_logo.png" class="h-4 w-4 m-auto">
									@endif
								</td>
								<td class="pos">
									<span>{{ $loop->iteration }}</span>
								</td>
				                <td class="participant-name">
				                	<div class="name-container">
					                    <img src="{{ $position['participant']->participant->presenter()['img'] }}" class="{{ $tournament->use_teams ? 'no-rounded' : '' }}">
					                    <div>
						                    <span class="text-name">{{ $position['participant']->participant->presenter()['name'] }}</span>
						                    <sapn class="text-subname">{{ $position['participant']->participant->presenter()['subname'] }}</span>
					                    </div>
				                	</div>
				                </td>
						        <td class="pts-total">
					        		{{ $position['pts'] }}
								</td>
						        <td class="pts">
					        		<span class="{{ $position['pj'] == 0 ? 'text-gray-500' : '' }}">{{ $position['pj'] }}</span>
								</td>
						        <td class="pts">
					        		<span class="{{ $position['pg'] == 0 ? 'text-gray-500' : '' }}">{{ $position['pg'] }}</span>
								</td>
						        <td class="pts">
					        		<span class="{{ $position['pe'] == 0 ? 'text-gray-500' : '' }}">{{ $position['pe'] }}</span>
								</td>
						        <td class="pts">
					        		<span class="{{ $position['pp'] == 0 ? 'text-gray-500' : '' }}">{{ $position['pp'] }}</span>
								</td>
						        <td class="pts">
					        		<span class="{{ $position['gf'] == 0 ? 'text-gray-500' : '' }}">{{ $position['gf'] }}</span>
								</td>
						        <td class="pts">
					        		<span class="{{ $position['gc'] == 0 ? 'text-gray-500' : '' }}">{{ $position['gc'] }}</span>
								</td>
						        <td class="pts">
					        		<span class="{{ $position['avg'] == 0 ? 'text-gray-500' : '' }} {{ $position['avg'] < 0 ? 'text-red-500' : '' }}">{{ $position['avg'] }}</span>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>

			</div>
			Total partidos: {{ $group->league->total_matches() }} - Jugados: {{ $group->league->played_matches() }} - Pendientes: {{ $group->league->pending_matches() }}
		</div>

		<div class="">
			Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat sapiente laborum hic. Expedita veritatis molestiae, magni voluptas accusamus, repudiandae ullam saepe dolorem, nihil placeat unde excepturi pariatur debitis? Fuga, cumque?
		</div>

	</div>

</div>
