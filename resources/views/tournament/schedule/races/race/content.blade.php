@include('tournament.schedule.races.race.menu')

<div class="content">
	<div class="race-content">

		@if ($race->finished())

			<div class="grid grid-cols-3 gap-2 md:gap-4 px-4 sm:px-24 md:px-32 lg:px-48 xl:px-64 pt-4">
				@foreach ($race->results->sortBy('position')->take(3) as $result)
					<div class="border rounded-r bg-white border-l-0 relative">
						<div class="px-3 py-1 {{ $loop->iteration == 1 ? 'border-l-2 border-yellow-400' : '' }} {{ $loop->iteration == 2 ? 'border-l-2 border-gray-400' : '' }} {{ $loop->iteration == 3 ? 'border-l-2 border-orange-700' : '' }}">
							<img src="{{ $result->group_participant->participant->presenter()['img'] }}" class="m-auto h-16 w-16 sm:w-20 sm:h-20 md:h-24 md:w-24 p-1 object-cover rounded-full shadow">
							<p class="pt-1 font-roboto-condensed font-semibold truncate text-11 sm:text-12 md:text-13 lg:text-14 text-center">
								{{ $result->group_participant->participant->presenter()['name'] }}
							</p>
							@if ($loop->iteration == 1)
								<img src="https://image.flaticon.com/icons/svg/199/199533.svg" style="position: absolute; top: 3px; left: 5px" class="w-6 h-6 md:w-8 md:h-8">
							@endif
							@if ($loop->iteration == 2)
								<img src="https://image.flaticon.com/icons/svg/199/199563.svg" style="position: absolute; top: 3px; left: 5px" class="w-6 h-6 md:w-8 md:h-8">
							@endif
							@if ($loop->iteration == 3)
								<img src="https://image.flaticon.com/icons/svg/199/199573.svg" style="position: absolute; top: 3px; left: 5px" class="w-6 h-6 md:w-8 md:h-8">
							@endif
						</div>
					</div>
				@endforeach
			</div>

			<div class="px-2 pb-2 pt-1 m-auto sm:px-24 md:px-32 lg:px-48 xl:px-64">
				<div class="race-standing-content">
			    	<div class="title">
			    		carrera
			    	</div>
			    	<div class="table-wrap">
						<table>
						    <thead>
								<tr>
									<th class="pos">Pos</th>
									<th class="participant">Piloto</th>
									<th class="pts">PTS</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($race->results->sortBy('position') as $position)
									<tr>
										<td class="pos {{ $loop->iteration == 1 ? 'border-l-4 border-yellow-400' : '' }} {{ $loop->iteration == 2 ? 'border-l-4 border-gray-400' : '' }} {{ $loop->iteration == 3 ? 'border-l-4 border-orange-700' : '' }}">
											<span>{{ $loop->iteration }}</span>
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
								        <td class="pts-total">
							        		{{ $race->score_participant($position->group_participant->id) }}
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>

		@endif
	</div> {{-- race-content --}}

</div> {{-- content --}}