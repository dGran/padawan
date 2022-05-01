<div class="my-4 | rounded border border-border-color dark:border-gray-700 | text-sm">
    <table class="bg-white dark:bg-dt-dark | w-full | rounded">
        <thead>
            <th class="text-left py-2.5 px-3">Equipo</th>
            <th class="text-left py-2.5 px-3">Localización</th>
            <th class="text-left py-2.5 px-3">Juego</th>
            <th class="w-24 | text-center py-2.5 px-3">Miembros</th>
        </thead>
        <tbody>
            @foreach ($eteams as $eteam)
                <tr class="group | border-t border-border-color dark:border-gray-700 | hover:bg-gray-100 dark:hover:bg-dt-darker">
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
                        {{ $eteam->game->name }}
                    </td>
                    <td class="w-24 | py-1.5 px-3 | text-center">
                        {{ $eteam->users()->count() }}
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>

</div>