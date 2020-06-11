<nav class="w-full z-10 bg-transparent md:flex-row md:flex-no-wrap md:justify-start flex items-center pt-5 md:pt-2">
	@isset($breadcrumb)
		<div class="absolute top-0 md:hidden">
			@include('layouts.partials.admin.breadcrumb')
		</div>
	@endisset
	<div class="w-full mx-auto items-center flex justify-between md:flex-no-wrap flex-wrap md:px-8 px-4 {{ isset($breadcrumb) ? 'pt-1' : '' }}">
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
			<div @click.away="open = false" class="relative" x-data="{ open: false }">
				<button @click="open = !open" class="focus:outline-none align-middle md:pl-4">
					<img src="{{ auth()->user()->profile->avatar() }}" class="object-cover rounded-full w-8 h-8 lg:w-10 lg:h-10 bg-gray-200 hover:bg-white" style="padding: 1px">
				</button>
				<div x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 origin-top-right rounded-md shadow-lg w-48 z-50">
					@include('layouts.partials.admin.user_menu')
				</div>
			</div>
		</ul>
	</div>
</nav>


{{-- <div class="relative bg-pink-600 pt-16 md:pt-24">
    <div class="px-4 md:px-8 mx-auto w-full pb-8">
    	@yield('header_content')

    </div>
</div> --}}