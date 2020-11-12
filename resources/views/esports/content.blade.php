<div class="custom-container">
    <div class="my-8">
        <h1 class="font-fjalla uppercase tracking-wider text-orange-500 text-lg font-semibold">
            e-Sports
        </h1>
        <p class="mt-4">

		        <form action="{{ route('esports') }}" method="GET">

	                <div class="element mb-2">
	                    <div class="relative flex items-center">
	                    	<input type="text" name="filterName" class="flex-1 appearance-none text-gray-700 block w-1/2 border border-gray-300 rounded py-2 px-3 focus:border-gray-500 text-xs" placeholder="Buscar..." autofocus value="{{ $filterName }}">
	                    	<div class="ml-2 flex-1 relative">
		                        <select name="filterGame" id="filterGame" class="bg-white appearance-none text-gray-700 block w-full border border-gray-300 rounded py-2 pl-3 pr-5 focus:border-gray-500 text-xs truncate">
	                            	<option class="truncate" value="0">Todos los juegos</option>
		                            @foreach ($games as $game)
		                                <option {{ $filterGame == $game->id ? 'selected' : '' }} value="{{ $game->id }}" class="truncate">
		                                    {{ $game->name }} - {{ $game->platform->name }}
		                                </option>
		                            @endforeach
		                        </select>
		                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
		                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
		                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
		                            </svg>
		                        </div>
	                        </div>
	                		<button type="submit" class="flex-none ml-2 py-2 px-3 bg-teal-500 text-white text-xs rounded">Buscar</button>
	                    </div>
	                </div>
		        </form>

			<div class="mt-4 mb-8">
				@if ($filterGame > 0)
					<h4 class="mb-4">
						{{ $filterGameName }}
					</h4>
				@endif
				@if ($eteams->count() > 0)
					<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
						@foreach ($eteams as $eteam)
							<a class="bg-gray-800 hover:bg-gray-700 relative shadow rounded" href="{{ route('eteam', $eteam->slug) }}">
								<div class="p-3 flex items-center text-gray-500 rounded text-xs">
									<img src="https://via.placeholder.com/80" class="rounded">
									<div class="flex flex-col ml-3 truncate">
										<span class="absolute top-0 right-0 mt-1 mr-1 text-xxs px-2 py-1 bg-gray-600 text-gray-400 rounded">
											{{ $eteam->short_name }}
										</span>
										<p class="pb-2 text-orange-500 text-sm pr-8 truncate">
											{{ $eteam->name }}
										</p>
										<p class="text-gray-400">
											{{ $eteam->location }}
										</p>
										<p class="text-gray-400">
											<span class="mr-1 font-medium">Propietario:</span>{{ $eteam->owner->name }}
										</p>
									</div>
								</div>
								@if ($filterGame == 0)
									<div class="px-3 pb-3 flex items-center ">
										<img src="{{ $eteam->game->img() }}" alt="{{ $eteam->game->name }}" class="flex-inital h-10 w-10 rounded-full object-cover">
										<div class="ml-2 flex-none text-{{ $eteam->game->platform->color }}-200 flex flex-col">
											<span class="text-xs">{{ $eteam->game->name }}</span>
											<span class="text-xxs">{{ $eteam->game->platform->name }}</span>
										</div>
									</div>
								@endif
							</a>
						@endforeach
					</ul>
				@else
					<div class="p-3 bg-gray-800 text-gray-500 rounded font-source-sans shadow text-md">
						No existen e-teams
					</div>
				@endif
			</div>
        </p>
    </div>
</div>