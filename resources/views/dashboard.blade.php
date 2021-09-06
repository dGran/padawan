<x-app-layout>

    @guest
      <div class="relative">
            <div class="banner-landing bg-edblue-700 dark:bg-edblue-900 relative overflow-hidden">
                <x-container class="py-8 md:py-16 text-white">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-16 gap-y-12">
                        <div class="flex flex-col justify-center text-center px-6 md:text-left md:px-0">
                            <p class="text-2xl md:text-3xl | font-raleway font-extrabold">
                                Lorem ipsum dolor sit amet
                            </p>
                            <p class="text-lg md:text-xl | font-raleway font-bold | text-edyellow-300 | pt-2">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit
                            </p>
                            <p class="text-2xl md:text-3xl | font-raleway font-extrabold | pt-2">
                                Lorem ipsum dolor sit amet
                            </p>
                            <p class="text-edblue-200 | text-normal md:text-base | pt-6">
                                Lorem, ipsum dolor sit amet consectetur adipisicing, elit. Excepturi laboriosam cupiditate fugit explicabo incidunt! Error nemo, cupiditate, sapiente molestiae necessitatibus aperiam numquam debitis amet veniam blanditiis, veritatis exercitationem, consequuntur et?
                            </p>
                            <a class='mt-8 mx-auto md:mx-0 px-4 py-2 w-max | bg-white | border border-white rounded | font-semibold text-edblue-700 | hover:scale-105 | focus:outline-none focus:scale-105 | transition transform ease-in-out duration-50 | select-none | cursor-pointer'>
                                Crea tu cuenta y únete!
                            </a>
                        </div>

                        <div class="">
                            <div class="flex flex-col justify-center items-center gap-8 h-full">
                                <i class="icon-fifa text-4xl"></i>
                                <i class="icon-efootball text-4xl"></i>
                                <i class="icon-gtracing text-5xl"></i>
                                <ul class="mt-6 flex items-center gap-8">
                                    <li>
                                        <i class="icon-brand-playstation text-xl"></i>
                                    </li>
                                    <li>
                                        <i class="icon-brand-xbox text-xl"></i>
                                    </li>
                                    <li>
                                        <i class="icon-brand-pcgame text-3xl"></i>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </x-container>
            </div>
        </div>
    @endguest

    @auth
        <div class="hidden dark:block" style="background: rgb(14,19,24); background: linear-gradient(90deg, rgba(14,19,24,1) 0%, rgba(33,46,54,1) 35%, rgba(33,46,54,1) 65%, rgba(14,19,24,1) 100%);">
            <x-container class="">
                <div class="flex flex-col justify-center bg-contain bg-no-repeat bg-center h-60 md:h-96 -mx-8" style="background-image: url({{ asset('img/test.png') }})"></div>
            </x-container>
        </div>
        <div class="dark:hidden border-b border-border-color" style="background: rgb(239,243,245);
