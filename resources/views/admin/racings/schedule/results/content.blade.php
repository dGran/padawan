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
                    <li class="-mb-px last:mr-0 flex-auto text-center">
                        <a class="text-xs font-bold uppercase px-5 py-3 shadow-lg rounded block leading-normal text-teal-500 bg-white" onclick="changeAtiveTab(event,'tab-prequaly')">
                            Pre-Qualy
                        </a>
                    </li>
                </ul>

                <div class="relative flex flex-col min-w-0 break-words w-full mb-6">
                    <div class="flex-auto">
                        <div class="tab-content tab-space">

                            <div class="block overflow-x-auto" id="tab-race">
                                @if ($race_results->count()>0)
                                    <div class="table-wrap">
                                        <table class="admin-tables">

                                            <thead>
                                                <th class="text-left">Participante</th>
                                                <th>Posición</th>
                                                @if ($race->racing->times)
                                                    <th class="text-left">Tiempo</th>
                                                @endif
                                                @if ($race->racing->fastest_lap)
                                                    <th class="text-left">Vuelta Rápida</th>
                                                @endif
                                                <th>Sanción</th>
                                                <th class="text-left">Estado</th>
                                            </thead>

                                            <tbody>
                                                @foreach ($race_results as $result)
                                                    <tr class="border-t">
                                                        <td class="truncate" style="min-width: 12rem">
                                                            <img src="{{ $result->group_participant->participant->presenter()['img'] }}" alt="" class="rounded-full h-10 w-10 object-cover shadow hidden lg:inline-block mr-2">
                                                            <span>{{ $result->group_participant->participant->presenter()['name'] }}</span>
                                                        </td>
                                                        <td class="">
                                                            <input type="number" class="position w-16 m-auto" id="position{{ $result->id }}" min="1" value="{{ $result->position }}" onBlur="update_result('{{ $result->id }}')">
                                                        </td>
                                                        @if ($race->racing->times)
                                                            <td class="">
                                                                <input type="time" class="time" id="time{{ $result->id }}" placeholder="Tiempo" step="0.001" value="{{ $result->time }}" onBlur="update_result('{{ $result->id }}')">
                                                            </td>
                                                        @endif
                                                        @if ($race->racing->fastest_lap)
                                                            <td class="flex-initial mr-5">
                                                                <input type="time" class="fastest_lap" id="fastest_lap{{ $result->id }}" placeholder="Vuelta rápida" step="0.001" value="{{ $result->fastest_lap }}" onBlur="update_result('{{ $result->id }}')">
                                                            </td>
                                                        @endif
                                                        <td class="">
                                                            <input type="number" class="sanction w-16 m-auto" id="sanction{{ $result->id }}" value="{{ $result->sanction }}" min="0" onBlur="update_result('{{ $result->id }}')">
                                                        </td>
                                                        <td style="min-width: 11rem">
                                                            <div class="relative">
                                                                <select class="state w-full" id="state{{ $result->id }}" onChange="update_result('{{ $result->id }}')">
                                                                    <option {{ $result->position > 0 ? 'selected' : 'disabled' }} value="finished">Carrera finalizada</option>
                                                                    <option {{ $result->position > 0 ? 'disabled' : '' }} {{ $result->state == 'not_shown' ? 'selected' : '' }} value="not_shown">No participa</option>
                                                                    <option {{ $result->position > 0 ? 'disabled' : '' }} {{ $result->state == 'retired' ? 'selected' : '' }} value="retired">Retirado</option>
                                                                    <option {{ $result->position > 0 ? 'disabled' : '' }} {{ $result->state == 'disqualified' ? 'selected' : '' }} value="disqualified">Descalificado</option>
                                                                </select>
                                                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                                                    </svg>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>

                                        </table>
                                    </div> {{-- table-wrap --}}

                                @endif

                            </div> {{-- tab-race --}}

                            <div class="hidden" id="tab-qualy">
                                @if ($qualy_results->count()>0)
                                    <div class="table-wrap not-w-full">
                                        <table class="admin-tables">

                                            <thead>
                                                <th class="text-left">Participante</th>
                                                <th>Posición</th>
                                                @if ($race->racing->times)
                                                    <th class="text-left">Tiempo</th>
                                                @endif
                                            </thead>

                                            <tbody>
                                                @foreach ($qualy_results as $result)
                                                    <tr class="border-t">
                                                        <td class="truncate" style="min-width: 12rem">
                                                            <img src="{{ $result->group_participant->participant->presenter()['img'] }}" alt="" class="rounded-full h-10 w-10 object-cover shadow hidden lg:inline-block mr-2">
                                                            <span>{{ $result->group_participant->participant->presenter()['name'] }}</span>
                                                        </td>
                                                        <td class="">
                                                            <input type="number" class="position w-16 m-auto" id="position{{ $result->id }}" min="1" value="{{ $result->position }}" onBlur="update_result('{{ $result->id }}')">
                                                        </td>
                                                        @if ($race->racing->times)
                                                            <td class="">
                                                                <input type="time" class="time" id="time{{ $result->id }}" placeholder="Tiempo" step="0.001" value="{{ $result->time }}" onBlur="update_result('{{ $result->id }}')">
                                                            </td>
                                                        @endif
                                                    </tr>
                                                @endforeach
                                            </tbody>

                                        </table>
                                    </div> {{-- table-wrap --}}

                                @endif
                            </div> {{-- tab-qualy --}}

                            <div class="hidden" id="tab-prequaly">
                                @if ($prequaly_results->count()>0)
                                    <div class="table-wrap not-w-full">
                                        <table class="admin-tables">

                                            <thead>
                                                <th class="text-left">Participante</th>
                                                <th>Posición</th>
                                                @if ($race->racing->times)
                                                    <th class="text-left">Tiempo</th>
                                                @endif
                                            </thead>

                                            <tbody>
                                                @foreach ($prequaly_results as $result)
                                                    <tr class="border-t">
                                                        <td class="truncate" style="min-width: 12rem">
                                                            <img src="{{ $result->group_participant->participant->presenter()['img'] }}" alt="" class="rounded-full h-10 w-10 object-cover shadow hidden lg:inline-block mr-2">
                                                            <span>{{ $result->group_participant->participant->presenter()['name'] }}</span>
                                                        </td>
                                                        <td class="">
                                                            <input type="number" class="position w-16 m-auto" id="position{{ $result->id }}" min="1" value="{{ $result->position }}" onBlur="update_result('{{ $result->id }}')">
                                                        </td>
                                                        @if ($race->racing->times)
                                                            <td class="">
                                                                <input type="time" class="time" id="time{{ $result->id }}" placeholder="Tiempo" step="0.001" value="{{ $result->time }}" onBlur="update_result('{{ $result->id }}')">
                                                            </td>
                                                        @endif
                                                    </tr>
                                                @endforeach
                                            </tbody>

                                        </table>
                                    </div> {{-- table-wrap --}}

                                @endif
                            </div> {{-- tab-prequaly --}}

                            <div class="mt-3">
                                <button class="bg-red-500 text-white active:bg-red-600 focus:bg-red-600 hover:bg-red-600 font-bold uppercase text-xs px-3 py-2 rounded outline-none focus:outline-none" style="transition: all .15s ease" type="button" onclick="reset('{{ $race->id }}')">
                                    Resetear todos los resultados
                                </button>
                            </div>

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