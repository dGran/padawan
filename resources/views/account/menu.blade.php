<x-card class="w-full md:w-80 p-4 flex flex-row md:flex-col justify-between gap-4 overflow-x-auto">
    @if ($activeTab === 'Account')
        <span class="w-full min-w-max text-center | px-4 py-2 | bg-edblue-500 text-dt-title-color | rounded | font-semibold text-sm | select-none | cursor-not-allowed">Mi cuenta</span>
    @else
        <x-link-button-light class="w-full min-w-max text-center" href="{{ route('account') }}">Mi cuenta</x-link-button-light>
    @endif
    @if ($activeTab === 'Notifications')
        <span class="w-full min-w-max text-center | px-4 py-2 | bg-edblue-500 text-dt-title-color | rounded | font-semibold text-sm | select-none | cursor-not-allowed">Notificaciones</span>
    @else
        <x-link-button-light class="w-full min-w-max text-center" href="{{ route('notifications') }}">Notificaciones</x-link-button-light>
    @endif
    @if ($activeTab === 'MyTeams')
        <span class="w-full min-w-max text-center | px-4 py-2 | bg-edblue-500 text-dt-title-color | rounded | font-semibold text-sm | select-none | cursor-not-allowed">Mis equipos</span>
    @else
        <x-link-button-light class="w-full min-w-max text-center" href="{{ route('myteams') }}">Mis equipos</x-link-button-light>
    @endif
</x-card>
