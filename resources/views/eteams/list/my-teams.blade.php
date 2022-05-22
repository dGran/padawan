@auth
    <h4 class="mt-6 md:mt-10 | font-semibold | font-fjalla | text-lg md:text-xl | tracking-wider | text-title-color dark:text-dt-title-color">Mis Equipos</h4>
        @if ($my_eteams->count() > 0)
            <section class="mt-4 mb-6 md:mt-6 md:mb-8 | w-full overflow-x-auto | scrollbar-thin scrollbar-thumb-sb-thumb-color scrollbar-track-sb-track-color hover:scrollbar-thumb-sb-thumb-color-hover dark:scrollbar-thumb-sb-thumb-dt-color dark:scrollbar-track-sb-track-dt-color dark:hover:scrollbar-thumb-sb-thumb-dt-color-hover scrollbar-thumb-rounded-full">
                <div class="flex items-start space-x-4">
                    @foreach ($my_eteams as $eteam)
                        <a class="group | w-52 | bg-white dark:bg-dt-dark rounded-md p-4 | hover:bg-gray-100 dark:hover:bg-dt-light-accent | focus:bg-gray-100 dark:focus:bg-dt-light-accent" href="{{ route('eteams.eteam', $eteam->slug) }}" style="min-width: 15rem;">
                            <img src="{{ $eteam->getLogo() }}" alt="" class="w-24 h-24 rounded-full bg-white object-contain p-0.5 | border border-gray-200 dark:border-edgray-600 | mx-auto">
                            <div class="border-t border-border-color dark:border-dt-border-color | group-hover:border-gray-200 dark:group-hover:border-edgray-675 | mt-3 pt-3 | flex flex-col">
                                <p class="font-semibold text-xs md:text-sm uppercase text-title-color dark:text-dt-title-color | truncate | text-center">
                                    {{ $eteam->name }}
                                </p>
                                <p class="text-xxs md:text-xs | text-center">
                                    {{ $eteam->game->name }}
                                </p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </section>
        @else
            <div class="pt-1.5">
                <span>No perteneces a ningún equipo,</span>
                <x-link href="{{ route('eteams.create') }}">registra tu equipo e-sport!</x-link>
            </div>
        @endif
@endauth