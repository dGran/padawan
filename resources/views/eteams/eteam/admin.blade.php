@include('eteams.eteam.admin.partials.menu')

@switch($admin_op)
    @case('perfil')
        @include('eteams.eteam.admin.profile')
        @break
    @case('noticias')
        @include('eteams.eteam.admin.posts')
        @break
    @case('miembros')
        @include('eteams.eteam.admin.members')
        @break
@endswitch