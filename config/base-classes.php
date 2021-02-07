<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Pagination
    |--------------------------------------------------------------------------
    |
    | These variables regulate the pagination settings for all repositories
    | throughout the app.
    |
    */

    'pagination' => [
        'columns' => [
            env('APP_PAGINATION_COLUMNS', '*')
        ],

        'page_name' => env('APP_PAGINATION_PAGE_NAME', 'page'),

        'page_size' => env('APP_PAGINATION_PAGE_SIZE', 10),
    ],
];
