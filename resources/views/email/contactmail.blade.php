@component('mail::message')
	Hola Administrador,
	<br><br>
	Se ha recibido un mensaje desde el Formuario de Contacto.
	<br><br>
	Nombre: {{ $data['name'] }}
	<br>
	E-Mail: {{ $data['email'] }}
	<br>
	Whatsapp: {{ $data['whatsapp'] }}
	@component('mail::panel')
	    {{ $data['message'] }}
	@endcomponent

@endcomponent