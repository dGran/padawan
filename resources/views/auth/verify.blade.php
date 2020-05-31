@extends('layouts.app', ['title' => 'Login', 'wrap_bg' => 'bg-gray-200'])

@section('content')

    <div class="container max-w-full mx-auto pt-4 pb-12 px-6 text-gray-800 below-fixed-header">
        <div class="max-w-sm mx-auto px-2 md:px-6">
            <div class="relative flex flex-wrap">
                <div class="w-full relative">
                    <div class="mt-6">
                        <h1 class="text-center font-semibold text-black text-2xl">
                            {{ __('Verify Your Email Address') }}
                        </h1>

                        @if (session('resent'))
                            <div class="custom-container relative">
                                <div class="px-4">
                                    <div id="flash-container" style="z-index:9999; " class="fixed top-0 left-0 right-0 autoHide5s">
                                        <div class="container mx-auto">
                                            <div class="text-white text-sm p-4 m-4 rounded bg-green-500 relative animated fadeInDown fast text-center">
                                                <span class="inline-block align-middle mr-10">
                                                    {{ __('A fresh verification link has been sent to your email address.') }}
                                                </span>
                                                <button class="bg-transparent text-2xl font-semibold leading-none absolute right-0 top-0 mt-4 mr-4 outline-none focus:outline-none" onclick="closeAlert()">
                                                    <span>×</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <script>
                            function closeAlert(){
                                animateCSS_remove('#flash-container div', 'fadeInDown');
                                animateCSS_add('#flash-container div', 'fadeOutUp', function() {
                                    $('#flash-container').remove();
                                });
                            }
                        </script>

                        <div class="mt-8">
                            {{ __('Before proceeding, please check your email for a verification link.') }}
                            {{ __('If you did not receive the email') }},
                            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                                @csrf
                                <button class="mt-6 text-lg font-semibold bg-gray-800 w-full text-white rounded-lg px-6 py-3 block shadow-xl hover:text-white hover:bg-black focus:outline-none">
                                    {{ __('click here to request another') }}
                                </button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
