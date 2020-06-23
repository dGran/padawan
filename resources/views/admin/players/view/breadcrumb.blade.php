<li><a href="{{ route('admin') }}" class="breadcrumb-link">Dashboard</a></li>
<li><span class="breadcrumb-separator">/</span></li>
<li><a href="{{ route('admin.teams') }}" class="breadcrumb-link">Jugadores</a></li>
<li><span class="breadcrumb-separator">/</span></li>
<li>{{ $player->name }}</li>