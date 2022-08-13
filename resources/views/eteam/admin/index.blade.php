@include('eteam.admin.partials.menu')

@switch($adminTab)
    @case('perfil')
        @livewire('eteam.options.admin.eteam-admin-profile', ['eteam' => $eteam])
        @break
    @case('noticias')
        @livewire('eteam.options.admin.eteam-admin-post', ['eteam' => $eteam, 'user' => auth()->user()])
        @break
    @case('miembros')
        @livewire('eteam.options.admin.eteam-admin-member', ['eteam' => $eteam])
        @break
    @case('multimedia')
        @livewire('eteam.options.admin.eteam-admin-file', ['eteam' => $eteam])
        @break
    @case('log')
        @livewire('eteam.options.admin.eteam-admin-log', ['eteam' => $eteam])
        @break
@endswitch
