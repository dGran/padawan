<div class="custom-container">
    <div class="my-8">
        <h1 class="font-fjalla uppercase tracking-wider text-orange-500 text-lg font-semibold">
            Listado de torneos
        </h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 {{-- lg:grid-cols-5 --}} gap-8 mb-8">
            @foreach ($tournaments as $tournament)
{{--                 <a href="{{ route('tournaments.view', $tournament) }}">
                    <div class="max-w-sm rounded overflow-hidden shadow-lg bg-white text-gray-700 mt-8">
                      <img class="w-full p-3" src="{{ $tournament->img() }}" alt="Sunset in the mountains">
                      <div class="px-6 py-4">
                        <div class="font-bold text-xl mb-2">{{ $tournament->name }}</div>
                        <p class="text-gray-700 text-base">
                          Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus quia, nulla! Maiores et perferendis eaque, exercitationem praesentium nihil.
                        </p>
                      </div>
                      <div class="px-4 py-4">
                        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-xs font-semibold text-gray-700 mr-1">#{{ $tournament->game->name }}</span>
                        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-xs font-semibold text-gray-700">#{{ $tournament->game->platform->name }}</span>
                      </div>
                    </div>
                </a> --}}

<div class="max-w-sm w-full lg:max-w-full lg:flex">
  <div class="h-48 lg:h-auto lg:w-48 flex-none bg-cover rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden" style="background-image: url('{{ $tournament->img() }}')" title="Woman holding a mug">
  </div>
  <div class="border-r border-b border-l border-gray-400 lg:border-l-0 lg:border-t lg:border-gray-400 bg-white rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal">
    <div class="mb-8">
      <p class="text-sm text-gray-600 flex items-center">
        <svg class="fill-current text-gray-500 w-3 h-3 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
          <path d="M4 8V6a6 6 0 1 1 12 0v2h1a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-8c0-1.1.9-2 2-2h1zm5 6.73V17h2v-2.27a2 2 0 1 0-2 0zM7 6v2h6V6a3 3 0 0 0-6 0z" />
        </svg>
        Members only
      </p>
      <div class="text-gray-900 font-bold text-xl mb-2">Can coffee make you a better developer?</div>
      <p class="text-gray-700 text-base">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus quia, nulla! Maiores et perferendis eaque, exercitationem praesentium nihil.</p>
    </div>
    <div class="flex items-center">
      <img class="w-10 h-10 rounded-full mr-4" src="{{ $tournament->img() }}" alt="Avatar of Jonathan Reinink">
      <div class="text-sm">
        <p class="text-gray-900 leading-none">Jonathan Reinink</p>
        <p class="text-gray-600">Aug 18</p>
      </div>
    </div>
  </div>
</div>

{{--                 <div class="mt-8">
                    <a href="#" class="block">
                        <img src="{{ $tournament->img() }}" alt="" class="hover:opacity-75 transition ease-in-out duration-150" width="120">
                    </a>
                    <div class="mt-2">
                        <a href="#" class="text-lg hover:text-gray-300">
                            {{ $tournament->name }}
                        </a>
                        <div class="flex items-center text-gray-400 text-sm mt-1">
                            <i class="fas fa-star text-orange-500"></i>
                            <span class="ml-1">85%</span>
                            <span class="mx-2">|</span>
                            <span>Feb 20, 2020</span>
                        </div>
                        <div class="text-gray-400 text-sm">
                            {{ $tournament->game->name }} - {{ $tournament->game->platform->name }}
                        </div>
                    </div>
                </div> --}}
            @endforeach
        </div>

    </div>
</div>