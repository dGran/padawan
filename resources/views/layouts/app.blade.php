<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

	<head>
		<meta charset="UTF-8">
		{{-- <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> --}}
		{{-- <meta name="viewport" content="initial-scale=1, viewport-fit=cover"> --}}
        <meta name="viewport" content="width=device-width,minimum-scale=1.0,initial-scale=1.0,maximum-scale=1.0,user-scalable=no,viewport-fit=cover">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="description" content="...">
		<meta name="keywords" content="...">
		{{-- Tooltips --}}
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/hint.css/2.6.0/hint.min.css">
		<link rel="stylesheet" href="{{ asset('fonts/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}"/>
		<link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
		<link rel="stylesheet" href="{{ asset('fonts/vendor/iconmoon.css') }}"/>
		<link rel="stylesheet" href="{{ asset('css/app.css') }}">
		@yield('styles')

        {{-- Sweet Alert --}}
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

		<title>
			{{ env('APP_NAME') }}
			@isset($title)
			- {{ $title }}
			@endisset
		</title>

		@stack('styles')
	</head>

	<body class="font-roboto bg-gray-900 text-gray-200" style="background-image: radial-gradient(#242e3f .5px, transparent .5px),radial-gradient(#101318 .5px, transparent .5px);
    background-size: calc(20 * .5px) calc(20 * .5px);
    background-position: 0 0,calc(10 * .5px) calc(10 * .5px);">
		<noscript>You need to enable JavaScript to run this app.</noscript>

		<div class="wrap flex flex-col h-screen justify-between {{ isset($wrap_bg) ? $wrap_bg : '' }}">
			<header class="">
				@include('layouts.partials.app.header')
			</header>

			<main class="mb-auto {{ isset($wrap_bg) ? $wrap_bg : '' }}">
				@isset($breadcrumb)
					@if($breadcrumb == 'dark')
						@include('layouts.partials.app.breadcrumb_dark')
					@elseif ($breadcrumb == 'light')
						@include('layouts.partials.app.breadcrumb')
					@endif
				@endisset
				@yield('content')
			</main>

			<footer class="bg-gray-900">
				@include('layouts.partials.app.footer')
			</footer>
		</div>

		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.3/dist/alpine.min.js" defer></script>

		@include('layouts.partials.app.javascript')
		@yield('modals')
        @if (flash()->message)
            @include('layouts.partials.flash_message')
        @endif
		@if ($errors->any())
			@include('layouts.partials.flash_errors')
		@endif

		@yield('js')

		@stack('scripts')
	</body>

</html>