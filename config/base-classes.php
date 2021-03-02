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
    | Journal mode
    |--------------------------------------------------------------------------
    |
    | This variable defines whether or not journal mode is enabled
    | for the application. This means a paper trail will be left in the
    | "journal_entries" table whenever a change (INSERT, UPDATE, DELETE)
    | will be performed on a model, via a Repository class.
    |
    */

    'journal_mode' => env('LARAVEL_BASE_JOURNAL_MODE', true),

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
