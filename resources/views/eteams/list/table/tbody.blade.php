@foreach ($eteams as $eteam)
    <tr class="group | border-t border-border-color dark:border-gray-700 | hover:bg-gray-100 dark:hover:bg-dt-light-accent"
        wire:loading.class="opacity-75">
        <td>
            <div class="flex items-center">
                <figure class="hidden sm:flex justify-center w-10 mr-2.5">
                    <img src="{{ $eteam->getLogo() }}" alt="" class="w-9 h-9 | rounded-full | object-cover">
                </figure>
                <span
                    class="flex justify-center rounded-lg bg-gray-200 dark:bg-gray-700 | w-10 px-2 py-1 | font-mono text-xxs font-medium uppercase | border border-transparent group-hover:border-gray-300 dark:group-hover:border-gray-600">
                    {{ $eteam->short_name }}
                </span>
                <a href="{{ route('eteams.eteam', $eteam->slug) }}" class="group-hover:underline | ml-2.5 truncate">
                    <span class="truncate">{{ $eteam->name }}</span>
                </a>
            </div>
        </td>
        <td class="members">
            {{ $eteam->users_count }}
        </td>
        <td>
        <span>
            {{ $eteam->game->name }}
        </span>
        </td>
        <td class="location">
            <div class='flex items-center truncate'>
                @if($eteam->location)
                    @if($eteam->country)
                        <img src="{{ $eteam->country->getFlag24() }}" alt="{{ $eteam->getCountryName() }}">
                        <span class="ml-1.5">{{ $eteam->location }},</span>
                        <span class="truncate ml-1">{{ $eteam->getCountryName() }}</span>
                    @else
                        <span>{{ $eteam->location }}</span>
                    @endif
                @elseif($eteam->country)
                    <img src="{{ $eteam->country->getFlag24() }}" alt="{{ $eteam->getCountryName() }}">
                    <span class="ml-1.5">{{ $eteam->getCountryName() }}</span>
                @else
                    <span class="text-text-light-color dark:text-dt-textlight-color">N/D</span>
                @endif
            </div>
        </td>
        <td class="date">
            {{ $eteam->getCreatedAtFormated() }}
        </td>
    </tr>
@endforeach
