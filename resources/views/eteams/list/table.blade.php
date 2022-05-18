<div class="my-4 | rounded border border-border-color dark:border-gray-700 | text-sm">
    @if ($eteams->count() > 0)
        <table class="bg-white dark:bg-dt-dark | w-full | rounded">
            <thead>
                <th class="text-left py-2.5 px-3">Equipo</th>
                <th class="text-left py-2.5 px-3">Localización</th>
                <th class="text-left py-2.5 px-3">Juego</th>
                <th class="w-24 | text-center py-2.5 px-3">Miembros</th>
                <th class="w-48 | text-center py-2.5 px-3">Fecha registro</th>
            </thead>
            <tbody>
                @foreach ($eteams as $eteam)
                    <tr class="group | border-t border-border-color dark:border-gray-700 | hover:bg-gray-100 dark:hover:bg-dt-darker" wire:loading.class = "opacity-75">
                        <td class="py-1.5 px-3 | flex items-center space-x-1.5">
                            <img src="{{ $eteam->getLogo() }}" alt="" class="w-9 h-9 rounded-full bg-white dark:bg-dt-dark object-contain p-0.5 | border border-gray-200 dark:border-gray-700">
                            <x-link href="{{ route('eteams.eteam', $eteam->slug) }}" class="group-hover:underline">
                                {{ $eteam->name }}
                            </x-link>
                        </td>
                        <td class="py-1.5 px-3">
                            @if ($eteam->location)
                                <span>{{ $eteam->location }}</span>
                                @if ($eteam->country)
                                    <p class="text-xs flex items-center">
                                        <span>, {{ $eteam->getCountryName() }}</span>
                                    </p>
                                @endif
                            @else
                                @if ($eteam->country)
                                    <span>{{ $eteam->getCountryName() }}</span>
                                @endif
                            @endif
                        </td>
                        <td class="py-1.5 px-3">
                            <span wire:loading.delay.longest>
                                nombre
                            </span>
                            <span wire:loading.remove>
                                {{ $eteam->game->name }}
                            </span>
                        </td>
                        <td class="w-24 | py-1.5 px-3 | text-center">
                            {{ $eteam->users->count() }}
                        </td>
                        <td class="w-24 | py-1.5 px-3 | text-center">
                            {{ $eteam->created_at }}
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="bg-white dark:bg-dt-dark rounded | py-6 px-4 | text-center">No se han encontrado equipos</p>
    @endif

</div>