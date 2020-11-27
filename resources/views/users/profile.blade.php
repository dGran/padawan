@extends('layouts.app', ['title' => 'Perfil de usuario', 'breadcrumb' => 'light', 'wrap_bg' => 'bg-gray-200'])

@section('styles')
	<style>
		input:checked + svg {
			display: block;
		}
	</style>
@endsection

@section('breadcrumb')
    @include('users.profile.breadcrumb')
@endsection

@section('content')
    @include('users.profile.content')
@endsection

@section('js')
    @include('users.profile.js')
@endsection