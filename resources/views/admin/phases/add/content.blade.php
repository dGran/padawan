<div class="antialiased font-sans flex px-4 md:px-8 pb-2">

    <div class="form">
        <form id="form-add" method="POST" role="form" action="{{ route('admin.phases.save', [$tournament, $season, $competition]) }}" lang="{{ app()->getLocale() }}">
            @csrf

            <div class="field-group">
                <div class="element">
                    <label for="name">*Nombre</label>
                    <input type="text" class="placeholder-gray-400" id="name" name="name" placeholder="Nombre" autofocus value="{{ old('name') }}">
                </div>
                <div class="element">
                    <label for="mode">*Modo de juego</label>
                    <div class="relative">
                        <select name="mode" id="mode">
                            @if ($tournament->game->mode_league)
                                <option {{ old('mode') == "league" ? 'selected' : '' }} value="league">Liga</option>
                            @endif
                            @if ($tournament->game->mode_playoffs)
                                <option {{ old('mode') == "playoff" ? 'selected' : '' }} value="playoff">Eliminatorias</option>
                            @endif
                            @if ($tournament->game->mode_races)
                                <option {{ old('mode') == "race" ? 'selected' : '' }} value="race">Carreras</option>
                            @endif
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="element">
                    <label for="num_participants">*Participantes</label>
                    <input type="number" class="placeholder-gray-400" id="num_participants" name="num_participants" placeholder="Número de participantes" min="0" max="{{ $competition->max_participants_new_phase() }}" value="{{ old('num_participants', 0) }}">
                    @if ($competition->phases->count()>0)
                        <p class="block text-blue-500 text-xs pt-2">El valor máximo es el número de participantes de la fase anterior</p>
                    @else
                        <p class="block text-blue-500 text-xs pt-2">El valor máximo es el número de participantes de la temporada</p>
                    @endif
                </div>
            </div>

            <div class="pt-4">
                <button type="submit" class="bg-green-500 text-white active:bg-green-600 focus:bg-green-600 hover:bg-green-600 font-bold uppercase text-sm px-5 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none" style="transition: all .15s ease">
                    Guardar
                </button>
                <a href="{{ route('admin.phases', [$tournament, $season, $competition]) }}" class="bg-transparent text-red-500 active:text-red-600 focus:text-red-600 hover:text-red-600 font-bold uppercase text-sm px-4 py-3 rounded outline-none focus:outline-none ml-2" style="transition: all .15s ease">
                    Cancelar
                </a>
            </div>

        </form>
    </div>

</div>