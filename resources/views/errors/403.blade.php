@extends('layouts.errors', ['title' => 'Error 403'])

@section('content')
	<div class="antialiased font-roboto flex h-screen bg-gray-200">
		<div class="m-auto">
			<div class="w-full flex items-center justify-center">
				<div class="max-w-lg m-12 md:m-8">
					<div class="text-black text-5xl md:text-6xl font-black animated bounceInUp">
						Oops!
						{{Spatie\Emoji\Emoji::prohibited()}}
					</div>
					<div class="w-16 h-1 bg-orange-500 my-3 animated bounceInRight"></div>
					<p class="text-gray-700 text-2xl md:text-3xl font-light mb-4 leading-normal animated bounceInLeft">
						Acceso Denegado/Prohibido
					</p>
					<span class="block mb-8 font-bold text-orange-600 text-sm md:text-base animated bounceInRight delay-1s">
						Código de error: 403
					</span>
					@if ($exception->getMessage())
						<p class="text-gray-700 text-xl md:text-2xl font-light leading-normal animated fadeIn delay-1s mb-8">
							{{ $exception->getMessage() }}
						</p>
					@endif
					<a class="bg-transparent text-gray-600 hover:text-gray-800 font-bold uppercase tracking-wide py-3 px-6 border-2 border-gray-500 hover:border-gray-600 rounded-lg text-base md:text-lg animated  fadeIn delay-1s bg-gray-100 hover:bg-white" href="{{ request()->is('admin/*') ? route('admin') : route('home') }}">
						{{ request()->is('admin/*') ? 'Ir al dashboard' : 'Ir al inicio' }}
					</a>
				</div>
			</div>
		</div>
	</div>
@endsection