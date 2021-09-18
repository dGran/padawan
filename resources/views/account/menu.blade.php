<x-card class="w-full md:w-80 p-4 md:p-6 | flex flex-row md:flex-col justify-between | space-x-3 md:space-x-0 | overflow-x-auto | scrollbar-thin scrollbar-thumb-sb-thumb-color scrollbar-track-sb-track-color hover:scrollbar-thumb-sb-thumb-color-hover dark:scrollbar-thumb-sb-thumb-dt-color dark:scrollbar-track-sb-track-dt-color dark:hover:scrollbar-thumb-sb-thumb-dt-color-hover scrollbar-thumb-rounded-full">
    @if ($activeTab === 'Account')
        <span class="w-full min-w-max text-center | md:mb-3 px-4 py-2 | bg-edblue-500 text-dt-title-color | rounded | font-semibold text-sm | select-none | cursor-not-allowed">Mi cuenta</span>
    @else
        <x-link-button-light class="w-full min-w-max text-center md:mb-3" href="{{ route('account') }}">Mi cuenta</x-link-button-light>
    @endif
    @if ($activeTab === 'Notifications')
        <span class="w-full min-w-max text-center | md:mb-3 px-4 py-2 | bg-edblue-500 text-dt-title-color | rounded | font-semibold text-sm | select-none | cursor-not-allowed">Notificaciones</span>
    @else
        <x-link-button-light class="w-full min-w-max text-center md:mb-3" href="{{ route('notifications') }}">Notificaciones</x-link-button-light>
    @endif
    @if ($activeTab === 'MyTeams')
        <span class="w-full min-w-max text-center | px-4 py-2 | bg-edblue-500 text-dt-title-color | rounded | font-semibold text-sm | select-none | cursor-not-allowed">Mis equipos</span>
    @else
        <x-link-button-light class="w-full min-w-max text-center" href="{{ route('myteams') }}">Mis equipos</x-link-button-light>
    @endif
</x-card>
