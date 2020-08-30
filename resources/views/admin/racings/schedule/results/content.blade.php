{{-- <div class="antialiased font-sans flex px-4 md:px-8 pb-2"> --}}
<div class="antialiased font-sans w-full px-4 md:px-8">
    <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 pt-4 pb-2">
        @include('admin.racings.menu')
        <h3 class="font-bold uppercase text-sm mt-4 pl-2">
            {{ $race->name }} - Resultados
        </h3>

        <div class="form">
            {{-- <form id="form-add" method="GET" role="form" action="{{ route('admin.racing.schedule.races.update.results', [$tournament, $season, $competition, $phase, $group, $race->id]) }}" lang="{{ app()->getLocale() }}"> --}}
                @if ($race_results->count()>0)
                    <h3 class="font-bold uppercase text-sm mb-6 pl-2">
                        Carrera
                    </h3>
                    @foreach ($race_results as $result)
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
                        </div>
                    @endforeach
                @endif

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

        <div class="form">
            {{-- <form id="form-add" method="GET" role="form" action="{{ route('admin.racing.schedule.races.update.results', [$tournament, $season, $competition, $phase, $group, $race->id]) }}" lang="{{ app()->getLocale() }}"> --}}
                @if ($qualy_results->count()>0)
                    <h3 class="font-bold uppercase text-sm mb-6 pl-2">
                        Qualifying
                    </h3>
                    @foreach ($qualy_results as $result)
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
                        </div>
                    @endforeach
                @endif

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

        <div class="form">
            {{-- <form id="form-add" method="GET" role="form" action="{{ route('admin.racing.schedule.races.update.results', [$tournament, $season, $competition, $phase, $group, $race->id]) }}" lang="{{ app()->getLocale() }}"> --}}
                @if ($prequaly_results->count()>0)
                    <h3 class="font-bold uppercase text-sm mb-6 pl-2">
                        Pre-Qualifying
                    </h3>
                    @foreach ($prequaly_results as $result)
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
                        </div>
                    @endforeach
                @endif

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