<div class="menu">
	<ul class="menu">
		<li class="items-center {{ \Request::is('admin') ? 'current' : '' }}">
			<a href="{{ route('admin') }}"><i class="fas fa-tv"></i>Dashboard</a>
		</li>
		<li class="items-center {{ \Request::is('admin/usuarios*') ? 'current' : '' }}">
			<a href="{{ route('admin.users') }}"><i class="fas fa-users"></i>Usuarios</a>
		</li>
		<li class="disabled items-center">
			<a href="#"><i class="fas fa-tools"></i>Settings (soon)</a>
		</li>
	</ul>

	<hr class="divider"/>

	<h6 class="section">Tablas generales</h6>
	<ul class="menu md:mb-4">
		<li class="disabled inline-flex">
			<a href="#">
				<i class="fas fa-tools"></i>
				Plataformas (soon)
			</a>
		</li>
		<li class="disabled inline-flex">
			<a href="#">
				<i class="fas fa-tools"></i>
				Juegos (soon)
			</a>
		</li>
	</ul>
</div>