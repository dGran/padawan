<div class="content p-2">
    <h2>clasificación</h2>
    <div class="races-standing-content">
    	<div class="title">
    		clasificacion pilotos
    	</div>
{{--     	<section class="races-tops">
    		<div class="wrap">
			    @for ($i = 0; $i < 3; $i++)
					<figure class="{{ $i == 0 ? 'first' : '' }} {{ $i == 1 ? 'second' : '' }} {{ $i == 2 ? 'third' : '' }}">
						<img src="{{ $positions[$i]['participant']->participant->presenter()['img'] }}" class="img-participant">
						<img src="{{ $i == 0 ? 'https://image.flaticon.com/icons/svg/2502/2502795.svg' : '' }} {{ $i == 1 ? 'https://image.flaticon.com/icons/svg/2502/2502798.svg' : '' }} {{ $i == 2 ? 'https://image.flaticon.com/icons/svg/2502/2502804.svg' : '' }}" class="img-position">
						<div class="name">
							{{ $positions[$i]['participant']->participant->presenter()['name'] }}
						</div>
						<div class="pts">
							{{ $positions[$i]['pts'] }}
						</div>
					</figure>
    			@endfor
			</div>
    	</section> --}}
    	<div class="table-wrap">
			<table>
			    <thead>
					<tr>
						<th class="pos">Pos</th>
						<th class="participant">Piloto</th>
						<th class="pts">PTS</th>
						@foreach ($racing->races as $race)
							<th class="pts">{{ $race->short_name() }}</th>
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