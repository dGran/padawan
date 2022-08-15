<tr>
    @include('eteam.admin.partials.thead-column-ordenable', ['order_name' => 'created_at', 'order_name_desc' => 'created_at_desc', 'column_title' => 'Fecha', 'classes' => 'w-36'])
    @include('eteam.admin.partials.thead-column-ordenable', ['order_name' => 'user', 'order_name_desc' => 'user_desc', 'column_title' => 'Usuario', 'classes' => 'w-36'])
    @include('eteam.admin.partials.thead-column-ordenable', ['order_name' => 'range', 'order_name_desc' => 'range_desc', 'column_title' => 'Rango', 'classes' => 'w-28'])
    @include('eteam.admin.partials.thead-column-ordenable', ['order_name' => 'contract_from', 'order_name_desc' => 'contract_from_desc', 'column_title' => 'Contrato desde', 'classes' => 'w-28'])
    @include('eteam.admin.partials.thead-column-ordenable', ['order_name' => 'contract_to', 'order_name_desc' => 'contract_to_desc', 'column_title' => 'Contrato hasta', 'classes' => 'w-28'])
    <th scope="col" class="w-36 text-sm font-medium text-gray-500 dark:text-gray-400 px-4 py-2.5 text-left whitespace-nowrap">
        <span>Acciones</span>
    </th>
</tr>
