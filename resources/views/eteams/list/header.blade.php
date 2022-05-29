{{-- @if (Auth::guest()) --}}
    <div class="relative">
        <div class="banner-landing bg-indigo-700 dark:bg-indigo-900 relative overflow-hidden">
            <x-container class="py-6 md:py-10 text-white">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-16 gap-y-12">
                    <div class="flex flex-col justify-center text-center px-6 md:text-left md:px-0">
                        <p class="text-2xl md:text-3xl | font-raleway font-extrabold">
                            Registra tu equipo e-sports
                        </p>
	                    <p class="text-lg md:text-xl | font-raleway font-bold | text-edyellow-300 | pt-2">
                            o solicita el ingreso en algún equipo
                        </p>
                            <p class="text-2xl md:text-3xl | font-raleway font-extrabold | pt-2">
                            y participa en los torneos y campeonatos
                        </p>
                        <p class="text-teal-200 | text-normal md:text-base | pt-6">
                            Para poder competir en los torneos y campeonatos por equipos es necesario estar inscrito en algún equipo. Los propietarios y capitanes tendrán acceso a un area privada para gestionar los miembros del equipo, noticias, etc... y podrán inscribir a su equipo en los campeonatos organizados por Padawan e-sports.
                        </p>
                    </div>

                    <div class="hidden sm:block">
                        <div class="flex flex-col justify-center items-center gap-8 h-full">
                            <img src="https://www.nicepng.com/png/full/177-1775206_hw-race-team-hot-wheels-hw-race-team.png" alt="Padawan e-sports" class="w-32 md:w-48">
                            {{-- <i class="icon-fifa text-4xl"></i>
                            <i class="icon-efootball text-4xl"></i>
                            <i class="icon-gtracing text-5xl"></i> --}}
                            </ul>
                        </div>
                    </div>
                </div>
            </x-container>
        </div>
    </div>
{{-- @endif --}}