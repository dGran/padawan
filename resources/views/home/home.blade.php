@extends('layouts.app', ['title' => 'Posts List'])

@section('content')
    @include('layouts.partials.flash_status_messages')

    <div class="custom-container below-fixed-header">
        <div class="py-8">
            <h2 class="font-fjalla uppercase tracking-wider text-orange-500 text-lg font-semibold">
                Content title
            </h2>

        </div>
    </div>
@endsection