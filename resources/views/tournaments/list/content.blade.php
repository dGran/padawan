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
    <div class="py-4 mb-8 bg-gray-800 rounded-md p-3 shadow-lg" style="background: #242c39">
        <h1 class="font-fjalla uppercase tracking-wider text-orange-500 text-lg font-semibold">
            Torneos nuevos
        </h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 my-4">
            @foreach ($seasons as $season)
                <a href="{{ route('tournament', [$season->tournament, $season]) }}">
                <div class="rounded-md relative bg-gray-800 border border-gray-900" onmouseover="show_details('{{ $season->id }}')" onmouseout="hide_details('{{ $season->id }}')">
                    <div class="border-b-2 border-yellow-500 ">
                        @if ($season->inscription_price > 0)
                            <div class="ribbon"><span>PREMIADO</span></div>
                        @endif
                        <img src="{{ asset($season->tournament->getBanner()) }}" alt="" class="rounded-t-md">
    {{--                     <div class="platform-logo h-16 w-16 rounded-full bg-white border border-{{ $season->tournament->game->platform->color }}-600 p-0 p-2" style="position: absolute; top:10px; right: 10px">
                            <img class="object-cover w-full h-full" src="{{ $season->tournament->game->platform->img() }}" alt="">
                        </div> --}}
                    </div>
                    <div class="relative">
                        <div class="flex items-center p-3 pb-0">
                            <img src="{{ asset($season->tournament->getLogo()) }}" alt="" class="flex-initial w-12 h-12 rounded shadow-lg">
                            <div class="ml-3">
                                <span class="block font-fjalla tracking-wider font-light uppercase text-yellow-500 text-11">{{ $season->tournament->game->name }}</span>
                                <span class="block font-semibold tracking-tight uppercase text-14">{{ $season->tournament->name }}</span>
                            </div>
                        </div>
                        <div class="p-3">
                            <div class="relative">
                                <div class="clearfix">
                                    <span class="float-left text-xs font-semibold inline-block text-{{ $season->tournament->game->platform->color }}-500">
                                        INSCRIPCIONES
                                    </span>
                                    <span class="float-right text-xs font-semibold inline-block text-{{ $season->tournament->game->platform->color }}-500">
                                        {{ $season->fill_places_percent() }}%
                                    </span>
                                </div>
                                <div class="overflow-hidden h-1 mt-1 mb-2 text-xs flex rounded bg-{{ $season->tournament->game->platform->color }}-200">
                                    <div style="width:{{ $season->fill_places_percent() }}%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-{{ $season->tournament->game->platform->color }}-500"></div>
                                </div>
                                <p class="text-right text-xs font-roboto-condensed text-11">
                                    {{ $season->fill_places() }} / {{ $season->num_participants }} PLAZAS
                                </p>
                            </div>
                        </div>
                        <div id="detail{{ $season->id }}" class="bg-{{ $season->tournament->game->platform->color }}-800 text-white absolute top-0 left-0 w-full h-full p-3 hidden animated uppercase text-13 font-roboto-condensed">
                            @if ($season->free_places() > 0)
                                <p class="text-center font-semibold">{{ $season->free_places() }} plazas Libres</p>
                                <div class="text-center py-3">
                                    <button class="bg-white text-teal-600 hover:bg-orange-500 hover:text-white font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1" type="button" style="transition: all .15s ease">
                                        @if ($season->inscription_price > 0)
                                            Inscríbete por {{ $season->inscription_price }} €!
                                        @else
                                            Inscríbete gratis!
                                        @endif
                                    </button>
                                </div>
                            @endif

                        </div>
                    </div>
                    <div class="bg-{{ $season->tournament->game->platform->color }}-800 px-3 py-2 text-white rounded-b-md text-center border-t-2 border-{{ $season->tournament->game->platform->color }}-600 uppercase" style="font-size: 12px">
                        {{ $season->tournament->game->platform->name }}
                    </div>
                </div>
                </a>
            @endforeach

        </div>
        <h1 class="font-fjalla uppercase tracking-wider text-orange-500 text-lg font-semibold pt-6 my-3">
            Listado completo
        </h1>
        <table class="bg-gray-800 w-full rounded-md">
            @foreach ($seasons as $season)
                <tr>
                    <td class="p-2">
                        {{ $season->tournament->name }}
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</div>