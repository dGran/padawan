<div class="antialiased font-sans w-full px-4 md:px-8">
    <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 pt-4">
        <form id="frmFilter" role="search" method="get" action="{{ route('admin.users') }}">
            @include('admin.users.list.filters')
        </form>
        @if ($filterName)
            <div class="filter-tags">
                @if ($filterName)
                    <button onclick="cancelFilterName()">{{ $filterName }}<i class="fas fa-times pl-2"></i></button>
                @endif
            </div>
        @endif
    </div>
    <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 pb-4 overflow-x-auto">
        <div class="table-wrap mt-4">
            <table class="admin-tables">
                <thead>
                    @include('admin.users.list.table_header')
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        @include('admin.users.list.table_body')
                    @endforeach
                </tbody>
            </table>

            <div class="px-5 py-4 bg-white border-t flex flex-col xs:flex-row items-center xs:justify-between">
                <span class="text-xs text-gray-900">
                    Registros: {{ $users->firstItem() }}-{{ $users->lastItem() }} de {{ $users->total() }}
                </span>
                <div class="inline-flex mt-2 xs:mt-0">
                    {{ $users->appends(['perPage' => $perPage, 'filterName' => $filterName, 'sortField' => $sortField, 'sortDirection' => $sortDirection])->onEachSide(1)->links('layouts.partials.admin.paginator') }}
                </div>
            </div>
        </div>
    </div>

    <div class="selected-regs hidden animated fast">
        <div class="info">
            <div class="selected-regs-count"></div>
            <button class="hint--left hint--rounded hint--bounce" id="cancel-selection" onclick="cancelSelection()" aria-label="Cancelar selección">
                <i class="fas fa-times-circle"></i>
            </button>
        </div>
        <div class="elements">
            <div class="scroll pt-4">
                <button class="hint--top-right hint--rounded hint--bounce mr-2" type="button" aria-label="Editar" id="edit" onclick="edit()">
                    <i class="fas fa-pen"></i>
                </button>
                <button class="hint--top hint--rounded hint--bounce mr-2" type="button" aria-label="Ver" id="view">
                    <i class="fas fa-eye"></i>
                </button>
                <button class="hint--top-right hint--error hint--rounded hint--bounce danger mr-2" type="button" aria-label="Eliminar" id="destroy" onclick="destroy()">
                    <i class="icon-trash"></i>
                </button>
                <button class="hint--top hint--rounded hint--bounce mr-2" type="button" aria-label="Duplicar" onclick="duplicate()">
                    <i class="icon-duplicate"></i>
                </button>
{{--                 <button class="hint--top hint--rounded hint--bounce mr-2" type="button" aria-label="Agregar a tabla de apoyo">
                    <i class="icon-bookmark-add"></i>
                </button> --}}
                <button class="hint--top hint--rounded hint--bounce mr-2" type="button" aria-label="Exportar (.xls)" onclick="exportFile('users', 'xls')">
                    <i class="icon-xls"></i>
                </button>
                <button class="hint--top hint--rounded hint--bounce mr-2" type="button" aria-label="Exportar (.xlsx)" onclick="exportFile('users', 'xlsx')">
                    <i class="icon-xlsx"></i>
                </button>
                <button class="hint--top-left hint--rounded hint--bounce" type="button" aria-label="Exportar (.csv)"  onclick="exportFile('users', 'csv')">
                    <i class="icon-csv"></i>
                </button>
            </div>
        </div>
    </div>

    <ul>
        <li>eliminar las variables de rutas en el TR y usar variables en el js (no en el general)</li>
        <li>falta aplicar los filtros y orden al exportar</li>
        <li>falta el importar</li>
    </ul>


</div>