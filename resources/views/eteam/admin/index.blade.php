@include('eteam.admin.partials.menu')

@switch($adminTab)
    @case('perfil')
        @livewire('eteam.admin.profile', ['eteam' => $eteam])
        @break
    @case('noticias')
        @livewire('eteam.admin.post', ['eteam' => $eteam])
        @break
    @case('miembros')
        @livewire('eteam.admin.member', ['eteam' => $eteam])
        @break
    @case('multimedia')
        @livewire('eteam.admin.file', ['eteam' => $eteam])
        @break
    @case('log')
        @livewire('eteam.admin.log', ['eteam' => $eteam])
        @break
@endswitch
