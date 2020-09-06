<div class="antialiased font-sans w-full px-4 md:px-8">
    <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 pt-4 pb-2">
        @include('admin.leagues.menu')

        <form id="form-edit" method="POST" role="form" action="{{ route('admin.league.config.update', [$tournament, $season, $competition, $phase, $group]) }}" lang="{{ app()->getLocale() }}">
        @csrf
        {{ method_field('PUT') }}

            <div class="flex-auto">
                <h3 class="font-bold uppercase text-sm mt-4 pl-2">
                    Puntuación
                </h3>
                <div class="form" style="margin-top: .5em">
                    <label class="custom-label flex pb-2">
                          <div class="bg-white border border-gray-400 rounded w-6 h-6 p-1 flex justify-center items-center mr-2">
                            <input type="checkbox" class="hidden" id="allow_draws" name="allow_draws" {{ $league->allow_draws || old('allow_draws') == "on" ? 'checked' : '' }} onchange="check_draws()">
                            <svg class="hidden w-4 h-4 text-green-600 pointer-events-none" viewBox="0 0 172 172"><g fill="none" stroke-width="none" stroke-miterlimit="10" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode:normal"><path d="M0 172V0h172v172z"/><path d="M145.433 37.933L64.5 118.8658 33.7337 88.0996l-10.134 10.1341L64.5 139.1341l91.067-91.067z" fill="currentColor" stroke-width="1"/></g></svg>
                          </div>
                          <span class="select-none"> Permitir empates</span>
                    </label>
                    <div class="field-group mt-4">
                        <div class="element">
                            <label for="win_points">Puntos por victoria</label>
                            <input type="number" class="placeholder-gray-400" id="win_points" name="win_points" placeholder="Puntos por victoria" min="0" max="99" value="{{ $league->win_points }}">
                        </div>
                        <div class="element">
                            <label for="draw_points">Puntos por empate</label>
                            <input type="number" class="placeholder-gray-400 {{ !$league->allow_draws ? 'disable' : '' }}" id="draw_points" name="draw_points" placeholder="Puntos por empate" min="0" max="99" value="{{ $league->draw_points }}">
                        </div>
                        <div class="element">
                            <label for="lose_points">Puntos por derrota</label>
                            <input type="number" class="placeholder-gray-400" id="lose_points" name="lose_points" placeholder="Puntos por derrota" min="0" max="99" value="{{ $league->lose_points }}">
                        </div>
                    </div>
                </div> {{-- form --}}
            </div>

            @if ($tournament->user_economy)
                <div class="flex-auto">
                    <h3 class="font-bold uppercase text-sm mt-4 pl-2">
                        Economía
                    </h3>
                    <div class="form" style="margin-top: .5em">
                        <div class="field-group mt-4">
                            <div class="element">
                                <label for="play_amount">€ por jugar</label>
                                <input type="number" class="placeholder-gray-400" id="play_amount" name="play_amount" placeholder="Remuneración por jugar" min="0" max="99" value="{{ $league->play_amount }}">
                            </div>
                            <div class="element">
                                <label for="play_ontime_amount">€ por jugar en plazo</label>
                                <input type="number" class="placeholder-gray-400" id="play_ontime_amount" name="play_ontime_amount" placeholder="Remuneración por jugar en plazo" min="0" max="99" value="{{ $league->play_ontime_amount }}">
                            </div>
                            <div class="element">
                                <label for="win_amount">€ por victoria</label>
                                <input type="number" class="placeholder-gray-400" id="win_amount" name="win_amount" placeholder="Remuneración por victoria" min="0" max="99" value="{{ $league->win_amount }}">
                            </div>
                            <div class="element">
                                <label for="draw_amount">€ por empate</label>
                                <input type="number" class="placeholder-gray-400 {{ !$league->allow_draws ? 'disable' : '' }}" id="draw_amount" name="draw_amount" placeholder="Remuneración por empate" min="0" max="99" value="{{ $league->draw_amount }}">
                            </div>
                            <div class="element">
                                <label for="lose_amount">€ por derrota</label>
                                <input type="number" class="placeholder-gray-400" id="lose_amount" name="lose_amount" placeholder="Remuneración por derrota" min="0" max="99" value="{{ $league->lose_amount }}">
                            </div>
                        </div>
                    </div> {{-- form --}}
                </div>
            @endif

            <div class="flex-auto">
                <h3 class="font-bold uppercase text-sm mt-4 pl-2">
                    Estadísticas
                </h3>
                <div class="form" style="margin-top: .5em">
                    <label class="custom-label flex pb-2">
                          <div class="bg-white border border-gray-400 rounded w-6 h-6 p-1 flex justify-center items-center mr-2">
                            <input type="checkbox" class="hidden" id="stats_mvp" name="stats_mvp" {{ $competition->stats_mvp || old('stats_mvp') == "on" ? 'checked' : '' }}>
                            <svg class="hidden w-4 h-4 text-green-600 pointer-events-none" viewBox="0 0 172 172"><g fill="none" stroke-width="none" stroke-miterlimit="10" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode:normal"><path d="M0 172V0h172v172z"/><path d="M145.433 37.933L64.5 118.8658 33.7337 88.0996l-10.134 10.1341L64.5 139.1341l91.067-91.067z" fill="currentColor" stroke-width="1"/></g></svg>
                          </div>
                          <span class="select-none"> MVP</span>
                    </label>
                    <label class="custom-label flex pb-2">
                          <div class="bg-white border border-gray-400 rounded w-6 h-6 p-1 flex justify-center items-center mr-2">
                            <input type="checkbox" class="hidden" id="stats_goals" name="stats_goals" {{ $competition->stats_goals || old('stats_goals') == "on" ? 'checked' : '' }}>
                            <svg class="hidden w-4 h-4 text-green-600 pointer-events-none" viewBox="0 0 172 172"><g fill="none" stroke-width="none" stroke-miterlimit="10" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode:normal"><path d="M0 172V0h172v172z"/><path d="M145.433 37.933L64.5 118.8658 33.7337 88.0996l-10.134 10.1341L64.5 139.1341l91.067-91.067z" fill="currentColor" stroke-width="1"/></g></svg>
                          </div>
                          <span class="select-none"> Goleadores</span>
                    </label>
                    <label class="custom-label flex pb-2">
                          <div class="bg-white border border-gray-400 rounded w-6 h-6 p-1 flex justify-center items-center mr-2">
                            <input type="checkbox" class="hidden" id="stats_assists" name="stats_assists" {{ $competition->stats_assists || old('stats_assists') == "on" ? 'checked' : '' }}>
                            <svg class="hidden w-4 h-4 text-green-600 pointer-events-none" viewBox="0 0 172 172"><g fill="none" stroke-width="none" stroke-miterlimit="10" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode:normal"><path d="M0 172V0h172v172z"/><path d="M145.433 37.933L64.5 118.8658 33.7337 88.0996l-10.134 10.1341L64.5 139.1341l91.067-91.067z" fill="currentColor" stroke-width="1"/></g></svg>
                          </div>
                          <span class="select-none"> Asistencias</span>
                    </label>
                    <label class="custom-label flex pb-2">
                          <div class="bg-white border border-gray-400 rounded w-6 h-6 p-1 flex justify-center items-center mr-2">
                            <input type="checkbox" class="hidden" id="stats_yellow_cards" name="stats_yellow_cards" {{ $competition->stats_yellow_cards || old('stats_yellow_cards') == "on" ? 'checked' : '' }}>
                            <svg class="hidden w-4 h-4 text-green-600 pointer-events-none" viewBox="0 0 172 172"><g fill="none" stroke-width="none" stroke-miterlimit="10" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode:normal"><path d="M0 172V0h172v172z"/><path d="M145.433 37.933L64.5 118.8658 33.7337 88.0996l-10.134 10.1341L64.5 139.1341l91.067-91.067z" fill="currentColor" stroke-width="1"/></g></svg>
                          </div>
                          <span class="select-none"> Tarjetas amarillas</span>
                    </label>
                    <label class="custom-label flex pb-2">
                          <div class="bg-white border border-gray-400 rounded w-6 h-6 p-1 flex justify-center items-center mr-2">
                            <input type="checkbox" class="hidden" id="stats_red_cards" name="stats_red_cards" {{ $competition->stats_red_cards || old('stats_red_cards') == "on" ? 'checked' : '' }}>
                            <svg class="hidden w-4 h-4 text-green-600 pointer-events-none" viewBox="0 0 172 172"><g fill="none" stroke-width="none" stroke-miterlimit="10" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode:normal"><path d="M0 172V0h172v172z"/><path d="M145.433 37.933L64.5 118.8658 33.7337 88.0996l-10.134 10.1341L64.5 139.1341l91.067-91.067z" fill="currentColor" stroke-width="1"/></g></svg>
                          </div>
                          <span class="select-none"> Tarjetas rojas</span>
                    </label>
                </div> {{-- form --}}
            </div>

            <div class="flex-auto">
                <h3 class="font-bold uppercase text-sm mt-4 pl-2">
                    Marcado de zonas
                </h3>
                <div class="form" style="margin-top: .5em">
                    @foreach ($league->tablezones as $league_tablezone)
                        <div class="field-group">
                            <div class="element">
                                <label for="position{{ $loop->iteration }}">Posición {{ $loop->iteration }}</label>
                                <div class="relative">
                                    <select name="position{{ $loop->iteration }}" id="position{{ $loop->iteration }}">
                                        <option selected value="0">Ninguno</option>
                                        @foreach ($tablezones as $zone)
                                            @if ($league_tablezone->tablezone_id == $zone->id)
                                                <option selected value="{{ $zone->id }}">{{ $zone->name }}</option>
                                            @else
                                                <option value="{{ $zone->id }}">{{ $zone->name }}</option>
                                            @endif
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
                    @endforeach
                </div>
            </div>


            <div class="my-4 text-center md:text-right">
                <button type="submit" class="bg-green-500 text-white active:bg-green-600 focus:bg-green-600 hover:bg-green-600 font-bold uppercase text-xs md:text-sm px-5 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none" style="transition: all .15s ease">
                    Guardar cambios
                </button>
            </div>

        </form>

    </div>
</div>