<div class="antialiased font-sans w-full px-4 md:px-8">
    <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 pt-4 pb-2">
        @include('admin.leagues.menu')

		<div class="rounded bg-blue-100 p-3 mb-4 border shadow">
        	<form id="form-generate" method="POST" role="form" action="{{ route('admin.league.schedule.generate', [$tournament, $season, $competition, $phase, $group]) }}" lang="{{ app()->getLocale() }}" enctype="multipart/form-data">
            	@csrf

	            <label class="custom-label flex">
	                  <div class="bg-white border border-gray-400 rounded w-6 h-6 p-1 flex justify-center items-center mr-2">
	                    <input type="checkbox" class="hidden" id="second_round" name="second_round">
	                    <svg class="hidden w-4 h-4 text-green-600 pointer-events-none" viewBox="0 0 172 172"><g fill="none" stroke-width="none" stroke-miterlimit="10" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode:normal"><path d="M0 172V0h172v172z"/><path d="M145.433 37.933L64.5 118.8658 33.7337 88.0996l-10.134 10.1341L64.5 139.1341l91.067-91.067z" fill="currentColor" stroke-width="1"/></g></svg>
	                  </div>
	                  <span class="second-round-text"> Partidos de ida y vuelta</span>
	            </label>
	            <label class="custom-label flex pt-2">
	                  <div class="bg-white border border-gray-400 rounded w-6 h-6 p-1 flex justify-center items-center mr-2">
	                    <input type="checkbox" class="hidden" id="inverse_order" name="inverse_order" disabled>
	                    <svg class="hidden w-4 h-4 text-green-600 pointer-events-none" viewBox="0 0 172 172"><g fill="none" stroke-width="none" stroke-miterlimit="10" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode:normal"><path d="M0 172V0h172v172z"/><path d="M145.433 37.933L64.5 118.8658 33.7337 88.0996l-10.134 10.1341L64.5 139.1341l91.067-91.067z" fill="currentColor" stroke-width="1"/></g></svg>
	                  </div>
	                  <span class="inverse-order-text text-gray-500"> Orden inverso para la segunda vuelta</span>
	            </label>
	            <button type="submit" class="mt-4 bg-blue-500 text-white active:bg-blue-600 focus:bg-blue-600 hover:bg-blue-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-lg outline-none focus:outline-none items-center flex" style="transition: all .15s ease">
	                <i class="icon-magic text-16 mr-2"></i>generar calendario
	            </button>
			</form>
		</div>

        <div class="table-wrap">
            <table class="admin-tables">
                @if ($league->days->count() > 0)
                    <thead>
						<tr>
						    <th class="w-12">
						        <label class="custom-check">
						            <div>
						                <input type="checkbox" id="allMark" onchange="showHideAllRowOptions()"/>
						                <svg viewBox="0 0 172 172"><g fill="none" stroke-width="none" stroke-miterlimit="10" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode:normal"><path d="M0 172V0h172v172z"/><path d="M145.433 37.933L64.5 118.8658 33.7337 88.0996l-10.134 10.1341L64.5 139.1341l91.067-91.067z" fill="currentColor" stroke-width="1"/></g></svg>
						            </div>
						        </label>
						    </th>
						    <th class="text-left">
						        <span>Nombre</span>
						    </th>
						</tr>
                    </thead>
                @endif
                <tbody>
                    @if ($league->days->count() > 0)
                        @foreach ($league->days as $day)
                        	<tr>
	                        	<td class="select text-center" style="vertical-align: top">
							        <label class="custom-check">
							            <div>
							                <input type="checkbox" class="mark" value="{{ $day->id }}" name="gameId[]" onchange="showHideRowOptions(this)"/>
							                <svg viewBox="0 0 172 172"><g fill="none" stroke-width="none" stroke-miterlimit="10" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode:normal"><path d="M0 172V0h172v172z"/><path d="M145.433 37.933L64.5 118.8658 33.7337 88.0996l-10.134 10.1341L64.5 139.1341l91.067-91.067z" fill="currentColor" stroke-width="1"/></g></svg>
							            </div>
							        </label>
							    </td>
                        		<td>
                        			<i class="{{ $day->active ? 'fas fa-check-circle text-green-500' : 'fas fa-circle text-gray-500' }} mr-1"></i>
                        			{{ $day->name() }}
                    				<div class="flex flex-col my-2">
	                        			@foreach ($day->matches as $match)
                        					<div class="{{ !$day->active ? 'text-gray-500' : '' }} my-1">
                        						<i class="{{ $match->played() ? 'fas fa-check-circle text-green-500' : 'fas fa-exclamation-circle text-yellow-500' }} mr-1"></i>
                        						<span>{{ $match->local_participant->participant->presenter()['name'] }}</span>
                        						@if ($match->played())
                        							<span>{{ $match->local_score }}-{{ $match->visitor_score }}</span>
                        						@else
                        							<span>vs</span>
                        						@endif
                        						<span>{{ $match->visitor_participant->participant->presenter()['name'] }}</span>
                        					</div>
	                        			@endforeach
                    				</div>
                        		</td>
                        	</tr>
                        @endforeach
                    @else
						<tr>
						    <td colspan="99" class="empty">
						        <i class="icon-nothing"></i>
						        No existen jornadas
						    </td>
						</tr>
                    @endif
                </tbody>
            </table>
        </div>

    </div>
</div>