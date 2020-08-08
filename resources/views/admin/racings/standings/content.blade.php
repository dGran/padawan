<div class="antialiased font-sans w-full px-4 md:px-8">
    <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 pt-4 pb-2">
        @include('admin.racings.menu')
        {{-- <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded"> --}}
        <div class="flex-auto">
            <h3 class="font-bold uppercase text-sm mt-4 mb-2 pl-2">
                Clasificación general
            </h3>

			<div class="table-wrap mb-4">
			    <table class="admin-tables">
			        <thead>
						<tr>
							<th class="sticky" style="width: 60px; min-width: 60px; max-width: 60px; left: 0px;">
								Pos.
							</th>
							<th class="sticky text-left" style="width: 150px; min-width: 150px; max-width: 150px; left: 60px;">Piloto</th>
							<th class="text-center">Puntos</th>
							@foreach ($racing->races as $race)
								<th class="text-center">
									<div class="whitespace-no-wrap text-center w-full" style="font-size: 10px;">
										{{ $race->name }}
									</div>
								</th>
							@endforeach
						</tr>
					</thead>
					<tbody>
						@foreach ($positions as $position)
							<tr>
								<td class="text-center sticky" style="width: 50px; min-width: 50px; max-width: 50px; left: 0px;">
									<span class="font-bold text-base text-gray-600">{{ $loop->iteration }}</span>
								</td>
				                <td class="sticky" style="width: 150px; min-width: 150px; max-width: 150px; left: 60px;">
				                	<div class="flex flex-row items-center">
					                    <img src="{{ $position['participant']->participant->presenter()['img'] }}" alt="" width=30>
					                    <span class="mx-2 truncate">{{ $position['participant']->participant->presenter()['name'] }}</span>
				                	</div>
				                </td>
						        <td class="text-center font-bold text-base text-gray-60">
						        	{{ $position['pts'] }}
								</td>
								@foreach ($racing->races as $race)
									<td class="text-center">
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
</div>