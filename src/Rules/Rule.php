<?php

namespace Thtg88\LaravelBaseClasses\Rules;

use Illuminate\Validation\Rule as BaseRule;

class Rule extends BaseRule
{
    /**
     * Get a unique constraint builder instance.
     *
     * @param string $table
     * @param string $column
     * @return \Thtg88\LaravelBaseClasses\Rules\UniqueCaseInsensitive
     */
    public static function uniqueCaseInsensitive(
        $table,
        $column = 'NULL'
    ): UniqueCaseInsensitive {
        return new UniqueCaseInsensitive($table, $column);
    }
}
