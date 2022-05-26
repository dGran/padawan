@if (Auth::guest() || (Auth::user() && $my_eteams->count() == 0))
    <div class="relative">
        <div class="banner-landing bg-indigo-700 dark:bg-indigo-900 relative overflow-hidden">
            <x-container class="py-6 md:py-10 text-white">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-16 gap-y-12">
                    <div class="flex flex-col justify-center text-center px-6 md:text-left md:px-0">
                        <p class="text-2xl md:text-3xl | font-raleway font-extrabold">
                            Registra tu equipo
                        </p>
{{-- 	                    <p class="text-lg md:text-xl | font-raleway font-bold | text-edyellow-300 | pt-2">
                            de los juegos que ofrecemos
                        </p> --}}
                            <p class="text-2xl md:text-3xl | font-raleway font-extrabold | pt-2">
                            y participa en los torneos y campeonatos
                        </p>
                        <p class="text-teal-200 | text-normal md:text-base | pt-6">
                            Tendrás acceso a un control de usuarios, panel de noticias privado, buscar nuevos miembros... para participar en los torneos de Padawan e-sports
                        </p>
                    </div>

                    <div class="hidden sm:block">
                        <div class="flex flex-col justify-center items-center gap-8 h-full">
                            <img src="https://www.nicepng.com/png/full/177-1775206_hw-race-team-hot-wheels-hw-race-team.png" alt="Padawan e-sports" class="w-32 md:w-48">
{{--                             <i class="icon-fifa text-4xl"></i>
                            <i class="icon-efootball text-4xl"></i>
                            <i class="icon-gtracing text-5xl"></i> --}}
                            </ul>
                        </div>
                    </div>
                </div>
            </x-container>
        </div>
    </div>
@endif