@extends('layouts.app', ['title' => 'Tournaments List', 'breadcrumb' => 'dark'])

@section('styles')
	<link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,300;0,700;1,400&display=swap" rel="stylesheet">

@endsection

@section('breadcrumb')
    @include('tournaments.list.breadcrumb')
@endsection

@section('content')
    @include('tournaments.list.content')
@endsection

@section('js')
	@include('tournaments.list.js')
@endsection


