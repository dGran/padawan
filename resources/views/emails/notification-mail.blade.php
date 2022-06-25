@component('mail::message')

    {{ $details['title'] }}
    <br><br>
    {{ $details['body'] }}
    <br><br><br>
    @component('mail::button', ['url' => $url])
        Mis notificaciones
    @endcomponent

@endcomponent
