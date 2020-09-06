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
							<th class="w-12">
								Pos.
							</th>
							<th class="text-left" style="min-width: 202px;">Piloto</th>
							<th class="text-center w-10">Pts</th>
							@foreach ($racing->races as $race)
								<th class="text-center w-10">
									<div class="whitespace-no-wrap text-center text-10">
										{{ $race->short_name }}
									</div>
								</th>
							@endforeach
						</tr>
					</thead>
					<tbody>
						@foreach ($positions as $position)
							<tr>
								<td class="text-center">
									<span class="font-bold text-base text-gray-600">{{ $loop->iteration }}</span>
								</td>
				                <td class="">
				                	<div class="flex flex-row items-center">
					                    <img src="{{ $position['participant']->participant->presenter()['img'] }}" alt="" width=30>
					                    <span class="mx-2 truncate">{{ $position['participant']->participant->presenter()['name'] }}</span>
				                	</div>
				                </td>
						        <td class="text-center font-bold text-base text-gray-60">
						        	{{ $position['pts'] }}
								</td>
								@foreach ($racing->races as $race)
									<td class="text-center text-10">
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