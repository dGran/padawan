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
        <span class="cursor-pointer" onclick="changeSort('{{ $order == 'name' ? 'name_desc' : 'name' }}')">Nombre</span>
        @if ($order == 'name')
            <i class="fas fa-sort-amount-up-alt"></i>
        @endif
        @if ($order == 'name_desc')
            <i class="fas fa-sort-amount-down"></i>
        @endif
    </th>
    <th class="text-left">
        Tipo
    </th>
</tr>