<div class="antialiased font-sans w-full px-4 md:px-8">
    <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 pt-4 pb-2">
        @include('admin.racings.menu')
        {{-- <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded"> --}}
        <div class="flex-auto">
            <h3 class="font-bold uppercase text-sm mt-4 pl-2">
                Configuración general
            </h3>

            <div class="form" style="margin-top: .5em">
                <form id="form-edit" method="GET" role="form" action="{{ route('admin.racing.config.update', [$tournament, $season, $competition, $phase, $group]) }}" lang="{{ app()->getLocale() }}">

                    <div class="field-group">
                        <div class="element">
                            <label for="num_races">Número de carreras</label>
                            <input type="number" class="placeholder-gray-400" id="num_races" name="num_races" placeholder="Número de carreras" autofocus min="1" max="99" value="{{ $racing->num_races }}">
                        </div>
                    </div>
                    <label class="custom-label flex pb-2 -mt-3">
                          <div class="bg-white border border-gray-400 rounded w-6 h-6 p-1 flex justify-center items-center mr-2">
                            <input type="checkbox" class="hidden" id="free_inscription" name="free_inscription" {{ $season->free_inscriprion || old('free_inscription') == "on" ? 'checked' : '' }}>
                            <svg class="hidden w-4 h-4 text-green-600 pointer-events-none" viewBox="0 0 172 172"><g fill="none" stroke-width="none" stroke-miterlimit="10" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode:normal"><path d="M0 172V0h172v172z"/><path d="M145.433 37.933L64.5 118.8658 33.7337 88.0996l-10.134 10.1341L64.5 139.1341l91.067-91.067z" fill="currentColor" stroke-width="1"/></g></svg>
                          </div>
                          <span class="select-none"> Registrar vuelta rápida</span>
                    </label>
                </form>
            </div>
        </div>

        <div class="flex-auto pt-2">
            <h3 class="font-bold uppercase text-sm pl-2">
                puntuaciones
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
                <div class="pt-8">
                    <a href="{{ route('admin.racing.config.restore.scores', [$tournament, $season, $competition, $phase, $group]) }}" class="text-gray-500 bg-transparent border border-solid border-gray-500 hover:bg-gray-500 hover:text-white active:bg-gray-600 font-bold uppercase text-xs px-4 py-2 rounded outline-none focus:outline-none mr-1 mb-1" type="button" style="transition: all .15s ease">
                      Restaurar puntuaciones
                    </a>
                </div>
            </div>
        </div>
        {{-- </div> --}}
    </div>
</div>