<tr>
    @include('eteam.admin.partials.thead-column-ordenable', ['order_name' => 'created_at', 'order_name_desc' => 'created_at_desc', 'column_title' => 'Fecha'])
    @include('eteam.admin.partials.thead-column-ordenable', ['order_name' => 'user', 'order_name_desc' => 'user_desc', 'column_title' => 'Usuario'])
    @include('eteam.admin.partials.thead-column-ordenable', ['order_name' => 'context', 'order_name_desc' => 'context_desc', 'column_title' => 'Contexto'])
    @include('eteam.admin.partials.thead-column-ordenable', ['order_name' => 'type', 'order_name_desc' => 'type_desc', 'column_title' => 'Tipo'])
    @include('eteam.admin.partials.thead-column-ordenable', ['order_name' => 'message', 'order_name_desc' => 'message_desc', 'column_title' => 'Mensaje'])
</tr>
