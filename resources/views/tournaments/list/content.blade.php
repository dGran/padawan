<style>
    .ribbon {
  position: absolute;
  left: -5px; top: -5px;
  z-index: 1;
  overflow: hidden;
  width: 75px; height: 75px;
  text-align: right;
}
.ribbon span {
  font-size: 10px;
  font-weight: bold;
  color: #FFF;
  text-transform: uppercase;
  text-align: center;
  line-height: 20px;
  transform: rotate(-45deg);
  -webkit-transform: rotate(-45deg);
  width: 100px;
  display: block;
  background: #79A70A;
  background: linear-gradient(#9BC90D 0%, #79A70A 100%);
  box-shadow: 0 3px 10px -5px rgba(0, 0, 0, 1);
  position: absolute;
  top: 19px; left: -21px;
}
.ribbon span::before {
  content: "";
  position: absolute; left: 0px; top: 100%;
  z-index: -1;
  border-left: 3px solid #79A70A;
  border-right: 3px solid transparent;
  border-bottom: 3px solid transparent;
  border-top: 3px solid #79A70A;
}
.ribbon span::after {
  content: "";
  position: absolute; right: 0px; top: 100%;
  z-index: -1;
  border-left: 3px solid transparent;
  border-right: 3px solid #79A70A;
  border-bottom: 3px solid transparent;
  border-top: 3px solid #79A70A;
}
</style>

<div class="custom-container">
{{--     <div class="my-8">
        <h1 class="font-fjalla uppercase tracking-wider text-orange-500 text-lg font-semibold">
            Listado de torneos
        </h1>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-8 mb-8">

            @foreach ($tournaments as $tournament)
                <a href="{{ route('tournaments.view', $tournament) }}">
                    <div class="max-w-sm rounded-lg overflow-hidden shadow-lg bg-white text-gray-700 mt-8 border hover:bg-yellow-200 hover:border-yellow-200">
                      <img class="w-full" src="{{ $tournament->game->img() }}" alt="Sunset in the mountains">
                      <div class="px-6 py-4">
                        <div class="font-bold text-xl mb-2">{{ $tournament->name }}</div>
                      </div>
                      <div class="px-4 py-4">
                        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-xs font-semibold text-gray-700 mr-1">#{{ $tournament->game->name }}</span>
                      </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
 --}}
    <div class="my-8">
        <h1 class="font-fjalla uppercase tracking-wider text-orange-500 text-lg font-semibold">
            Torneos disponibles
        </h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 my-4">
            <div class="bg-gray-800 rounded-md border-2 border-gray-900 hover:border-red-500 relative">
<div class="ribbon"><span>PREMIADO</span></div>
                <img src="https://e00-marca.uecdn.es/assets/multimedia/imagenes/2019/12/16/15765089814192.png" alt="" class="rounded-t-md">
                <div class="platform-logo h-16 w-16 rounded-full bg-red-800 border border-red-600 p-0 shadow-md p-2" style="position: absolute; top:10px; right: 10px">
                    <img class="object-cover w-full h-full" src="https://www.freepnglogos.com/uploads/playstation-png-logo/andtoid-playstation-png-logo-24.png" alt="">
                </div>
                <div class="flex items-center border-t-4 border-yellow-500 p-3 pb-0">
                    <img src="https://storage.googleapis.com/pro-gaming-production.appspot.com/images%2Fgames%2Flogos%2F71524f81c05c3cb7bc4d05cc8f781cfbe647c15d.png?GoogleAccessId=firebase-adminsdk-4bf2k%40pro-gaming-production.iam.gserviceaccount.com&Expires=16447014000&Signature=RhZuuN%2FLRUOmBaQjCPQYh4r7pQPho3lyNZh7fud2%2BijWFeAN0GjW3AP2ufarOO5jPLkt8KqF0Ue3qnH5BW9kJE2uJ2eS25I9jE59epzZaipq73ouTW51Oj7Yhr5gg7ujEqIQF%2FdO79x7qhWX7irDswMPSusaWTsny%2BgYvdBq02TC1Gbo%2BnxKslxd2qqDH5VUuMA8setZghvLJuHRPLcCAxMnedl7L9jlJHfEB8hKjK7LzPOK96w30iOdqaHNyQwUEBNh7ZFeiv%2FmmrpE9DtDfTPQT6q%2BUWgru5axsnAlmGbhCFUgk8oVIs11%2BhRotAejurgk20n%2FBCLzFFKcg34f4w%3D%3D" alt="" class="flex-initial w-12 h-12 rounded">
                    <div class="flex-0 ml-3">
                        <span class="block font-fjalla tracking-wider font-light">FIFA 20</span>
                        <span class="block font-semibold text-yellow-500">Clubes Pro Divisiones - Temporada 2</span>
                    </div>
                </div>
                <div class="p-3">
                    <div class="relative">
                        <div class="text-right">
                            <span class="text-xs font-semibold inline-block text-red-500">
                                30%
                            </span>
                        </div>
                        <div class="overflow-hidden h-1 mb-2 text-xs flex rounded bg-red-200">
                            <div style="width:30%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-red-500"></div>
                        </div>
                        <p class="text-right text-xs">
                            8 / 24 PLAZAS
                        </p>
                    </div>
                </div>
                <div class="bg-red-800 px-3 py-2 text-white rounded-b-md text-center border-t-4 border-red-600">
                    PlayStation
                </div>
            </div>
            <div class="bg-gray-800 rounded-md border-2 border-gray-900 hover:border-green-500 relative">
                <img src="https://e00-marca.uecdn.es/assets/multimedia/imagenes/2019/12/16/15765089814192.png" alt="" class="rounded-t-md">
                <div class="platform-logo h-16 w-16 rounded-full bg-green-800 border border-green-600 p-0 shadow-md p-2" style="position: absolute; top:10px; right: 10px">
                    <img class="object-cover w-full h-full" src="https://image.flaticon.com/icons/svg/732/732146.svg" alt="" style="fill: white;">
                </div>
                <div class="flex items-center border-t-4 border-yellow-500 p-3 pb-0">
                    <img src="https://storage.googleapis.com/pro-gaming-production.appspot.com/images%2Fgames%2Flogos%2F71524f81c05c3cb7bc4d05cc8f781cfbe647c15d.png?GoogleAccessId=firebase-adminsdk-4bf2k%40pro-gaming-production.iam.gserviceaccount.com&Expires=16447014000&Signature=RhZuuN%2FLRUOmBaQjCPQYh4r7pQPho3lyNZh7fud2%2BijWFeAN0GjW3AP2ufarOO5jPLkt8KqF0Ue3qnH5BW9kJE2uJ2eS25I9jE59epzZaipq73ouTW51Oj7Yhr5gg7ujEqIQF%2FdO79x7qhWX7irDswMPSusaWTsny%2BgYvdBq02TC1Gbo%2BnxKslxd2qqDH5VUuMA8setZghvLJuHRPLcCAxMnedl7L9jlJHfEB8hKjK7LzPOK96w30iOdqaHNyQwUEBNh7ZFeiv%2FmmrpE9DtDfTPQT6q%2BUWgru5axsnAlmGbhCFUgk8oVIs11%2BhRotAejurgk20n%2FBCLzFFKcg34f4w%3D%3D" alt="" class="flex-initial w-12 h-12 rounded">
                    <div class="flex-0 ml-3">
                        <span class="block font-fjalla tracking-wider font-light">FIFA 20</span>
                        <span class="block font-semibold text-yellow-500">Liga ESP Septiembre</span>
                    </div>
                </div>
                <div class="p-3">
                    <div class="relative">
                        <div class="text-right">
                            <span class="text-xs font-semibold inline-block text-green-500">
                                50%
                            </span>
                        </div>
                        <div class="overflow-hidden h-1 mb-2 text-xs flex rounded bg-green-200">
                            <div style="width:50%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-green-500"></div>
                        </div>
                        <p class="text-right text-xs">
                            12 / 24 PLAZAS
                        </p>
                    </div>
                </div>
                <div class="bg-green-800 px-3 py-2 text-white rounded-b-md text-center border-t-4 border-green-600">
                    Xbox
                </div>
            </div>
            <div class="bg-gray-800 rounded-md border-2 border-gray-900 hover:border-blue-300 relative">
                <img src="https://i.ytimg.com/vi/baNWFMuSpdI/maxresdefault.jpg" alt="" class="rounded-t-md">
                <div class="platform-logo h-16 w-16 rounded-full bg-blue-800 border border-blue-600 p-0 shadow-md p-2" style="position: absolute; top:10px; right: 10px">
                    <img class="object-cover w-full h-full" src="https://image.flaticon.com/icons/svg/76/76658.svg" alt="" style="fill: white;">
                </div>
                <div class="flex items-center border-t-4 border-yellow-500 p-3 pb-0">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcRs4P1WIUa-SRGPb5afZKCovfc0GQm13pzmTw&usqp=CAU" alt="" class="flex-initial w-12 h-12 rounded">
                    <div class="flex-0 ml-3">
                        <span class="block font-fjalla tracking-wider font-light">GT RACING</span>
                        <span class="block font-semibold text-yellow-500">Campeonato Septiembre</span>
                    </div>
                </div>
                <div class="p-3">
                    <div class="relative">
                        <div class="text-right">
                            <span class="text-xs font-semibold inline-block text-blue-500">
                                30%
                            </span>
                        </div>
                        <div class="overflow-hidden h-1 mb-2 text-xs flex rounded bg-blue-200">
                            <div style="width:30%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-500"></div>
                        </div>
                        <p class="text-right text-xs">
                            8 / 24 PLAZAS
                        </p>
                    </div>
                </div>
                <div class="bg-blue-800 px-3 py-2 text-white rounded-b-md text-center border-t-4 border-blue-600">
                    PC
                </div>
            </div>
        </div>
    </div>
</div>
