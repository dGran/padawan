<div class="custom-container">
    <div class="my-8">
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
                        <p class="text-gray-700 text-base">
                          {{-- Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus quia, nulla! Maiores et perferendis eaque, exercitationem praesentium nihil. --}}
                        </p>
                      </div>
                      <div class="px-4 py-4">
                        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-xs font-semibold text-gray-700 mr-1">#{{ $tournament->game->name }}</span>
                        {{-- <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-xs font-semibold text-gray-700">#{{ $tournament->game->platform->name }}</span> --}}
                      </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>
