<style>
	[class*=hint--]:after {
	    padding: 5px 8px;
	    font-size: 11px;
	}
	.box {
	  width: 200px; height: 300px;
	  position: relative;
	  border: 1px solid #BBB;
	  background: #EEE;
	}
	.ribbon {
	  position: absolute;
	  left: -5px; top: -5px;
	  z-index: 1;
	  overflow: hidden;
	  width: 75px; height: 75px;
	  text-align: right;
	}
	.ribbon span {
	  font-size: 10px;
	  font-weight: bold;
	  color: #FFF;
	  text-transform: uppercase;
	  text-align: center;
	  line-height: 20px;
	  transform: rotate(-45deg);
	  -webkit-transform: rotate(-45deg);
	  width: 100px;
	  display: block;
	  background: #79A70A;
	  background: linear-gradient(#B6BAC9 0%, #808080 100%);
	  box-shadow: 0 3px 10px -5px rgba(0, 0, 0, 1);
	  position: absolute;
	  top: 19px; left: -21px;
	}
	.ribbon span::before {
	  content: "";
	  position: absolute; left: 0px; top: 100%;
	  z-index: -1;
	  border-left: 3px solid #808080;
	  border-right: 3px solid transparent;
	  border-bottom: 3px solid transparent;
	  border-top: 3px solid #808080;
	}
	.ribbon span::after {
	  content: "";
	  position: absolute; right: 0px; top: 100%;
	  z-index: -1;
	  border-left: 3px solid transparent;
	  border-right: 3px solid #808080;
	  border-bottom: 3px solid transparent;
	  border-top: 3px solid #808080;
	}
</style>

<div class="antialiased font-sans w-full px-4 md:px-8">
    <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 pt-4 pb-2">
        @include('admin.racings.menu')
        {{-- <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded"> --}}
        <div class="flex-auto">
            <div class="border-b border-gray-400">
				<a href="{{ route('admin.racing.schedule.races.add', [$tournament, $season, $competition, $phase, $group]) }}" class="my-3 bg-teal-500 text-white hover:bg-teal-600 active:bg-teal-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none" type="button" style="transition: all .15s ease">
					<div class="flex items-center">
						<i class="icon-add mr-3 text-xl"></i>
						<span>Nueva carrera</span>
					</div>
				</a>
            </div>
            <h3 class="font-bold uppercase text-sm mt-2 mb-4">
                Calendario de carreras
            </h3>
            @if ($races->count() == 0)
	            <div class="bg-white shadow-md rounded-lg p-4 mt-2 mb-4">
					No existen carreras
	            </div>
			@else
				<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-3">
					@foreach ($races as $race)
			            <div class="{{ $race->results ? 'bg-gray-100 ' : 'bg-white' }}  shadow-md rounded-lg p-5 mt-2 mb-4 relative">
			            	@if ($race->results)
			            		<div class="ribbon"><span>FINALIZADA</span></div>
			            	@endif

			            	<div class="flex flex-row mb-4">
			            		<div class="flex flex-col border-r pr-2 mr-2 {{ $race->results ? 'text-gray-800' : 'text-pink-600' }} font-bold">
			            			<span class="text-center text-4xl font-bold tracking-wide" style="line-height: 1em">
			            				@if (!is_null($race->date))
			            					{{ date('d', strtotime($race->date)) }}
			            				@else
			            					N/D
			            				@endif
			            			</span>
			            			<div class="flex flex-row whitespace-no-wrap justify-center">
			            				<span class="uppercase" style="font-size: 11px">
			            					@if (!is_null($race->date))
			            						{{ date('M', strtotime($race->date)) }} |
			            					@else
			            						N/D
			            					@endif
			            				</span>
			            				<span class="uppercase ml-1" style="font-size: 11px">
			            					@if (!is_null($race->date))
			            						{{ date('H:i', strtotime($race->date)) }}
			            					@else
			            						N/D
			            					@endif
			            				</span>
			            			</div>
			            		</div>
			            		<div class="">
			            			<p class="font-semibold">{{ $race->name }}</p>
			            			<span class="block text-xs text-gray-700">{{ $race->circuit->name }}</span>
			            		</div>
			            	</div>
			            	<div class="">
			            		<img src="{{ $race->circuit->img() }}" alt="{{ $race->circuit->name }}" class="object-cover w-full h-auto rounded shadow-lg" style="{{ $race->results ? 'filter: grayscale(100%);' : '' }}">
								<button class="mt-4 w-full text-white font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none {{ $race->results ? 'bg-teal-500 hover:bg-teal-600 active:bg-teal-600' : 'bg-gray-500 hover:bg-gray-600 active:bg-gray-600' }}" type="button" style="transition: all .15s ease">
									{{ $race->results ? 'Ver resultados' : 'Editar resultados' }}
								</button>
								<button class="bg-gray-500 text-white hover:bg-gray-600 active:bg-gray-600 font-bold uppercase text-xs py-2 px-3 rounded-full shadow hover:shadow-md outline-none focus:outline-none hint--bottom hint--rounded hint--bounce" type="button" style="transition: all .15s ease; position: absolute; top: -10px; right: 48px" aria-label="Editar">
									<i class="icon-edit"></i>
								</button>
							<button class="bg-red-500 text-white hover:bg-red-600 active:bg-red-600 font-bold uppercase text-xs py-2 px-3 rounded-full shadow hover:shadow-md outline-none focus:outline-none hint--bottom hint--error hint--rounded hint--bounce" type="button" style="transition: all .15s ease; position: absolute; top: -10px; right: 8px" aria-label="Eliminar">
									<i class="icon-trash"></i>
								</button>
			            	</div>
			            </div>
					@endforeach
				</div>
            @endif
        </div>
    </div>
</div>