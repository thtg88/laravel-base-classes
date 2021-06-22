<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Bulk Insert Chunk Size
    |--------------------------------------------------------------------------
    |
    | This variable holds the size of the array of data to chunk
    | whenever performing a bulk insert. This is set to accommodate different
    | systems, which may have different limits.
    |
    */

    'create_bulk_chunk_size' => env('LARAVEL_BASE_CREATE_BULK_CHUNK_SIZE', 100),

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
            env('LARAVEL_BASE_PAGINATION_COLUMNS', '*'),
        ],

        'page_name' => env('LARAVEL_BASE_PAGINATION_PAGE_NAME', 'page'),

        'page_size' => env('LARAVEL_BASE_PAGINATION_PAGE_SIZE', 10),
    ],
];
