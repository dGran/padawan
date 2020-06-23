<div class="antialiased font-sans flex px-4 md:px-8 pb-2">

    <div class="form">
        <form id="form-add" method="POST" role="form" action="{{ route('admin.players.save') }}" lang="{{ app()->getLocale() }}" enctype="multipart/form-data">
            @csrf

            <div class="text-center pb-6">
                <h4 class="block uppercase tracking-wide text-xs font-bold text-gray-500 mb-1">
                    Database
                </h4>
                <p>
                    {{ $player_database->name }}
                </p>
                <p class="text-xs text-gray-600">
                    {{ $player_database->game->name }} ({{ $player_database->game->platform->name }})
                </p>
                <p class="text-xs text-blue-500 mt-2">
                    *Para alta en otra database cambia el filtro de database en el listado
                </p>
            </div>
            <input type="file" name="img" id="img" onchange="showImage(this)" style="display:none"/>
            <input type="hidden" name="deleteImg" id="deleteImg" value=0>
            <input type="hidden" name="players_databases_id" id="players_databases_id" value={{ $player_database->id }}>
            <div class="flex flex-row mb-3 rounded justify-center">
                <div class="relative">
                    <img id="thumbnail" src="{{ asset('img/players/default.png') }}" alt="img" class="object-cover w-20 h-20 rounded-full border border-gray-500 bg-white p-1">
                    <a id="delete_img" class="hidden absolute rounded-full h-8 w-8 flex items-center justify-center bg-red-500 text-white active:bg-red-600 font-bold outline-none focus:outline-none text-xl cursor-pointer" onclick="deleteImage()" style="top: -5px; right: -10px">
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
                    <label for="name">*Nombre</label>
                    <input type="text" class="placeholder-gray-400" id="name" name="name" placeholder="Nombre" autofocus value="{{ old('name') }}">
                </div>
                <div class="element">
                    <label for="nation_name">Nacionalidad</label>
                    <input type="text" class="placeholder-gray-400" id="nation_name" name="nation_name" placeholder="Nacionalidad" value="{{ old('nation_name') }}">
                </div>
                <div class="element">
                    <label for="position_id">Posición</label>
                    <div class="relative">
                        <select name="position_id" id="position_id">
                            <option {{ old('position_id') == null ? 'selected' : '' }} value="">*Desconocida</option>
                            @foreach ($positions as $position)
                                <option {{ old('position_id') == $position->id ? 'selected' : ''  }} value="{{ $position->id }}">
                                    {{ $position->name }}
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
            </div>

            <div class="field-group">
                <div class="element">
                    <label for="overall_rating">Media</label>
                    <input type="number" class="placeholder-gray-400" id="overall_rating" name="overall_rating" placeholder="Valoración media" value="{{ old('overall_rating') }}">
                </div>
                <div class="element">
                    <label for="height">Altura</label>
                    <input type="number" class="placeholder-gray-400" id="height" name="height" placeholder="Altura" value="{{ old('height') }}">
                </div>
                <div class="element">
                    <label for="age">Edad</label>
                    <input type="number" class="placeholder-gray-400" id="age" name="age" placeholder="Edad" value="{{ old('age') }}">
                </div>
                <div class="element">
                    <label for="foot">Pie</label>
                    <div class="relative">
                        <select name="foot" id="foot">
                            <option {{ old('foot') == null ? 'selected' : '' }} value="">*Desconocido</option>
                            <option {{ old('foot') == 'right' ? 'selected' : '' }} value="right">Derecho</option>
                            <option {{ old('foot') == 'left' ? 'selected' : '' }} value="left">Izquierdo</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <div class="field-group">
                <div class="element">
                    <label for="team_name">Equipo</label>
                    <input type="text" class="placeholder-gray-400" id="team_name" name="team_name" placeholder="Equipo" value="{{ old('team_name') }}">
                </div>
                <div class="element">
                    <label for="league_name">Liga</label>
                    <input type="text" class="placeholder-gray-400" id="league_name" name="league_name" placeholder="Liga" value="{{ old('league_name') }}">
                </div>
                <div class="element">
                    <label for="game_id">Game ID</label>
                    <input type="number" class="placeholder-gray-400" id="game_id" name="game_id" placeholder="ID del jugador en {{ $player_database->game->name }}" value="{{ old('game_id') }}">
                </div>
            </div>

            <div class="mt-8">
                <button type="submit" class="bg-green-500 text-white active:bg-green-600 font-bold uppercase text-sm px-5 py-3 rounded shadow hover:shadow-lg hover:bg-green-600 outline-none focus:outline-none" style="transition: all .15s ease">
                    Guardar
                </button>
                <a href="{{ route('admin.players') }}" class="bg-transparent text-red-500 font-bold uppercase text-sm px-4 py-3 rounded outline-none focus:outline-none ml-2" style="transition: all .15s ease">
                    Cancelar
                </a>
            </div>

        </form>
    </div>

</div>