<div>
{{--    requests--}}
    <div class="relative bg-white dark:bg-dt-dark border-t border-border-color dark:border-edgray-700">
        <div class="w-full px-4 py-2.5 text-left">
            <div class="flex items-center justify-between space-x-4">
                <i class="flex-initial text-lg text-edblue-500 dark:text-edblue-400 fa-solid fa-person-arrow-down-to-line w-5"></i>
                <p class="flex-1 | flex flex-col | leading-5">
                    <span class="text-title-color dark:text-dt-title-color font-medium">Solicitudes recibidas</span>
                    <span class="text-xxs | text-text-light-color">Listado de solicitudes de ingreso en el equipo</span>
                </p>
                @if ($requests->count() > 0)
                    <span class="inline-block py-1 px-1.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-red-600 dark:bg-red-500 text-white rounded mr-1.5">{{ $requests->count() }}</span>
                @endif
            </div>
        </div>
        @include('eteam.admin.management.requests')
    </div>
{{--    invitations--}}
    <div class="relative bg-white dark:bg-dt-dark border-t border-border-color dark:border-edgray-700">
        <div class="w-full px-4 py-2.5 text-left">
            <div class="flex items-center justify-between space-x-4">
                <i class="flex-initial text-lg text-edblue-500 dark:text-edblue-400 fa-solid fa-person-circle-question w-5"></i>
                <p class="flex-1 | flex flex-col | leading-5">
                    <span class="text-title-color dark:text-dt-title-color font-medium">Invitaciones enviadas</span>
                    <span class="text-xxs | text-text-light-color">Listado de invitaciones enviadas para el ingreso en el equipo</span>
                </p>
                @if ($invitations->count() > 0)
                    <span class="inline-block py-1 px-1.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-red-600 dark:bg-red-500 text-white rounded mr-1.5">{{ $invitations->count() }}</span>
                @endif
            </div>
        </div>
        @include('eteam.admin.management.invitations')
    </div>
{{--    new invitation--}}
    <div class="relative bg-white dark:bg-dt-dark border-t border-border-color dark:border-edgray-700">
        <div class="w-full px-4 py-2.5 text-left">
            <div class="flex items-center justify-between space-x-4">
                <i class="flex-initial text-lg text-edblue-500 dark:text-edblue-400 fa-solid fa-person-circle-plus w-5"></i>
                <p class="flex-1 | flex flex-col | leading-5">
                    <span class="text-title-color dark:text-dt-title-color font-medium">Nueva invitación</span>
                    <span class="text-xxs | text-text-light-color">Invita a nuevos usuarios para tu equipo</span>
                </p>
                @if ($requests->count() > 0)
                    <span class="inline-block py-1 px-1.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-red-600 dark:bg-red-500 text-white rounded mr-1.5">{{ $requests->count() }}</span>
                @endif
            </div>
        </div>
        <div class="relative overflow-hidden transition-all max-h-0 duration-700 | border-border-color dark:border-edgray-700" :class="selected == 1 ? 'border-t' : 'border-0'" x-ref="container1" x-bind:style="selected == 1 ? 'max-height: ' + $refs.container1.scrollHeight + 'px' : ''">
            @include('eteam.admin.management.new-invitation')
        </div>
    </div>
</div>
