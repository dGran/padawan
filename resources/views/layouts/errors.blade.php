<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

	<head>
		<meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,minimum-scale=1.0,initial-scale=1.0,maximum-scale=1.0,user-scalable=no,viewport-fit=cover">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="description" content="...">
		<meta name="keywords" content="...">
		<link rel="stylesheet" href="{{ asset('css/app.css') }}">
		@yield('styles')

		<title>
			{{ env('APP_NAME') }}
			@isset($title)
			- {{ $title }}
			@endisset
		</title>
	</head>

	<body>
		@yield('content')
	</body>

</html>