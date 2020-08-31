<div class="antialiased font-sans w-full px-4 md:px-8">
    <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 pt-4 pb-2">
        @include('admin.racings.menu')
        <h3 class="font-bold uppercase text-sm mt-4 pl-2">
            {{ $race->name }} - Resultados
        </h3>

        <div class="flex flex-wrap" id="tabs-id">
            <div class="w-full">
                <ul class="flex mb-0 list-none flex-wrap pt-3 pb-4 flex-row">
                    <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">
                        <a class="text-xs font-bold uppercase px-5 py-3 shadow-lg rounded block leading-normal text-white bg-teal-500" onclick="changeAtiveTab(event,'tab-race')">
                            Carrera
                        </a>
                    </li>
                    <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">
                        <a class="text-xs font-bold uppercase px-5 py-3 shadow-lg rounded block leading-normal text-teal-500 bg-white" onclick="changeAtiveTab(event,'tab-qualy')">
                            Qualy
                        </a>
                    </li>
                    <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">
                        <a class="text-xs font-bold uppercase px-5 py-3 shadow-lg rounded block leading-normal text-teal-500 bg-white" onclick="changeAtiveTab(event,'tab-prequaly')">
                            Pre-Qualy
                        </a>
                    </li>
                </ul>
                <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded">
                    <div class="flex-auto">
                        <div class="tab-content tab-space">

                            <div class="block" id="tab-race">
                                <div class="overflow-x-auto pt-5">
                                    @if ($race_results->count()>0)
                                        @foreach ($race_results as $result)
                                            <div class="block md:hidden mb-2 flex flex-row items-center">
                                                <img src="{{ $result->group_participant->participant->presenter()['img'] }}" alt="" class="w-8 inline-block mr-2">
                                                <span>{{ $result->group_participant->participant->presenter()['name'] }}</span>
                                            </div>
                                            <div class="flex flex-row items-center pb-4 mb-4 border-b px-4 pb-5 ">
                                                <div class="flex-initial hidden md:block w-48 mr-5 truncate">
                                                    <img src="{{ $result->group_participant->participant->presenter()['img'] }}" alt="" class="w-10 hidden md:inline-block mr-2">
                                                    <span>{{ $result->group_participant->participant->presenter()['name'] }}</span>
                                                </div>
                                                <div class="flex-initial mr-5">
                                                    <input type="number" class="position w-16" id="position{{ $result->id }}" min="1" placeholder="Posición" class="w-24" autofocus value="{{ $result->position }}" onchange="update_result('{{ $result->id }}')">
                                                </div>
                                                @if ($race->racing->times)
                                                    <div class="flex-initial mr-5">
                                                        <input type="time" class="time" id="time{{ $result->id }}" placeholder="Tiempo" class="w-24" value="{{ $result->time }}" onchange="update_result('{{ $result->id }}')">
                                                    </div>
                                                @endif
                                                @if ($race->racing->fastest_lap)
                                                    <div class="flex-initial mr-5">
                                                        <input type="time" class="fastest_lap" id="fastest_lap{{ $result->id }}" placeholder="Vuelta rápida" class="w-24" value="{{ $result->fastest_lap }}" onchange="update_result('{{ $result->id }}')">
                                                    </div>
                                                @endif
                                                <div class="flex-initial mr-5">
                                                    <input type="number" class="sanction w-16" id="sanction{{ $result->id }}" placeholder="Tiempo" class="w-24" value="{{ $result->sanction }}" onchange="update_result('{{ $result->id }}')">
                                                </div>
                                                <div class="flex-initial mr-5">
                                                    <select name="state">
                                                        <option value="">Carrera disputada</option>
                                                        <option value="">No presentado</option>
                                                        <option value="">Retirado</option>
                                                        <option value="">Descalificado</option>
                                                    </select>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                    <div class="px-4 pb-4">
                                        <a href="{{ route('admin.racing.schedule', [$tournament, $season, $competition, $phase, $group]) }}" class="bg-gray-500 text-white active:bg-gray-600 focus:bg-gray-600 hover:bg-gray-600 font-bold uppercase text-sm px-5 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none" style="transition: all .15s ease">
                                            Volver
                                        </a>
                                        <button class="bg-transparent text-red-500 active:text-red-600 focus:text-red-600 hover:text-red-600 font-bold uppercase text-sm px-4 py-3 rounded outline-none focus:outline-none ml-2" style="transition: all .15s ease" type="button" onclick="reset('{{ $race->id }}')">
                                            Resetear
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="hidden" id="tab-qualy">
                                <div class="overflow-x-auto">
                                    @if ($qualy_results->count()>0)
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
                                                @if ($race->racing->times)
                                                    <div class="flex-initial mr-5">
                                                        <input type="time" class="time" id="time{{ $result->id }}" placeholder="Tiempo" class="w-24" value="{{ $result->time }}" onblur="update_result('{{ $result->id }}')">
                                                    </div>
                                                @endif
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
                                </div>
                            </div> {{-- tab-qualy --}}

                            <div class="hidden" id="tab-prequaly">
                                <div class="overflow-x-auto">
                                    @if ($prequaly_results->count()>0)
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
                                                @if ($race->racing->times)
                                                    <div class="flex-initial mr-5">
                                                        <input type="time" class="time" id="time{{ $result->id }}" placeholder="Tiempo" class="w-24" value="{{ $result->time }}" onblur="update_result('{{ $result->id }}')">
                                                    </div>
                                                @endif
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
                                </div>
                            </div> {{-- tab-prequaly --}}

                        </div> {{-- tab-content --}}
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            function changeAtiveTab(event,tabID){
                let element = event.target;
                while(element.nodeName !== "A"){
                    element = element.parentNode;
                }
                ulElement = element.parentNode.parentNode;
                aElements = ulElement.querySelectorAll("li > a");
                tabContents = document.getElementById("tabs-id").querySelectorAll(".tab-content > div");
                for(let i = 0 ; i < aElements.length; i++){
                    aElements[i].classList.remove("text-white");
                    aElements[i].classList.remove("bg-teal-500");
                    aElements[i].classList.add("text-teal-500");
                    aElements[i].classList.add("bg-white");
                    tabContents[i].classList.add("hidden");
                    tabContents[i].classList.remove("block");
                }
                element.classList.remove("text-teal-500");
                element.classList.remove("bg-white");
                element.classList.add("text-white");
                element.classList.add("bg-teal-500");
                document.getElementById(tabID).classList.remove("hidden");
                document.getElementById(tabID).classList.add("block");
            }
        </script>

    </div>
</div>