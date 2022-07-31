@include('eteam.admin.menu')

@switch($adminTab)
    @case('perfil')
        @include('eteams.eteam.admin.profile')
        @break
    @case('noticias')
        @include('eteams.eteam.admin.posts')
        @break
    @case('miembros')
        @include('eteams.eteam.admin.members')
        @break
    @case('multimedia')
        @include('eteams.eteam.admin.multimedia')
        @break
    @case('log')
        @livewire('eteam.admin.log', ['eteam' => $eteam])
        @break
@endswitch
