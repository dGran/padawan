@include('tournament.schedule.races.race.menu')

<div class="content">
	<div class="race-content">

		@if ($race->finished())

			<div class="race-standing-tops">
				@foreach ($results->take(3) as $result)
					<div class="items">
						<div class="item {{ $result->position == 1 ? 'border-l-2 border-yellow-400' : '' }} {{ $result->position == 2 ? 'border-l-2 border-gray-400' : '' }} {{ $result->position == 3 ? 'border-l-2 border-orange-700' : '' }}">
							<img class="img" src="{{ $result->group_participant->presenter()['img'] }}">
							<p class="name">
								{{ $result->group_participant->presenter()['name'] }}
							</p>
							@if ($result->position == 1)
								<img class="position-indicator" src="{{ asset('img/tournaments/other/gold.png') }}">
							@endif
							@if ($result->position == 2)
								<img class="position-indicator" src="{{ asset('img/tournaments/other/silver.png') }}">
							@endif
							@if ($result->position == 3)
								<img class="position-indicator" src="{{ asset('img/tournaments/other/bronze.png') }}">
							@endif
						</div>
					</div>
				@endforeach
			</div> {{-- race-standing-tops --}}

			<div class="race-standing-content">
				<div class="race-standing-results mt-4">
			    	<div class="title">
			    		<i class="far fa-bullseye text-{{ $tournament->game->platform->color }}-500 font-bold text-11 mr-2"></i>carrera
			    	</div>
			    	<div class="table-wrap">
						<table>
						    <thead>
								<tr>
									<th class="pos">Pos</th>
									<th class="participant">Piloto</th>
									<th class="pts md:hidden">PTS</th>
									@if ($race->racing->times)
										<th class="time">Tiempo</th>
									@endif
									@if ($race->racing->fastest_lap)
										<th class="time">V.R.</th>
									@endif
									<th class="sanction">San</th>
									<th class="pts hidden md:table-cell">PTS</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($results as $position)
									<tr class="{{ $position->position == 0 ? 'text-gray-500' : '' }}">
										<td class="pos {{ $position->position == 1 ? 'border-l-4 border-yellow-400' : '' }} {{ $position->position == 2 ? 'border-l-4 border-gray-400' : '' }} {{ $position->position == 3 ? 'border-l-4 border-orange-700' : '' }}">
											<span>{{ $position->position > 0 ? $position->position : '-' }}</span>
										</td>
						                <td class="participant-name">
						                	<div class="name-container">
							                    <img src="{{ $position->group_participant->presenter()['img'] }}">
							                    <div>
								                    <span class="text-name">{{ $position->group_participant->presenter()['name'] }}</span>
								                    {{-- <sapn class="text-subname">Mercedes</span> --}}
							                    </div>
						                	</div>
						                </td>
								        <td class="pts-total md:hidden relative">
							        		{{ $race->score_participant($position->group_participant->id) }}
							        		@if ($race->racing->score_fastest_lap > 0 || $race->racing->score_pole > 0)
{{-- 							                	@if ( ($race->pole() && $race->pole()->group_participant->id == $position->group_participant->id) || ($race->fastest_lap() && $race->fastest_lap()->group_participant->id == $position->group_participant->id) )
							                		@if ($race->pole()->group_participant->id == $position->group_participant->id && $race->fastest_lap()->group_participant->id == $position->group_participant->id)
							                			<div class="text-center leading-none absolute text-8 mr-2 mt-3 uppercase w-full" style="bottom: 3px; left: 0">
							                				<span class="text-gray-600">{{ $race->clean_score_participant($position->group_participant->id) }}</span><span class="text-teal-500"> +2</span><span class="text-red-500"> -1</span>
							                			</div>
							                		@else
							                			<div class="text-center leading-none absolute text-8 mr-2 mt-3 uppercase w-full" style="bottom: 3px; left: 0">
							                				<span class="text-gray-600">{{ $race->clean_score_participant($position->group_participant->id) }}</span><span class="text-teal-500"> +1</span><span class="text-red-500"> -1</span>
							                			</div>
							                		@endif
							                	@endif --}}
							                @endif
										</td>
						                @if ($race->racing->times)
							                <td class="time whitespace-no-wrap">
							                	@if ($position->position > 0)
						                			{{ $position->time ? \Carbon\Carbon::parse($position->time)->Format('H:i:s.v') : '-' }}
						                		@else
						                			{{ $position->state() }}
						                		@endif
							                </td>
							            @endif
						                @if ($race->racing->fastest_lap)
							                <td class="time">
						                		<span class="{{ $race->fastest_lap() && $race->fastest_lap()->group_participant->id == $position->group_participant->id ? 'text-gray-800 font-bold' : 'text-gray-900 text-opacity-50' }}">
						                			{{ $position->fastest_lap ? \Carbon\Carbon::parse($position->fastest_lap)->Format('i:s.v') : '-' }}
						                		</span>
							                </td>
							            @endif
								        <td class="sanction">
							        		<span class="{{ $position->sanction > 0 ? 'text-red-600 font-bold' : 'text-gray-900 text-opacity-50' }}">
							        			{{ $position->sanction > 0 ? $position->sanction : '-' }}
							        		</span>
										</td>
								        <td class="pts-total hidden md:table-cell relative">
							        		{{ $race->score_participant($position->group_participant->id) }}
							        		@if ($race->racing->score_fastest_lap > 0 || $race->racing->score_pole > 0)
							                	@if ( ($race->pole() && $race->pole()->group_participant->id == $position->group_participant->id) || ($race->fastest_lap() && $race->fastest_lap()->group_participant->id == $position->group_participant->id) )
							                		@if ($race->pole()->group_participant->id == $position->group_participant->id && $race->fastest_lap()->group_participant->id == $position->group_participant->id)
							                			<div class="text-center leading-none absolute text-8 mr-2 mt-3 uppercase w-full" style="bottom: 2px; left: 0">
							                				<span class="text-gray-600">{{ $race->clean_score_participant($position->group_participant->id) }}</span><span class="text-teal-500"> +2</span><span class="text-red-500"> -1</span>
							                			</div>
							                		@else
							                			<div class="text-center leading-none absolute text-8 mr-2 mt-3 uppercase w-full" style="bottom: 2px; left: 0">
							                				<span class="text-gray-600">{{ $race->clean_score_participant($position->group_participant->id) }}</span><span class="text-teal-500"> +1</span><span class="text-red-500"> -1</span>
							                			</div>
							                		@endif
							                	@endif
							                @endif
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div> {{-- race-standing-results --}}

				@if ($race->racing->score_fastest_lap > 0 || $race->racing->score_pole > 0)
					<div class="py-2 text-gray-600">
						@if ($race->racing->score_fastest_lap > 0)
							<p class="text-11">* El piloto que consigue la vuelta rápida suma {{ $race->racing->score_fastest_lap }} punto</p>
						@endif
						@if ($race->racing->score_pole > 0)
							<p class="text-11">* El piloto que consigue la pole suma {{ $race->racing->score_fastest_lap }} punto</p>
						@endif
					</div>
				@endif

				<div class="grid grid-cols-2 sm:grid-cols-2 gap-4 mt-4 pb-6">

					@if ($race->racing->fastest_lap && $race->fastest_lap())
						<div class="race-standing-results">
					    	<div class="title text-center">
					    		vuelta rápida
					    	</div>
					    	<div class="sub-results-content">
					    		<img src="{{ $race->fastest_lap()->group_participant->presenter()['img'] }}">
								<p class="text-gray-600">
									{{ $race->fastest_lap()->group_participant->presenter()['name'] }}
								</p>
								<p>
									{{ \Carbon\Carbon::parse($race->fastest_lap()->fastest_lap)->Format('i\m s\s v\m\s') }}
								</p>
								@if ($race->racing->score_fastest_lap > 0)
									<p class="text-teal-500">
										+{{ $race->racing->score_fastest_lap }} {{ $race->racing->score_fastest_lap == 1 ? 'punto' : 'puntos' }}
									</p>
								@endif
					    	</div>
						</div>
					@endif

					@if ($race->racing->qualifying && $race->pole())
						<div class="race-standing-results">
					    	<div class="title text-center">
					    		pole position
					    	</div>
					    	<div class="sub-results-content">
					    		<img src="{{ $race->pole()->group_participant->presenter()['img'] }}">
								<p class="text-gray-600">
									{{ $race->pole()->group_participant->presenter()['name'] }}
								</p>
								<p>
									@if ($race->racing->times)
										@if ($race->pole()->time)
											{{ \Carbon\Carbon::parse($race->pole()->time)->Format('i\m s\s v\m\s') }}
										@else
											<span class="italic">*Tiempo no registrado</span>
										@endif
									@endif
								</p>
								@if ($race->racing->score_pole > 0)
									<p class="text-teal-500">
										+{{ $race->racing->score_pole }} {{ $race->racing->score_pole == 1 ? 'punto' : 'puntos' }}
									</p>
								@endif
					    	</div>
						</div>
					@endif

				</div>

			</div> {{-- race-standing-content --}}

		@else
			<div class="race-standing-content pt-5">
				<p class="empty-data">
					<b>Información no disponible</b>, la carrera aún no se ha disputado.
				</p>
			</div>
		@endif

	</div> {{-- race-content --}}

</div> {{-- content --}}