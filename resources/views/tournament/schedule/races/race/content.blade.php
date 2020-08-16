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
	<div class="bg-gray-900 px-4">

		<div class="race-banner" style="background: url('{{ asset('img/race_banner.png') }}') no-repeat 0 0;">
			<div class="flex items-center py-2 md:py-4">
				<img src="https://as01.epimg.net/img/comunes/fotos/fichas/paises/svg/aut.svg" alt="" class="h-10 w-10 rounded-full border border-white object-cover mr-2">
				<div class="flex-auto truncate mr-2 flex flex-row">
					<div class="flex flex-col truncate">
						<span class="leading-5 truncate">{{ $race->name }}</span>
						<span class="text-13 text-gray-400 leading-3 pt-1">
							{{ $race->circuit->name }}
						</span>
					</div>
				</div>
				<div class="flex-initial md:flex-auto text-right">
					<div class="text-center leading-6">
        				@if (!is_null($race->date))
        					<p class="date uppercase text-13 font-normal text-gray-400">
			            		<span>{{ $race->date->format('l, j') }}</span>
			            		<span>{{ str_replace(".", "", $race->date->format('M')) }}</span>
			            		<span>{{ $race->date->format('Y') }}</span>
        					</p>
        					<p class="hour text-28 text-yellow-600 pb-1">
								<span>{{ $race->date->format('H:i') }}</span>
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
				<i class="icon-economy block text-25"></i>
				<span class="text-10 uppercase">Circuito</span>
			</li>
			<li class="inline-block ml-3 text-center">
				<i class="icon-economy block text-25"></i>
				<span class="text-10 uppercase">Clasificación</span>
			</li>
			<li class="inline-block ml-3 text-center">
				<i class="icon-economy block text-25"></i>
				<span class="text-10 uppercase">Carrera</span>
			</li>
		</ul>

	</div>

	<div class="grid grid-cols-3 gap-2 md:gap-4 px-4 sm:px-24 md:px-32 lg:px-48 xl:px-64 py-4">
		<div class="border rounded-r bg-white border-l-0 relative">
			<div class="border-l-2 border-yellow-400 px-3 py-1">
				<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcRlxu7rHTW625hNZbSDqzPFxNp2I1rQr9r2tw&usqp=CAU" class="m-auto h-16 w-16 sm:w-20 sm:h-20 md:h-24 md:w-24 p-1 object-cover rounded-full shadow">
				<p class="pt-1 font-roboto-condensed font-semibold truncate text-11 sm:text-12 md:text-13 lg:text-14 text-center">Airton Senna</p>
				<img src="https://image.flaticon.com/icons/svg/199/199533.svg" style="position: absolute; top: 3px; left: 5px" class="w-6 h-6 md:w-8 md:h-8">
			</div>
		</div>
		<div class="border rounded-r bg-white border-l-0 relative">
			<div class="border-l-2 border-gray-400 px-3 py-1">
				<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/e0/Anonymous.svg/1200px-Anonymous.svg.png" class="m-auto h-16 w-16 sm:w-20 sm:h-20 md:h-24 md:w-24 p-1 object-cover rounded-full shadow">
				<p class="pt-1 font-roboto-condensed font-semibold truncate text-11 sm:text-12 md:text-13 lg:text-14 text-center">Airton Senna</p>
				<img src="https://image.flaticon.com/icons/svg/199/199563.svg" style="position: absolute; top: 3px; left: 5px" class="w-6 h-6 md:w-8 md:h-8">
			</div>
		</div>
		<div class="border rounded-r bg-white border-l-0 relative">
			<div class="border-l-2 border-orange-700 px-3 py-1">
				<img src="//as01.epimg.net/img/comunes/fotos/fichas/deportistas/v/val/100/24352.jpg" class="m-auto h-16 w-16 sm:w-20 sm:h-20 md:h-24 md:w-24 p-1 object-cover rounded-full shadow">
				<p class="pt-1 font-roboto-condensed font-semibold truncate text-11 sm:text-12 md:text-13 lg:text-14 text-center">Airton Senna</p>
				<img src="https://image.flaticon.com/icons/svg/199/199573.svg" style="position: absolute; top: 3px; left: 5px" class="w-6 h-6 md:w-8 md:h-8">
			</div>
		</div>

	</div>
</div>