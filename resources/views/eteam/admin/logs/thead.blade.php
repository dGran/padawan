<tr>
    @include('eteam.admin.partials.thead-column-ordenable', ['order_name' => 'created_at', 'order_name_desc' => 'created_at_desc', 'column_title' => 'Fecha', 'classes' => 'w-36'])
    @include('eteam.admin.partials.thead-column-ordenable', ['order_name' => 'user', 'order_name_desc' => 'user_desc', 'column_title' => 'Usuario', 'classes' => 'w-36'])
    @include('eteam.admin.partials.thead-column-ordenable', ['order_name' => 'context', 'order_name_desc' => 'context_desc', 'column_title' => 'Contexto', 'classes' => 'w-36'])
    @include('eteam.admin.partials.thead-column-ordenable', ['order_name' => 'type', 'order_name_desc' => 'type_desc', 'column_title' => 'Tipo', 'classes' => 'w-28'])
    @include('eteam.admin.partials.thead-column-ordenable', ['order_name' => 'message', 'order_name_desc' => 'message_desc', 'column_title' => 'Mensaje', 'classes' => ''])
</tr>
