<?php

return [

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
            env('APP_PAGINATION_COLUMNS', '*')
        ],

        'page_name' => env('APP_PAGINATION_PAGE_NAME', 'page'),

        'page_size' => env('APP_PAGINATION_PAGE_SIZE', 10),
    ],
];
