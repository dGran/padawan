<a class="group | bg-white dark:bg-dt-dark rounded-md p-3 | hover:bg-gray-100 dark:hover:bg-dt-light-accent | focus:bg-gray-100 dark:focus:bg-dt-light-accent | border border-border-color dark:border-gray-700" href="{{ route('eteams.eteam', $eteam->slug) }}">
    <div class="flex items-start justify-between space-x-3">
        <img src="{{ $eteam->getLogo() }}" alt="" class="w-20 h-20 lg:w-24 lg:h-24 rounded-full bg-white dark:bg-dt-dark object-cover | border border-border-color dark:border-edgray-700">
        <div class="flex-1 flex flex-col ml-3 mt-3">
            <span class="font-koulen text-lg lg:text-xl text-title-color dark:text-dt-title-color | tracking-wide | leading-5 lg:leading-6">{{ $eteam->name }}</span>
            <p class="mt-1 | flex items-center space-x-2">
                <span class="flex justify-center rounded-md bg-gray-200 dark:bg-gray-700 | w-10 px-1.5 py-0.5 | font-mono text-xxs font-medium uppercase | border border-transparent group-hover:border-gray-300 dark:group-hover:border-gray-600">
                    {{ $eteam->short_name }}
                </span>
                <span class="text-xs lg:text-sm">{{ $eteam->game->name }}</span>
            </p>
        </div>
        <div class="flex flex-col justify-between h-20 lg:h-24">
            <div class="flex flex-col items-center">
                @if ($eteam->country)
                    <img src="{{ $eteam->country->getFlag24() }}" alt="{{ $eteam->getCountryName() }}" title="{{ $eteam->getCountryName() }}" class="">
                    <span class="text-xxxs | mt-1 | uppercase">{{ $eteam->country->alpha_3 }}</span>
                @else
                    <span class="text-xxxs | mt-1 | uppercase">N/D</span>
                @endif
            </div>
            <div class="group-hover:border-gray-200 dark:group-hover:border-edgray-675">

                <p class="flex items-center">
                    <i class="icon-users text-base"></i><span class="ml-2 text-sm">{{ $eteam->users()->count() }}</span>
                </p>
            </div>
        </div>
    </div>
</a>