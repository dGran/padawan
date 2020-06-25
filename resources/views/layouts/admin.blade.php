<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

	<head>

		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,minimum-scale=1.0,initial-scale=1.0,maximum-scale=1.0,user-scalable=no,viewport-fit=cover">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="description" content="...">
		<meta name="keywords" content="...">
		<meta name="theme-color" content="#000000" />

		<link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}" />
		<link rel="apple-touch-icon" sizes="76x76" href="{{ asset('img/apple-icon.png') }}"/>

		{{-- Tooltips --}}
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/hint.css/2.6.0/hint.min.css">
		{{-- Iconmoon --}}
		<link rel="stylesheet" href="{{ asset('fonts/vendor/iconmoon.css') }}"/>
	    {{-- Font Awesome --}}
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
		{{-- <link rel="stylesheet" href="{{ asset('fonts/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}"/> --}}

 		<!--ION Range Silder -->
    	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/css/ion.rangeSlider.min.css"/>
		{{-- Custom --}}
		<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
		@yield('styles')

        {{-- Sweet Alert --}}
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

		<title>
			Admin Panel
			@isset($title)
			- {{ $title }}
			@endisset
		</title>
	</head>

	<body class="text-gray-800 antialiased bg-gray-200 md:mx-4">
		<noscript>You need to enable JavaScript to run this app.</noscript>

		{{-- <div id="root"> --}}
		@include('layouts.partials.admin.sidebar')

		<div class="relative md:ml-64">
			@include('layouts.partials.admin.header')
			@isset($breadcrumb)
				<div class="hidden md:block">
					@include('layouts.partials.admin.breadcrumb')
				</div>
			@endisset
	        @if (flash()->message)
	            @include('layouts.partials.flash_message')
	        @endif
			@yield('content')
		</div>

	    {{-- JQuery --}}
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    	{{-- Mouse Trap --}}
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/mousetrap/1.6.3/mousetrap.min.js"></script>
		{{-- Alpine --}}
		<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    	<!--ION Range Silder -->
    	<script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/js/ion.rangeSlider.min.js"></script>

		@include('layouts.partials.admin.javascript')
		@yield('modals')
		@yield('js')
	</body>

</html>