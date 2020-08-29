<div class="antialiased font-sans w-full px-4 md:px-8">
    <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 pt-4 pb-2">
        @include('admin.racings.menu')
        {{-- <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded"> --}}
        <div class="flex-auto">
            <h3 class="font-bold uppercase text-sm mt-4 pl-2">
                Configuración general
            </h3>

            <div class="form" style="margin-top: .5em">
                <form id="form-edit" method="POST" role="form" action="{{ route('admin.racing.config.update', [$tournament, $season, $competition, $phase, $group]) }}" lang="{{ app()->getLocale() }}">
                @csrf
                {{ method_field('PUT') }}

                    <label class="custom-label flex pb-2">
                          <div class="bg-white border border-gray-400 rounded w-6 h-6 p-1 flex justify-center items-center mr-2">
                            <input type="checkbox" class="hidden" id="fastest_lap" name="fastest_lap" {{ $racing->fastest_lap || old('fastest_lap') == "on" ? 'checked' : '' }} onchange="check_fastest_lap()">
                            <svg class="hidden w-4 h-4 text-green-600 pointer-events-none" viewBox="0 0 172 172"><g fill="none" stroke-width="none" stroke-miterlimit="10" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode:normal"><path d="M0 172V0h172v172z"/><path d="M145.433 37.933L64.5 118.8658 33.7337 88.0996l-10.134 10.1341L64.5 139.1341l91.067-91.067z" fill="currentColor" stroke-width="1"/></g></svg>
                          </div>
                          <span class="select-none"> Registrar vuelta rápida</span>
                    </label>
                    <label class="custom-label flex pb-2">
                          <div class="bg-white border border-gray-400 rounded w-6 h-6 p-1 flex justify-center items-center mr-2">
                            <input type="checkbox" class="hidden" id="pre_qualifying" name="pre_qualifying" {{ $racing->pre_qualifying || old('pre_qualifying') == "on" ? 'checked' : '' }} onchange="check_pre_qualying()">
                            <svg class="hidden w-4 h-4 text-green-600 pointer-events-none" viewBox="0 0 172 172"><g fill="none" stroke-width="none" stroke-miterlimit="10" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode:normal"><path d="M0 172V0h172v172z"/><path d="M145.433 37.933L64.5 118.8658 33.7337 88.0996l-10.134 10.1341L64.5 139.1341l91.067-91.067z" fill="currentColor" stroke-width="1"/></g></svg>
                          </div>
                          <span class="select-none"> Pre-qualifying</span>
                    </label>
                    <label class="custom-label flex pb-2">
                          <div class="bg-white border border-gray-400 rounded w-6 h-6 p-1 flex justify-center items-center mr-2">
                            <input type="checkbox" class="hidden" id="qualifying" name="qualifying" {{ $racing->qualifying || old('qualifying') == "on" ? 'checked' : '' }} onchange="check_qualying()">
                            <svg class="hidden w-4 h-4 text-green-600 pointer-events-none" viewBox="0 0 172 172"><g fill="none" stroke-width="none" stroke-miterlimit="10" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode:normal"><path d="M0 172V0h172v172z"/><path d="M145.433 37.933L64.5 118.8658 33.7337 88.0996l-10.134 10.1341L64.5 139.1341l91.067-91.067z" fill="currentColor" stroke-width="1"/></g></svg>
                          </div>
                          <span class="select-none"> Qualifying</span>
                    </label>

                    <div class="field-group mt-4">
                        <div class="element">
                            <label for="score_fastest_lap">Puntuación Vuelta Rápida</label>
                            <input type="number" class="placeholder-gray-400 {{ !$racing->fastest_lap ? 'disable' : '' }}" id="score_fastest_lap" name="score_fastest_lap" placeholder="Puntuación por vuelta rápida" min="0" max="99" value="{{ $racing->score_fastest_lap }}">
                        </div>
                        <div class="element">
                            <label for="score_pole">Puntuación Pole</label>
                            <input type="number" class="placeholder-gray-400 {{ !$racing->fastest_lap ? 'disable' : '' }}" id="score_pole" name="score_pole" placeholder="Puntuación por vuelta rápida" min="0" max="99" value="{{ $racing->score_pole }}">
                        </div>
                    </div>
                    <label class="custom-label flex pb-2">
                          <div class="bg-white border border-gray-400 rounded w-6 h-6 p-1 flex justify-center items-center mr-2">
                            <input type="checkbox" class="hidden" id="times" name="times" {{ $racing->times || old('times') == "on" ? 'checked' : '' }}>
                            <svg class="hidden w-4 h-4 text-green-600 pointer-events-none" viewBox="0 0 172 172"><g fill="none" stroke-width="none" stroke-miterlimit="10" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode:normal"><path d="M0 172V0h172v172z"/><path d="M145.433 37.933L64.5 118.8658 33.7337 88.0996l-10.134 10.1341L64.5 139.1341l91.067-91.067z" fill="currentColor" stroke-width="1"/></g></svg>
                          </div>
                          <span class="select-none"> Registrar tiempos</span>
                    </label>
                    <label class="custom-label flex pb-2">
                          <div class="bg-white border border-gray-400 rounded w-6 h-6 p-1 flex justify-center items-center mr-2">
                            <input type="checkbox" class="hidden" id="show_circuit_flags" name="show_circuit_flags" {{ $racing->show_circuit_flags || old('show_circuit_flags') == "on" ? 'checked' : '' }}>
                            <svg class="hidden w-4 h-4 text-green-600 pointer-events-none" viewBox="0 0 172 172"><g fill="none" stroke-width="none" stroke-miterlimit="10" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode:normal"><path d="M0 172V0h172v172z"/><path d="M145.433 37.933L64.5 118.8658 33.7337 88.0996l-10.134 10.1341L64.5 139.1341l91.067-91.067z" fill="currentColor" stroke-width="1"/></g></svg>
                          </div>
                          <span class="select-none"> Mostrar banderas de circuitos</span>
                    </label>

                    <div class="mt-8 text-center md:text-right border-t pt-4">
                        <button type="submit" class="bg-green-500 text-white active:bg-green-600 focus:bg-green-600 hover:bg-green-600 font-bold uppercase text-xs md:text-sm px-5 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none" style="transition: all .15s ease">
                            Guardar cambios
                        </button>
                    </div>

                </form>
            </div>
        </div>

        <div class="flex-auto pt-2">
            <h3 class="font-bold uppercase text-sm pl-2">
                puntuación por posiciones
            </h3>
            <div class="bg-white shadow-md rounded-lg p-6 mt-2 mb-4">
                <div class="grid grid-cols-3 sm:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4">
                    @foreach ($racing_scores as $score)
                        <div>
                            <label class="uppercase tracking-wide text-xs font-bold text-gray-500">Pos. {{ $score->position }}</label>
                            <input type="number" class="placeholder-gray-400 mt-2" id="score{{ $score->id }}" name="score" placeholder="Puntos" value="{{ $score->score }}" min="0" max="999" onchange="update_score('{{ $score->id }}')">
                        </div>
                    @endforeach
                </div>
                <div class="mt-8 text-center md:text-right border-t pt-4">
                    <a href="{{ route('admin.racing.config.restore.scores', [$tournament, $season, $competition, $phase, $group]) }}" class="bg-gray-500 text-white active:bg-gray-600 focus:bg-gray-600 hover:bg-gray-600 font-bold uppercase text-xs md:text-sm px-5 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none" type="button" style="transition: all .15s ease">
                        Restaurar puntuaciones
                    </a>
                </div>
            </div>
        </div>
        {{-- </div> --}}
    </div>
</div>