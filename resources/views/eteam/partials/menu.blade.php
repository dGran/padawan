<ul class="pb-2 pt-6 sm:pt-8 md:pt-9 lg:pt-12 px-6 | bg-gradient-to-r from-gray-150 via-white to-gray-150 dark:from-dt-darkest dark:via-dt-dark dark:to-dt-darkest | border-b border-border-color dark:border-dt-border-color | flex items-center justify-between sm:justify-center space-x-4 sm:space-x-8 | select-none | overflow-x-auto | scrollbar-thin scrollbar-thumb-sb-thumb-color scrollbar-track-sb-track-color hover:scrollbar-thumb-sb-thumb-color-hover dark:scrollbar-thumb-sb-thumb-dt-color dark:scrollbar-track-sb-track-dt-color dark:hover:scrollbar-thumb-sb-thumb-dt-color-hover scrollbar-thumb-rounded-full">
    @include('eteam.partials.options', ['tab_name' => 'sede'])
    @include('eteam.partials.options', ['tab_name' => 'noticias'])
    @include('eteam.partials.options', ['tab_name' => 'miembros'])
    @include('eteam.partials.options', ['tab_name' => 'multimedia'])
    @include('eteam.partials.options', ['tab_name' => 'palmares'])
    @auth
        @if (auth()->user()->isAdminETeam($eteam->id))
            @include('eteam.partials.options.blade.php', ['tab_name' => 'admin'])
        @endif
    @endauth
</ul>
