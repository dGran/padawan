<tr>
    @include('eteam.admin.partials.thead-column-ordenable', ['order_name' => 'id', 'order_name_desc' => 'id_desc', 'column_title' => 'Id', 'classes' => 'w-16'])
    @include('eteam.admin.partials.thead-column-ordenable', ['order_name' => 'created_at', 'order_name_desc' => 'created_at_desc', 'column_title' => 'Fecha', 'classes' => 'w-36'])
    @include('eteam.admin.partials.thead-column-ordenable', ['order_name' => 'user', 'order_name_desc' => 'user_desc', 'column_title' => 'Usuario', 'classes' => 'w-36'])
    @include('eteam.admin.partials.thead-column-ordenable', ['order_name' => 'visibility', 'order_name_desc' => 'visibility_desc', 'column_title' => 'Visibilidad', 'classes' => 'w-28'])
    @include('eteam.admin.partials.thead-column-ordenable', ['order_name' => 'title', 'order_name_desc' => 'title_desc', 'column_title' => 'Título', 'classes' => ''])
    <th scope="col" class="w-36 text-sm font-medium text-gray-500 dark:text-gray-400 px-4 py-2.5 text-left whitespace-nowrap">
        <span>Acciones</span>
    </th>
</tr>
