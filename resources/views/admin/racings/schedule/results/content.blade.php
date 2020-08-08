{{-- <div class="antialiased font-sans flex px-4 md:px-8 pb-2"> --}}
<div class="antialiased font-sans w-full px-4 md:px-8">
    <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 pt-4 pb-2">
        @include('admin.racings.menu')
        <h3 class="font-bold uppercase text-sm mt-4 pl-2">
            {{ $race->name }} - Resultados
        </h3>
        <div class="form">
            {{-- <form id="form-add" method="GET" role="form" action="{{ route('admin.racing.schedule.races.update.results', [$tournament, $season, $competition, $phase, $group, $race->id]) }}" lang="{{ app()->getLocale() }}"> --}}

                @foreach ($results as $result)
                    @if ($result->position > 0)
                        <div class="block md:hidden mb-2 flex flex-row items-center">
                            <img src="{{ $result->group_participant->participant->presenter()['img'] }}" alt="" class="w-8 inline-block mr-2">
                            <span>{{ $result->group_participant->participant->presenter()['name'] }}</span>
                        </div>
                        <div class="flex flex-row items-center pb-4 mb-4 border-b">
                            <div class="flex-initial hidden md:block w-48 mr-5 truncate">
                                <img src="{{ $result->group_participant->participant->presenter()['img'] }}" alt="" class="w-10 hidden md:inline-block mr-2">
                                <span>{{ $result->group_participant->participant->presenter()['name'] }}</span>
                            </div>
                            <div class="flex-initial mr-5">
                                <input type="number" class="position" id="position{{ $result->id }}" min="1" placeholder="Posición" class="w-24" autofocus value="{{ $result->position }}" onblur="update_result('{{ $result->id }}')">
                            </div>
                            <div class="flex-initial mr-5">
                                <label class="custom-label flex">
                                      <div class="bg-white border border-gray-400 rounded w-6 h-6 p-1 flex justify-center items-center mr-2">
                                        <input type="checkbox" class="fastest_lap hidden" id="fastest_lap{{ $result->id }}" {{ $result->fastest_lap || old('lastest_lap') == "on" ? 'checked' : '' }} onchange="update_result('{{ $result->id }}')">
                                        <svg class="hidden w-4 h-4 text-green-600 pointer-events-none" viewBox="0 0 172 172"><g fill="none" stroke-width="none" stroke-miterlimit="10" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode:normal"><path d="M0 172V0h172v172z"/><path d="M145.433 37.933L64.5 118.8658 33.7337 88.0996l-10.134 10.1341L64.5 139.1341l91.067-91.067z" fill="currentColor" stroke-width="1"/></g></svg>
                                      </div>
                                      <span class="select-none"> VR</span>
                                </label>
                            </div>
                            <div class="flex-initial">
                                <label class="custom-label flex">
                                      <div class="bg-white border border-gray-400 rounded w-6 h-6 p-1 flex justify-center items-center mr-2">
                                        <input type="checkbox" class="pole hidden" id="pole{{ $result->id }}" {{ $result->pole || old('pole') == "on" ? 'checked' : '' }} onchange="update_result('{{ $result->id }}')">
                                        <svg class="hidden w-4 h-4 text-green-600 pointer-events-none" viewBox="0 0 172 172"><g fill="none" stroke-width="none" stroke-miterlimit="10" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode:normal"><path d="M0 172V0h172v172z"/><path d="M145.433 37.933L64.5 118.8658 33.7337 88.0996l-10.134 10.1341L64.5 139.1341l91.067-91.067z" fill="currentColor" stroke-width="1"/></g></svg>
                                      </div>
                                      <span class="select-none"> Pole</span>
                                </label>
                            </div>
                        </div>
                    @endif
                @endforeach

                @foreach ($results as $result)
                    @if ($result->position == 0)
                        <div class="block md:hidden mb-2 flex flex-row items-center">
                            <img src="{{ $result->group_participant->participant->presenter()['img'] }}" alt="" class="w-8 inline-block mr-2">
                            <span>{{ $result->group_participant->participant->presenter()['name'] }}</span>
                        </div>
                        <div class="flex flex-row items-center pb-4 mb-4 border-b">
                            <div class="flex-initial hidden md:block w-48 mr-5 truncate">
                                <img src="{{ $result->group_participant->participant->presenter()['img'] }}" alt="" class="w-10 hidden md:inline-block mr-2">
                                <span>{{ $result->group_participant->participant->presenter()['name'] }}</span>
                            </div>
                            <div class="flex-initial mr-5">
                                <input type="number" class="position" id="position{{ $result->id }}" min="1" placeholder="Posición" class="w-24" autofocus value="{{ $result->position }}" onblur="update_result('{{ $result->id }}')">
                            </div>
                            <div class="flex-initial mr-5">
                                <label class="custom-label flex">
                                      <div class="bg-white border border-gray-400 rounded w-6 h-6 p-1 flex justify-center items-center mr-2">
                                        <input type="checkbox" class="fastest_lap hidden" id="fastest_lap{{ $result->id }}" {{ $result->fastest_lap || old('lastest_lap') == "on" ? 'checked' : '' }} onchange="update_result('{{ $result->id }}')">
                                        <svg class="hidden w-4 h-4 text-green-600 pointer-events-none" viewBox="0 0 172 172"><g fill="none" stroke-width="none" stroke-miterlimit="10" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode:normal"><path d="M0 172V0h172v172z"/><path d="M145.433 37.933L64.5 118.8658 33.7337 88.0996l-10.134 10.1341L64.5 139.1341l91.067-91.067z" fill="currentColor" stroke-width="1"/></g></svg>
                                      </div>
                                      <span class="select-none"> VR</span>
                                </label>
                            </div>
                            <div class="flex-initial">
                                <label class="custom-label flex">
                                      <div class="bg-white border border-gray-400 rounded w-6 h-6 p-1 flex justify-center items-center mr-2">
                                        <input type="checkbox" class="pole hidden" id="pole{{ $result->id }}" {{ $result->pole || old('pole') == "on" ? 'checked' : '' }} onchange="update_result('{{ $result->id }}')">
                                        <svg class="hidden w-4 h-4 text-green-600 pointer-events-none" viewBox="0 0 172 172"><g fill="none" stroke-width="none" stroke-miterlimit="10" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode:normal"><path d="M0 172V0h172v172z"/><path d="M145.433 37.933L64.5 118.8658 33.7337 88.0996l-10.134 10.1341L64.5 139.1341l91.067-91.067z" fill="currentColor" stroke-width="1"/></g></svg>
                                      </div>
                                      <span class="select-none"> Pole</span>
                                </label>
                            </div>
                        </div>
                    @endif
                @endforeach

                <div class="pt-4">
                    <a href="{{ route('admin.racing.schedule', [$tournament, $season, $competition, $phase, $group]) }}" class="bg-gray-500 text-white active:bg-gray-600 focus:bg-gray-600 hover:bg-gray-600 font-bold uppercase text-sm px-5 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none" style="transition: all .15s ease">
                        Volver
                    </a>
                    <button class="bg-transparent text-red-500 active:text-red-600 focus:text-red-600 hover:text-red-600 font-bold uppercase text-sm px-4 py-3 rounded outline-none focus:outline-none ml-2" style="transition: all .15s ease" type="button" onclick="reset('{{ $race->id }}')">
                        Resetear
                    </button>
                </div>

            {{-- </form> --}}
        </div>
    </div>
</div>