<div>
    <div class="min-w-full">
        <p>solicitudes</p>
        <p>invitaciones</p>
        <p>todos los capitanes pueden degradar a otro capitan (degrade)</p>
        <p class="text-red-500"><strong>BUG</strong>: al otorgar o retirar capitanía no se puede hacer la acción contraria hasta recargar la página</p>
        <p>falta la accion de eliminar/desactivar, al propietario nadie le puede eliminar, a uno mismo no se puede eliminar</p>
        @include('eteam.admin.members.filters')
        <div class="overflow-x-auto scrollbar-thin scrollbar-thumb-sb-thumb-color scrollbar-track-sb-track-color hover:scrollbar-thumb-sb-thumb-color-hover dark:scrollbar-thumb-sb-thumb-dt-color dark:scrollbar-track-sb-track-dt-color dark:hover:scrollbar-thumb-sb-thumb-dt-color-hover scrollbar-thumb-rounded-full">
            <table class="min-w-full">
                <thead class="select-none">
                @include('eteam.admin.members.thead')
                </thead>
                <tbody>
                @include('eteam.admin.members.tbody')
                </tbody>
            </table>
        </div>
    </div>
</div>