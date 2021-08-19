<div class="md:py-6 md:border-b dark:border-dark-800">
	<x-container class="md:hidden select-none">
		<ul x-data="{selected:null}">
		    <li class="flex align-center flex-col -mx-4">
		        <a @click="selected !== 1 ? selected = 1 : selected = null"
		            class="cursor-pointer | px-4 py-3 | border-b dark:border-dark-800 | font-miriam font-semibold uppercase tracking-widest text-left text-sm | text-gray-700 dark:text-dark-light | inline-block | flex justify-between">
		            <span>menu</span>
		            <span><i x-bind:class="{ 'fas fa-angle-down' : selected !== 1, 'fas fa-angle-up' : selected == 1 }" class="transition duration-150 ease-in-out"></i></span>
		        </a>
		        <div x-show="selected == 1" class="bg-gray-50 dark:bg-dark-800 border-b dark:border-dark-800 px-6 py-1.5"
		            x-transition:enter="transition ease-out duration-300 origin-top"
		            x-transition:enter-start="opacity-0 transform scale-y-0"
		            x-transition:enter-end="opacity-100 transform scale-y-100"
		            x-transition:leave="transition ease-in duration-150 origin-top"
		            x-transition:leave-start="opacity-100 transform scale-y-100"
		            x-transition:leave-end="opacity-0 transform scale-y-0">
		            <ul class="flex flex-col | leading-6 text-xs uppercase font-medium tracking-wide | py-2">
		                <li class="py-1"><a href="{{ route('welcome') }}" class="block | text-gray-500 dark:text-dark-normal | hover:text-gray-700 dark:hover:text-dark-light | focus:outline-none focus:text-gray-700 dark:focus:text-dark-light | transition duration-150 ease-in-out">Welcome</a></li>
		                <li class="py-1"><a href="{{ route('dashboard') }}" class="block | text-xs uppercase font-medium text-gray-500 dark:text-dark-normal | hover:text-gray-700 dark:hover:text-dark-light | focus:outline-none focus:text-gray-700 dark:focus:text-dark-light | transition duration-150 ease-in-out">Dashboard</a></li>
		            </ul>
		        </div>
		    </li>
		    <li class="flex align-center flex-col -mx-4">
		        <a @click="selected !== 2 ? selected = 2 : selected = null"
		            class="cursor-pointer | px-4 py-3 | border-b dark:border-dark-800 | font-miriam font-semibold uppercase tracking-widest text-left text-sm | text-gray-700 dark:text-dark-light | inline-block | flex justify-between">
		            <span>padawan</span>
		            <span><i x-bind:class="{ 'fas fa-angle-down' : selected !== 2, 'fas fa-angle-up' : selected == 2 }" class="transition duration-150 ease-in-out"></i></span>
		        </a>
		        <div x-show="selected == 2" class="bg-gray-50 dark:bg-dark-800 border-b dark:border-dark-800 px-6 py-1.5"
		            x-transition:enter="transition ease-out duration-300 origin-top"
		            x-transition:enter-start="opacity-0 transform scale-y-0"
		            x-transition:enter-end="opacity-100 transform scale-y-100"
		            x-transition:leave="transition ease-in duration-150 origin-top"
		            x-transition:leave-start="opacity-100 transform scale-y-100"
		            x-transition:leave-end="opacity-0 transform scale-y-0">
		            <ul class="flex flex-col | leading-6 text-xs uppercase font-medium tracking-wide | py-2">
		                <li class="py-1"><a href="{{ route('welcome') }}" class="block | text-gray-500 dark:text-dark-normal | hover:text-gray-700 dark:hover:text-dark-light | focus:outline-none focus:text-gray-700 dark:focus:text-dark-light | transition duration-150 ease-in-out">Welcome</a></li>
		                <li class="py-1"><a href="{{ route('dashboard') }}" class="block | text-xs uppercase font-medium text-gray-500 dark:text-dark-normal | hover:text-gray-700 dark:hover:text-dark-light | focus:outline-none focus:text-gray-700 dark:focus:text-dark-light | transition duration-150 ease-in-out">Dashboard</a></li>
		            </ul>
		        </div>
		    </li>
		    <li class="flex align-center flex-col -mx-4">
		        <a @click="selected !== 3 ? selected = 3 : selected = null"
		            class="cursor-pointer | px-4 py-3 | border-b dark:border-dark-800 | font-miriam font-semibold uppercase tracking-widest text-left text-sm | text-gray-700 dark:text-dark-light | inline-block | flex justify-between">
		            <span>legal</span>
		            <span><i x-bind:class="{ 'fas fa-angle-down' : selected !== 3, 'fas fa-angle-up' : selected == 3 }" class="transition duration-150 ease-in-out"></i></span>
		        </a>
		        <div x-show="selected == 3" class="bg-gray-50 dark:bg-dark-800 border-b dark:border-dark-800 px-6 py-1.5"
		            x-transition:enter="transition ease-out duration-300 origin-top"
		            x-transition:enter-start="opacity-0 transform scale-y-0"
		            x-transition:enter-end="opacity-100 transform scale-y-100"
		            x-transition:leave="transition ease-in duration-150 origin-top"
		            x-transition:leave-start="opacity-100 transform scale-y-100"
		            x-transition:leave-end="opacity-0 transform scale-y-0">
		            <ul class="flex flex-col | leading-6 text-xs uppercase font-medium tracking-wide | py-2">
		                <li class="py-1"><a href="{{ route('cookie-policy') }}" class="block | text-gray-500 dark:text-dark-normal | hover:text-gray-700 dark:hover:text-dark-light | focus:outline-none focus:text-gray-700 dark:focus:text-dark-light | transition duration-150 ease-in-out">Política de cookies</a></li>
		                <li class="py-1"><a href="{{ route('privacity-policy') }}" class="block | text-xs uppercase font-medium text-gray-500 dark:text-dark-normal | hover:text-gray-700 dark:hover:text-dark-light | focus:outline-none focus:text-gray-700 dark:focus:text-dark-light | transition duration-150 ease-in-out">Política de privacidad</a></li>
		            </ul>
		        </div>
		    </li>
		    {{-- @hasrole('') @endhasrole --}}
		</ul>
	</x-container>

