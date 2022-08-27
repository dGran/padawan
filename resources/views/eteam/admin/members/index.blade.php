<div>
    <div class="min-w-full">
        <p>solicitudes</p>
        <p>invitaciones, nueva invitación, modal con búsqueda de usuarios</p>
        <p>filtro de usuarios inactivos, ver como tratar si se quiere reincorporar al usuario, habrá que comprobar que no esté en otro equipo del mismo juego</p>
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
        @include('eteam.admin.members.invitations-and-requests')
    </div>
</div>
