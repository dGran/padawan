<style>
    .banner-landing:before {
        content: "";
        width: 55%;
        height: 100%;
        position: absolute;
        bottom: 0;
        right: 0;
        transform-origin: bottom left;
        transform: skew(-30deg,0deg);
        background: linear-gradient(233deg,#fff 5%,hsla(0,0%,100%,.01) 95%);
        mix-blend-mode: soft-light;
        pointer-events: none;
    }
</style>

<x-app-layout>

    @guest
      <div class="relative">
            <div class="banner-landing bg-edblue-700 dark:bg-edblue-900 relative overflow-hidden">
                <x-container class="py-8 md:py-16 text-white">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-16 gap-y-12">
                        <div class="flex flex-col justify-center text-center px-6 md:text-left md:px-0">
                            <p class="text-2xl md:text-3xl | font-raleway font-extrabold">
                                Participa en los torneos y campeonatos
                            </p>
                            <p class="text-lg md:text-xl | font-raleway font-bold | text-edyellow-300 | pt-2">
                                gana dinero con los tornes e-sports
                            </p>
                            <p class="text-2xl md:text-3xl | font-raleway font-extrabold | pt-2">
                                sin salir de casa
                            </p>
                            <p class="text-edblue-200 | text-normal md:text-base | pt-6">
                                Ponemos a tu disposición torneos, ligas, campeonatos de disitntos juegos, gratuitos y de pago, por diversión o por incentivos
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

 {{--                                <img class="rounded-full bg-red-300 h-36 w-36 object-cover absolute top-0 left-0 ml-48" src="https://www.ginx.tv/uploads2/PES/eFootballUpdate_main.jpg">
                                <img class="rounded-full bg-edyellow-400 h-48 w-48 object-cover absolute top-0 left-0 ml-32 mt-36" src="https://onewindows.es/wp-content/uploads/2014/06/GT-Racing-2.png">
                                <img class="rounded-full bg-edblue-300 h-60 w-60 object-contain absolute top-0 right-0 mt-10 mr-16" src="https://www.footyrenders.com/render/kylian-mbappe-fifa-22.png"> --}}

                            </div>

                        </div>
                    </div>
                </x-container>
            </div>
        </div>
    @endguest

    @auth
        <div class="" style="background: rgb(14,19,24);
    background: linear-gradient(90deg, rgba(14,19,24,1) 0%, rgba(33,46,54,1) 35%, rgba(33,46,54,1) 65%, rgba(14,19,24,1) 100%);">
            <x-container class="">
                <div class="flex flex-col justify-center bg-contain  bg-no-repeat bg-center h-64 md:h-80" style="background-image: url(https://prod.r3eassets.com/assets/content/carlivery/mrs-gt-racing-22-4559-image-big.png)">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/f3/Xbox_Series_X_S_black.svg/1280px-Xbox_Series_X_S_black.svg.png" alt="" class="w-32 h-16 md:w-40 md:h-20 p-1.5 md:p-3 object-cover bg-white rounded-lg opacity-70">
                    <img src="https://ithardware.pl/artykuly/max/16466_1.jpg" alt="" class="w-32 h-16 md:w-40 md:h-20 p-1.5 md:p-3 object-cover bg-white rounded-lg opacity-70 mt-6">

                </div>
            </x-container>
        </div>
    @endauth

    <div class="py-16 bg-edgray-200 dark:bg-dt-dark-accent">
        <x-container>
            <section class="text-center">
                <article>
                    <p class="text-2xl md:text-3xl | font-raleway font-extrabold | text-center | text-title-color dark:text-dt-title-color">
                        ¿Qué puedes aprender en EDteam?
                    </p>
                    <p class="text-normal md:text-base | pt-4">
                        Publicamos 2 torneos semanales. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur ipsa ipsum dolorum in incidunt mollitia
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
                            PlayStation, Xbox, PC Game..., jugamos en todas las plataformas <br>
                            <ul class="mt-1 flex items-center text-xl gap-3">
                                <li><i class="icon-playstation"></i></li>
                                <li><i class="icon-xbox"></i></li>
                                <li><i class="icon-steam"></i></li>
                            </ul>
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
                        ¿Qué puedes aprender en EDteam?
                    </p>
                    <p class="text-normal md:text-base | pt-4">
                        Publicamos 2 torneos semanales. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur ipsa ipsum dolorum in incidunt mollitia
                    </p>
                </article>
            </section>
        </x-container>
    </div>

</x-app-layout>
