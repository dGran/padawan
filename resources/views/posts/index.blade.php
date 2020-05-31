@extends('layouts.app', ['title' => 'Posts List', 'breadcrumb' => 'dark'])

@section('breadcrumb')
    @include('posts.breadcrumb')
@endsection

@section('content')

    <div class="custom-container">
        <div class="my-8">
            <h1 class="font-fjalla uppercase tracking-wider text-orange-500 text-lg font-semibold">
                Posts List
            </h1>
            <table class="mt-4">
                <thead>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Acción</th>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <td>{{ $post->id }}</td>
                            <td>{{ $post->title }}</td>
                            <td>
                                @can('destroy_posts')
                                    <a href="{{ route('posts.destroy', $post->title) }}">Eliminar nota</a>
                                @else
                                    Usted no puede eliminar esta nota
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="my-12 text-xs">
            Check this for apply in other pages
            <div class="text-gray-500">
                <i class="fa fa-info mr-2" aria-hidden="true"></i>
                <a href="https://styde.net/roles-y-permisos-con-spatie-laravel-permission/" class="hover:text-white">
                    https://styde.net/roles-y-permisos-con-spatie-laravel-permission/
                </a>
            </div>
            <div class="text-gray-500">
                <i class="fa fa-info mr-2" aria-hidden="true"></i>
                <a href="https://github.com/spatie/laravel-permission" class="hover:text-white">
                    https://github.com/spatie/laravel-permission
                </a>
            </div>
        </div>
    </div>

@endsection