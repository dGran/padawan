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
		<li class="{{ stripos(Request::route()->getName(), 'admin.tournaments') !== false ? 'current' : '' }}">
			<a href="{{ route('admin.tournaments') }}"><i class="icon-tournaments"></i>Torneos</a>
		</li>
		<li class="{{ stripos(Request::route()->getName(), 'admin.seasons') !== false ? 'current' : '' }}">
			<a href="{{ route('admin.seasons.selector') }}"><i class="icon-seasons"></i>Temporadas</a>
		</li>
		<li class="{{ stripos(Request::route()->getName(), 'admin.participants') !== false ? 'current' : '' }}">
			<a href="{{ route('admin.participants.selector') }}"><i class="icon-participants"></i>Participantes</a>
		</li>
		<li class="disabled {{-- {{ \Request::is('admin/juegos*') ? 'current' : '' }} --}}">
			<a {{-- href="{{ route('admin.games') }}" --}}><i class="icon-competitions"></i>Competiciones</a>
		</li>
		<li class="disabled {{-- {{ \Request::is('admin/juegos*') ? 'current' : '' }} --}}">
			<a {{-- href="{{ route('admin.games') }}" --}}><i class="icon-news"></i>Noticias</a>
		</li>
		<li class="disabled {{-- {{ \Request::is('admin/juegos*') ? 'current' : '' }} --}}">
			<a {{-- href="{{ route('admin.games') }}" --}}><i class="icon-economy"></i>Economía</a>
		</li>
		<li class="disabled {{-- {{ \Request::is('admin/juegos*') ? 'current' : '' }} --}}">
			<a {{-- href="{{ route('admin.games') }}" --}}><i class="icon-transfers"></i>Transfers</a>
		</li>
	</ul>

	<hr class="divider"/>
	<h6 class="section">e-Sports</h6>
	<ul class="menu md:mb-4">
		<li class="disabled {{-- {{ \Request::is('admin/juegos*') ? 'current' : '' }} --}}">
			<a {{-- href="{{ route('admin.games') }}" --}}><i class="icon-eteams"></i>E-Teams</a>
		</li>
		<li class="disabled {{-- {{ \Request::is('admin/juegos*') ? 'current' : '' }} --}}">
			<a {{-- href="{{ route('admin.games') }}" --}}><i class="icon-eplayers"></i>E-Players</a>
		</li>
	</ul>

	<hr class="divider"/>
	<h6 class="section">Tablas generales</h6>
	<ul class="menu md:mb-4">
		<li class="disabled {{-- {{ \Request::is('admin/juegos*') ? 'current' : '' }} --}}">
			<a {{-- href="{{ route('admin.games') }}" --}}><i class="icon-roles"></i>Roles</a>
		</li>
		<li class="{{ \Request::is('admin/usuarios*') ? 'current' : '' }}">
			<a href="{{ route('admin.users') }}"><i class="icon-users"></i>Usuarios</a>
		</li>
		<li class="{{ \Request::is('admin/plataformas*') ? 'current' : '' }}">
			<a href="{{ route('admin.platforms') }}"><i class="icon-platforms"></i>Plataformas</a>
		</li>
		<li class="{{ \Request::is('admin/juegos*') ? 'current' : '' }}">
			<a href="{{ route('admin.games') }}"><i class="icon-games"></i>Juegos</a>
		</li>
		<li class="{{ \Request::is('admin/equipos*') ? 'current' : '' }}">
			<a href="{{ route('admin.teams') }}"><i class="icon-teams"></i>Equipos</a>
		</li>
		<li class="{{ \Request::is('admin/base-datos-jugadores*') ? 'current' : '' }}">
			<a href="{{ route('admin.players_databases') }}"><i class="icon-db"></i>BD Jugadores</a>
		</li>
		<li class="{{ \Request::is('admin/jugadores*') ? 'current' : '' }}">
			<a href="{{ route('admin.players') }}"><i class="icon-players"></i>Jugadores</a>
		</li>
		<li class="{{ \Request::is('admin/posiciones*') ? 'current' : '' }}">
			<a href="{{ route('admin.positions') }}"><i class="icon-positions"></i>Posiciones</a>
		</li>
		<li class="{{ \Request::is('admin/circuitos*') ? 'current' : '' }}">
			<a href="{{ route('admin.circuits') }}"><i class="icon-circuits"></i>Circuitos</a>
		</li>
		<li class="disabled {{-- {{ \Request::is('admin/juegos*') ? 'current' : '' }} --}}">
			<a {{-- href="{{ route('admin.games') }}" --}}><i class="icon-zones"></i>Marcado de zonas</a>
		</li>
	</ul>

	<hr class="divider"/>
	<h6 class="section">Tienda</h6>
	<ul class="menu md:mb-4">
		<li class="disabled {{-- {{ \Request::is('admin/juegos*') ? 'current' : '' }} --}}">
			<a {{-- href="{{ route('admin.games') }}" --}}><i class="icon-categories"></i>Categorías</a>
		</li>
		<li class="disabled {{-- {{ \Request::is('admin/juegos*') ? 'current' : '' }} --}}">
			<a {{-- href="{{ route('admin.games') }}" --}}><i class="icon-products"></i>Productos</a>
		</li>
	</ul>

	<hr class="divider"/>
	<h6 class="section">Extra</h6>
	<ul class="menu md:mb-4">
		<li class="disabled {{-- {{ \Request::is('admin/juegos*') ? 'current' : '' }} --}}">
			<a {{-- href="{{ route('admin.games') }}" --}}><i class="icon-news"></i>Noticias</a>
		</li>
		<li class="disabled {{-- {{ \Request::is('admin/juegos*') ? 'current' : '' }} --}}">
			<a {{-- href="{{ route('admin.games') }}" --}}><i class="icon-pages"></i>Páginas</a>
		</li>
		<li class="disabled {{-- {{ \Request::is('admin/juegos*') ? 'current' : '' }} --}}">
			<a {{-- href="{{ route('admin.games') }}" --}}><i class="icon-menus"></i>Menu builder</a>
		</li>
	</ul>

</div>