<div class="antialiased font-sans flex px-4 md:px-8 pb-2">

    <div class="form">
        <form id="form-edit" method="POST" role="form" action="{{ route('admin.seasons.update', [$tournament, $season->id]) }}" lang="{{ app()->getLocale() }}">
            @csrf
            {{ method_field('PUT') }}

            <div class="field-group">
                <div class="element">
                    <label for="name">*Nombre</label>
                    <input type="text" class="placeholder-gray-400" id="name" name="name" placeholder="Nombre" autofocus value="{{ old('name', $season->name) }}">
                </div>
                <div class="element">
                    <label for="num_participants">*Número de participantes</label>
                    <input type="number" min="{{ $season->participants->count() }}" class="placeholder-gray-400 {{ $season->hasCompetitionWithPhases() ? 'disable' : '' }}" id="num_participants" name="num_participants" placeholder="Número de participantes" value="{{ old('num_participants', $season->num_participants) }}">
                    @if ($season->hasCompetitionWithPhases())
                        <p class="block text-blue-500 text-xs pt-2">Ya existen competiciones con fases configuradas, debes eliminarlas para poder editar el número de participantes</p>
                    @else
                        @if ($season->participants->count() > 0)
                            <p class="block text-blue-500 text-xs pt-2">Mínimo: {{ $season->participants->count() }} (participantes ya registrados)</p>
                        @else
                            <p class="block text-blue-500 text-xs pt-2">0 para participantes ilimitados</p>
                        @endif
                    @endif
                </div>
                <div class="element">
                    <label for="inscription_price">Precio de inscripción</label>
                    <input type="number" min="0" step="any" class="placeholder-gray-400" id="inscription_price" name="inscription_price" placeholder="Precio de inscripción" value="{{ old('inscription_price', $season->inscription_price) }}">
                </div>
            </div>

            <label class="custom-label flex pb-2 -mt-3">
                  <div class="bg-white border border-gray-400 rounded w-6 h-6 p-1 flex justify-center items-center mr-2">
                    <input type="checkbox" class="hidden" id="free_inscription" name="free_inscription" {{ $season->free_inscriprion || old('free_inscription') == "on" ? 'checked' : '' }}>
                    <svg class="hidden w-4 h-4 text-green-600 pointer-events-none" viewBox="0 0 172 172"><g fill="none" stroke-width="none" stroke-miterlimit="10" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode:normal"><path d="M0 172V0h172v172z"/><path d="M145.433 37.933L64.5 118.8658 33.7337 88.0996l-10.134 10.1341L64.5 139.1341l91.067-91.067z" fill="currentColor" stroke-width="1"/></g></svg>
                  </div>
                  <span class="select-none"> Inscripciones libres</span>
            </label>
            <p class="block text-blue-500 text-xs pb-4">Inscripciones libres sin validación de los administradores</p>

            @if ($tournament->use_rosters)
                <div class="field-group">
                    <div class="element">
                        <label for="players_databases_id">Database</label>
                        <div class="relative">
                            <select name="players_databases_id" id="players_databases_id">
                                @foreach ($players_databases as $player_database)
                                    <option {{ $season->players_databases_id == $player_database->id || old('players_databases_id') == $player_database->id ? 'selected' : '' }} value="{{ $player_database->id }}">
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
                    <div class="element">
                        <label for="min_players">Mínimo jugadores plantilla</label>
                        <input type="number" min="0" class="placeholder-gray-400" id="min_players" name="min_players" placeholder="Jugadores mínimos por plantilla" value="{{ old('min_players', $season->min_players) }}">
                    </div>
                    <div class="element">
                        <label for="max_players">Máximo jugadores plantilla</label>
                        <input type="number" min="0" class="placeholder-gray-400" id="max_players" name="max_players" placeholder="Jugadores máximos por plantilla" value="{{ old('max_players', $season->max_players) }}">
                    </div>
                </div>
            @endif

            @if ($tournament->use_economy)
                <div class="field-group">
                    <div class="element">
                        <label for="initial_budget">Presupuesto inicial</label>
                        <input type="number" min="0" step="any" class="placeholder-gray-400" id="initial_budget" name="initial_budget" placeholder="Presupuesto inicial de cada participante" value="{{ old('initial_budget', $season->initial_budget) }}">
                    </div>
                </div>
            @endif

            @if ($tournament->use_salaries)
                <div class="field-group">
                    <div class="element">
                        <label for="salary_cap">Tope salarial</label>
                        <input type="number" min="0" class="placeholder-gray-400" id="salary_cap" name="salary_cap" placeholder="Tope salarial de cada participante" value="{{ old('salary_cap', $season->salary_cap) }}">
                        <p class="block text-blue-500 text-xs pt-2">Valor máximo de la suma de los salarios de todos los jugadores de cada participante</p>
                    </div>
                    @if ($tournament->use_free_agents)
                            <div class="element">
                                <label for="free_agents_default_salary">Salario agentes libres</label>
                                <input type="number" min="0" step="any" class="placeholder-gray-400" id="free_agents_default_salary" name="free_agents_default_salary" placeholder="Salario inicial de agentes libres" value="{{ old('free_agents_default_salary', $season->free_agents_default_salary) }}">
                                <p class="block text-blue-500 text-xs pt-2">Valor por defecto del salario de agentes libres</p>
                            </div>
                            <div class="element">
                                <label for="free_agents_default_price">Precio agentes libres</label>
                                <input type="number" min="0" step="any" class="placeholder-gray-400" id="free_agents_default_price" name="free_agents_default_price" placeholder="Precio inicial de agentes libres" value="{{ old('free_agents_default_price', $season->free_agents_default_price) }}">
                                <p class="block text-blue-500 text-xs pt-2">Valor por defecto del precio de agentes libres</p>
                            </div>
                        </div>
                        <div class="field-group">
                            <div class="element">
                                <label for="free_agents_new_salary">Salario agentes libres fichados</label>
                                <input type="number" min="0" step="any" class="placeholder-gray-400" id="free_agents_new_salary" name="free_agents_new_salary" placeholder="Salario de agentes libres una vez fichados" value="{{ old('free_agents_new_salary', $season->free_agents_new_salary) }}">
                                <p class="block text-blue-500 text-xs pt-2">Valor del salario de agentes libres una vez han sido fichados</p>
                            </div>
                            <div class="element">
                                <label for="free_agents_new_price">Precio agentes libres fichados</label>
                                <input type="number" min="0" step="any" class="placeholder-gray-400" id="free_agents_new_price" name="free_agents_new_price" placeholder="Precio de agentes libres una vez fichados" value="{{ old('free_agents_new_price', $season->free_agents_new_price) }}">
                                <p class="block text-blue-500 text-xs pt-2">Valor del precio de agentes libres una vez han sido fichados</p>
                            </div>
                            <div class="element">
                                <label for="dismiss_remuneration">Remuneración por despidos</label>
                                <input type="number" min="0" step="any" class="placeholder-gray-400" id="dismiss_remuneration" name="dismiss_remuneration" placeholder="Remuneración por despidos" value="{{ old('dismiss_remuneration', $season->dismiss_remuneration) }}">
                                <p class="block text-blue-500 text-xs pt-2">Valor de la remuneración cuando un participante despide a un jugador</p>
                            </div>
                        </div>
                    @endif
            @endif

            @if ($tournament->use_clauses)
                <div class="field-group">
                    <div class="element">
                        <label for="clauses_max_paid">Máximo claúsulas pagadas permitido</label>
                        <input type="number" min="0" class="placeholder-gray-400" id="clauses_max_paid" name="clauses_max_paid" placeholder="Claúsulas pagadas máximo" value="{{ old('clauses_max_paid', $season->clauses_max_paid) }}">
                        <p class="block text-blue-500 text-xs pt-2">Número de máximo de pago de claúsulas que puede realizar un participante</p>
                    </div>
                    <div class="element">
                        <label for="clauses_max_received">Máximo claúsulas recibidas permitido</label>
                        <input type="number" min="0" class="placeholder-gray-400" id="clauses_max_received" name="clauses_max_received" placeholder="Claúsulas recibidas máximo" value="{{ old('clauses_max_received', $season->clauses_max_received) }}">
                        <p class="block text-blue-500 text-xs pt-2">Número de máximo de pago de claúsulas que puede recibir un participante</p>
                    </div>
                    <div class="element">
                        <label for="clause_tax">Impuesto por pago de claúsulas</label>
                        <input type="number" min="0" step="any" class="placeholder-gray-400" id="clause_tax" name="clause_tax" placeholder="Claúsulas recibidas máximo" value="{{ old('clause_tax', $season->clause_tax) }}">
                        <p class="block text-blue-500 text-xs pt-2">Valor del impuesto por pago de claúsulas</p>
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