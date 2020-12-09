@extends('layouts.livewire-layout', ['title' => 'E-Sports', 'breadcrumb' => 'dark'])

@section('breadcrumb')
    @include('esports.eteams.list.breadcrumb')
@endsection

@section('content')
	@livewire('eteams-list')
    {{-- @include('esports.eteams.list.content') --}}
@endsection