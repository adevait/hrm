<?php

return [

    /*
    |--------------------------------------------------------------------------
    | View Storage Paths
    |--------------------------------------------------------------------------
    |
    | Most templating systems load templates from disk. Here you may specify
    | an array of paths that should be checked for your views. Of course
    | the usual Laravel view path has already been registered for you.
    |
    */

    'paths' => [
        realpath(base_path('resources/views')),
        realpath(base_path('app/Modules/Pim/resources/views')),
        realpath(base_path('app/Modules/Settings/resources/views')),
        realpath(base_path('app/Modules/Leave/resources/views')),
        realpath(base_path('app/Modules/Recruitment/resources/views')),
        realpath(base_path('app/Modules/Discipline/resources/views')),
        realpath(base_path('app/Modules/Time/resources/views')),
    ],

    /*
    |--------------------------------------------------------------------------
    | Compiled View Path
    |--------------------------------------------------------------------------
    |
    | This option determines where all the compiled Blade templates will be
    | stored for your application. Typically, this is within the storage
    | directory. However, as usual, you are free to change this value.
    |
    */

    'compiled' => realpath(storage_path('framework/views')),

];
