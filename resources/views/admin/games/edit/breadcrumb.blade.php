<li><a href="{{ route('admin') }}" class="breadcrumb-link">Dashboard</a></li>
<li><span class="breadcrumb-separator">/</span></li>
<li><a href="{{ route('admin.games') }}" class="breadcrumb-link">Juegos</a></li>
<li><span class="breadcrumb-separator">/</span></li>
<li>{{ $game->name }}</li>