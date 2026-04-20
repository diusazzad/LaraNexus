<?php

return [
    /*
    |--------------------------------------------------------------------------
    | LaraNexus Dashboard Path
    |--------------------------------------------------------------------------
    |
    | This is the URI path where the LaraNexus dashboard will be accessible.
    |
    */
    'path' => env('LARANEXUS_PATH', 'laranexus'),

    /*
    |--------------------------------------------------------------------------
    | Middleware
    |--------------------------------------------------------------------------
    |
    | These middleware will be assigned to every LaraNexus route.
    |
    */
    'middleware' => [
        'web',
    ],
];
