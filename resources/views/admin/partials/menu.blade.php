<div class="menu">

	<ul class="menu">
		<li class="{{ \Request::is('admin') ? 'current' : '' }}">
			<a href="{{ route('admin') }}"><i class="fas fa-tv"></i>Dashboard</a>
		</li>
		<li class="disabled {{-- {{ \Request::is('admin/juegos*') ? 'current' : '' }} --}}">
			<a {{-- href="{{ route('admin.games') }}" --}}><i class="icon-settings"></i>Settings</a>
		</li>
	</ul>

	<hr class="divider"/>
	<h6 class="section">Torneos</h6>
	<ul class="menu md:mb-4">
		<li class="disabled {{-- {{ \Request::is('admin/juegos*') ? 'current' : '' }} --}}">
			<a {{-- href="{{ route('admin.games') }}" --}}><i class="icon-eteams"></i>Torneos</a>
		</li>
		<li class="{{ \Request::is('admin/equipos*') ? 'current' : '' }}">
			<a href="{{ route('admin.teams') }}"><i class="icon-teams"></i>Equipos</a>
		</li>
		<li class="{{ \Request::is('admin/base-datos-jugadores*') ? 'current' : '' }}">
			<a href="{{ route('admin.players_databases') }}"><i class="icon-db"></i>BD Jugadores</a>
		</li>
		<li class="disabled {{-- {{ \Request::is('admin/juegos*') ? 'current' : '' }} --}}">
			<a {{-- href="{{ route('admin.games') }}" --}}><i class="icon-players"></i>Jugadores</a>
		</li>
		<li class="{{ \Request::is('admin/posiciones*') ? 'current' : '' }}">
			<a href="{{ route('admin.positions') }}"><i class="icon-positions"></i>Posiciones</a>
		</li>
		<li class="{{ \Request::is('admin/circuitos*') ? 'current' : '' }}">
			<a href="{{ route('admin.circuits') }}"><i class="icon-circuits"></i>Circuitos</a>
		</li>
		<li class="disabled {{-- {{ \Request::is('admin/juegos*') ? 'current' : '' }} --}}">
			<a {{-- href="{{ route('admin.games') }}" --}}><i class="icon-players"></i>Marcado de zonas</a>
		</li>
	</ul>

	<hr class="divider"/>
	<h6 class="section">e-Sports</h6>
	<ul class="menu md:mb-4">
		<li class="disabled {{-- {{ \Request::is('admin/juegos*') ? 'current' : '' }} --}}">
			<a {{-- href="{{ route('admin.games') }}" --}}><i class="icon-eteams"></i>Equipos</a>
		</li>
		<li class="disabled {{-- {{ \Request::is('admin/juegos*') ? 'current' : '' }} --}}">
			<a {{-- href="{{ route('admin.games') }}" --}}><i class="icon-rosters"></i>Jugadores</a>
		</li>
	</ul>

	<hr class="divider"/>
	<h6 class="section">Tablas generales</h6>
	<ul class="menu md:mb-4">
		<li class="{{ \Request::is('admin/usuarios*') ? 'current' : '' }}">
			<a href="{{ route('admin.users') }}"><i class="icon-users"></i>Usuarios</a>
		</li>
		<li class="{{ \Request::is('admin/plataformas*') ? 'current' : '' }}">
			<a href="{{ route('admin.platforms') }}"><i class="icon-platforms"></i>Plataformas</a>
		</li>
		<li class="{{ \Request::is('admin/juegos*') ? 'current' : '' }}">
			<a href="{{ route('admin.games') }}"><i class="icon-games"></i>Juegos</a>
		</li>
	</ul>

</div>