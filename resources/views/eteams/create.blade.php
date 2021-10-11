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

		<div class="max-w-full md:max-w-2xl mx-auto | my-8">
			<h4 class="text-xl lg:text-2xl text-title-color dark:text-white | font-raleway font-extrabold | tracking-wide | mb-6">
			    Registra tu equipo e-sports
			</h4>

	        @switch($step)
	            @case(1)
	                @include('eteams.create.step1')
	                @break
	            @case(2)
	                @include('eteams.create.step2')
	                @break
	        @endswitch

		</div>

    </x-container>
</div>