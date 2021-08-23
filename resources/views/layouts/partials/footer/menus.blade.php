<div class="">
	<x-container class="md:hidden select-none">
		<ul x-data="{selected:null}">
		    <li class="flex align-center flex-col -mx-4">
		        <a @click="selected !== 1 ? selected = 1 : selected = null"
		            class="cursor-pointer | px-4 py-3 | border-b border-gray-200 dark:border-gray-800 | font-semibold text-left | text-title-color dark:text-dt-title-color | inline-block | flex justify-between">
		            <span>Menu</span>
		            <span><i x-bind:class="{ 'fas fa-angle-down' : selected !== 1, 'fas fa-angle-up' : selected == 1 }" class="transition duration-150 ease-in-out"></i></span>
		        </a>
		        <div x-show="selected == 1" class="border-b border-gray-200 dark:border-gray-800 px-6 py-1.5"
		            x-transition:enter="transition ease-out duration-300 origin-top"
		            x-transition:enter-start="opacity-0 transform scale-y-0"
		            x-transition:enter-end="opacity-100 transform scale-y-100"
		            x-transition:leave="transition ease-in duration-150 origin-top"
		            x-transition:leave-start="opacity-100 transform scale-y-100"
		            x-transition:leave-end="opacity-0 transform scale-y-0">
		            <ul class="flex flex-col | py-3">
		                <li class="py-1"><a href="{{ route('welcome') }}" class="block | hover:text-title-color dark:hover:text-dt-title-color | focus:outline-none focus:text-title-color dark:focus:text-dt-title-color | transition duration-150 ease-in-out">Welcome</a></li>
		                <li class="py-1"><a href="{{ route('dashboard') }}" class="block | hover:text-title-color dark:hover:text-dt-title-color | focus:outline-none focus:text-title-color dark:focus:text-dt-title-color | transition duration-150 ease-in-out">Dashboard</a></li>
		            </ul>
		        </div>
		    </li>
		    <li class="flex align-center flex-col -mx-4">
		        <a @click="selected !== 2 ? selected = 2 : selected = null"
		            class="cursor-pointer | px-4 py-3 | border-b border-gray-200 dark:border-gray-800 | font-semibold text-left | text-title-color dark:text-dt-title-color | inline-block | flex justify-between">
		            <span>Padawan</span>
		            <span><i x-bind:class="{ 'fas fa-angle-down' : selected !== 2, 'fas fa-angle-up' : selected == 2 }" class="transition duration-150 ease-in-out"></i></span>
		        </a>
		        <div x-show="selected == 2" class="border-b border-gray-200 dark:border-gray-800 px-6 py-1.5"
		            x-transition:enter="transition ease-out duration-300 origin-top"
		            x-transition:enter-start="opacity-0 transform scale-y-0"
		            x-transition:enter-end="opacity-100 transform scale-y-100"
		            x-transition:leave="transition ease-in duration-150 origin-top"
		            x-transition:leave-start="opacity-100 transform scale-y-100"
		            x-transition:leave-end="opacity-0 transform scale-y-0">
		            <ul class="flex flex-col | py-3">
		                <li class="py-1"><a href="{{ route('welcome') }}" class="block | hover:text-title-color dark:hover:text-dt-title-color | focus:outline-none focus:text-title-color dark:focus:text-dt-title-color | transition duration-150 ease-in-out">Welcome</a></li>
		                <li class="py-1"><a href="{{ route('dashboard') }}" class="block | hover:text-title-color dark:hover:text-dt-title-color | focus:outline-none focus:text-title-color dark:focus:text-dt-title-color | transition duration-150 ease-in-out">Dashboard</a></li>
		            </ul>
		        </div>
		    </li>
		    <li class="flex align-center flex-col -mx-4">
		        <a @click="selected !== 3 ? selected = 3 : selected = null"
		            class="cursor-pointer | px-4 py-3 | border-b border-gray-200 dark:border-gray-800 | font-semibold text-left | text-title-color dark:text-dt-title-color | inline-block | flex justify-between">
		            <span>Legal</span>
		            <span><i x-bind:class="{ 'fas fa-angle-down' : selected !== 3, 'fas fa-angle-up' : selected == 3 }" class="transition duration-150 ease-in-out"></i></span>
		        </a>
		        <div x-show="selected == 3" class="border-b border-gray-200 dark:border-gray-800 px-6 py-1.5"
		            x-transition:enter="transition ease-out duration-300 origin-top"
		            x-transition:enter-start="opacity-0 transform scale-y-0"
		            x-transition:enter-end="opacity-100 transform scale-y-100"
		            x-transition:leave="transition ease-in duration-150 origin-top"
		            x-transition:leave-start="opacity-100 transform scale-y-100"
		            x-transition:leave-end="opacity-0 transform scale-y-0">
		            <ul class="flex flex-col | py-3">
		                <li class="py-1"><a href="{{ route('cookie-policy') }}" class="block | hover:text-title-color dark:hover:text-dt-title-color | focus:outline-none focus:text-title-color dark:focus:text-dt-title-color | transition duration-150 ease-in-out">Política de cookies</a></li>
		                <li class="py-1"><a href="{{ route('privacity-policy') }}" class="block | hover:text-title-color dark:hover:text-dt-title-color | focus:outline-none focus:text-title-color dark:focus:text-dt-title-color | transition duration-150 ease-in-out">Política de privacidad</a></li>
		            </ul>
		        </div>
		    </li>
		    {{-- @hasrole('') @endhasrole --}}
		</ul>
	</x-container>

	{{-- md or highter view --}}
	<x-container class="hidden md:block">
		<div class="flex items-start justify-between gap-20 select-none | text-xs">
			<div class="flex-initial">
		        <h4 class="font-semibold text-left | text-title-color dark:text-edblue-400 | mb-3">Menu</h4>
		        <ul class="flex flex-col | list-none | ml-1.5 pl-3 border-l border-text-color">
		            <li class="py-0.5"><a href="{{ route('welcome') }}" class="dark:text-dt-text-light-color | hover:text-title-color dark:hover:text-dt-text-color | focus:outline-none focus:text-title-color dark:focus:text-dt-text-color | transition duration-150 ease-in-out">Welcome</a></li>
		            <li class="py-0.5"><a href="{{ route('dashboard') }}" class="dark:text-dt-text-light-color | hover:text-title-color dark:hover:text-dt-text-color | focus:outline-none focus:text-title-color dark:focus:text-dt-text-color | transition duration-150 ease-in-out">Dashboard</a></li>
		        </ul>
			</div>

			<div class="flex-initial">
		        <h4 class="font-semibold text-left | text-title-color dark:text-edblue-400 | mb-3">Padawan</h4>
		        <ul class="flex flex-col | list-none | ml-1.5 pl-3 border-l border-text-color">
		            <li class="py-0.5"><a href="{{ route('welcome') }}" class="dark:text-dt-text-light-color | hover:text-title-color dark:hover:text-dt-text-color | focus:outline-none focus:text-title-color dark:focus:text-dt-text-color | transition duration-150 ease-in-out">Welcome</a></li>
		            <li class="py-0.5"><a href="{{ route('dashboard') }}" class="dark:text-dt-text-light-color | hover:text-title-color dark:hover:text-dt-text-color | focus:outline-none focus:text-title-color dark:focus:text-dt-text-color | transition duration-150 ease-in-out">Dashboard</a></li>
		        </ul>
			</div>

			<div class="flex-initial">
		        <h4 class="font-semibold text-left | text-title-color dark:text-edblue-400 | mb-3">Legal</h4>
		        <ul class="flex flex-col | list-none | ml-1.5 pl-3 border-l border-text-color">
		            <li class="py-0.5"><a href="{{ route('cookie-policy') }}" class="dark:text-dt-text-light-color | hover:text-title-color dark:hover:text-dt-text-color | focus:outline-none focus:text-title-color dark:focus:text-dt-text-color | transition duration-150 ease-in-out">Política de cookies</a></li>
		            <li class="py-0.5"><a href="{{ route('privacity-policy') }}" class="dark:text-dt-text-light-color | hover:text-title-color dark:hover:text-dt-text-color | focus:outline-none focus:text-title-color dark:focus:text-dt-text-color | transition duration-150 ease-in-out">Política de privacidad</a></li>
		            <li class="py-0.5"><a href="{{ route('cookie-policy') }}" class="dark:text-dt-text-light-color | hover:text-title-color dark:hover:text-dt-text-color | focus:outline-none focus:text-title-color dark:focus:text-dt-text-color | transition duration-150 ease-in-out">Política de cookies</a></li>
		            <li class="py-0.5"><a href="{{ route('privacity-policy') }}" class="dark:text-dt-text-light-color | hover:text-title-color dark:hover:text-dt-text-color | focus:outline-none focus:text-title-color dark:focus:text-dt-text-color | transition duration-150 ease-in-out">Política de privacidad</a></li>
		        </ul>
			</div>

			<div class="flex-1 flex justify-end">
				<div class="flex flex-col">
					<h4 class="font-semibold text-left | text-title-color dark:text-edblue-400 | mb-3">Redes sociales</h4>
					@include('layouts.partials.footer.social')
				</div>
			</div>
		</div>
	</x-container>
</div>