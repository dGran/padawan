<style>
	.tops li:before {
		content: "";
	    z-index: 2;
	    position: absolute;
	    top: 0;
	    left: 0;
	    border: 25px solid transparent;
	    border-top-color: #d20000;
	    border-left-color: #d20000;
	}
</style>

<div class="content">
	<div class="race-content">
		<div class="bg-gray-900 px-4">

			<div class="race-banner" style="background: url('{{ asset('img/race_banner.png') }}') no-repeat 0 0;">
				<div class="flex items-center py-2 md:py-4">
					<img src="https://as01.epimg.net/img/comunes/fotos/fichas/paises/svg/aut.svg" alt="" class="h-10 w-10 rounded-full border border-white object-cover mr-2">
					<div class="flex-1 truncate mr-2 flex flex-row">
						<div class="flex flex-col truncate">
							<span class="leading-5 truncate">
								{{ $race->name }}
							</span>
							<span class="text-13 text-gray-400 leading-3 pt-1 truncate">
								{{ $race->circuit->name }}
							</span>
						</div>
					</div>
					<div class="flex-inital text-right">
						<div class="text-center leading-6">
							@if (!$race->finished())
		        				@if (!is_null($race->date))
		        					<p class="date uppercase text-11 md:text-13 font-normal text-gray-400">
					            		<span>{{ $race->date->format('l, j') }}</span>
					            		<span>{{ str_replace(".", "", $race->date->format('M')) }}</span>
					            		<span>{{ $race->date->format('Y') }}</span>
		        					</p>
		        					<p class="hour text-25 md:text-28 text-yellow-600 pb-1">
										<span>{{ $race->date->format('H:i') }}</span>
		        					</p>
		        				@endif
		        			@else
	        					<p class="uppercase text-11 md:text-13 font-normal text-gray-400">
									CARRERA
	        					</p>
	        					<p class="text-20 md:text-28 text-yellow-600 pb-1">
									FINALIZADA
	        					</p>
		        			@endif
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="submenu bg-white shadow border-b p-2 text-center">
			<ul>
				<li class="inline-block text-center">
					{{-- <i class="icon-economy block text-25"></i> --}}
					<img src="https://image.flaticon.com/icons/svg/1074/1074666.svg" class="h-8 w-8 m-auto">
					<span class="text-9 uppercase">Circuito</span>
				</li>
				<li class="inline-block ml-6 text-center">
					{{-- <i class="icon-economy block text-25"></i> --}}
					<img src="https://image.flaticon.com/icons/svg/1789/1789066.svg" class="h-8 w-8 m-auto">
					<span class="text-9 uppercase">Calificación</span>
				</li>
				<li class="inline-block ml-6 text-center">
					{{-- <i class="icon-economy block text-25"></i> --}}
					<img src="https://image.flaticon.com/icons/svg/1016/1016068.svg" class="h-8 w-8 m-auto">
					<span class="text-9 uppercase">Carrera</span>
				</li>
				<li class="inline-block ml-6 text-center">
					{{-- <i class="icon-economy block text-25"></i> --}}
					<img src="https://image.flaticon.com/icons/svg/833/833409.svg" class="h-8 w-8 m-auto">
					<span class="text-9 uppercase">Multimedia</span>
				</li>
			</ul>

		</div>

	</div>
</div>