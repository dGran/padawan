<div>

	{{-- breadcrumb --}}
{{-- 	@section('breadcrumb')
	    <li class="min-w-max">
	        <x-link class="" href="{{ route('dashboard') }}">Inicio</x-link><span class="px-1.5">/</span>
	    </li>
	    <li class="min-w-max">
	        <span>Equipos e-sports</span>
	    </li>
	@endsection --}}


	<div class="relative">
	    <div class="banner-landing bg-teal-700 dark:bg-teal-900 relative overflow-hidden">
	        <x-container class="py-6 md:py-10 text-white">
	            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-16 gap-y-12">
	                <div class="flex flex-col justify-center text-center px-6 md:text-left md:px-0">
	                    <p class="text-2xl md:text-3xl | font-raleway font-extrabold">
	                        Registra tu equipo
	                    </p>
{{-- 	                    <p class="text-lg md:text-xl | font-raleway font-bold | text-edyellow-300 | pt-2">
	                        de los juegos que ofrecemos
	                    </p> --}}
		                    <p class="text-2xl md:text-3xl | font-raleway font-extrabold | pt-2">
	                        y participa en los torneos y campeonatos
	                    </p>
	                    <p class="text-teal-200 | text-normal md:text-base | pt-6">
	                        Tendrás acceso a un control de usuarios, panel de noticias privado, buscar nuevos miembros... para participar en los torneos de Padawan e-sports
	                    </p>
	                    <a class='mt-8 mx-auto md:mx-0 px-4 py-2 w-max | bg-white | border border-white rounded | font-semibold text-teal-700 | hover:scale-105 | focus:outline-none focus:scale-105 | transition transform ease-in-out duration-50 | select-none | cursor-pointer' href="{{ route('eteams.create') }}">
	                        Registra tu equipo e-sport!
	                    </a>
	                </div>

	                <div class="">
	                    <div class="flex flex-col justify-center items-center gap-8 h-full">
	                        <img src="https://storage.googleapis.com/ltr-stateless/2020/09/598aff03-form.png" alt="Padawan e-sports" class="w-32 md:w-48">
{{--                             <i class="icon-fifa text-4xl"></i>
	                        <i class="icon-efootball text-4xl"></i>
	                        <i class="icon-gtracing text-5xl"></i> --}}
	                        </ul>
	                    </div>
	                </div>
	            </div>
	        </x-container>
	    </div>
	</div>


    <x-container>

        <h4 class="mt-8 | font-semibold | font-fjalla | uppercase | text-xl md:text-2xl | tracking-wider | text-title-color dark:text-dt-title-color">Equipos e-sports</h4>

        <section class="mt-4 mb-6 md:mt-6 md:mb-8">

        	<div class="mb-4">
	        	<x-input type="search" wire:model="name" placeholder="Buscar..." class="w-full"></x-input>
        	</div>

        	<div class="my-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">
            	@foreach ($eteams as $eteam)
            		<a class="group | bg-white dark:bg-dt-dark rounded-md p-4 | hover:bg-gray-100 dark:hover:bg-dt-light-accent | focus:bg-gray-100 dark:focus:bg-dt-light-accent" href="{{ route('eteams.eteam', $eteam->slug) }}">
            			{{-- <img src="{{ $eteam->banner }}" alt="" class=""> --}}
            			<div class="flex items-start justify-between">
	            			<img src="{{ $eteam->getLogo() }}" alt="" class="w-24 h-24 rounded-full bg-white object-contain p-0.5 | border border-gray-200 dark:border-edgray-600">
	            			<div class="flex-1 flex flex-col ml-3 mt-0.5">
		            			<p class="font-semibold text-normal uppercase text-title-color dark:text-dt-title-color">
		            				{{ $eteam->name }}
		            			</p>
		            			<p class="text-xs mt-1.5">
		            				{{ $eteam->location }}
		            			</p>
		            			@if ($eteam->country)
			            			<p class="text-xs flex items-center">
			            				{{ $eteam->getCountryName() }}
			            			</p>
		            			@endif
		            			<p class="text-xxs mt-1.5">
		            				{{ $eteam->posts()->count() }} {{ $eteam->posts()->count() == 1 ? 'noticia' : 'noticias' }}
		            			</p>
	            			</div>
	            			@if ($eteam->country)
		            			<div class="flex flex-col items-center">
			            			<img src="{{ $eteam->country->getFlag24() }}" alt="{{ $eteam->getCountryName() }}" title="{{ $eteam->getCountryName() }}" class="">
			            			<span class="text-xxxs | mt-1 | uppercase">{{ $eteam->country->alpha_3 }}</span>
		            			</div>
	            			@endif
            			</div>
            			<div class="border-t border-border-color dark:border-dt-border-color | group-hover:border-gray-200 dark:group-hover:border-edgray-675 | mt-3 pt-3 | flex items-center justify-between">
            				{{ $eteam->game->name }}
            				<p class="flex items-center">
            					<i class="icon-users text-base"></i><span class="ml-2 text-sm">{{ $eteam->users()->count() }}</span>
            				</p>
            			</div>
            		</a>
            	@endforeach
        	</div>
        </section>

    </x-container>
</div>