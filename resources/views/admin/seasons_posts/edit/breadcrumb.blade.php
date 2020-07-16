<li><a href="{{ route('admin') }}" class="breadcrumb-link">Dashboard</a></li>
<li><span class="breadcrumb-separator">/</span></li>
<li><a href="{{ route('admin.tournaments') }}" class="breadcrumb-link">Torneos</a></li>
<li><span class="breadcrumb-separator">/</span></li>
<li>{{ $tournament->name }} ({{ $tournament->game->name }} - {{ $tournament->game->platform->name }})</li>
<li><span class="breadcrumb-separator">/</span></li>
<li><a href="{{ route('admin.seasons', $tournament) }}" class="breadcrumb-link">Temporadas</a></li>
<li><span class="breadcrumb-separator">/</span></li>
<li>{{ $season->name }}</li>
<li><span class="breadcrumb-separator">/</span></li>
<li><a href="{{ route('admin.seasons_posts', [$tournament, $season]) }}" class="breadcrumb-link">Noticias</a></li>
<li><span class="breadcrumb-separator">/</span></li>
<li>Editar noticia #{{ $season_post->id }}</li>