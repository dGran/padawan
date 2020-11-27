@extends('layouts.app', ['title' => $eteam->name, 'breadcrumb' => 'dark'])

@section('breadcrumb')
    @include('esports.eteams.eteam.info.breadcrumb')
@endsection

@section('content')
	<div class="custom-container">
	    <div class="mt-4 mb-8">
			@include('esports.eteams.eteam.partials.title')
			@include('esports.eteams.eteam.partials.menu')
			@include('esports.eteams.eteam.info.content')
			@include('esports.eteams.eteam.partials.footer')
		</div>

	</div>
@endsection