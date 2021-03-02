<?php

namespace Thtg88\LaravelBaseClasses\Tests\TestClasses\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Thtg88\LaravelBaseClasses\Models\Model;
use Thtg88\LaravelBaseClasses\Tests\TestClasses\Factories\TestModelFactory;

class TestModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillables = [
        'end_date',
        'start_date',
        'uuid',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
        'deleted_at' => 'datetime',
        'end_date'   => 'datetime',
        'start_date' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return TestModelFactory::new();
    }
}
