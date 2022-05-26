<li class="min-w-max">
    <x-link class="" href="{{ route('dashboard') }}">Inicio</x-link><span class="px-1.5">/</span>
</li>
<li class="min-w-max">
    <x-link class="" href="{{ route('eteams.index') }}">Equipos e-sports</x-link><span class="px-1.5">/</span>
</li>
<li class="min-w-max">
    <span>{{ $eteam->name }}</span>
</li>