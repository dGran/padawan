<ul class="bg-white rounded-md shadow mt-1 text-sm font-semibold">
	<li>
		<span class="text-gray-800 block px-4 py-2 text-sm font-semibold border-b border-gray-400 bg-gray-300 rounded-t-lg">
			Hi, {{ auth()->user()->name }}
		</span>
	</li>
	<li class="block bg-transparent hover:bg-gray-100 focus:bg-gray-100 border-b border-gray-200">
		<a class="block px-4 py-2 border-l-2 border-transparent hover:border-orange-500 focus:border-orange-500 text-gray-800 hover:text-orange-500 focus:text-orange-500 focus:outline-none" href="{{ route('profile') }}">
			<i class="fas fa-address-card mr-2 w-4 text-center"></i>Profile
		</a>
	</li>
	@admin(auth()->user())
		<li class="block bg-transparent hover:bg-gray-100 focus:bg-gray-100 border-b border-gray-200">
			<a class="block px-4 py-2 border-l-2 border-transparent hover:border-orange-500 focus:border-orange-500 text-gray-800 hover:text-orange-500 focus:text-orange-500 focus:outline-none" href="{{ route('home') }}">
				<i class="fas fa-users-cog mr-2 w-4 text-center"></i>Salir del Admin Panel
			</a>
		</li>
	@endadmin

	{{-- last-item --}}
	<li class="block bg-transparent hover:bg-gray-100 focus:bg-gray-100 border-b border-gray-200 rounded-b-md">
		<a class="block px-4 py-2 border-l-2 border-transparent hover:border-orange-500 focus:border-orange-500 text-gray-800 hover:text-orange-500 focus:text-orange-500 focus:outline-none rounded-b-md" href="{{ route('logout') }}">
			<i class="fas fa-door-open mr-2 w-4 text-center"></i>Logout
		</a>
	</li>
</ul>