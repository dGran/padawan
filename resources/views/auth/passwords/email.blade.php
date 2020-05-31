@extends('layouts.app', ['title' => 'Login', 'wrap_bg' => 'bg-gray-200'])

@section('content')

    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script>

    @include('layouts.partials.flash_errors')

    @include('layouts.partials.flash_status_messages')

    <div class="container max-w-full mx-auto pt-4 pb-12 px-6 text-gray-800 below-fixed-header">
        <div class="max-w-sm mx-auto px-2 md:px-6">
            <div class="relative flex flex-wrap">
                <div class="w-full relative">
                    <div class="mt-6">
                        <h1 class="text-center font-semibold text-black text-2xl">
                            {{ __('Reset Password') }}
                        </h1>

                        <form class="mt-8" method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="mx-auto max-w-lg">
                                <div class="py-2">
                                    <label class="px-1 text-sm text-gray-600" for="email">
                                        {{ __('E-Mail Address') }}
                                    </label>
                                    <input placeholder="" type="text" class="text-md block px-3 py-2 rounded-lg w-full bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none" name="email" id="email" value="{{ old('email') }}" autofocus>
                                </div>
                                <button class="mt-3 text-lg font-semibold bg-gray-800 w-full text-white rounded-lg px-6 py-3 block shadow-xl hover:text-white hover:bg-black focus:outline-none">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection