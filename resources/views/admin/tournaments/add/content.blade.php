<div class="antialiased font-sans flex px-4 md:px-8 pb-2">

    <div class="form">
        <form id="form-add" method="POST" role="form" action="{{ route('admin.tournaments.save') }}" lang="{{ app()->getLocale() }}" enctype="multipart/form-data">
            @csrf

            <div class="label-img">
                Logo
            </div>
            <input type="file" name="img" id="img" onchange="showImage(this)" style="display:none"/>
            <input type="hidden" name="deleteImg" id="deleteImg" value=0>
            <div class="flex flex-row mb-3 rounded justify-center">
                <div class="relative">
                    <img id="thumbnail" src="{{ asset('img/games/default.png') }}" alt="img" class="thumbnail">
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
            <div class="flex flex-col mt-2 mb-6 text-gray-500 text-xs justify-center items-center text-center">
                <span>
                    Archivos válidos: .jpeg, .png, .jpg, .gif, .svg
                </span>
                <span class="font-bold">
                    Dimensiones recomendadas: 200x200px
                </span>
            </div>

            <div class="label-img pt-2">
                Banner
            </div>
            <input type="file" name="banner" id="banner" onchange="showBanner(this)" style="display:none"/>
            <input type="hidden" name="deleteBanner" id="deleteBanner" value=0>
            <div class="flex flex-row mb-3 rounded justify-center">
                <div class="relative">
                    <img id="thumbnail_banner" src="{{ asset('img/games/default_banner.png') }}" alt="banner" class="thumbnail original-size">
                    <a id="delete_banner" class="hidden absolute rounded-full h-8 w-8 flex items-center justify-center bg-red-500 text-white active:bg-red-600 font-bold outline-none focus:outline-none text-xl cursor-pointer" onclick="deleteBanner()" style="top: -5px; right: -10px">
                        <i class="fas fa-times"></i>
                    </a>
                </div>
            </div>
            <div class="flex flex-row mt-3 mb-1 justify-center">
                <label for="banner" class="cursor-pointer inine-flex justify-between items-center focus:outline-none border py-2 px-4 rounded-lg shadow-sm text-left text-gray-600 bg-gray-100 hover:bg-gray-200 font-medium">
                    <i class="fas fa-upload mr-2"></i>Cargar imagen
                </label>
            </div>
            <div class="flex flex-col mt-2 mb-6 text-gray-500 text-xs justify-center items-center text-center">
                <span>
                    Archivos válidos: .jpeg, .png, .jpg, .gif, .svg
                </span>
                <span class="font-bold">
                    Dimensiones recomendadas: 960x540px
                </span>
            </div>

            <div class="field-group">
                <div class="element">
                    <label for="name">*Nombre</label>
                    <input type="text" class="placeholder-gray-400" id="name" name="name" placeholder="Nombre" autofocus value="{{ old('name') }}">
                </div>
                <div class="element">
                    <label for="game_id">Juego</label>
                    <div class="relative">
                        <select name="game_id" id="game_id" onchange="check_game_options()">
                            @foreach ($games as $game)
                                <option {{ old('game_id') == $game->id ? 'selected' : '' }} value="{{ $game->id }}" data-game-rosters="{{ $game->rosters }}" data-mode-league="{{ $game->mode_league }}" data-mode-playoffs="{{ $game->mode_playoffs }}" data-mode-races="{{ $game->mode_races }}">
                                    {{ $game->name }} ({{ $game->platform->name }})
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
                    <label for="participant_type">Tipo Participante</label>
                    <div class="relative">
                        <select name="participant_type" id="participant_type" onchange="check_use_rosters()">
                            <option {{ old('participant_type') == "individual" ? 'selected' : '' }} value="individual">Individual</option>
                            <option {{ old('participant_type') == "eteam" ? 'selected' : '' }} value="eteam">e-Teams</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <label class="custom-label flex pb-2">
                  <div class="bg-white border border-gray-400 rounded w-6 h-6 p-1 flex justify-center items-center mr-2">
                    <input type="checkbox" class="hidden" id="use_teams" name="use_teams" {{ old('use_teams') == "on" ? 'checked' : '' }}>
                    <svg class="hidden w-4 h-4 text-green-600 pointer-events-none" viewBox="0 0 172 172"><g fill="none" stroke-width="none" stroke-miterlimit="10" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode:normal"><path d="M0 172V0h172v172z"/><path d="M145.433 37.933L64.5 118.8658 33.7337 88.0996l-10.134 10.1341L64.5 139.1341l91.067-91.067z" fill="currentColor" stroke-width="1"/></g></svg>
                  </div>
                  <span class="select-none"> Usa equipos</span>
            </label>
            <p class="block text-blue-500 text-xs pb-4">Cada participante representa a un equipo</p>

            <label class="custom-label flex pb-2">
                  <div class="bg-white border border-gray-400 rounded w-6 h-6 p-1 flex justify-center items-center mr-2">
                    <input type="checkbox" class="hidden" id="use_rosters" name="use_rosters" {{ old('use_rosters') == "on" ? 'checked' : '' }}>
                    <svg class="hidden w-4 h-4 text-green-600 pointer-events-none" viewBox="0 0 172 172"><g fill="none" stroke-width="none" stroke-miterlimit="10" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode:normal"><path d="M0 172V0h172v172z"/><path d="M145.433 37.933L64.5 118.8658 33.7337 88.0996l-10.134 10.1341L64.5 139.1341l91.067-91.067z" fill="currentColor" stroke-width="1"/></g></svg>
                  </div>
                  <span class="select-none"> Usa plantillas de jugadores</span>
            </label>
            <p class="info_use_rosters block text-blue-500 text-xs pb-4">
                Cada participante está compuesto por una plantilla de jugadores, se usarán tanto para estadísticas como para el mercado de fichajes
            </p>

            <label class="custom-label flex pt-4 pb-4">
                  <div class="bg-white border border-gray-400 rounded w-6 h-6 p-1 flex justify-center items-center mr-2">
                    <input type="checkbox" class="hidden" id="market" name="market" {{ old('market') == "on" ? 'checked' : '' }} onchange="check_market()">
                    <svg class="hidden w-4 h-4 text-green-600 pointer-events-none" viewBox="0 0 172 172"><g fill="none" stroke-width="none" stroke-miterlimit="10" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode:normal"><path d="M0 172V0h172v172z"/><path d="M145.433 37.933L64.5 118.8658 33.7337 88.0996l-10.134 10.1341L64.5 139.1341l91.067-91.067z" fill="currentColor" stroke-width="1"/></g></svg>
                  </div>
                  <span class="select-none"> Mercado de fichajes</span>
            </label>

            <label class="custom-label disable flex pl-6 pb-2">
                  <div class="bg-white border border-gray-400 rounded w-6 h-6 p-1 flex justify-center items-center mr-2">
                    <input type="checkbox" class="hidden" id="use_economy" name="use_economy" {{ old('use_economy') == "on" ? 'checked' : '' }}>
                    <svg class="hidden w-4 h-4 text-green-600 pointer-events-none" viewBox="0 0 172 172"><g fill="none" stroke-width="none" stroke-miterlimit="10" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode:normal"><path d="M0 172V0h172v172z"/><path d="M145.433 37.933L64.5 118.8658 33.7337 88.0996l-10.134 10.1341L64.5 139.1341l91.067-91.067z" fill="currentColor" stroke-width="1"/></g></svg>
                  </div>
                  <span class="select-none"> Presupuestos</span>
            </label>
            <p class="info_use_economy block text-blue-300 text-xs pl-6 pb-4">Cada participante tiene un presupuesto</p>

            <label class="custom-label disable flex pl-6 pb-2">
                  <div class="bg-white border border-gray-400 rounded w-6 h-6 p-1 flex justify-center items-center mr-2">
                    <input type="checkbox" class="hidden" id="use_salaries" name="use_salaries"  {{ old('use_salaries') == "on" ? 'checked' : '' }}>
                    <svg class="hidden w-4 h-4 text-green-600 pointer-events-none" viewBox="0 0 172 172"><g fill="none" stroke-width="none" stroke-miterlimit="10" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode:normal"><path d="M0 172V0h172v172z"/><path d="M145.433 37.933L64.5 118.8658 33.7337 88.0996l-10.134 10.1341L64.5 139.1341l91.067-91.067z" fill="currentColor" stroke-width="1"/></g></svg>
                  </div>
                  <span class="select-none"> Salarios</span>
            </label>
            <p class="info_use_salaries block text-blue-300 text-xs pl-6 pb-4">Los jugadores tienen salarios</p>

            <label class="custom-label disable flex pl-6 pb-2">
                  <div class="bg-white border border-gray-400 rounded w-6 h-6 p-1 flex justify-center items-center mr-2">
                    <input type="checkbox" class="hidden" id="use_transfers" name="use_transfers" {{ old('use_transfers') == "on" ? 'checked' : '' }}>
                    <svg class="hidden w-4 h-4 text-green-600 pointer-events-none" viewBox="0 0 172 172"><g fill="none" stroke-width="none" stroke-miterlimit="10" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode:normal"><path d="M0 172V0h172v172z"/><path d="M145.433 37.933L64.5 118.8658 33.7337 88.0996l-10.134 10.1341L64.5 139.1341l91.067-91.067z" fill="currentColor" stroke-width="1"/></g></svg>
                  </div>
                  <span class="select-none"> Fichajes</span>
            </label>
            <p class="info_use_transfers block text-blue-300 text-xs pl-6 pb-4">Se permiten los intercambios de jugadores</p>

            <label class="custom-label disable flex pl-6 pb-2">
                  <div class="bg-white border border-gray-400 rounded w-6 h-6 p-1 flex justify-center items-center mr-2">
                    <input type="checkbox" class="hidden" id="use_clauses" name="use_clauses" {{ old('use_clauses') == "on" ? 'checked' : '' }}>
                    <svg class="hidden w-4 h-4 text-green-600 pointer-events-none" viewBox="0 0 172 172"><g fill="none" stroke-width="none" stroke-miterlimit="10" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode:normal"><path d="M0 172V0h172v172z"/><path d="M145.433 37.933L64.5 118.8658 33.7337 88.0996l-10.134 10.1341L64.5 139.1341l91.067-91.067z" fill="currentColor" stroke-width="1"/></g></svg>
                  </div>
                  <span class="select-none"> Claúsulas</span>
            </label>
              <p class="info_use_clauses block text-blue-300 text-xs pl-6 pb-4">Se permiten los fichajes mediante pago de claúsulas</p>

            <label class="custom-label disable flex pl-6 pb-2">
                  <div class="bg-white border border-gray-400 rounded w-6 h-6 p-1 flex justify-center items-center mr-2">
                    <input type="checkbox" class="hidden" id="use_free_agents" name="use_free_agents" {{ old('use_free_agents') == "on" ? 'checked' : '' }}>
                    <svg class="hidden w-4 h-4 text-green-600 pointer-events-none" viewBox="0 0 172 172"><g fill="none" stroke-width="none" stroke-miterlimit="10" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode:normal"><path d="M0 172V0h172v172z"/><path d="M145.433 37.933L64.5 118.8658 33.7337 88.0996l-10.134 10.1341L64.5 139.1341l91.067-91.067z" fill="currentColor" stroke-width="1"/></g></svg>
                  </div>
                  <span class="select-none"> Agentes Libres</span>
            </label>
            <p class="info_use_free_agents block text-blue-300 text-xs pl-6 pb-4">Se permiten los despidos y los fichajes de agentes libres</p>

            <div class="field-group pt-4">
                <div class="element">
                    <label for="rules">Reglas</label>
                    <textarea name="rules" id="rules" rows="10">{{ old('rules') }}</textarea>
                </div>
            </div>


            {{-- QUICKLY CONFIGURATION --}}

            <label class="custom-label flex pt-8 pb-2">
                  <div class="bg-white border border-gray-400 rounded w-6 h-6 p-1 flex justify-center items-center mr-2">
                    <input type="checkbox" class="hidden" id="quickly" name="quickly" {{ old('quickly') == "on" ? 'checked' : '' }} onchange="check_quickly()">
                    <svg class="hidden w-4 h-4 text-green-600 pointer-events-none" viewBox="0 0 172 172"><g fill="none" stroke-width="none" stroke-miterlimit="10" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode:normal"><path d="M0 172V0h172v172z"/><path d="M145.433 37.933L64.5 118.8658 33.7337 88.0996l-10.134 10.1341L64.5 139.1341l91.067-91.067z" fill="currentColor" stroke-width="1"/></g></svg>
                  </div>
                  <span class="select-none block uppercase tracking-wide text-xs pt-1 font-bold text-teal-500"> Configuración rápida</span>
            </label>
            <p class="block text-xs pb-4 text-teal-600">
                Activa la casilla para crear automáticamente los participantes (sin identidad), 1 temporada con 1 competición con 1 fase y con 1 grupo, en éste se agregán todos los participantes.<br>
            </p>

           <div class="field-group m-3">
                <div class="element">
                    <label for="num_participants">*Número de participantes</label>
                    <input type="number" min="0" class="placeholder-gray-400 disable" id="num_participants" name="num_participants" placeholder="Número de participantes" value="{{ old('num_participants', 0) }}">
                    <p class="info_num_participants block text-blue-500 text-xs pt-2">0 para participantes ilimitados</p>
                </div>
                <div class="element">
                    <label for="mode">*Modo de juego</label>
                    <div class="relative">
                        <select name="mode" id="mode" class="disable"></select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-8">
                <button type="submit" class="bg-green-500 text-white active:bg-green-600 focus:bg-green-600 hover:bg-green-600 font-bold uppercase text-sm px-5 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none" style="transition: all .15s ease">
                    Guardar
                </button>
                <a href="{{ route('admin.tournaments') }}" class="bg-transparent text-red-500 active:text-red-600 focus:text-red-600 hover:text-red-600 font-bold uppercase text-sm px-4 py-3 rounded outline-none focus:outline-none ml-2" style="transition: all .15s ease">
                    Cancelar
                </a>
            </div>

        </form>
    </div>

</div>