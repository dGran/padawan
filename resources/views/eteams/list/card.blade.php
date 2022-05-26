<div class="my-4 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-3 md:gap-6">
    @foreach ($eteams as $eteam)
        <a class="group | bg-white dark:bg-dt-dark rounded-md p-4 | hover:bg-gray-100 dark:hover:bg-dt-light-accent | focus:bg-gray-100 dark:focus:bg-dt-light-accent" href="{{ route('eteams.eteam', $eteam->slug) }}">
            <div class="flex items-start justify-between">
                <img src="{{ $eteam->getLogo() }}" alt="" class="w-24 h-24 rounded-full bg-white object-contain p-0.5 | border border-gray-200 dark:border-edgray-600">
                <div class="flex-1 flex flex-col ml-3 mt-0.5">
                    <p class="font-semibold text-normal uppercase text-title-color dark:text-dt-title-color">
                        {{ $eteam->name }}
                    </p>
                    <p class="text-xs mt-1.5">
                        {{ $eteam->location }}
                    </p>
                    @if ($eteam->country)
                        <p class="text-xs flex items-center">
                            {{ $eteam->getCountryName() }}
                        </p>
                    @endif
                    <p class="text-xxs mt-1.5">
                        {{ $eteam->posts()->count() }} {{ $eteam->posts()->count() == 1 ? 'noticia' : 'noticias' }}
                    </p>
                </div>
                @if ($eteam->country)
                    <div class="flex flex-col items-center">
                        <img src="{{ $eteam->country->getFlag24() }}" alt="{{ $eteam->getCountryName() }}" title="{{ $eteam->getCountryName() }}" class="">
                        <span class="text-xxxs | mt-1 | uppercase">{{ $eteam->country->alpha_3 }}</span>
                    </div>
                @endif
            </div>
            <div class="border-t border-border-color dark:border-dt-border-color | group-hover:border-gray-200 dark:group-hover:border-edgray-675 | mt-3 pt-3 | flex items-center justify-between">
                {{ $eteam->game->name }}
                <p class="flex items-center">
                    <i class="icon-users text-base"></i><span class="ml-2 text-sm">{{ $eteam->users()->count() }}</span>
                </p>
            </div>
        </a>
    @endforeach
</div>