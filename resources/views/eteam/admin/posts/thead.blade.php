<tr>
    @include('eteam.admin.partials.thead-column-ordenable', ['order_name' => 'created_at', 'order_name_desc' => 'created_at_desc', 'column_title' => 'Fecha'])
    @include('eteam.admin.partials.thead-column-ordenable', ['order_name' => 'user', 'order_name_desc' => 'user_desc', 'column_title' => 'Usuario'])
</tr>
