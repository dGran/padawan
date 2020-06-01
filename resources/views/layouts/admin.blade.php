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
		{{-- Custom --}}
		<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
		@yield('styles')

		<title>
			Admin Panel
			@isset($title)
			- {{ $title }}
			@endisset
		</title>
	</head>

	<body class="text-gray-800 antialiased bg-gray-200">
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
			@yield('content')
		</div>

	    {{-- JQuery --}}
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    	{{-- Mouse Trap --}}
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/mousetrap/1.6.3/mousetrap.min.js"></script>
	    {{-- Popper --}}
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js" charset="utf-8"></script>

		@include('layouts.partials.admin.javascript')
		@yield('modals')
		@yield('js')
	</body>

</html>