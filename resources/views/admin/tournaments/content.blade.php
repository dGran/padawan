<div class="antialiased font-sans w-full px-4 md:px-8">
    <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">

        <form id="frmFilter" role="search" method="get" action="{{ route('admin.tournaments') }}">
            @include('admin.tournaments.filters')
        </form>

        <div class="table-wrap">
            <table class="admin-tables">
                <thead>
                    @include('admin.tournaments.table_header')
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        @include('admin.tournaments.table_body')
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
        <div class="wrap">
            <div class="selected-regs-count"></div>
            <div class="elements">
                <div class="element">
                    <button type="button" onmouseenter="openPopover(event,'support-table')" onmouseleave="openPopover(event,'support-table')">
                        <img src="https://image.flaticon.com/icons/svg/411/411085.svg" alt="" width="24">
                    </button>
                    <label class="hidden" id="support-table">Agregar a tabla de apoyo</label>
                </div>
                <div class="element">
                    <button type="button" onmouseenter="openPopover(event,'delete')" onmouseleave="openPopover(event,'delete')">
                        <img src="https://image.flaticon.com/icons/svg/1828/1828843.svg" alt="" width="24">
                    </button>
                    <label class="hidden" id="delete">Eliminar</label>
                </div>
                <div class="element">
                    <button type="button" onmouseenter="openPopover(event,'duplicate')" onmouseleave="openPopover(event,'duplicate')">
                        <img src="https://image.flaticon.com/icons/svg/1387/1387647.svg" alt="" width="24">
                    </button>
                    <label class="hidden" id="duplicate">Duplicar</label>
                </div>
                <div class="element">
                    <button type="button" onmouseenter="openPopover(event,'export_xls')" onmouseleave="openPopover(event,'export_xls')">
                        <img src="https://image.flaticon.com/icons/svg/29/29070.svg" alt="" width="24">
                    </button>
                    <label class="hidden" id="export_xls">Exportar (.xls)</label>
                </div>
                <div class="element">
                    <button type="button" onmouseenter="openPopover(event,'export_xlsx')" onmouseleave="openPopover(event,'export_xlsx')">
                        <img src="https://image.flaticon.com/icons/svg/28/28841.svg" alt="" width="24">
                    </button>
                    <label class="hidden" id="export_xlsx">Exportar (.xslx)</label>
                </div>
                <div class="element">
                    <button type="button" onmouseenter="openPopover(event,'export_csv')" onmouseleave="openPopover(event,'export_csv')">
                        <img src="https://image.flaticon.com/icons/svg/28/28842.svg" alt="" width="24">
                    </button>
                    <label class="hidden" id="export_csv">Exportar (.csv)</label>
                </div>
            </div>
        </div>
    </div>
</div>