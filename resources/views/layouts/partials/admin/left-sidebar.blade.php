<div class="bg-white dark:bg-dt-dark | border-b border-border-color dark:border-dt-border-color">
    <div class="hidden md:flex items-center py-2 h-14 px-3 border-b border-border-color dark:border-dt-border-color">
        <x-link href="{{ route('admin.dashboard') }}" class="flex items-center | focus:no-underline hover:no-underline">
            <i class="icon-logo | text-3xl"></i>
            <p class="ml-1.5">
                <span class="text-base font-semibold tracking-tighter | text-title-color dark:text-dt-title-color">Admin</span>
                <span class="text-base font-semibold tracking-tighter | text-title-color dark:text-dt-title-color">|</span>
                <span class="text-xs font-normal tracking-tighter | text-title-color dark:text-dt-title-color | uppercase">{{ config('app.name') }}</span>
            </p>
        </x-link>
    </div>
    <div class="py-4 | flex items-center justify-center">
        <div class="flex flex-col items-center leading-4">
	        <button class="group | focus:outline-none">
	            <img src="{{ auth()->user()->getAvatarUrl() }}" alt="{{ auth()->user() . " avatar" }}" class="rounded-full | object-cover | mt-1 w-9 h-9 | bg-edgray-150 dark:bg-gray-600 | border border-gray-200 dark:border-gray-600 | group-hover:border-gray-300 dark:group-hover:border-gray-500 | focus:outline-none group-focus:border-gray-300 dark:group-focus:border-gray-500 | transition duration-150 ease-in-out | cursor-pointer">
	        </button>
            <span class="text-sm mt-1.5">{{ auth()->user()->name }}</span>
	        <form method="POST" action="{{ route('logout') }}">
	            @csrf
				<x-link :href="route('logout')" class="text-xs" onclick="event.preventDefault(); this.closest('form').submit();">cerrar sesión</x-link>
	        </form>


            <a class='mt-4 px-4 py-2 | bg-gray-100 | border border-border-color dark:border-transparent rounded | text-xs font-normal text-edblue-700 | hover:font-semibold hover:scale-105 | focus:outline-none focus:font-semibold focus:scale-105 | transition transform ease-in-out duration-50' href="{{ route('dashboard') }}">
                <i class="fas fa-door-open mr-1.5"></i>Salir de Admin
            </a>
        </div>
    </div>
</div>

<ul class="p-2">
{{-- 	<li class="">
		<a href="#" class="flex items-center | px-4 py-2 mt-1 | text-sm | border border-transparent | rounded | hover:bg-gray-100 dark:hover:bg-dt-light-accent hover:border-border-color dark:hover:border-transparent hover:text-title-color dark:hover:text-dt-title-color | focus:bg-gray-100 dark:focus:bg-dt-light-accent focus:border-border-color dark:focus:border-transparent focus:outline-none | focus:text-title-color dark:focus:text-dt-title-color">
		    <i class="fas fa-th-large mr-3"></i>
		    <span>Normal</span>
		</a>
	</li>
	<li class="cursor-not-allowed">
		<a href="#" class="flex items-center | px-4 py-2 mt-1 | text-sm | text-text-light-color dark:text-dt-text-lighter-color border border-transparent | rounded | focus:outline-none | pointer-events-none">
		    <i class="fas fa-th-large mr-3"></i>
		    <span>Disable</span>
		</a>
	</li>
	<li class="cursor-wait | mb-14">
		<a href="#" class="flex items-center | px-4 py-2 mt-1 | text-sm | border border-transparent | rounded | bg-edblue-500 text-dt-title-color | focus:outline-none | pointer-events-none">
		    <i class="fas fa-th-large mr-3"></i>
		    <span>Active</span>
		</a>
	</li> --}}


	<li class="">
		<a href="#" class="flex items-center | px-4 py-2 mt-1 | text-sm | border border-transparent | rounded | hover:bg-gray-100 dark:hover:bg-dt-light-accent hover:border-border-color dark:hover:border-transparent hover:text-title-color dark:hover:text-dt-title-color | focus:bg-gray-100 dark:focus:bg-dt-light-accent focus:border-border-color dark:focus:border-transparent focus:outline-none | focus:text-title-color dark:focus:text-dt-title-color">
		    <i class="fas fa-th-large mr-3"></i>
		    <span>Dashboard</span>
		</a>
	</li>
	<li class="cursor-not-allowed">
		<a href="#" class="flex items-center | px-4 py-2 mt-1 | text-sm | text-text-light-color dark:text-dt-text-lighter-color border border-transparent | rounded | focus:outline-none | pointer-events-none">
		    <i class="fas fa-th-large mr-3"></i>
		    <span>Log</span>
		</a>
	</li>

	<li class="px-4 my-3 -mx-2 border-b border-border-color dark:border-dt-border-color"></li>
{{-- 	<li class="px-4 mt-6 mb-2 text-xs uppercase text-edblue-600 dark:text-edblue-400">
		<span>Tablas generales</span>
	</li> --}}
	<li class="">
		<a href="#" class="flex items-center | px-4 py-2 mt-1 | text-sm | border border-transparent | rounded | hover:bg-gray-100 dark:hover:bg-dt-light-accent hover:border-border-color dark:hover:border-transparent hover:text-title-color dark:hover:text-dt-title-color | focus:bg-gray-100 dark:focus:bg-dt-light-accent focus:border-border-color dark:focus:border-transparent focus:outline-none | focus:text-title-color dark:focus:text-dt-title-color">
		    <i class="fas fa-th-large mr-3"></i>
		    <span>Usuarios</span>
		</a>
	</li>
	<li class="cursor-not-allowed">
		<a href="#" class="flex items-center | px-4 py-2 mt-1 | text-sm | text-text-light-color dark:text-dt-text-lighter-color border border-transparent | rounded | focus:outline-none | pointer-events-none">
		    <i class="fas fa-th-large mr-3"></i>
		    <span>Plataformas</span>
		</a>
	</li>
	<li class="cursor-not-allowed">
		<a href="#" class="flex items-center | px-4 py-2 mt-1 | text-sm | text-text-light-color dark:text-dt-text-lighter-color border border-transparent | rounded | focus:outline-none | pointer-events-none">
		    <i class="fas fa-th-large mr-3"></i>
		    <span>Juegos</span>
		</a>
	</li>
	<li class="cursor-not-allowed">
		<a href="#" class="flex items-center | px-4 py-2 mt-1 | text-sm | text-text-light-color dark:text-dt-text-lighter-color border border-transparent | rounded | focus:outline-none | pointer-events-none">
		    <i class="fas fa-th-large mr-3"></i>
		    <span>Circuitos</span>
		</a>
	</li>

	<li class="px-4 my-3 -mx-2 border-b border-border-color dark:border-dt-border-color"></li>

	<li class="cursor-not-allowed | mb-14">
		<a href="#" class="flex items-center | px-4 py-2 mt-1 | text-sm | text-text-light-color dark:text-dt-text-lighter-color border border-transparent | rounded | focus:outline-none | pointer-events-none">
		    <i class="fas fa-th-large mr-3"></i>
		    <span>Usuarios</span>
		</a>
	</li>
</ul>