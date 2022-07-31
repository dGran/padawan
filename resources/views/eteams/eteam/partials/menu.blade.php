<ul class="pb-2 pt-6 sm:pt-8 md:pt-9 lg:pt-12 px-6 | bg-gradient-to-r from-gray-150 via-white to-gray-150 dark:from-dt-darkest dark:via-dt-dark dark:to-dt-darkest | border-b border-border-color dark:border-dt-border-color | flex items-center justify-between sm:justify-center space-x-4 sm:space-x-8 | select-none | overflow-x-auto | scrollbar-thin scrollbar-thumb-sb-thumb-color scrollbar-track-sb-track-color hover:scrollbar-thumb-sb-thumb-color-hover dark:scrollbar-thumb-sb-thumb-dt-color dark:scrollbar-track-sb-track-dt-color dark:hover:scrollbar-thumb-sb-thumb-dt-color-hover scrollbar-thumb-rounded-full">
	<li>
		<button class="w-16 | flex flex-col items-center | focus:outline-none | {{ $tab == 'sede' ? 'text-title-color dark:text-dt-title-color pointer-events-none' : 'opacity-75 hover:opacity-100 focus:opacity-100' }}" wire:click="changeTab('sede')">
			<i class="icon-home text-2xl md:text-3xl lg:4xl"></i>
			<span class="mt-1 | uppercase | text-xxxs md:text-xxs lg:text-xs | font-miriam">Sede</span>
		</button>
	</li>
	<li>
		<button class="w-16 | flex flex-col items-center | focus:outline-none | {{ $tab == 'noticias' ? 'text-title-color dark:text-dt-title-color pointer-events-none' : 'opacity-75 hover:opacity-100 focus:opacity-100' }}" wire:click="changeTab('noticias')">
			<i class="icon-news text-2xl md:text-3xl lg:4xl"></i>
			<span class="mt-1 | uppercase | text-xxxs md:text-xxs lg:text-xs | font-miriam">Noticias</span>
		</button>
	</li>
	<li>
		<button class="w-16 | flex flex-col items-center | focus:outline-none | {{ $tab == 'miembros' ? 'text-title-color dark:text-dt-title-color pointer-events-none' : 'opacity-75 hover:opacity-100 focus:opacity-100' }}" wire:click="changeTab('miembros')">
			<i class="icon-users text-2xl md:text-3xl lg:4xl"></i>
			<span class="mt-1 | uppercase | text-xxxs md:text-xxs lg:text-xs | font-miriam">Miembros</span>
		</button>
	</li>
	<li>
		<button class="w-16 | flex flex-col items-center | focus:outline-none | {{ $tab == 'multimedia' ? 'text-title-color dark:text-dt-title-color pointer-events-none' : 'opacity-75 hover:opacity-100 focus:opacity-100' }}" wire:click="changeTab('multimedia')">
			<i class="icon-video-gallery text-2xl md:text-3xl lg:4xl"></i>
			<span class="mt-1 | uppercase | text-xxxs md:text-xxs lg:text-xs | font-miriam">Multimedia</span>
		</button>
	</li>
	<li>
		<button class="w-16 | flex flex-col items-center | focus:outline-none | {{ $tab == 'palmares' ? 'text-title-color dark:text-dt-title-color pointer-events-none' : 'opacity-75 hover:opacity-100 focus:opacity-100' }}" wire:click="changeTab('palmares')">
			<i class="icon-trophy text-2xl md:text-3xl lg:4xl"></i>
			<span class="mt-1 | uppercase | text-xxxs md:text-xxs lg:text-xs | font-miriam">Palmarés</span>
		</button>
	</li>
	@auth
		@if (auth()->user()->isAdminETeam($eteam->id))
			<li>
				<button class="w-16 | flex flex-col items-center | focus:outline-none | {{ $tab == 'admin' ? 'text-title-color dark:text-dt-title-color pointer-events-none' : 'opacity-75 hover:opacity-100 focus:opacity-100' }}" wire:click="changeTab('admin')">
					<i class="icon-admin text-2xl md:text-3xl lg:4xl"></i>
					<span class="mt-1 | uppercase | text-xxxs md:text-xxs lg:text-xs | font-miriam">Admin</span>
				</button>
			</li>
		@endif
	@endauth
</ul>
