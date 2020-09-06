@extends('layouts.app', ['title' => $tournament->name])

@section('breadcrumb')
	@include('tournament.schedule.leagues.breadcrumb')
@endsection

@section('content')

	<div class="tournament">
		<div class="wrapper">

			@include('tournament.partials.tournament_header')

	        <div class="content">
	            @include('tournament.schedule.leagues.content')
	        </div>

			@if ($tournament->has_sponsors())
		        <div class="sponsors">
		        	@include('tournament.partials.sponsors')
		        </div>
	        @endif

	    </div> {{-- wrapper --}}
	</div> {{-- tournament --}}

@endsection

@section('js')
	@include('tournament.schedule.leagues.js')
@endsection