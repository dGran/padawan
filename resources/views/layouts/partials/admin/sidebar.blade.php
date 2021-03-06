<nav class="md:left-0 md:block md:fixed md:top-0 md:bottom-0 md:overflow-y-auto md:flex-row md:flex-no-wrap md:overflow-hidden shadow md:shadow-lg bg-white flex flex-wrap items-center justify-between relative md:w-64 z-10 py-2 px-4 md:px-10">
	<div class="md:flex-col md:items-stretch md:min-h-full md:flex-no-wrap px-0 flex flex-wrap items-center justify-between w-full mx-auto">
		{{-- top-menu --}}
		<button class="cursor-pointer text-black opacity-50 md:hidden py-1 text-xl leading-none bg-transparent rounded border border-solid border-transparent focus:outline-none" type="button" onclick="toggleNavbar('collapse-sidebar')">
	    	<i class="fas fa-bars"></i>
	    </button>
		<span class="md:block text-left md:pb-2 text-gray-700 mr-0 inline-block whitespace-no-wrap text-base uppercase font-bold p-4 px-0 cursor-default relative">
			Admin Panel
			<span class="absolute md:static text-center md:block text-teal-500" style="font-size: 9px; bottom: 5px; right: -23px; -webkit-transform: rotate(360deg); -moz-transform: rotate(360deg); -ms-transform: rotate(360deg); -o-transform: rotate(360deg); transform: rotate(360deg);">
				padawan sports
			</span>
		</span>
{{-- 		<div class="hidden md:block animated flash text-pink-600 infinite">
			Aqui falta poner la información del usuario, como el menu en la vista mobile
		</div> --}}
		<ul class="md:hidden items-center flex flex-wrap list-none">
			{{-- user --}}
			<li class="inline-block relative">
				<div @click.away="open = false" class="relative" x-data="{ open: false }">
					<button @click="open = !open" class="focus:outline-none align-middle md:pl-4">
						<img src="{{ auth()->user()->profile->avatar() }}" class="rounded-full w-8 h-8 lg:w-10 lg:h-10 object-cover overflow-hidden">
					</button>
					<div x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 origin-top-right rounded-md shadow-lg w-48 z-50">
						@include('layouts.partials.admin.user_menu')
					</div>
				</div>
			</li>
		</ul>


		<div class="border border-gray-300 md:border-transparent md:flex md:flex-col md:items-stretch md:opacity-100 md:relative md:mt-4 md:shadow-none shadow absolute top-0 left-0 right-0 z-40 overflow-y-auto overflow-x-hidden h-auto items-center flex-1 rounded hidden pb-8" id="collapse-sidebar">
			<div class="md:min-w-full md:hidden block pb-4 mb-4 border-b border-solid border-gray-300">
				<div class="flex flex-wrap">
					<div class="w-6/12">
						<span class="md:block text-left md:pb-2 text-gray-700 mr-0 inline-block whitespace-no-wrap text-sm uppercase font-bold p-4 px-0 cursor-default relative">
							Admin Panel
							<span class="absolute md:static text-center md:block text-teal-500" style="font-size: 9px; bottom: 5px; right: -23px; -webkit-transform: rotate(360deg); -moz-transform: rotate(360deg); -ms-transform: rotate(360deg); -o-transform: rotate(360deg); transform: rotate(360deg);">
								padawan sports
							</span>
						</span>
					</div>
					{{-- close-button --}}
					<div class="w-6/12 flex justify-end">
						<button type="button" class="cursor-pointer text-black opacity-50 md:hidden py-1 text-base font-bold leading-none bg-transparent rounded border border-solid border-transparent focus:outline-none" onclick="toggleNavbar('collapse-sidebar')">
							<i class="fas fa-times"></i>
						</button>
					</div>
				</div>
			</div>

			{{-- menu --}}
			@yield('menu')
		</div>
	</div>
</nav>