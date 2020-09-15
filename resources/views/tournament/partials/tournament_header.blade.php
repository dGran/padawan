<figure class="banner">
    <img src="{{ asset($tournament->getBanner()) }}" alt="{{ $tournament->name }}">
</figure>

<div class="platform-content {{ $tournament->game->platform->color }}">

    <nav class="breadcrumb">
        <ol class="list-reset">
            @yield('breadcrumb')
        </ol>
    </nav>

    <div class="tournament-info">
    	<figure class="logo">
        	<img src="{{ asset($tournament->getLogo()) }}" alt="{{ $tournament->name }}">
        </figure>
        <div class="info">
            <span class="name">{{ $tournament->name }}</span>
            <span class="game"><b>Juego:</b> {{ $tournament->game->name }}</span>
            <span class="platform"><b>Plataforma:</b> {{ $tournament->game->platform->name }}</span>
            <span class="participation mt-1">
            	<b>Participación:</b> {{ $tournament->participant_type == "individual" ? 'Individual' : 'Equipos e-Sports' }}
            </span>
        </div>
    </div>

    <div class="menu overflow-x-auto">
        <ul>
            <li class="{{ Request::route()->getName() == 'tournament' ? 'active' : 'item' }}">
                <a href="{{ route('tournament', [$tournament, $season]) }}">Inicio</a>
            </li>
            <li class="{{ Request::route()->getName() == 'tournament.rules' ? 'active' : 'item' }}">
                <a href="{{ route('tournament.rules', [$tournament, $season]) }}">Normativa</a>
            </li>
            <li class="{{ Request::route()->getName() == 'tournament.standing' ? 'active' : 'item' }}">
                <a href="{{ route('tournament.standing', [$tournament, $season, isset($competition) ? $competition : '', isset($phase) ? $phase : '', isset($group) ? $group : '']) }}">Clasificación</a>
            </li>
            <li class="{{ stripos(Request::route()->getName(), 'tournament.schedule') !== false ? 'active' : 'item' }}">
                <a href="{{ route('tournament.schedule', [$tournament, $season, isset($competition) ? $competition : '', isset($phase) ? $phase : '', isset($group) ? $group : '']) }}">Calendario</a>
            </li>
            <li class="{{ Request::route()->getName() == 'tournament.participants' ? 'active' : 'item' }}">
                <a href="{{ route('tournament.participants', [$tournament, $season]) }}">Participantes</a>
            </li>
        </ul>
    </div>

</div> {{-- platform-content --}}
