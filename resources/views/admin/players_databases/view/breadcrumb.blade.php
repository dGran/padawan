<li><a href="{{ route('admin') }}" class="breadcrumb-link">Dashboard</a></li>
<li><span class="breadcrumb-separator">/</span></li>
<li><a href="{{ route('admin.players_databases') }}" class="breadcrumb-link">BD Jugadores</a></li>
<li><span class="breadcrumb-separator">/</span></li>
<li>{{ $player_database->name }}</li>