background: linear-gradient(90deg, rgba(239,243,245,1) 0%, rgba(249,250,251,1) 35%, rgba(249,250,251,1) 65%, rgba(239,243,245,1) 100%);">
            <x-container class="">
                <div class="flex flex-col justify-center bg-contain bg-no-repeat bg-center h-60 md:h-96 -mx-8" style="background-image: url({{ asset('img/test.png') }})"></div>
            </x-container>
        </div>
        <div class="bg-gray-150 dark:bg-dt-darkest">
            <x-container class="py-3 text-xl md:text-2xl flex items-center justify-center gap-6 text-title-color dark:text-dt-title-color">
                <i class="icon-brand-xbox"></i>
                <i class="icon-brand-playstation"></i>
                <i class="icon-brand-pcgame"></i>
            </x-container>
        </div>
    @endauth

    <div class="py-16 bg-edgray-200 dark:bg-dt-dark-accent">
        <x-container>
            <section class="text-center">
                <article>
                    <p class="text-2xl md:text-3xl | font-raleway font-extrabold | text-center | text-title-color dark:text-dt-title-color">
                        Lorem ipsum dolor sit amet consectetur?
                    </p>
                    <p class="text-normal md:text-base | pt-4">
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Est optio ea a maxime voluptate itaque rerum eum mollitia repellat, numquam beatae odio, velit, incidunt. Velit perspiciatis, facilis id commodi possimus?
                    </p>
                </article>
            </section>

            <section class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 md:gap-x-8 md:gap-y-4 mt-8">

                <a href="#" class="flex | group">
                    <article class="flex-1 flex flex-col items-center | px-3 py-6 lg:px-6 lg:py-10 | relative | rounded-lg | hover:bg-gray-50 dark:hover:bg-dt-light-accent | transition ease-in-out duration-300">
                        <img src="https://image.flaticon.com/icons/png/512/639/639365.png" alt="" class="w-20 h-20 md:w-24 md:h-24 object-cover transform transition duration-300 group-hover:scale-110">
                        <h4 class="text-center font-raleway text-title-color dark:text-dt-title-color text-lg md:text-xl font-bold pt-6 pb-2">
                            Torneos e-sports<br>premiados
                        </h4>
                        <p class="text-center text-xs md:text-sm">
                            Compite en nuestros torneos e-sports de forma individual o colectiva
                        </p>
                    </article>

                </a>

                <a href="#" class="flex | group">
                    <article class="flex-1 flex flex-col items-center | px-3 py-6 lg:px-6 lg:py-10 | relative | rounded-lg | hover:bg-gray-50 dark:hover:bg-dt-light-accent | transition ease-in-out duration-300">
                        <img src="https://image.flaticon.com/icons/png/512/4292/4292657.png" alt="" class="w-20 h-20 md:w-24 md:h-24 object-cover transform transition duration-300 group-hover:scale-110">
                        <h4 class="text-center text-title-color dark:text-dt-title-color text-lg md:text-xl font-bold pt-6 pb-2">
                            Torneos, ligas, campeonatos...
                        </h4>
                        <p class="text-center text-xs md:text-sm">
                            Competiciones oficiales / amistosas, inviduales / por equipos <br>para distintos juegos
                        </p>
                    </article>

                </a>

                <a href="#" class="flex | group">
                    <article class="flex-1 flex flex-col items-center | px-3 py-6 lg:px-6 lg:py-10 | relative | rounded-lg | hover:bg-gray-50 dark:hover:bg-dt-light-accent | transition ease-in-out duration-300">
                        <img src="https://image.flaticon.com/icons/png/512/3565/3565673.png" alt="" class="w-20 h-20 md:w-24 md:h-24 object-cover transform transition duration-300 group-hover:scale-110">
                        <h4 class="text-center text-title-color dark:text-dt-title-color text-lg md:text-xl font-bold pt-6 pb-2">
                            Equipos e-sports, inscribe o forma tu equipo
                        </h4>
                        <p class="text-center text-xs md:text-sm">
                            Inscribe a tu equipo e-sports para competir o crealo y busca integrantes desde nuestra plataforma
                        </p>
                    </article>

                </a>

                <a href="#" class="flex | group">
                    <article class="flex-1 flex flex-col items-center | px-3 py-6 lg:px-6 lg:py-10 | relative | rounded-lg | hover:bg-gray-50 dark:hover:bg-dt-light-accent | transition ease-in-out duration-300">
                        <img src="https://image.flaticon.com/icons/png/512/3899/3899246.png" alt="" class="w-20 h-20 md:w-24 md:h-24 object-cover transform transition duration-300 group-hover:scale-110">
                        <h4 class="text-center text-title-color dark:text-dt-title-color text-lg md:text-xl font-bold pt-6 pb-2">
                            Distintas plataformas para todos los jugadores
                        </h4>
                        <p class="text-center text-xs md:text-sm">
                            PlayStation, Xbox, PC Game..., jugamos en todas las plataformas
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
                        Lorem, ipsum dolor sit amet consectetur?
                    </p>
                    <p class="text-normal md:text-base | pt-4">
                        Lorem ipsum dolor, sit, amet consectetur adipisicing elit. Odio itaque, repellat neque error necessitatibus rerum beatae, maxime, minus inventore at quibusdam possimus? Qui, necessitatibus quod ut fugit repudiandae, optio et.
                    </p>
                </article>
            </section>
        </x-container>
    </div>

</x-app-layout>
