@extends('layouts.app', ['title' => 'Posts List'])

@section('content')
    @include('layouts.partials.flash_status_messages')

    <div class="custom-container below-fixed-header">
        <div class="py-8">
            <h2 class="font-fjalla uppercase tracking-wider text-orange-500 text-lg font-semibold">
                Content title
            </h2>

			{{-- <iframe class="mt-8 w-full h-screen" src="https://docs.google.com/viewer?url=http://unec.edu.az/application/uploads/2014/12/pdf-sample.pdf&embedded=true"  frameborder="0"></iframe> --}}

        </div>
    </div>
@endsection