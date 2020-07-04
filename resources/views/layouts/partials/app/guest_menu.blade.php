<div @click.away="open = false" class="relative" x-data="{ open: false }">
	<button @click="open = !open" class="focus:outline-none align-middle md:pl-4">
		<img src="{{ asset('img/avatars/guest.png') }}" alt="avatar" class="rounded-full p-1 w-8 h-8 lg:w-10 lg:h-10 bg-gray-200 hover:bg-white">
	</button>
	<div x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 origin-top-right rounded-md shadow-lg w-48 z-50">
		<ul class="bg-white rounded-md shadow mt-1 text-sm font-semibold">
{{-- 			<li>
				<span class="text-gray-800 block px-4 py-2 border-b border-gray-400 bg-gray-300 rounded-t-md">
					Hi, guest
				</span>
			</li> --}}
			<li class="block bg-transparent hover:bg-gray-100 focus:bg-gray-100 border-b border-gray-200 rounded-t-md">
				<a class="block px-4 py-2 border-l-2 border-transparent hover:border-orange-500 focus:border-orange-500 text-gray-800 hover:text-orange-500 focus:text-orange-500 focus:outline-none rounded-t-md" href="{{ route('login') }}">
					<i class="fas fa-fingerprint mr-2 w-4 text-center"></i>Iniciar sesión
				</a>
			</li>
			{{-- last-item --}}
			<li class="block bg-transparent hover:bg-gray-100 focus:bg-gray-100 rounded-b-md">
				<a class="block px-4 py-2 border-l-2 border-transparent hover:border-orange-500 focus:border-orange-500 text-gray-800 hover:text-orange-500 focus:text-orange-500 focus:outline-none rounded-b-md" href="{{ route('register') }}">
					<i class="fas fa-clipboard-list mr-2 w-4 text-center"></i>Registro
				</a>
			</li>
		</ul>
	</div>
</div>