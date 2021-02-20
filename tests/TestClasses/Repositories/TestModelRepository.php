<?php

namespace Thtg88\LaravelBaseClasses\Tests\TestClasses\Repositories;

use Thtg88\LaravelBaseClasses\Repositories\Repository;
use Thtg88\LaravelBaseClasses\Tests\TestClasses\Models\TestModel;

class TestModelRepository extends Repository
{
    /**
     * Create a new repository instance.
     *
     * @param \Thtg88\LaravelBaseClasses\Tests\TestClasses\Models\TestModel $model
     * @return void
     */
    public function __construct(TestModel $model)
    {
        $this->model = $model;

        parent::__construct();
    }
}
