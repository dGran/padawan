@include('tournament.schedule.races.race.menu')

<div class="content">
	<div class="race-content">

		@if ($race->qualys_finished())

			<div class="race-standing-content {{ !$race->pre_qualy ? 'pb-6' : '' }}">

				<div class="race-standing-results mt-4">
			    	<div class="title flex items-center">
			    		<i class="far fa-bullseye text-{{ $tournament->game->platform->color }}-500 font-bold text-11 mr-2"></i>qualy
			    	</div>
			    	<div class="table-wrap">
						<table>
						    <thead>
								<tr>
									<th class="pos">Pos</th>
									<th class="participant">Piloto</th>
									@if ($race->racing->times)
										<th class="time">Tiempo</th>
									@endif
								</tr>
							</thead>
							<tbody>
								@foreach ($qualy_results as $position)
									<tr class="{{ $position->position == 0 ? 'text-gray-500' : '' }}">
										<td class="pos {{ $loop->iteration == 1 ? 'border-l-4 border-yellow-400' : '' }} {{ $loop->iteration == 2 ? 'border-l-4 border-gray-400' : '' }} {{ $loop->iteration == 3 ? 'border-l-4 border-orange-700' : '' }}">
											<span>{{ $position->position > 0 ? $loop->iteration : '-' }}</span>
										</td>
						                <td class="participant-name">
						                	<div class="name-container">
							                    <img src="{{ $position->group_participant->participant->presenter()['img'] }}">
							                    <div>
								                    <span class="text-name">{{ $position->group_participant->participant->presenter()['name'] }}</span>
								                    {{-- <sapn class="text-subname">Mercedes</span> --}}
							                    </div>
						                	</div>
						                </td>
					                	@if ($race->racing->times)
							                <td class="time whitespace-no-wrap">
							                	@if ($position->position > 0)
						                			{{ $position->time ? \Carbon\Carbon::parse($position->time)->Format('i:s.v') : '-' }}
						                		@else
						                			<span>{{ $position->state() }}</span>
						                		@endif
							                </td>
							            @endif
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div> {{-- race-standing-results --}}

			</div> {{-- race-standing-content --}}

			@if ($race->pre_qualy)
				<div class="race-standing-content pb-6">
					<div class="race-standing-results mt-4">
				    	<div class="title">
				    		<i class="far fa-bullseye text-{{ $tournament->game->platform->color }}-500 font-bold text-11 mr-2"></i>pre-qualy
				    	</div>
				    	<div class="table-wrap">
							<table>
							    <thead>
									<tr>
										<th class="pos">Pos</th>
										<th class="participant">Piloto</th>
										@if ($race->racing->times)
											<th class="time">Tiempo</th>
										@endif
									</tr>
								</thead>
								<tbody>
									@foreach ($prequaly_results as $position)
										<tr class="{{ $position->position == 0 ? 'text-gray-500' : '' }}">
											<td class="pos {{ $loop->iteration == 1 ? 'border-l-4 border-yellow-400' : '' }} {{ $loop->iteration == 2 ? 'border-l-4 border-gray-400' : '' }} {{ $loop->iteration == 3 ? 'border-l-4 border-orange-700' : '' }}">
												<span>{{ $position->position > 0 ? $loop->iteration : '-' }}</span>
											</td>
							                <td class="participant-name">
							                	<div class="name-container">
								                    <img src="{{ $position->group_participant->participant->presenter()['img'] }}">
								                    <div>
									                    <span class="text-name">{{ $position->group_participant->participant->presenter()['name'] }}</span>
									                    {{-- <sapn class="text-subname">Mercedes</span> --}}
								                    </div>
							                	</div>
							                </td>
						                	@if ($race->racing->times)
								                <td class="time whitespace-no-wrap">
								                	@if ($position->position > 0)
							                			{{ $position->time ? \Carbon\Carbon::parse($position->time)->Format('i:s.v') : '-' }}
							                		@else
							                			{{ $position->state() }}
							                		@endif
								                </td>
								            @endif
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div> {{-- race-standing-results --}}

				</div> {{-- race-standing-content --}}
			@endif

		@else
			<div class="race-standing-content pt-5">
				<p class="empty-data">
					<b>Información no disponible</b>, el Qualy aún no se ha disputado.
				</p>
			</div>
		@endif

	</div> {{-- race-content --}}

</div> {{-- content --}}