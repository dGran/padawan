<figure class="banner">
    <img src="{{ asset('img/games/' . $tournament->game->banner) }}" alt="{{ $tournament->name }}">
</figure>

<div class="platform-content {{ $tournament->game->platform->color }}">

    <nav class="breadcrumb">
        <ol class="list-reset">
            <li class="link"><a href="{{ route('home') }}">Padawan</a></li>
            <li class="separator"></li>
            <li class="link"><a href="{{ route('tournaments') }}">Torneos</a></li>
            <li class="separator"></li>
            <li class="current">{{ $tournament->name }}</li>
        </ol>
    </nav>

    <div class="tournament-info">
    	<figure class="logo">
        	<img src="{{ $tournament->game->img() }}" alt="{{ $tournament->name }}">
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
            <li class="{{ Request::route()->getName() == 'tournament' ? 'active' : 'item' }}"><a href="{{ route('tournament', $tournament) }}">Inicio</a></li>
            <li class="{{ Request::route()->getName() == 'tournament.rules' ? 'active' : 'item' }}"><a href="{{ route('tournament.rules', $tournament) }}">Normativa</a></li>
            @if ($tournament->seasons->first()->competitions->count() > 1)
                <li class="item"><a href="#">Competiciones</a></li>
            @else
                <li class="{{ Request::route()->getName() == 'tournament.schedule' ? 'active' : 'item' }}"><a href="{{ route('tournament.schedule', $tournament) }}">Calendario</a></li>
                <li class="{{ Request::route()->getName() == 'tournament.standing' ? 'active' : 'item' }}"><a href="{{ route('tournament.standing', $tournament) }}">Clasificación</a></li>
            @endif
            <li class="{{ Request::route()->getName() == 'tournament.participants' ? 'active' : 'item' }}"><a href="{{ route('tournament.participants', $tournament) }}">Participantes</a></li>
        </ul>
    </div>

</div> {{-- platform-content --}}
