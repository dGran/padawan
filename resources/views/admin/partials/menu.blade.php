<div class="menu">
	<ul class="menu">
		<li class="items-center {{ \Request::is('admin') ? 'current' : '' }}">
			<a href="{{ route('admin') }}"><i class="fas fa-tv"></i>Dashboard</a>
		</li>
		<li class="disabled items-center">
			<a href="#"><i class="fas fa-tools"></i>Settings (soon)</a>
		</li>
	</ul>

	<hr class="divider"/>

	<h6 class="section">Tablas generales</h6>
	<ul class="menu md:mb-4">

		<li class="items-center {{ \Request::is('admin/usuarios*') ? 'current' : '' }}">
			<a href="{{ route('admin.users') }}"><i class="fas fa-users"></i>Usuarios</a>
		</li>
		<li class="items-center {{ \Request::is('admin/plataformas*') ? 'current' : '' }}">
			<a href="{{ route('admin.platforms') }}"><i class="fas fa-users"></i>Plataformas</a>
		</li>
		<li class="items-center {{ \Request::is('admin/juegos*') ? 'current' : '' }}">
			<a href="{{ route('admin.games') }}"><i class="fas fa-users"></i>Juegos</a>
		</li>
		<li class="disabled inline-flex">
			<a href="#">
				<i class="fas fa-tools"></i>
				Equipos eSports (soon)
			</a>
		</li>
	</ul>
</div>