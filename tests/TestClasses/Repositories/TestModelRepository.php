<?php

namespace Thtg88\LaravelBaseClasses\Tests\TestClasses\Repositories;

use Thtg88\LaravelBaseClasses\Repositories\Concerns\WithFindByUuid;
use Thtg88\LaravelBaseClasses\Repositories\Repository;
use Thtg88\LaravelBaseClasses\Tests\TestClasses\Models\TestModel;

class TestModelRepository extends Repository
{
    use WithFindByUuid;

    /** @var string */
    protected static $model_name = 'uuid';

    /** @var array */
    protected static $order_by_columns = ['id' => 'desc'];

    /** @var string[] */
    protected static $search_columns = [];

    /** @var string[] */
    protected static $filter_columns = [];

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
