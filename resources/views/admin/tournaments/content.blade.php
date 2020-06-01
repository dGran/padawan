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
            <div class="scroll pt-12 mx-1 md:mx-4">
                <button class="hint--top-right hint--error hint--rounded hint--bounce danger mr-2" type="button" aria-label="Eliminar">
                    <i class="icon-trash"></i>
                </button>
                <button class="hint--top hint--rounded hint--bounce mr-2" type="button" aria-label="Duplicar">
                    <i class="icon-duplicate"></i>
                </button>
                <button class="hint--top hint--rounded hint--bounce mr-2" type="button" aria-label="Agregar a tabla de apoyo">
                    <i class="icon-bookmark-add"></i>
                </button>
                <button class="hint--top hint--rounded hint--bounce mr-2" type="button" aria-label="Exportar (.xls)">
                    <i class="icon-xls"></i>
                </button>
                <button class="hint--top hint--rounded hint--bounce mr-2" type="button" aria-label="Exportar (.xlsx)">
                    <i class="icon-xlsx"></i>
                </button>
                <button class="hint--top-left hint--rounded hint--bounce" type="button" aria-label="Exportar (.csv)">
                    <i class="icon-csv"></i>
                </button>
            </div>
        </div>
    </div>

</div>