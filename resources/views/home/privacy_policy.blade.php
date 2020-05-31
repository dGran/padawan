@extends('layouts.app', ['title' => 'Privacy Policy', 'breadcrumb' => 'dark'])

@section('breadcrumb')
    @include('home.privacy_policy.breadcrumb')
@endsection

@section('content')
    @include('home.privacy_policy.content')
@endsection