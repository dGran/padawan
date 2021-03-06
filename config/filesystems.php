<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => env('FILESYSTEM_DRIVER', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Default Cloud Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Many applications store files both locally and in the cloud. For this
    | reason, you may specify a default "cloud" driver here. This driver
    | will be bound as the Cloud disk implementation in the container.
    |
    */

    'cloud' => env('FILESYSTEM_CLOUD', 's3'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been setup for each driver as an example of the required options.
    |
    | Supported Drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        'avatars' => [
            'driver' => 'local',
            'root' => public_path('img/avatars'),
            'visibility' => 'public',
        ],

        'platforms' => [
            'driver' => 'local',
            'root' => public_path('img/platforms'),
            'visibility' => 'public',
        ],

        'games' => [
            'driver' => 'local',
            'root' => public_path('img/games'),
            'visibility' => 'public',
        ],

        'circuits' => [
            'driver' => 'local',
            'root' => public_path('img/circuits'),
            'visibility' => 'public',
        ],

        'teams' => [
            'driver' => 'local',
            'root' => public_path('img/teams'),
            'visibility' => 'public',
        ],

        'players' => [
            'driver' => 'local',
            'root' => public_path('img/players'),
            'visibility' => 'public',
        ],

        'tournaments' => [
            'driver' => 'local',
            'root' => public_path('img/tournaments'),
            'visibility' => 'public',
        ],

        'seasons_posts' => [
            'driver' => 'local',
            'root' => public_path('img/seasons_posts'),
            'visibility' => 'public',
        ],

        'competitions' => [
            'driver' => 'local',
            'root' => public_path('img/competitions'),
            'visibility' => 'public',
        ],

        'eteams' => [
            'driver' => 'local',
            'root' => public_path('img/eteams'),
            'visibility' => 'public',
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],


        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Here you may configure the symbolic links that will be created when the
    | `storage:link` Artisan command is executed. The array keys should be
    | the locations of the links and the values should be their targets.
    |
    */

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

];
