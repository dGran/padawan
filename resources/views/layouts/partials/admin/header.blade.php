<nav class="w-full z-10 bg-transparent md:flex-row md:flex-no-wrap md:justify-start flex items-center pt-5 md:pt-2">
	@isset($breadcrumb)
		<div class="absolute top-0 md:hidden">
			@include('layouts.partials.admin.breadcrumb')
		</div>
	@endisset
	<div class="w-full mx-autp items-center flex justify-between md:flex-no-wrap flex-wrap md:px-8 px-4">
		<span class="text-lg uppercase inline-block font-semibold text-pink-500 {{ isset($breadcrumb) ? 'pt-3' : '' }}">
			{{ $title }}
		</span>
{{-- 		<form class="md:flex hidden flex-row flex-wrap items-center lg:ml-auto mr-3">
			<div class="relative flex w-full flex-wrap items-stretch">
				<span class="z-10 h-full leading-snug font-normal absolute text-center text-gray-400 absolute bg-transparent rounded text-base items-center justify-center w-8 pl-3 py-3">
					<i class="fas fa-search"></i>
				</span>
				<input type="text" placeholder="Search here..." class="px-3 py-3 placeholder-gray-400 text-gray-700 relative bg-white bg-white rounded text-sm shadow outline-none focus:outline-none focus:shadow-outline w-full pl-10"/>
			</div>
		</form> --}}
		<ul class="flex-col md:flex-row list-none items-center hidden md:flex">
			<a class="text-gray-600 block" href="#pablo" onclick="openDropdown(event,'user-dropdown')">
				<div class="items-center flex">
					<span class="w-12 h-12 text-sm text-white bg-gray-300 inline-flex items-center justify-center rounded-full">
						<img alt="avatar" class="w-full rounded-full align-middle border-none shadow-lg" src="{{ auth()->user()->profile->avatar() }}"/>
					</span>
				</div>
			</a>
			<div class="hidden bg-white text-base z-50 float-left py-2 list-none text-left rounded shadow-lg mt-1" style="min-width: 12rem;" id="user-dropdown">
				@include('layouts.partials.admin.user_menu')
			</div>
		</ul>
	</div>
</nav>


{{-- <div class="relative bg-pink-600 pt-16 md:pt-24">
    <div class="px-4 md:px-8 mx-auto w-full pb-8">
    	@yield('header_content')

    </div>
</div> --}}