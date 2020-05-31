@extends('layouts.app', ['title' => 'Contact', 'breadcrumb' => 'light', 'wrap_bg' => 'bg-gray-200'])

@section('breadcrumb')
    @include('home.contact.breadcrumb')
@endsection

@section('content')
    @include('home.contact.content')
@endsection