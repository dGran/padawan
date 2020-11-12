@extends('layouts.app', ['title' => $eteam->name . ' - Estadísticas', 'breadcrumb' => 'dark'])

@section('breadcrumb')
    @include('esports.eteam.stats.breadcrumb')
@endsection

@section('content')
	<div class="custom-container">
	    <div class="mt-4 mb-8">
		    <div class="mb-4">
		        <h1 class="font-fjalla uppercase tracking-wider text-orange-500 text-lg font-semibold">
		            {{ $eteam->name }}
		        </h1>
		    </div>
			@include('esports.eteam.partials.menu')

			@include('esports.eteam.stats.content')
		</div>
	</div>
@endsection