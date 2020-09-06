<div class="antialiased font-sans w-full px-4 md:px-8">
    <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 pt-4 pb-2">
        @include('admin.leagues.menu')

        <div class="table-wrap">
            <table class="admin-tables">
                @if ($league->days->count() > 0)
                    <thead>
						<tr>
						    <th class="w-12">
						        <label class="custom-check">
						            <div>
						                <input type="checkbox" id="allMark" onchange="showHideAllRowOptions()"/>
						                <svg viewBox="0 0 172 172"><g fill="none" stroke-width="none" stroke-miterlimit="10" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode:normal"><path d="M0 172V0h172v172z"/><path d="M145.433 37.933L64.5 118.8658 33.7337 88.0996l-10.134 10.1341L64.5 139.1341l91.067-91.067z" fill="currentColor" stroke-width="1"/></g></svg>
						            </div>
						        </label>
						    </th>
						    <th class="text-left">
						        <span>Nombre</span>
						    </th>
						</tr>
                    </thead>
                @endif
                <tbody>
                    @if ($league->days->count() > 0)
                        @foreach ($league->days as $day)
                            {{-- @include('admin.leagues.schedule.list.table_body') --}}
                        @endforeach
                    @else
						<tr>
						    <td colspan="99" class="empty">
						        <i class="icon-nothing"></i>
						        No existen jornadas
						    </td>
						</tr>
                    @endif
                </tbody>
            </table>
            @if ($league->days->count() > 0)
                <div class="px-5 py-4 bg-white border-t flex flex-col xs:flex-row items-center xs:justify-between">
                    {{-- @include('admin.leagues.schedule.list.table_footer') --}}
                </div>
            @endif
        </div>

    </div>
</div>