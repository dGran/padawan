<div class="eteam-menu {{ $eteam->game->platform->color }} rounded-t">
	<ul>
		<li class="{{ \Request::route()->getName() == 'eteam' ? 'current' : '' }}">
			<a href="{{ route('eteam', $eteam->slug) }}">
				<i class="fas fa-id-card-alt"></i>
				<span>Info</span>
			</a>
		</li>
		<li class="{{ \Request::route()->getName() == 'eteam.members' ? 'current' : '' }}">
			<a href="{{ route('eteam.members', $eteam->slug) }}">
				<i class="fas fa-users"></i>
				<span>Miembros</span>
			</a>
		</li>
		<li class="disable {{ \Request::route()->getName() == 'eteam.stats' ? 'current' : '' }}">
			<a href="{{ route('eteam.stats', $eteam->slug) }}">
				<i class="far fa-chart-bar"></i>
				<span>Estadísticas</span>
			</a>
		</li>
		@if ($eteam->userIsAdmin())
			<li class="{{ \Request::route()->getName() == 'eteam.admin' ? 'current' : '' }}">
				<a href="{{ route('eteam.admin', $eteam->slug) }}">
					<i class="fas fa-user-edit"></i>
					<span>Admin</span>
				</a>
			</li>
		@endif
	</ul>
</div> {{-- eteam-menu --}}