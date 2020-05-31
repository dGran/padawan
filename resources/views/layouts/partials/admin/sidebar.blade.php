<nav class="md:left-0 md:block md:fixed md:top-0 md:bottom-0 md:overflow-y-auto md:flex-row md:flex-no-wrap md:overflow-hidden shadow md:shadow-lg bg-white flex flex-wrap items-center justify-between relative md:w-64 z-10 py-2 px-4">
	<div class="md:flex-col md:items-stretch md:min-h-full md:flex-no-wrap px-0 flex flex-wrap items-center justify-between w-full mx-auto">
		{{-- top-menu --}}
		<button class="cursor-pointer text-black opacity-50 md:hidden py-1 text-xl leading-none bg-transparent rounded border border-solid border-transparent focus:outline-none" type="button" onclick="toggleNavbar('collapse-sidebar')">
	    	<i class="fas fa-bars"></i>
	    </button>
		<a class="md:block text-left md:pb-2 text-gray-700 mr-0 inline-block whitespace-no-wrap text-sm uppercase font-bold p-4 px-0" href="javascript:void(0)">
			Admin Panel
		</a>
		<ul class="md:hidden items-center flex flex-wrap list-none">
			{{-- notifications --}}
			<li class="inline-block relative">
				<a class="text-gray-700 block py-1 px-3" href="#pablo" onclick="openDropdown(event,'notification-dropdown')">
	        		<i class="fas fa-bell"></i>
				</a>
				{{-- notifications-manu --}}
				<div class="hidden bg-white text-base z-50 float-left py-2 list-none text-left rounded shadow-lg mt-1" style="min-width: 12rem;" id="notification-dropdown">
					@include('layouts.partials.admin.notifications_menu')
				</div>
			</li>
			{{-- user --}}
			<li class="inline-block relative">
				<a class="text-gray-600 block cursor-pointer" onclick="openDropdown(event,'user-responsive-dropdown')">
					<div class="items-center flex">
						<span class="w-10 h-10 text-sm text-white bg-gray-300 inline-flex items-center justify-center rounded-full">
							<img alt="avatar" class="w-full rounded-full align-middle border-none shadow-lg bg-gray-600" style="padding: 1px" src="{{ auth()->user()->profile->avatar() }}"/>
						</span>
					</div>
				</a>
				{{-- user-menu --}}
				<div class="hidden bg-white text-base z-50 float-left py-2 list-none text-left rounded shadow-lg mt-1" style="min-width: 12rem;" id="user-responsive-dropdown">
					@include('layouts.partials.admin.user_menu')
				</div>
			</li>
		</ul>


		<div class="md:flex md:flex-col md:items-stretch md:opacity-100 md:relative md:mt-4 md:shadow-none shadow absolute top-0 left-0 right-0 z-40 overflow-y-auto overflow-x-hidden h-auto items-center flex-1 rounded hidden" id="collapse-sidebar">
			<div class="md:min-w-full md:hidden block pb-4 mb-4 border-b border-solid border-gray-300">
				<div class="flex flex-wrap">
					<div class="w-6/12">
						<span class="md:block text-left md:pb-2 text-gray-700 mr-0 inline-block whitespace-no-wrap text-sm uppercase font-bold p-4 px-0">
							Admin Panel
						</span>
					</div>
					{{-- close-button --}}
					<div class="w-6/12 flex justify-end">
						<button type="button" class="cursor-pointer text-black opacity-50 md:hidden py-1 text-xl leading-none bg-transparent rounded border border-solid border-transparent focus:outline-none" onclick="toggleNavbar('collapse-sidebar')">
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