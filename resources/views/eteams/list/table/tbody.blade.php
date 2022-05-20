@foreach ($eteams as $eteam)
<tr class="group | border-t border-border-color dark:border-gray-700 | hover:bg-gray-100 dark:hover:bg-dt-darker" wire:loading.class = "opacity-75">
    <td class="py-1.5 px-3 | flex items-center space-x-1.5">
        <img src="{{ $eteam->getLogo() }}" alt="" class="w-10 h-10 rounded-full bg-white dark:bg-dt-dark object-contain p-0.5 | border border-gray-200 dark:border-gray-700">
        <x-link href="{{ route('eteams.eteam', $eteam->slug) }}" class="group-hover:underline">
            {{ $eteam->name }}
        </x-link>
    </td>
    <td class="py-1.5 px-3">
        <div class='flex items-center'>
        @if($eteam->location)            
            @if($eteam->country)
                <img src="{{ $eteam->country->getFlag24() }}" alt="{{ $eteam->getCountryName() }}">
                <span class="ml-1.5">{{ $eteam->location }},</span>
                <span class="ml-1">{{ $eteam->getCountryName() }}</span>
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
    <td class="py-1.5 px-3">
        <span>
            {{ $eteam->game->name }}
        </span>
    </td>
    <td class="w-24 | py-1.5 px-3 | text-center">
        {{ $eteam->users->count() }}
    </td>
    <td class="w-24 | py-1.5 px-3 | text-center">
        {{ $eteam->getCreatedAtFormated() }}
    </td>

</tr>
@endforeach