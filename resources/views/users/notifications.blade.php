@extends('layouts.app', ['title' => 'Notificaciones', 'breadcrumb' => 'light', 'wrap_bg' => 'bg-gray-200'])

@section('breadcrumb')
    @include('users.notifications.breadcrumb')
@endsection

@section('content')
    @include('users.notifications.content')
@endsection

@section('js')
    @include('users.notifications.js')
@endsection