<li><a href="{{ route('home') }}" class="breadcrumb-link">Inicio</a></li>
<li><span class="breadcrumb-separator">/</span></li>
<li><a href="{{ route('tournaments') }}" class="breadcrumb-link">Torneos</a></li>
<li><span class="breadcrumb-separator">/</span></li>
<li>{{ $tournament->name }}</li>