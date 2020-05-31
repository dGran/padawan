@extends('layouts.app', ['title' => 'Tournaments List', 'breadcrumb' => 'dark'])

@section('breadcrumb')
    @include('tournaments.list.breadcrumb')
@endsection

@section('content')
    @include('tournaments.list.content')
@endsection