{{-- md or highter view --}}
	<x-container class="hidden md:block">
		<div class="flex items-start gap-16 select-none">
			<div>
		        <h4 class="font-miriam font-semibold uppercase tracking-widest text-md | text-gray-700 dark:text-dark-light">menu</h4>
		        <ul class="flex flex-col | list-none | leading-6 text-xs uppercase font-medium tracking-wide | pt-4">
		            <li class="py-1"><a href="{{ route('welcome') }}" class="block | text-gray-500 dark:text-dark-normal | hover:text-gray-700 dark:hover:text-dark-light | focus:outline-none focus:text-gray-700 dark:focus:text-dark-light | transition duration-150 ease-in-out">Welcome</a></li>
		            <li class="py-1"><a href="{{ route('dashboard') }}" class="block | text-gray-500 dark:text-dark-normal | hover:text-gray-700 dark:hover:text-dark-light | focus:outline-none focus:text-gray-700 dark:focus:text-dark-light | transition duration-150 ease-in-out">Dashboard</a></li>
		        </ul>
			</div>

			<div>
		        <h4 class="font-miriam font-semibold uppercase tracking-widest text-md | text-gray-700 dark:text-dark-light">padawan</h4>
		        <ul class="flex flex-col | list-none | leading-6 text-xs uppercase font-medium tracking-wide | pt-4">
		            <li class="py-1"><a href="{{ route('welcome') }}" class="block | text-gray-500 dark:text-dark-normal | hover:text-gray-700 dark:hover:text-dark-light | focus:outline-none focus:text-gray-700 dark:focus:text-dark-light | transition duration-150 ease-in-out">Welcome</a></li>
		            <li class="py-1"><a href="{{ route('dashboard') }}" class="block | text-gray-500 dark:text-dark-normal | hover:text-gray-700 dark:hover:text-dark-light | focus:outline-none focus:text-gray-700 dark:focus:text-dark-light | transition duration-150 ease-in-out">Dashboard</a></li>
		        </ul>
			</div>

			<div>
		        <h4 class="font-miriam font-semibold uppercase tracking-widest text-md | text-gray-700 dark:text-dark-light">legal</h4>
		        <ul class="flex flex-col | list-none | leading-6 text-xs uppercase font-medium tracking-wide | pt-4">
		            <li class="py-1"><a href="{{ route('cookie-policy') }}" class="block | text-gray-500 dark:text-dark-normal | hover:text-gray-700 dark:hover:text-dark-light | focus:outline-none focus:text-gray-700 dark:focus:text-dark-light | transition duration-150 ease-in-out">Política de cookies</a></li>
		            <li class="py-1"><a href="{{ route('privacity-policy') }}" class="block | text-gray-500 dark:text-dark-normal | hover:text-gray-700 dark:hover:text-dark-light | focus:outline-none focus:text-gray-700 dark:focus:text-dark-light | transition duration-150 ease-in-out">Política de privacidad</a></li>
		        </ul>
			</div>
		</div>
	</x-container>
</div>