<li><a href="{{ route('admin') }}" class="breadcrumb-link">Dashboard</a></li>
<li><span class="breadcrumb-separator">/</span></li>
<li><a href="{{ route('admin.tournaments') }}" class="breadcrumb-link">Torneos</a></li>
<li><span class="breadcrumb-separator">/</span></li>
<li>{{ $tournament->name }} ({{ $tournament->game->name }} - {{ $tournament->game->platform->name }})</li>
<li><span class="breadcrumb-separator">/</span></li>
<li><a href="{{ route('admin.seasons', $tournament->slug) }}" class="breadcrumb-link">Temporadas</a></li>
<li><span class="breadcrumb-separator">/</span></li>
<li>{{ $season->name }}</li>
<li><span class="breadcrumb-separator">/</span></li>
<li><a href="{{ route('admin.competitions', [$tournament, $season]) }}" class="breadcrumb-link">Competiciones</a></li>
<li><span class="breadcrumb-separator">/</span></li>
<li>{{ $competition->name }}</li>
<li><span class="breadcrumb-separator">/</span></li>
<li><a href="{{ route('admin.phases', [$tournament, $season, $competition]) }}" class="breadcrumb-link">Fases</a></li>
<li><span class="breadcrumb-separator">/</span></li>
<li><a href="{{ route('admin.groups', [$tournament, $season, $competition, $phase]) }}" class="breadcrumb-link">Grupos</a></li>
<li><span class="breadcrumb-separator">/</span></li>
<li>Nuevo</li>