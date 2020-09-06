<div class="flex flex-wrap">
    <div class="w-full mx-auto overflow-x-auto">
        <ul class="racing-menu">
            <li class="ml-2 {{ \Request::route()->getName() == 'admin.league.standings' ? 'current order-first' : '' }}">
                <a href="{{ route('admin.league.standings', [$tournament, $season, $competition, $phase, $group]) }}">Clasificaciones</a>
            </li>
            <li class="ml-2 {{ stripos(Request::route()->getName(), 'admin.league.schedule') !== false ? 'current order-first' : '' }}">
                <a href="{{ route('admin.league.schedule', [$tournament, $season, $competition, $phase, $group]) }}">Calendario</a>
            </li>
            <li class="ml-2 {{ \Request::route()->getName() == 'admin.league.config' ? 'current order-first' : '' }}">
                <a href="{{ route('admin.league.config', [$tournament, $season, $competition, $phase, $group]) }}">Configuración</a>
            </li>
        </ul>
    </div>
</div>