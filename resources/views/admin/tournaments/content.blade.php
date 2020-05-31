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
        <div class="text-xs p-3 bg-gray-200 text-center">
            <div class="selected-regs-count"></div>
            <div class="inline-flex mt-5 border">
                <button class="bg-gray-100 hover:bg-white text-gray-800 font-bold p-2 md:px-4 rounded-l">
                    <img src="https://image.flaticon.com/icons/svg/411/411085.svg" alt="" width="24">
                </button>
                <button class="bg-gray-100 hover:bg-white text-gray-800 font-bold p-2 md:px-4">
                    <img src="https://image.flaticon.com/icons/svg/1828/1828843.svg" alt="" width="24">
                </button>
                <button class="bg-gray-100 hover:bg-white text-gray-800 font-bold p-2 md:px-4">
                    <img src="https://image.flaticon.com/icons/svg/1387/1387647.svg" alt="" width="24">
                </button>
                <button class="bg-gray-100 hover:bg-white text-gray-800 font-bold p-2 md:px-4">
                    <img src="https://image.flaticon.com/icons/svg/29/29070.svg" alt="" width="24">
                </button>
                <button class="bg-gray-100 hover:bg-white text-gray-800 font-bold p-2 md:px-4">
                    <img src="https://image.flaticon.com/icons/svg/28/28841.svg" alt="" width="24">
                </button>
                <button class="bg-gray-100 hover:bg-white text-gray-800 font-bold p-2 md:px-4 rounded-r">
                    <img src="https://image.flaticon.com/icons/svg/28/28842.svg" alt="" width="24">

                </button>
            </div>
        </div>
    </div>
</div>