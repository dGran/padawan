<div class="content p-2">
    <h2>clasificación</h2>
    <div class="border my-3 bg-white rounded">
    	<div class="border-b uppercase text-13 font-bold p-2 rounded" style="background: #f9f9f9">
    		clasificacion pilotos
    	</div>
    	<div class="tops text-center pt-3">
    		<span class="uppercase font-bold font-roboto-condensed text-15 border-b-2 border-red-500">
    			podium provisional
    		</span>
    		<div class="flex justify-center mt-4 mb-12 mx-3">
				<figure class="relative">
					<img src="{{ $positions[0]['participant']->participant->presenter()['img'] }}" class="w-20 h-20 rounded-full object-cover m-2 shadow-md">
					<img src="https://image.flaticon.com/icons/svg/2502/2502795.svg" alt="" class="w-8 h-8 absolute bg-yellow-400 border border-white rounded p-1" style="top: -5px; left: 3px">
					<div class="border border-white w-24 bg-yellow-400 rounded text-10 p-1 text-center absolute shadow-md" style="bottom: -5px; left: 0px">
						{{ $positions[0]['participant']->participant->presenter()['name'] }}
					</div>
					<div class="text-28 font-bold font-roboto-condensed w-full text-center absolute" style="bottom: -45px; left: 0px">
						{{ $positions[0]['pts'] }}
					</div>
				</figure>
				<figure class="relative ml-3">
					<img src="{{ $positions[1]['participant']->participant->presenter()['img'] }}" class="w-20 h-20 rounded-full object-cover m-2 shadow-md">
					<img src="https://image.flaticon.com/icons/svg/2502/2502798.svg" alt="" class="w-8 h-8 absolute bg-gray-400 border border-white rounded p-1" style="top: -5px; left: 3px">
					<div class="w-24 border border-white bg-gray-400 rounded text-10 p-1 text-center absolute shadow-md" style="bottom: -5px; left: 0px">
						{{ $positions[1]['participant']->participant->presenter()['name'] }}
					</div>
					<div class="text-28 font-bold font-roboto-condensed w-full text-center absolute" style="bottom: -45px; left: 0px">
						{{ $positions[1]['pts'] }}
					</div>
				</figure>
				<figure class="relative ml-3">
					<img src="{{ $positions[2]['participant']->participant->presenter()['img'] }}" class="w-20 h-20 rounded-full object-cover m-2 shadow-md">
					<img src="https://image.flaticon.com/icons/svg/2502/2502804.svg" alt="" class="w-8 h-8 absolute bg-orange-700 border border-white rounded p-1" style="top: -5px; left: 3px">
					<div class="w-24 border border-white bg-orange-700 rounded text-white text-10 p-1 text-center absolute shadow-md" style="bottom: -5px; left: 0px">
						{{ $positions[2]['participant']->participant->presenter()['name'] }}
					</div>
					<div class="text-28 font-bold font-roboto-condensed w-full text-center absolute" style="bottom: -45px; left: 0px">
						{{ $positions[2]['pts'] }}
					</div>
				</figure>
			</div>
    	</div>
    	<div class="overflow-x-auto border-t">
			<table class="races-standings-table w-full">
			    <thead class="border-b">
					<tr class="">
						<th class="py-2 align-bottom uppercase text-11 w-8 px-2">
							Pos
						</th>
						<th class="align-bottom text-left py-2 uppercase text-11">Piloto</th>
						<th class="align-bottom text-center py-2 uppercase text-11" style="min-width: 32px; width: 42px">PTS</th>
						@foreach ($racing->races as $race)
							<th class="align-bottom py-2 uppercase text-11" style="min-width: 32px; width: 42px;">
								<div class="flex flex-col items-center">
									{{-- <img src="https://lh3.googleusercontent.com/proxy/vUKPcrYa3CsCXXiOy2TX9r-KNabrOxm0KFsYqDJM0lf3Qu2If1eatZoZuEHBZZDEVBUAqiEVXgb-iF3bcvZRVA5IB9NrWHfHVm8XPgXQq9oRBR-e" alt="" class="w-6 pb-1"> --}}
									{{ $race->short_name() }}
								</div>
							</th>
						@endforeach
					</tr>
				</thead>
				<tbody>
					@foreach ($positions as $position)
						<tr class="hover:bg-yellow-100" style="border-top: 1px solid #f2f2f2">
							<td class="sticky py-1 text-right text-12 font-bold text-gray-500 pr-2 {{ $loop->iteration == 1 ? 'border-l-4 border-yellow-400' : '' }} {{ $loop->iteration == 2 ? 'border-l-4 border-gray-400' : '' }} {{ $loop->iteration == 3 ? 'border-l-4 border-orange-700' : '' }}">
								<span class="pr-1">{{ $loop->iteration }}</span>
							</td>
			                <td class="sticky py-1" style="min-width: 230px">
			                	<div class="flex flex-row items-center text-13">
				                    <img src="{{ $position['participant']->participant->presenter()['img'] }}" class="rounded-full h-8 w-8 object-cover">
				                    <div class="truncate">
					                    <span class="mx-2 ">{{ $position['participant']->participant->presenter()['name'] }}</span>
					                    <sapn class="block mx-2 text-9 text-gray-600">Mercedes</span>
				                    </div>
			                	</div>
			                </td>
					        <td class="sticky py-1 text-center font-bold text-gray-60 px-2 text-14 bg-orange-100" style="border-left: 1px solid #f2f2f2">
					        	{{ $position['pts'] }}
							</td>
							@foreach ($racing->races as $race)
								<td class="py-1 text-center text-12 px-2" style="border-left: 1px solid #f2f2f2">
									{{ $race->score_participant($position['participant']->id) }}
								</td>
							@endforeach
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>

</div>