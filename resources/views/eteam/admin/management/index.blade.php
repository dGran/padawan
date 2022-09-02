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
                <span class="inline-block py-1 px-1.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-red-600 dark:bg-red-500 text-white rounded mr-1.5">{{ $requests->count() }}</span>
            </div>
        </div>
        @includeWhen($requests->count() > 0, 'eteam.admin.management.requests')
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
                <button type="button" onclick="" class="w-32 inline-block px-4 py-1.5 bg-green-600 text-white text-xxs leading-tight rounded shadow-md hover:bg-green-700 hover:shadow-lg focus:bg-green-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-800 active:shadow-lg transition duration-150 ease-in-out">
                    Nueva invitación
                </button>
                <span class="inline-block py-1 px-1.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-red-600 dark:bg-red-500 text-white rounded mr-1.5">{{ $invitations->count() }}</span>
            </div>
        </div>
        @includeWhen($invitations->count() > 0, 'eteam.admin.management.invitations')
    </div>
</div>
