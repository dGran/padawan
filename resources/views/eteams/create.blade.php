<div>
	{{-- breadcrumb --}}
	@section('breadcrumb')
	    <li class="min-w-max">
	        <x-link class="" href="{{ route('dashboard') }}">Inicio</x-link><span class="px-1.5">/</span>
	    </li>
	    <li class="min-w-max">
	        <x-link class="" href="{{ route('eteams.index') }}">Equipos e-sports</x-link><span class="px-1.5">/</span>
	    </li>
	    <li class="min-w-max">
	        <span>Nuevo equipo</span>
	    </li>
	@endsection

    <x-container>

        @switch($paso)
            @case(1)
                @include('eteams.create.step1')
                @break
            @case(2)
                @include('eteams.create.step2')
                @break
        @endswitch

    </x-container>
</div>