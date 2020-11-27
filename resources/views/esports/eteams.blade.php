@extends('layouts.app', ['title' => 'E-Sports', 'breadcrumb' => 'dark'])

@section('breadcrumb')
    @include('esports.eteams.list.breadcrumb')
@endsection

@section('content')
    @include('esports.eteams.list.content')
@endsection