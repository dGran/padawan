<div class="grid grid-cols-1 md:grid-cols-2 gap-2 bg-white">

    <div class="p-2">
        <h2>últimas noticias</h2>
        <div class="flex items-center mt-3 border-b mb-3 pb-3">
            <img src="{{ $tournament->game->img() }}" alt="" class="w-16 h-16 self-start rounded">
            <div class="ml-3 flex flex-col self-start text-gray-800">
                <p class="text-{{ $tournament->game->platform->color }}-700 font-semibold">PARTICIPACION</p>
                <p class="">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Labore iure magnam praesentium eveniet quod. Dignissimos molestias expedita quod repellat est maxime quae magni dolorem. Ab, nulla vel amet atque libero.</p>
            </div>
        </div>
        <div class="flex items-center mt-3 border-b mb-3 pb-3">
            <img src="{{ $tournament->game->img() }}" alt="" class="w-16 h-16 self-start rounded">
            <div class="ml-3 flex flex-col self-start text-gray-800">
                <p class="text-xs text-{{ $tournament->game->platform->color }}-700 font-semibold">RESULTADOS</p>
                <p class="text-xs">pAdRoNe reporta el partido jugado contra Belraus (3-0).</p>
            </div>
        </div>
        <div class="flex items-center mt-3 border-b mb-3 pb-3">
            <img src="{{ $tournament->game->img() }}" alt="" class="w-16 h-16 self-start rounded">
            <div class="ml-3 flex flex-col self-start">
                <p class="text-xs text-{{ $tournament->game->platform->color }}-700 font-semibold">PARTICIPACION</p>
                <p class="text-xs">pAdRoNe se ha inscrito.</p>
            </div>
        </div>
    </div>

    <div class="p-2">
        <h2>últimas noticias</h2>
        <div class="flex items-center mt-3 border-b mb-3 pb-3">
            <img src="{{ $tournament->game->img() }}" alt="" class="w-16 h-16 self-start rounded">
            <div class="ml-3 flex flex-col self-start">
                <p class="text-xs text-{{ $tournament->game->platform->color }}-700 font-semibold">PARTICIPACION</p>
                <p class="text-xs">pAdRoNe se ha inscrito.</p>
            </div>
        </div>
        <div class="flex items-center mt-3 border-b mb-3 pb-3">
            <img src="{{ $tournament->game->img() }}" alt="" class="w-16 h-16 self-start rounded">
            <div class="ml-3 flex flex-col self-start">
                <p class="text-xs text-{{ $tournament->game->platform->color }}-700 font-semibold">PARTICIPACION</p>
                <p class="text-xs">pAdRoNe se ha inscrito.</p>
            </div>
        </div>
        <div class="flex items-center mt-3 border-b mb-3 pb-3">
            <img src="{{ $tournament->game->img() }}" alt="" class="w-16 h-16 self-start rounded">
            <div class="ml-3 flex flex-col self-start">
                <p class="text-xs text-{{ $tournament->game->platform->color }}-700 font-semibold">PARTICIPACION</p>
                <p class="text-xs">pAdRoNe se ha inscrito.</p>
            </div>
        </div>
    </div>
</div>