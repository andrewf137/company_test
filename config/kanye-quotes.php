<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Kanye Quotes Driver
    |--------------------------------------------------------------------------
    |
    | This option controls the default kanye quotes driver that will be used to
    | get kanye quotes. By default, the kanye-api-rest is used;
    | however, you remain free to modify this option if you wish.
    |
    | Supported: "kanye-api-rest"
    |
    */

    'driver' => 'kanye-api-rest',

    /*
    |--------------------------------------------------------------------------
    | kanye-api-rest Options
    |--------------------------------------------------------------------------
    |
    | Here you may specify the configuration options that should be used when
    | retrieving the kanye quotes, like endpoint and number of quotes.
    |
    */

    'kanye-api-rest' => [
        'endpoint' => env('KANYE_QUOTES_ENDPOINT'),
        'numberOfQuotes' => 5,
    ],
];
