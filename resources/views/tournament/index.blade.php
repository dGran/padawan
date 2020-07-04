@extends('layouts.app', ['title' => 'Tournaments List', 'breadcrumb' => 'light', 'wrap_bg' => 'bg-white'])

@section('breadcrumb')
    @include('tournament.index.breadcrumb')
@endsection

@section('content')
    @include('tournament.menu')
    @include('tournament.index.content')
@endsection