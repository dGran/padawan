@extends('layouts.app', ['title' => 'Cookie Policy', 'breadcrumb' => 'dark'])

@section('breadcrumb')
    @include('home.cookie_policy.breadcrumb')
@endsection

@section('content')
    @include('home.cookie_policy.content')
@endsection