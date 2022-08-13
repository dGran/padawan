@if ($myTeams->count() > 0)
    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8 | scrollbar-thin scrollbar-thumb-sb-thumb-color scrollbar-track-sb-track-color hover:scrollbar-thumb-sb-thumb-color-hover dark:scrollbar-thumb-sb-thumb-dt-color dark:scrollbar-track-sb-track-dt-color dark:hover:scrollbar-thumb-sb-thumb-dt-color-hover scrollbar-thumb-rounded-full">
            <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead class="border-b border-border-color dark:border-edgray-700">
                        <tr>
                            <th scope="col" class="text-sm font-medium text-title-color dark:text-dt-title-color px-4 py-2.5 text-left whitespace-nowrap">
                                Equipo
                            </th>
                            <th scope="col" class="text-sm font-medium text-title-color dark:text-dt-title-color px-4 py-2.5 text-left whitespace-nowrap">
                                Miembros
                            </th>
                            <th scope="col" class="text-sm font-medium text-title-color dark:text-dt-title-color px-4 py-2.5 text-left whitespace-nowrap">
                                Juego
                            </th>
                            <th scope="col" class="text-sm font-medium text-title-color dark:text-dt-title-color px-4 py-2.5 text-left whitespace-nowrap">
                                Localización
                            </th>
                            <th scope="col" class="text-sm font-medium text-title-color dark:text-dt-title-color px-4 py-2.5 text-left whitespace-nowrap">
                                Rango
                            </th>
                            <th scope="col" class="text-sm font-medium text-title-color dark:text-dt-title-color px-4 py-2.5 text-left whitespace-nowrap">
                                Fecha registro
                            </th>
                            <th scope="col" class="text-sm font-medium text-title-color dark:text-dt-title-color px-4 py-2.5 text-left whitespace-nowrap">
                                Acciones
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($myTeams as $myTeam)
                            <tr class="border-b border-border-color dark:border-edgray-700">
                                <td class="text-sm font-light px-4 py-2.5 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <span
                                            class="flex justify-center rounded-lg bg-gray-200 dark:bg-gray-700 | w-10 px-2 py-1 | font-mono text-xxs font-medium uppercase | border border-transparent group-hover:border-gray-300 dark:group-hover:border-gray-600">
                                            {{ $myTeam->eteam->short_name }}
                                        </span>
                                        <x-link href="{{ route('eteam', $myTeam->eteam->slug) }}" class="ml-2.5">
                                            {{ $myTeam->eteam->name }}
                                        </x-link>
                                    </div>
                                </td>
                                <td class="text-sm font-light px-4 py-2.5 whitespace-nowrap">
                                    {{ $myTeam->eteam->users->count() }}
                                </td>
                                <td class="text-sm font-light px-4 py-2.5 whitespace-nowrap">
                                    {{ $myTeam->eteam->game->name }}
                                </td>
                                <td class="text-sm font-light px-4 py-2.5 whitespace-nowrap">
                                    <div class="flex items-center">
                                        @if($myTeam->eteam->location)
                                            @if($myTeam->eteam->country)
                                                <img src="{{ $myTeam->eteam->country->getFlag24() }}" alt="{{ $myTeam->eteam->getCountryName() }}">
                                                <span class="ml-1.5">{{ $myTeam->eteam->location }},</span>
                                                <span class="ml-1">{{ $myTeam->eteam->getCountryName() }}</span>
                                            @else
                                                <span>{{ $myTeam->eteam->location }}</span>
                                            @endif
                                        @elseif($myTeam->eteam->country)
                                            <img src="{{ $myTeam->eteam->country->getFlag24() }}" alt="{{ $myTeam->eteam->getCountryName() }}">
                                            <span class="ml-1.5">{{ $myTeam->eteam->getCountryName() }}</span>
                                        @else
                                            <span class="text-text-light-color dark:text-dt-textlight-color">N/D</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="text-sm font-light px-4 py-2.5 whitespace-nowrap">
                                    <div class="flex items-center space-x-2 5">
                                        @if ($myTeam->owner || $myTeam->captain)
                                            @if ($myTeam->owner)
                                                <span class="text-xs inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-medium bg-edgray-600 text-white rounded">Propietario</span>
                                            @endif
                                            @if ($myTeam->captain)
                                                <span class="text-xs inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-medium bg-indigo-600 text-white rounded">Capitán</span>
                                            @endif
                                        @else
                                            <span>Miembro</span>
                                        @endif
                                    </div>
{{--                                    <i class="fa-solid {{ $myTeam->owner ? 'fa-check' : 'fa-xmark' }}"></i>--}}
                                </td>
                                <td class="text-sm font-light px-4 py-2.5 whitespace-nowrap">
                                    {{ $myTeam->eteam->getCreatedAtFormated() }}
                                </td>
                                <td class="text-sm font-light px-4 py-2.5 whitespace-nowrap">
                                    <div class="flex items-center space-x-1.5">
                                        <button type="button" onclick='Livewire.emit("openModal", "modals.eteams.leave-eteam-confirmation-modal", @json(['eteam' => $myTeam->eteam]))'
                                                class="w-32 inline-block px-4 py-1.5 bg-rose-600 text-white text-xxs leading-tight rounded shadow-md hover:bg-rose-700 hover:shadow-lg focus:bg-rose-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-rose-800 active:shadow-lg transition duration-150 ease-in-out">
                                            Abandonar equipo
                                        </button>
                                        @if ($myTeam->owner)
                                            <button type="button" onclick='Livewire.emit("openModal", "modals.eteams.disolve-eteam-confirmation-modal", @json(['eteam' => $myTeam->eteam]))'
                                                    class="w-32 inline-block px-4 py-1.5 text-xxs leading-tight rounded hover:text-title-color dark:hover:text-dt-title-color focus:text-title-color dark:focus:text-dt-title-color focus:outline-none transition duration-150 ease-in-out">
                                                Disolver equipo
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@else
    No perteneces a ningún equipo
@endif
