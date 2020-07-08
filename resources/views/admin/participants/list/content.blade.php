<div class="antialiased font-sans w-full px-4 md:px-8">
    <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 pt-4 pb-2">
        @include('admin.participants.list.filters')
        @include('admin.participants.list.filter_tags')
    </div>

    <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 pb-4 overflow-x-auto mb-2">
        <div class="py-1 uppercase text-xs font-semibold">
            @if ($season->num_participants == 0)
                Participantes ilimitados
            @else
                <span>Participantes: </span><span class="current-registers"></span> / <span class="max-registers"></span>
            @endif
        </div>
        <div class="table-wrap">
            <table class="admin-tables">
                @if ($participants->count() > 0)
                    <thead>
                        @include('admin.participants.list.table_header')
                    </thead>
                @endif
                <tbody>
                    @if ($participants->count() > 0)
                        @foreach ($participants as $participant)
                            @include('admin.participants.list.table_body')
                        @endforeach
                    @else
                        @include('admin.partials.list.table_body_empty')
                    @endif
                </tbody>
            </table>
            @if ($participants->count() > 0)
                <div class="px-5 py-4 bg-white border-t flex flex-col xs:flex-row items-center xs:justify-between">
                    @include('admin.participants.list.table_footer')
                </div>
            @endif
        </div>
    </div>
</div>

<ul>
    <li>- expulsar usuario o eteam</li>
    <li>- sustituir (por reserva) usuario o eteam</li>
    <li>- crear tabla reservas y eliminar el campo reserve de participantes</li>
    <li>- generar automaticamente los participantes si no son ilimitados al crear la temporada, y modificar al editar (o no permitir editar (estudiar)</li>
    <li>- agregar campo en temporadas, admin reservas</li>
</ul>

<div class="selected-options hidden animated fast">
    @include('admin.participants.list.selected_options',
        [
            'edit'        => 1,
            'view'        => 1,
            'destroy'     => 1,
            'export'      => 1
        ])
</div>

<div class="global-options hidden animated fast">
    @include('admin.participants.list.global_options',
        [
            'import'      => 1,
            'export'      => 1
        ])
</div>