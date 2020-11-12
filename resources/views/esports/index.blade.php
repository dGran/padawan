@extends('layouts.app', ['title' => 'E-Sports', 'breadcrumb' => 'dark'])

@section('breadcrumb')
    @include('esports.breadcrumb')
@endsection

@section('content')
    @include('esports.content')
@endsection