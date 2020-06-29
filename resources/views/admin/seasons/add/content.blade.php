<div class="antialiased font-sans flex px-4 md:px-8 pb-2">

    <div class="form">
        <form id="form-add" method="POST" role="form" action="{{ route('admin.seasons.save', $tournament) }}" lang="{{ app()->getLocale() }}">
            @csrf

            <div class="field-group">
                <div class="element">
                    <label for="name">*Nombre</label>
                    <input type="text" class="placeholder-gray-400" id="name" name="name" placeholder="Nombre" autofocus value="{{ old('name') }}">
                </div>
                <div class="element">
                    <label for="num_participants">*Número de participantes</label>
                    <input type="number" min="0" class="placeholder-gray-400" id="num_participants" name="num_participants" placeholder="Número de participantes" value="{{ old('num_participants', 0) }}">
                    <p class="block text-blue-500 text-xs pt-2">0 para participantes ilimitados</p>
                </div>
                <div class="element">
                    <label for="inscription_price">Precio de inscripción</label>
                    <input type="number" min="0" class="placeholder-gray-400" id="inscription_price" name="inscription_price" placeholder="Precio de inscripción" value="{{ old('inscription_price', 0) }}">
                </div>
            </div>

            <label class="custom-label flex pb-2">
                  <div class="bg-white border border-gray-400 rounded w-6 h-6 p-1 flex justify-center items-center mr-2">
                    <input type="checkbox" class="hidden" id="free_inscription" name="free_inscription" {{ old('free_inscription') == "on" ? 'checked' : '' }}>
                    <svg class="hidden w-4 h-4 text-green-600 pointer-events-none" viewBox="0 0 172 172"><g fill="none" stroke-width="none" stroke-miterlimit="10" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode:normal"><path d="M0 172V0h172v172z"/><path d="M145.433 37.933L64.5 118.8658 33.7337 88.0996l-10.134 10.1341L64.5 139.1341l91.067-91.067z" fill="currentColor" stroke-width="1"/></g></svg>
                  </div>
                  <span class="select-none"> Inscripción libre</span>
            </label>
            <p class="block text-blue-500 text-xs pb-4">Inscripciones libres sin supervisión de los administradores</p>

            @if ($tournament->participant_type == "individual" && $tournament->use_rosters)
                <div class="field-group">
                    <div class="element">
                        <label for="players_databases_id">Database</label>
                        <div class="relative">
                            <select name="players_databases_id" id="players_databases_id">
                                @foreach ($players_databases as $player_database)
                                    <option {{ old('players_databases_id') == $player_database->id ? 'selected' : '' }} value="{{ $player_database->id }}">
                                        {{ $player_database->name }}
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

            @endif


            <div class="pt-4">
                <button type="submit" class="bg-green-500 text-white active:bg-green-600 focus:bg-green-600 hover:bg-green-600 font-bold uppercase text-sm px-5 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none" style="transition: all .15s ease">
                    Guardar
                </button>
                <a href="{{ route('admin.seasons', $tournament) }}" class="bg-transparent text-red-500 active:text-red-600 focus:text-red-600 hover:text-red-600 font-bold uppercase text-sm px-4 py-3 rounded outline-none focus:outline-none ml-2" style="transition: all .15s ease">
                    Cancelar
                </a>
            </div>

        </form>
    </div>

</div>