<div>
    @include('tournament.partials.header', ['activeTab' => 'Schedule', 'color' => 'edblue'])

    <x-container>

        <h4 class="mt-4 md:mt-6 | font-fjalla | text-lg md:text-xl | tracking-wider | text-title-color dark:text-dt-title-color | pb-0.5 | border-b border-gray-200 dark:border-dt-border-color">Próxima carrera</h4>
        <section class="mt-4 mb-6 md:mt-6 md:mb-8">
            <div class="bg-white dark:bg-dt-dark | border border-border-color dark:border-dt-border-color | rounded-md | py-6">
                <div class="max-w-2xl | md:mx-auto | px-4">
                    <div class="flex items-start justify-between">
                        <div class="flex flex-col items-center | font-condensed | mr-3 pr-3 | border-r border-border-color dark:border-dt-border-color | text-rose-600 dark:text-edyellow-600">
                            <p class="text-5xl font-bold">
                                16
                            </p>
                            <p class="text-xs font-semibold uppercase">
                                mar - 22:30
                            </p>
                        </div>

                        <div class="flex-1 flex flex-col">
                            <p class="text-sm font-semibold text-title-color dark:text-dt-title-color">Carrera 1</p>
                            <div class="text-xxs | flex flex-col | mt-2">
                                <p>Alsance Village</p>
                                <p>3.150m. / 18 vueltas</p>
                            </div>
                        </div>

                        <div class="border border-border-color dark:border-dt-border-color | text-title-color dark:text-dt-title-color | font-semibold | rounded-full | w-8 h-8 | flex items-center justify-center | text-sm | leading-3">
                            2
                        </div>

                    </div>
                    <img src="{{ asset('img/circuit.png') }}" alt="" class="my-6 rounded w-full">

                    <p class="| font-miriam | uppercase | text-center | text-title-color dark:text-dt-title-color">
                        inicio carrera en...
                    </p>
                    <div class="flex items-center justify-center | mt-3 mb-6 | space-x-1 | font-condensed">
                        <div class="bg-rose-600 dark:bg-edyellow-600 text-dt-title-color dark:text-title-color border border-border-color dark:border-dt-border-color py-2 px-3 md:py-3 md:px-4 | rounded-md">
                            <div class="w-9 md:w-10 flex flex-col items-center">
                                <span class="text-3xl md:text-4xl font-bold">9</span>
                                <span class="text-xxxs md:text-xxs | uppercase | mt-1.5">dias</span>
                            </div>
                        </div>
                        <div class="bg-rose-600 dark:bg-edyellow-600 text-dt-title-color dark:text-title-color border border-border-color dark:border-dt-border-color py-2 px-3 md:py-3 md:px-4 | rounded-md">
                            <div class="w-9 md:w-10 flex flex-col items-center">
                                <span class="text-3xl md:text-4xl font-bold">13</span>
                                <span class="text-xxxs md:text-xxs | uppercase | mt-1.5">horas</span>
                            </div>
                        </div>
                        <div class="bg-rose-600 dark:bg-edyellow-600 text-dt-title-color dark:text-title-color border border-border-color dark:border-dt-border-color py-2 px-3 md:py-3 md:px-4 | rounded-md">
                            <div class="w-9 md:w-10 flex flex-col items-center">
                                <span class="text-3xl md:text-4xl font-bold">5</span>
                                <span class="text-xxxs md:text-xxs | uppercase | mt-1.5">minutos</span>
                            </div>
                        </div>
                        <div class="bg-rose-600 dark:bg-edyellow-600 text-dt-title-color dark:text-title-color border border-border-color dark:border-dt-border-color py-2 px-3 md:py-3 md:px-4 | rounded-md">
                            <div class="w-9 md:w-10 flex flex-col items-center">
                                <span class="text-3xl md:text-4xl font-bold">29</span>
                                <span class="text-xxxs md:text-xxs | uppercase | mt-1.5">segundos</span>
                            </div>
                        </div>
                    </div>
                    <a class="block | px-4 py-2 | appearance-none | border border-rose-600 dark:border-edyellow-600 | rounded | font-miriam font-semibold text-sm uppercase | text-center | text-rose-600 dark:text-edyellow-600 | hover:text-dt-title-color dark:hover:text-title-color hover:bg-rose-600 dark:hover:bg-edyellow-600 | focus:outline-none focus:text-dt-title-color dark:focus:text-title-color focus:bg-rose-600 dark:focus:bg-edyellow-600" href="{{ route('tournament.race', 'color=edblue') }}">
                        previo carrera
                    </a>
                </div>
            </div>
        </section>

        <h4 class="mt-4 md:mt-6 | font-fjalla | text-lg md:text-xl | tracking-wider | text-title-color dark:text-dt-title-color | pb-0.5 | border-b border-gray-200 dark:border-dt-border-color">Calendario</h4>
        <section class="mt-4 mb-6 md:mt-6 md:mb-8">

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 | cursor-pointer">

                <a class="block | focus:outline-none group bg-white dark:bg-dt-dark | border border-border-color dark:border-dt-border-color | p-4 | rounded-md | hover:border-gray-300 dark:hover:border-edgray-600 | hover:bg-border-color dark:hover:bg-dt-border-color | focus:border-gray-300 dark:focus:border-edgray-600 | focus:bg-border-color dark:focus:bg-dt-border-color" href="{{ route('tournament.race', 'op=carrera', 'color=edblue') }}">
                    <div class="flex items-start justify-between">
                        <div class="flex flex-col items-center | font-condensed | mr-3 pr-3 | border-r border-border-color dark:border-dt-border-color | text-rose-600 dark:text-edyellow-600">
                            <p class="text-5xl font-bold">
                                16
                            </p>
                            <p class="text-xs font-semibold uppercase">
                                mar - 22:30
                            </p>
                        </div>

                        <div class="flex-1 flex flex-col">
                            <p class="text-sm font-semibold text-title-color dark:text-dt-title-color">Carrera 1</p>
                            <div class="text-xxs | flex flex-col | mt-2">
                                <p>Alsance Village</p>
                                <p>3.150m. / 18 vueltas</p>
                            </div>
                        </div>

                        <div class="border border-border-color dark:border-dt-border-color | text-title-color dark:text-dt-title-color | font-semibold | rounded-full | w-8 h-8 | flex items-center justify-center | text-sm | leading-3 | group-hover:border-gray-300 dark:group-hover:border-edgray-600 | group-focus:border-gray-300 dark:group-focus:border-edgray-600 | group-hover:bg-white dark:group-hover:bg-dt-dark | group-focus:bg-white dark:group-focus:bg-dt-dark">
                            1
                        </div>

                    </div>
                    <div class="inline-block overflow-hidden my-6 rounded w-full">
                        <img src="{{ asset('img/circuit.png') }}" alt="" class="block transform group-hover:scale-110 group-focus:scale-110 transition duration-300 ease-in-out">
                    </div>
                    <p class="w-full | px-4 py-2 | appearance-none | bg-rose-600 dark:bg-edyellow-600 | rounded | font-miriam font-semibold text-sm uppercase | text-center | text-dt-title-color dark:text-title-color | group-hover:bg-rose-700 dark:group-hover:bg-edyellow-500 | focus:outline-none group-focus:bg-rose-700 dark:group-focus:bg-edyellow-500">
                        ver resultados
                    </p>
                </a>

                <a class="block | focus:outline-none group bg-white dark:bg-dt-dark | border border-border-color dark:border-dt-border-color | p-4 | rounded-md | hover:border-gray-300 dark:hover:border-edgray-600 | hover:bg-border-color dark:hover:bg-dt-border-color | focus:border-gray-300 dark:focus:border-edgray-600 | focus:bg-border-color dark:focus:bg-dt-border-color" href="{{ route('tournament.race', 'color=edblue') }}">
                    <div class="flex items-start justify-between">
                        <div class="flex flex-col items-center | font-condensed | mr-3 pr-3 | border-r border-border-color dark:border-dt-border-color | text-rose-600 dark:text-edyellow-600">
                            <p class="text-5xl font-bold">
                                16
                            </p>
                            <p class="text-xs font-semibold uppercase">
                                mar - 22:30
                            </p>
                        </div>

                        <div class="flex-1 flex flex-col">
                            <p class="text-sm font-semibold text-title-color dark:text-dt-title-color">Carrera 1</p>
                            <div class="text-xxs | flex flex-col | mt-2">
                                <p>Alsance Village</p>
                                <p>3.150m. / 18 vueltas</p>
                            </div>
                        </div>

                        <div class="border border-border-color dark:border-dt-border-color | text-title-color dark:text-dt-title-color | font-semibold | rounded-full | w-8 h-8 | flex items-center justify-center | text-sm | leading-3 | group-hover:border-gray-300 dark:group-hover:border-edgray-600 | group-focus:border-gray-300 dark:group-focus:border-edgray-600 | group-hover:bg-white dark:group-hover:bg-dt-dark | group-focus:bg-white dark:group-focus:bg-dt-dark">
                            2
                        </div>

                    </div>
                    <div class="inline-block overflow-hidden my-6 rounded w-full">
                        <img src="{{ asset('img/circuit.png') }}" alt="" class="block transform group-hover:scale-110 group-focus:scale-110 transition duration-300 ease-in-out">
                    </div>
                    <p class="w-full | px-4 py-2 | appearance-none | border border-rose-600 dark:border-edyellow-600 | rounded | font-miriam font-semibold text-sm uppercase | text-center | text-rose-600 dark:text-edyellow-600 | group-hover:text-rose-700 dark:group-hover:text-edyellow-500 | group-focus:text-rose-600 dark:group-focus:text-edyellow-500">
                        previo carrera
                    </p>
                </a>

                <a class="block | focus:outline-none group bg-white dark:bg-dt-dark | border border-border-color dark:border-dt-border-color | p-4 | rounded-md | hover:border-gray-300 dark:hover:border-edgray-600 | hover:bg-border-color dark:hover:bg-dt-border-color | focus:border-gray-300 dark:focus:border-edgray-600 | focus:bg-border-color dark:focus:bg-dt-border-color" href="{{ route('tournament.race', 'color=edblue') }}">
                    <div class="flex items-start justify-between">
                        <div class="flex flex-col items-center | font-condensed | mr-3 pr-3 | border-r border-border-color dark:border-dt-border-color | text-rose-600 dark:text-edyellow-600">
                            <p class="text-5xl font-bold">
                                16
                            </p>
                            <p class="text-xs font-semibold uppercase">
                                mar - 22:30
                            </p>
                        </div>

                        <div class="flex-1 flex flex-col">
                            <p class="text-sm font-semibold text-title-color dark:text-dt-title-color">Carrera 1</p>
                            <div class="text-xxs | flex flex-col | mt-2">
                                <p>Alsance Village</p>
                                <p>3.150m. / 18 vueltas</p>
                            </div>
                        </div>

                        <div class="border border-border-color dark:border-dt-border-color | text-title-color dark:text-dt-title-color | font-semibold | rounded-full | w-8 h-8 | flex items-center justify-center | text-sm | leading-3 | group-hover:border-gray-300 dark:group-hover:border-edgray-600 | group-focus:border-gray-300 dark:group-focus:border-edgray-600 | group-hover:bg-white dark:group-hover:bg-dt-dark | group-focus:bg-white dark:group-focus:bg-dt-dark">
                            3
                        </div>

                    </div>
                    <div class="inline-block overflow-hidden my-6 rounded w-full">
                        <img src="{{ asset('img/circuit.png') }}" alt="" class="block transform group-hover:scale-110 group-focus:scale-110 transition duration-300 ease-in-out">
                    </div>
                    <p class="w-full | px-4 py-2 | appearance-none | border border-rose-600 dark:border-edyellow-600 | rounded | font-miriam font-semibold text-sm uppercase | text-center | text-rose-600 dark:text-edyellow-600 | group-hover:text-rose-700 dark:group-hover:text-edyellow-500 | group-focus:text-rose-600 dark:group-focus:text-edyellow-500">
                        previo carrera
                    </p>
                </a>

                <a class="block | focus:outline-none group bg-white dark:bg-dt-dark | border border-border-color dark:border-dt-border-color | p-4 | rounded-md | hover:border-gray-300 dark:hover:border-edgray-600 | hover:bg-border-color dark:hover:bg-dt-border-color | focus:border-gray-300 dark:focus:border-edgray-600 | focus:bg-border-color dark:focus:bg-dt-border-color" href="{{ route('tournament.race', 'color=edblue') }}">
                    <div class="flex items-start justify-between">
                        <div class="flex flex-col items-center | font-condensed | mr-3 pr-3 | border-r border-border-color dark:border-dt-border-color | text-rose-600 dark:text-edyellow-600">
                            <p class="text-5xl font-bold">
                                16
                            </p>
                            <p class="text-xs font-semibold uppercase">
                                mar - 22:30
                            </p>
                        </div>

                        <div class="flex-1 flex flex-col">
                            <p class="text-sm font-semibold text-title-color dark:text-dt-title-color">Carrera 1</p>
                            <div class="text-xxs | flex flex-col | mt-2">
                                <p>Alsance Village</p>
                                <p>3.150m. / 18 vueltas</p>
                            </div>
                        </div>

                        <div class="border border-border-color dark:border-dt-border-color | text-title-color dark:text-dt-title-color | font-semibold | rounded-full | w-8 h-8 | flex items-center justify-center | text-sm | leading-3 | group-hover:border-gray-300 dark:group-hover:border-edgray-600 | group-focus:border-gray-300 dark:group-focus:border-edgray-600 | group-hover:bg-white dark:group-hover:bg-dt-dark | group-focus:bg-white dark:group-focus:bg-dt-dark">
                            4
                        </div>

                    </div>
                    <div class="inline-block overflow-hidden my-6 rounded w-full">
                        <img src="{{ asset('img/circuit.png') }}" alt="" class="block transform group-hover:scale-110 group-focus:scale-110 transition duration-300 ease-in-out">
                    </div>
                    <p class="w-full | px-4 py-2 | appearance-none | border border-rose-600 dark:border-edyellow-600 | rounded | font-miriam font-semibold text-sm uppercase | text-center | text-rose-600 dark:text-edyellow-600 | group-hover:text-rose-700 dark:group-hover:text-edyellow-500 | group-focus:text-rose-600 dark:group-focus:text-edyellow-500">
                        previo carrera
                    </p>
                </a>

            </div>



{{--             <x-link href="{{ route('tournament.race', 'color=edblue') }}">Carrera 1</x-link>
            <x-link href="{{ route('tournament.race', 'op=qualy', 'color=edblue') }}">Carrera 1 - Qualy</x-link> --}}
        </section>

    </x-container>
</div>