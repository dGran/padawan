<x-app-layout>
    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium alias autem consequatur delectus dolore ex explicabo inventore, laudantium libero molestiae natus nemo non pariatur quaerat quibusdam quos temporibus. Officiis, quam?
    <!-- Background image -->
    <div class="index-banner relative overflow-hidden bg-no-repeat bg-cover h-96" style="
          background-position: 50%;
          background-image: url('img/index-banner.jpg');
        ">
        <div id="index-banner-mask"
             class="index-banner-mask absolute top-0 right-0 bottom-0 left-0 w-full h-full overflow-hidden bg-fixed">
            <div class="flex justify-center items-start h-full relative">
                <div class="text-center text-white px-4 md:px-8">
                    <h1 class="text-3xl lg:text-4xl mt-8 font-bold">Padawan e-sports</h1>
                    <h3 class="mt-3 text-xl lg:text-2xl font-bold text-edblue-400">Torneos y campeonatos online para GT, Fifa y eFootball</h3>
                    <img src="{{ asset('img/logo.png') }}" alt="Padawan e-sports"
                         class="absolute top-0 right-0 mt-1 mr-3 w-16 lg:w-24 opacity-20 ">
                    <div
                        class="absolute bottom-0 left-0 right-0 | text-xl md:text-2xl flex items-center justify-center space-x-6 py-3 text-white">
                        <i class="icon-brand-playstation"></i>
                        <i class="icon-brand-xbox"></i>
                        <i class="icon-brand-pcgame"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Background image -->

