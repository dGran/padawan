<div class="antialiased font-sans w-full px-4 md:px-8">
    <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 pt-4 pb-2">
    	<h3 class="text-base font-bold mt-4 mb-2">
    		Por favor, selecciona el torneo...
    	</h3>
        <form action="{{ route('admin.participants.selector.select') }}" method="POST">
            @csrf
            <div class="relative w-full lg:w-3/4 lg:w-1/2">
                <select name="tournament_id" id="tournament_id" class="appearance-none h-full rounded border block appearance-none w-full bg-white border-gray-400 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" onchange="loadSeasons()">
                    @foreach ($tournaments as $tournament)
                        <option value="{{ $tournament->id }}">
                            {{ $tournament->name }} ({{ $tournament->game->name }} - {{ $tournament->game->platform->name }})
                        </option>
                    @endforeach
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                    </svg>
                </div>
            </div>

            <h3 class="text-base font-bold mt-4 mb-2">
                Por favor, selecciona la temporada...
            </h3>
            <div class="relative w-full lg:w-3/4 lg:w-1/2">
                <select name="season_slug" id="season_slug" class="disable appearance-none h-full rounded border block appearance-none w-full bg-white border-gray-400 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                    <option>No existen temporadas</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                    </svg>
                </div>
            </div>
            <button class="bg-green-500 text-white active:bg-green-600 font-bold uppercase text-sm mt-3 px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1" type="submit" style="transition: all .15s ease">
                Seleccionar torneo
            </button>
        </form>
    </div>
</div>