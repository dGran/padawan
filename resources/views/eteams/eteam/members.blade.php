<div class="p-4 md:p-6 lg:p-8">
	<div class="pb-4 | flex items-center space-x-2">
		<button class="rounded | px-2.5 py-1 | border border-transparent | focus:outline-none | {{ $membersFilter == 'all' ? 'bg-edblue-500 dark:bg-edblue-400 | text-dt-title-color dark:text-title-color | pointer-events-none' : 'hover:border-edblue-500 dark:hover:border-edblue-400 | focus:border-edblue-500 dark:focus:border-edblue-400 | cursor-pointer' }}" wire:click="changeMembersFilter('all')">
			<span>Todos</span>
		</button>
		<button class="rounded | px-2.5 py-1 | border border-transparent | focus:outline-none | {{ $membersFilter != 'all' ? 'bg-edblue-500 dark:bg-edblue-400 | text-dt-title-color dark:text-title-color | pointer-events-none' : 'hover:border-edblue-500 dark:hover:border-edblue-400 | focus:border-edblue-500 dark:focus:border-edblue-400 | cursor-pointer' }}" wire:click="changeMembersFilter('captains')">
			<span>Capitanes</span>
		</button>
	</div>

	@if ($members->count() > 0)
		<ul class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
			@foreach ($members as $member)
				<li>
					<button class="relative | group | w-full flex flex-col items-center | rounded-md | border border-border-color dark:border-dt-border-color | hover:bg-border-color dark:hover:bg-dt-border-color | focus:outline-none focus:bg-border-color dark:focus:bg-dt-border-color" wire:click="$emit('openModal', 'modals.user-modal', {{ json_encode([$member->user]) }})">
						@if ($member->user->profile && $member->user->profile->country)
							<div class="absolute top-0 left-0 m-3">
								<img src="{{ $member->user->getFlag() }}" alt="">
								<span class="text-xxs">{{ $member->user->profile->location ? $member->user->profile->location : $member->user->profile->country->short_name }}</span>
							</div>
						@endif
						@if ($member->captain || $member->owner)
							<div class="absolute top-0 right-0 m-3">
								<p class="{{ $member->owner ? 'bg-edblue-400 text-edgray-900' : 'bg-edyellow-500 text-edgray-900' }} rounded-full | w-6 h-6 | flex items-center justify-center | text-xxs font-bold font-fjalla" title="{{ $member->owner ? 'Propietario' : 'Capitán' }}">{{ $member->owner ? 'P' : 'C' }}</p>
							</div>
						@endif
						<i class="icon-{{ $member->isRacing() ? 'racing' : 'soccer' }}-shape | mt-2 | text-edgray-500 dark:text-edgray-600" style="font-size: 12em;"></i>
						<div class="w-full | bg-gray-150 dark:bg-dt-darker | text-center | text-title-color dark:text-dt-title-color | text-normal md:text-base | p-3 | rounded-b-md| group-hover:text-edyellow-500">{{ $member->getName() }}</div>
					</button>
				</li>
			@endforeach
		</ul>
	@else
		<p class="py-6 w-full text-center rounded border border-border-color dark:border-dt-border-color">{{ $membersFilter == 'all' ? 'No existen miembros' : 'No existen capitanes' }}</p>
	@endif
</div>
