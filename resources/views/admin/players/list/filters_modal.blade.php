<div class="hidden overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-start" id="filters">
    <div class="relative w-auto my-6 mx-auto max-w-3xl">
        <!--content-->
        <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">

            <!--header-->
            <div class="flex items-start justify-between p-4 border-b border-solid border-gray-300 rounded-t">
                <h3 class="text-2xl font-semibold">
                    Filtros
                </h3>
                <button class="p-1 ml-auto bg-transparent border-0 text-black opacity-5 float-right text-3xl leading-none font-semibold outline-none focus:outline-none" type="button" onclick="showHideFilters()">
                    <span class="bg-transparent text-black opacity-5 h-6 w-6 text-2xl block outline-none focus:outline-none">×</span>
                </button>
            </div>

            <!--body-->
            <div class="relative p-6 flex-auto">
                <div class="text-bold pb-2">
                    <label for="filterPlayerDatabase">Database</label>
                </div>
                <div class="relative">
                    <select name="filterPlayerDatabase" id="filterPlayerDatabase" class="appearance-none h-full rounded border block appearance-none w-full bg-white border-gray-400 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" onchange="loadPositions()">
                        <option {{ $filterPlayerDatabase == 0 ? 'selected' : '' }} value="0">
                            Todas
                        </option>
                        @foreach ($players_databases as $player_database)
                            <option {{ $filterPlayerDatabase == $player_database->id ? 'selected' : '' }} value="{{ $player_database->id }}">
                                {{ $player_database->name }} ({{ $player_database->game->name }} - {{ $player_database->game->platform->name }})
                            </option>
                        @endforeach
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                        </svg>
                    </div>
                </div>

                <div class="text-bold pb-2 pt-4">
                    <label for="filterPosition">
                        Posición
                        <img id="loading" class="inline-block float-right hidden" src="{{ asset('img/loading.gif') }}" alt="" width="18">
                    </label>
                </div>
                <div class="relative">
                    <select name="filterPosition" id="filterPosition" class="disable appearance-none h-full rounded border block appearance-none w-full bg-white border-gray-400 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                        <option value="0">Todas</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                        </svg>
                    </div>
                </div>

                <div class="text-bold pb-2 pt-4">
                    <label for="filterOverallRange" class="col-form-label d-block">Valoración general</label>
                </div>
                <div class="relative">
                    <input type="text" class="js-range-slider" name="filterOverallRange" id="filterOverallRange" value="" />
                </div>

                <div class="text-bold pb-2 pt-4">
                    <label for="filterAgeRange" class="col-form-label d-block">Edad</label>
                </div>
                <div class="relative">
                    <input type="text" class="js-range-slider" name="filterAgeRange" id="filterAgeRange" value="" />
                </div>

                <div class="text-bold pb-2 pt-4">
                    <label for="filterHeightRange" class="col-form-label d-block">Altura</label>
                </div>
                <div class="relative">
                    <input type="text" class="js-range-slider" name="filterHeightRange" id="filterHeightRange" value="" />
                </div>

                <div class="text-bold pb-2 pt-4">
                    <label for="filterNation">Nacionalidad</label>
                </div>
                <div class="relative">
                    <input type="text" name="filterNation" id="filterNation" class="rounded border border-gray-400 border-b block px-4 py-2 bg-white text-sm text-gray-700 w-full focus:bg-white focus:border-gray-500 focus:text-gray-700 focus:outline-none" placeholder="Nacionalidad" value="{{ $filterNation }}">
                </div>

                <div class="text-bold pb-2 pt-4">
                    <label for="filterTeam">Equipo</label>
                </div>
                <div class="relative">
                    <input type="text" name="filterTeam" id="filterTeam" class="rounded border border-gray-400 border-b block px-4 py-2 bg-white text-sm text-gray-700 w-full focus:bg-white focus:border-gray-500 focus:text-gray-700 focus:outline-none" placeholder="Equipo" value="{{ $filterTeam }}">
                </div>

                <div class="text-bold pb-2 pt-4">
                    <label for="filterLeague">Liga</label>
                </div>
                <div class="relative">
                    <input type="text" name="filterLeague" id="filterLeague" class="rounded border border-gray-400 border-b block px-4 py-2 bg-white text-sm text-gray-700 w-full focus:bg-white focus:border-gray-500 focus:text-gray-700 focus:outline-none" placeholder="Liga" value="{{ $filterLeague }}">
                </div>

                <div class="text-bold pb-2 pt-4">
                    <label for="filterFoot">Pie</label>
                </div>
                <div class="relative">
                    <select name="filterFoot" id="filterFoot" class="appearance-none h-full rounded border block appearance-none w-full bg-white border-gray-400 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                        <option {{ $filterFoot == null ? 'selected' : '' }} value="">Todos</option>
                        <option {{ $filterFoot == 'right' ? 'selected' : '' }} value="right">Derecho</option>
                        <option {{ $filterFoot == 'left' ? 'selected' : '' }} value="left">Izquierdo</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                        </svg>
                    </div>
                </div>

                <div class="text-bold pb-2 pt-4">
                    <label for="filterGameID">Game ID</label>
                </div>
                <div class="relative">
                    <input type="text" name="filterGameID" id="filterGameID" class="rounded border border-gray-400 border-b block px-4 py-2 bg-white text-sm text-gray-700 w-full focus:bg-white focus:border-gray-500 focus:text-gray-700 focus:outline-none" placeholder="Liga" value="{{ $filterGameID }}">
                </div>

                <div class="text-bold pb-2 pt-4">
                    <label for="perPage">Registros por página</label>
                </div>
                <div class="relative">
                    <select name="perPage" id="perPage" class="appearance-none h-full rounded border block appearance-none w-full bg-white border-gray-400 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                        <option {{ $perPage == 3 ? 'selected' : '' }}>3</option>
                        <option {{ $perPage == 5 ? 'selected' : '' }}>5</option>
                        <option {{ $perPage == 8 ? 'selected' : '' }}>8</option>
                        <option {{ $perPage == 10 ? 'selected' : '' }}>10</option>
                        <option {{ $perPage == 12 ? 'selected' : '' }}>12</option>
                        <option {{ $perPage == 15 ? 'selected' : '' }}>15</option>
                        <option {{ $perPage == 20 ? 'selected' : '' }}>20</option>
                        <option {{ $perPage == 25 ? 'selected' : '' }}>25</option>
                        <option {{ $perPage == 50 ? 'selected' : '' }}>50</option>
                        <option {{ $perPage == 100 ? 'selected' : '' }}>100</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                        </svg>
                    </div>
                </div>

                <div class="text-bold pb-2 pt-4">
                    <label for="order">Orden</label>
                </div>
                <div class="relative">
                    <select name="order" id="order" class="appearance-none h-full rounded border block appearance-none w-full bg-white border-gray-400 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                        <option {{ $order == 'id' ? 'selected' : '' }} value="id">
                            ID (0..9)
                        </option>
                        <option {{ $order == 'id_desc' ? 'selected' : '' }} value="id_desc">
                            ID (9..0)
                        </option>
                        <option {{ $order == 'name' ? 'selected' : '' }} value="name">
                            Nombre (A..Z)
                        </option>
                        <option {{ $order == 'name_desc' ? 'selected' : '' }} value="name_desc">
                            Nombre (Z..A)
                        </option>
                        <option {{ $order == 'overall' ? 'selected' : '' }} value="overall">
                            Media (0..9)
                        </option>
                        <option {{ $order == 'overall_desc' ? 'selected' : '' }} value="overall_desc">
                            Media (9..0)
                        </option>
                        <option {{ $order == 'age' ? 'selected' : '' }} value="age">
                            Edad (0..9)
                        </option>
                        <option {{ $order == 'age_desc' ? 'selected' : '' }} value="age_desc">
                            Edad (9..0)
                        </option>
                        <option {{ $order == 'height' ? 'selected' : '' }} value="height">
                            Altura (0..9)
                        </option>
                        <option {{ $order == 'height_desc' ? 'selected' : '' }} value="height_desc">
                            Altura (9..0)
                        </option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                        </svg>
                    </div>
                </div>

            </div>

            <!--footer-->
            <div class="flex items-center justify-end p-6 border-t border-solid border-gray-300 rounded-b">
                <button class="text-red-500 background-transparent font-bold uppercase px-6 py-2 text-sm outline-none focus:outline-none mr-1 mb-1" type="button" style="transition: all .15s ease" onclick="showHideFilters()">
                    Cerrar
                </button>
                <button type="submit" class="bg-green-500 text-white active:bg-green-600 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1" style="transition: all .15s ease">
                    Aplicar filtros
                </button>
            </div>

        </div>
    </div>
</div>
<div class="hidden opacity-25 fixed inset-0 z-40 bg-black" id="filters-backdrop"></div>