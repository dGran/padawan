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
                @case(3)
                    @include('eteams.create.step3')
                    @break
                @case(4)
                    @include('eteams.create.step4')
                    @break
	        @endswitch

		</div>

    </x-container>
</div>

@push('custom-scripts')
	<script>
	   window.livewire.on('focus-step-2', function () {
	        $("#name").focus();
	    });
	   window.livewire.on('focus-step-3', function () {
	        $("#whatsapp").focus();
	    });
	   window.livewire.on('focus-step-4', function () {
	        $("#presentation").focus();
	    });
	</script>
@endpush