{{--      <div class="banner-landing bg-edblue-700 dark:bg-edblue-900 relative overflow-hidden"></div>--}}

    @if ($lastUsers->count() > 0)
        <div class="py-6">
            <x-container>
                <section>
                    <div class="text-center md:max-w-xl lg:max-w-3xl mx-auto">
                        <h3 class="text-lg md:text-xl mb-3 md:mb-6 | font-raleway font-extrabold | text-center | text-dt-title-color" style="text-shadow: 0 0 9px #0e9b72, 0 0 9px #0e9b72, 0 0 9px #0e9b72, 0 0 9px #0e9b72;">
                            Recién llegados
                        </h3>
                    </div>

                    <div class="flex justify-center mb-1.5">
                        @foreach ($lastUsers as $lastUser)
                            <img src="{{ $lastUser->getAvatarUrl() }}" class="p-px bg-gray-50 dark:bg-dt-darker rounded-full object-cover shadow w-12 md:w-16 hover:shadow-lg | scale-95 transform hover:scale-110 transition duration-100 ease-in-out | {{ $loop->index == 0 ?: '-ml-3' }} z-[{{ 6-$loop->index }}] hover:z-50" onclick='Livewire.emit("openModal", "modals.user-modal", @json(['user' => $lastUser]))' />
                        @endforeach
                    </div>
                </section>
            </x-container>
        </div>
    @endif

    <div class="py-16 bg-edgray-300 dark:bg-dt-dark-accent">
        <x-container>
            <section class="text-center">
                <article>
                    <p class="text-2xl md:text-3xl | font-raleway font-extrabold | text-center | text-title-color dark:text-dt-title-color">
                        ¿Qué es padawan <span class="text-edblue-500 dark:text-edblue-400">e-sports</span>?
                    </p>
                    <p class="text-normal md:text-base | pt-4">
                        <ul>
                            <li>Plataforma online de competiciones e-sports online.</li>
                            <li>Control de equipos e-sports con mercado para competir en los torneos y campeonatos.</li>
                        </ul>
                    </p>
                </article>
            </section>

            <section class="grid grid-cols-2 sm:grid-cols-3 xl:grid-cols-4 gap-3 md:gap-x-6 mt-8">

                <a href="#" class="flex | group">
                    <article
                        class="flex-1 flex flex-col items-center | px-3 py-6 lg:px-6 lg:py-10 | relative | rounded-lg | hover:bg-gray-200 dark:hover:bg-dt-light-accent | transition ease-in-out duration-300">
                        <img src="{{ asset('img/index/gt7.jpg') }}" alt=""
                             class="w-24 h-24 md:w-32 md:h-32 rounded-2xl object-cover transform transition duration-300 group-hover:scale-110 ease-in-out">
                        <h4 class="text-center font-raleway text-title-color dark:text-dt-title-color text-lg md:text-xl font-bold pt-6 pb-2">
                            GT7
                        </h4>
                        <p class="text-center text-xs md:text-sm">
                            Compite en nuestros campeonatos
                        </p>
                    </article>

                </a>

                <a href="#" class="flex | group">
                    <article
                        class="flex-1 flex flex-col items-center | px-3 py-6 lg:px-6 lg:py-10 | relative | rounded-lg | hover:bg-gray-200 dark:hover:bg-dt-light-accent | transition ease-in-out duration-300">
                        <img src="{{ asset('img/index/fifa23.jpeg') }}" alt=""
                             class="w-24 h-24 md:w-32 md:h-32 rounded-2xl object-cover transform transition duration-300 group-hover:scale-110 ease-in-out">
                        <h4 class="text-center text-title-color dark:text-dt-title-color text-lg md:text-xl font-bold pt-6 pb-2">
                            FIFA 23
                        </h4>
                        <p class="flex flex-col items-center justify-center text-xs md:text-sm">
                            <span class="text-center">Torneos, ligas, individuales, clubes...</span>
                            <span class="mt-2 text-rose-500 dark:text-rose-400 uppercase font-bold animate-pulse">Próximamente...</span>
                        </p>
                    </article>

                </a>

                <a href="#" class="flex | group">
                    <article
                        class="flex-1 flex flex-col items-center | px-3 py-6 lg:px-6 lg:py-10 | relative | rounded-lg | hover:bg-gray-200 dark:hover:bg-dt-light-accent | transition ease-in-out duration-300">
                        <img src="{{ asset('img/index/efootball2022.png') }}" alt=""
                             class="w-24 h-24 md:w-32 md:h-32 rounded-2xl object-cover transform transition duration-300 group-hover:scale-110 ease-in-out">
                        <h4 class="text-center text-title-color dark:text-dt-title-color text-lg md:text-xl font-bold pt-6 pb-2">
                            eFootball 2022
                        </h4>
                        <p class="flex flex-col items-center justify-center text-xs md:text-sm">
                            <span class="text-center">Torneos, ligas, individuales, clubes...</span>
                            <span class="mt-2 text-rose-500 dark:text-rose-400 uppercase font-bold animate-pulse">Próximamente...</span>
                        </p>
                    </article>

                </a>

                <a href="#" class="flex | group">
                    <article
                        class="flex-1 flex flex-col items-center | px-3 py-6 lg:px-6 lg:py-10 | relative | rounded-lg | hover:bg-gray-200 dark:hover:bg-dt-light-accent | transition ease-in-out duration-300">
                        <img src="{{ asset('img/index/cross-platform.jpg') }}" alt=""
                             class="w-24 h-24 md:w-32 md:h-32 rounded-2xl object-cover transform transition duration-300 group-hover:scale-110 ease-in-out">
                        <h4 class="text-center text-title-color dark:text-dt-title-color text-lg md:text-xl font-bold pt-6 pb-2">
                            ...para todos!
                        </h4>
                        <p class="text-center text-xs md:text-sm">
                            PlayStation, Xbox, PC, participa sólo o con tu equipo
                        </p>
                    </article>
                </a>
            </section>
        </x-container>
    </div>

    <div class="py-16">
        <x-container>
            <section class="text-center">
                <article>
                    <p class="text-2xl md:text-3xl | font-raleway font-extrabold | text-center | text-title-color dark:text-dt-title-color">
                        Estos son nuestros partners
                    </p>
                    <p class="text-normal md:text-base | pt-4">
                        Lorem ipsum dolor, sit, amet consectetur adipisicing elit. Odio itaque, repellat neque error
                        necessitatibus rerum beatae, maxime, minus inventore at quibusdam possimus? Qui, necessitatibus
                        quod ut fugit repudiandae, optio et.
                    </p>
                </article>
            </section>
        </x-container>
    </div>

    {{-- @endguest --}}


</x-app-layout>

<script>
    var indexBannerMask = document.getElementById('index-banner-mask');

    if (document.documentElement.classList.contains('dark')) {
        indexBannerMask.classList.add('dark');
    } else {
        indexBannerMask.classList.remove('dark');
    }
</script>
