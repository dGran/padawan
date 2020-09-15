<div class="antialiased font-sans w-full px-4 md:px-8">
    <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 pt-4 pb-2">
        @include('admin.racings.menu')
        <h3 class="font-bold uppercase text-sm mt-4 pl-2">
            Nueva carrera
        </h3>
        <div class="form">
            <form id="form-add" method="POST" role="form" action="{{ route('admin.racing.schedule.races.add', [$tournament, $season, $competition, $phase, $group]) }}" lang="{{ app()->getLocale() }}">
                @csrf

                <div class="field-group">
                    <div class="element">
                        <label for="name">*Nombre</label>
                        <input type="text" class="placeholder-gray-400" id="name" name="name" placeholder="Nombre" autofocus value="{{ old('name') }}">
                    </div>
                    <div class="element">
                        <label for="short_name">Nombre corto</label>
                        <input type="text" class="placeholder-gray-400" id="short_name" name="short_name" maxlength="3" placeholder="Nombre corto" value="{{ old('short_name') }}">
                    </div>
                </div>

                <div class="field-group">
                    <div class="element">
                        <label for="circuit_id">Circuito</label>
                        <div class="relative">
                            <select name="circuit_id" id="circuit_id">
                                @foreach ($circuits as $circuit)
                                    <option value="{{ $circuit->id }}">{{ $circuit->name }}</option>
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
                        <label for="laps">Vueltas</label>
                        <input type="number" min="1" class="placeholder-gray-400" id="laps" name="laps" placeholder="Vueltas" value="{{ old('laps', 1) }}">
                    </div>
                    <div class="element">
                        <label for="date">Fecha</label>
                        <input type="datetime-local" class="placeholder-gray-400" id="date" name="date" placeholder="Fecha de carrera" value="{{ old('date', \Carbon\Carbon::parse(now())->format('Y-m-d\TH:i')) }}">
                    </div>
                </div>

                @if ($group->racing->pre_qualifying)
                    <label class="custom-label flex pb-2">
                          <div class="bg-white border border-gray-400 rounded w-6 h-6 p-1 flex justify-center items-center mr-2">
                            <input type="checkbox" class="hidden" id="pre_qualifying" name="pre_qualifying" {{ $group->racing->pre_qualifying || old('pre_qualifying') == "on" ? 'checked' : '' }}>
                            <svg class="hidden w-4 h-4 text-green-600 pointer-events-none" viewBox="0 0 172 172"><g fill="none" stroke-width="none" stroke-miterlimit="10" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode:normal"><path d="M0 172V0h172v172z"/><path d="M145.433 37.933L64.5 118.8658 33.7337 88.0996l-10.134 10.1341L64.5 139.1341l91.067-91.067z" fill="currentColor" stroke-width="1"/></g></svg>
                          </div>
                          <span class="select-none"> Pre-qualifying</span>
                    </label>
                @endif

                @if ($group->racing->qualifying)
                    <label class="custom-label flex pb-2">
                          <div class="bg-white border border-gray-400 rounded w-6 h-6 p-1 flex justify-center items-center mr-2">
                            <input type="checkbox" class="hidden" id="qualifying" name="qualifying" {{ $group->racing->qualifying || old('qualifying') == "on" ? 'checked' : '' }}>
                            <svg class="hidden w-4 h-4 text-green-600 pointer-events-none" viewBox="0 0 172 172"><g fill="none" stroke-width="none" stroke-miterlimit="10" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode:normal"><path d="M0 172V0h172v172z"/><path d="M145.433 37.933L64.5 118.8658 33.7337 88.0996l-10.134 10.1341L64.5 139.1341l91.067-91.067z" fill="currentColor" stroke-width="1"/></g></svg>
                          </div>
                          <span class="select-none"> Qualifying</span>
                    </label>
                @endif

                <div class="pt-4">
                    <button type="submit" class="bg-green-500 text-white active:bg-green-600 focus:bg-green-600 hover:bg-green-600 font-bold uppercase text-sm px-5 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none" style="transition: all .15s ease">
                        Guardar
                    </button>
                    <a href="{{ route('admin.racing.schedule', [$tournament, $season, $competition, $phase, $group]) }}" class="bg-transparent text-red-500 active:text-red-600 focus:text-red-600 hover:text-red-600 font-bold uppercase text-sm px-4 py-3 rounded outline-none focus:outline-none ml-2" style="transition: all .15s ease">
                        Cancelar
                    </a>
                </div>

            </form>
        </div>
    </div>
</div>