<ul class="pb-2 pt-6 sm:pt-8 md:pt-9 lg:pt-12 px-6 | bg-gradient-to-r from-gray-150 via-white to-gray-150 dark:from-dt-darkest dark:via-dt-dark dark:to-dt-darkest | border-b border-border-color dark:border-dt-border-color | flex items-center justify-between sm:justify-center space-x-4 sm:space-x-8 | select-none | overflow-x-auto | scrollbar-thin scrollbar-thumb-sb-thumb-color scrollbar-track-sb-track-color hover:scrollbar-thumb-sb-thumb-color-hover dark:scrollbar-thumb-sb-thumb-dt-color dark:scrollbar-track-sb-track-dt-color dark:hover:scrollbar-thumb-sb-thumb-dt-color-hover scrollbar-thumb-rounded-full">
    @include('eteam.partials.options-menu', ['option_name' => 'sede', 'option_icon' => 'icon-home'])
    @include('eteam.partials.options-menu', ['option_name' => 'noticias', 'option_icon' => 'icon-news'])
    @include('eteam.partials.options-menu', ['option_name' => 'miembros', 'option_icon' => 'icon-users'])
    @include('eteam.partials.options-menu', ['option_name' => 'multimedia', 'option_icon' => 'icon-video-gallery'])
    @include('eteam.partials.options-menu', ['option_name' => 'palmares', 'option_icon' => 'icon-trophy'])
    @auth
        @if (auth()->user()->isAdminETeam($eteam->id))
            @include('eteam.partials.options-menu', ['option_name' => 'admin', 'option_icon' => 'icon-admin'])
        @endif
    @endauth
</ul>
