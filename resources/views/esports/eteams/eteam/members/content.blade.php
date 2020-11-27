<div class="bg-gray-700 text-white">
	<div class="p-3">
		<p class="font-bold pb-2 text-sm md:text-base">
			Listado de miembros
		</p>
		<ul class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4 mb-4">
			@foreach ($eteam->users as $member)
				<li class="p-2 mt-4 text-xs md:text-sm bg-gray-600 hover:bg-gray-500 hover:text-gray-800 focus:bg-gray-500 focus:text-gray-800 rounded shadow hover:shadow-lg focus:shadow-lg">
					<img src="{{ $member->user->profile->avatar() }}" alt="{{ $member->user->name }}"
					class="h-10 w-10 rounded-full object-cover -mt-6 mx-auto shadow-md">
					<p class="text-center pt-2">
						{{ $member->user->name }}
						@if ($member->isAdmin())
							<span class="text-orange-300 font-bold">(C)</strong>
						@endif
					</p>
					<p class="text-center text-xxs md:text-xs pt-2">
						{{ $member->user->profile->years() }}
					</p>
					<p class="text-center text-xxs md:text-xs">
						{{ $member->user->profile->location }}
					</p>
				</li>
			@endforeach
		</ul>
	</div>
</div>