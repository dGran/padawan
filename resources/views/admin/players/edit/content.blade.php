<div class="antialiased font-sans flex px-4 md:px-8 pb-2">

    <div class="form">
        <form id="form-add" method="POST" role="form" action="{{ route('admin.players.update', $player->id) }}" lang="{{ app()->getLocale() }}" enctype="multipart/form-data">
            {{ method_field('PUT') }}
            @csrf
            <input type="file" name="img" id="img" value="{{ $player->img }}" onchange="showImage(this)" style="display:none"/>
            <input type="hidden" name="deleteImg" id="deleteImg" value=0>
            <div class="flex flex-row mb-3 rounded justify-center">
                <div class="relative">
                    <img id="thumbnail" src="{{ $player->img() }}" alt="img" class="object-cover w-24 h-24 rounded-full shadow overflow-hidden border-4 border-white">
                    <a id="delete_img" class="{{ is_null($player->img) ? 'hidden' : '' }} absolute rounded-full h-8 w-8 flex items-center justify-center bg-red-500 text-white active:bg-red-600 font-bold outline-none focus:outline-none text-xl cursor-pointer" onclick="deleteImage()" style="top: -5px; right: -10px">
                        <i class="fas fa-times"></i>
                    </a>
                </div>
            </div>
            <div class="flex flex-row mt-3 mb-1 justify-center">
                <label for="img" class="cursor-pointer inine-flex justify-between items-center focus:outline-none border py-2 px-4 rounded-lg shadow-sm text-left text-gray-600 bg-gray-100 hover:bg-gray-200 font-medium">
                    <i class="fas fa-upload mr-2"></i>Cargar imagen
                </label>
            </div>
            <div class="flex flex-row mt-2 mb-6 text-gray-500 text-xs justify-center">
                <span class="">
                    Archivos válidos: .jpeg, .png, .jpg, .gif, .svg
                </span>
            </div>

            <div class="field-group">
                <div class="element">
                    <label for="players_databases_id">Database</label>
                    <div class="relative">
                        <select name="players_databases_id" id="players_databases_id" onchange="loadPositions()">
                            @foreach ($players_databases as $player_database)
                                <option {{ $player->players_databases_id == $player_database->id ? 'selected' : '' }} value="{{ $player_database->id }}">
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
                </div>
                <div class="element">
                    <label for="name">*Nombre</label>
                    <input type="text" class="placeholder-gray-400" id="name" name="name" placeholder="Nombre" autofocus value="{{ old('name', $player->name) }}">
                </div>
                <div class="element">
                    <label for="nation_name">Nacionalidad</label>
                    <input type="text" class="placeholder-gray-400" id="nation_name" name="nation_name" placeholder="Nacionalidad" value="{{ old('nation_name', $player->nation_name) }}">
                </div>
            </div>

            <div class="field-group">
                <div class="element">
                    <label for="position_id">
                        Posición
                        <img id="loading" class="inline-block float-right hidden" src="{{ asset('img/loading.gif') }}" alt="" width="18">
                    </label>
                    <div class="relative">
                        <select name="position_id" id="position_id" class="disable">
                            <option>Database no seleccionada</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="element">
                    <label for="overall_rating">Media</label>
                    <input type="number" class="placeholder-gray-400" id="overall_rating" name="overall_rating" placeholder="Valoración media" value="{{ old('overall_rating', $player->overall_rating) }}">
                </div>
                <div class="element">
                    <label for="height">Altura</label>
                    <input type="number" class="placeholder-gray-400" min="0" id="height" name="height" placeholder="Altura en centímetros" value="{{ old('height', $player->height) }}">
                </div>
                <div class="element">
                    <label for="age">Edad</label>
                    <input type="number" class="placeholder-gray-400" min="0" id="age" name="age" placeholder="Edad" value="{{ old('age', $player->age) }}">
                </div>
            </div>
            <div class="field-group">
                <div class="element">
                    <label for="team_name">Equipo</label>
                    <input type="text" class="placeholder-gray-400" id="team_name" name="team_name" placeholder="Equipo" value="{{ old('team_name', $player->team_name) }}">
                </div>
                <div class="element">
                    <label for="league_name">Liga</label>
                    <input type="text" class="placeholder-gray-400" id="league_name" name="league_name" placeholder="Liga" value="{{ old('league_name', $player->league_name) }}">
                </div>
                <div class="element">
                    <label for="foot">Pie</label>
                    <div class="relative">
                        <select name="foot" id="foot">
                            <option {{ $player->foot == null ? 'selected' : '' }} value="">*Desconocido</option>
                            <option {{ $player->foot == 'right' ? 'selected' : '' }} value="right">Derecho</option>
                            <option {{ $player->foot == 'left' ? 'selected' : '' }} value="left">Izquierdo</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="element">
                    <label for="game_id">Game ID</label>
                    <input type="number" class="placeholder-gray-400" id="game_id" name="game_id" placeholder="ID del jugador en el juego" value="{{ old('game_id', $player->game_id) }}">
                </div>
            </div>

            <div class="mt-8">
                <button type="submit" class="bg-green-500 text-white active:bg-green-600 focus:bg-green-600 hover:bg-green-600 font-bold uppercase text-sm px-5 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none" style="transition: all .15s ease">
                    Guardar
                </button>
                <a href="{{ route('admin.players') }}" class="bg-transparent text-red-500 active:text-red-600 focus:text-red-600 hover:text-red-600 font-bold uppercase text-sm px-4 py-3 rounded outline-none focus:outline-none ml-2" style="transition: all .15s ease">
                    Cancelar
                </a>
            </div>

        </form>
    </div>

</div>