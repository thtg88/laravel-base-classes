<?php

namespace Tests\Unit\Repository;

use Thtg88\LaravelBaseClasses\Tests\TestCase as BaseTestCase;
use Thtg88\LaravelBaseClasses\Tests\TestClasses\Repositories\TestModelRepository;

abstract class TestCase extends BaseTestCase
{
    /** @var \Thtg88\LaravelBaseClasses\Repositories\TestModelRepository */
    protected $repository;

    public function setUp(): void
    {
        parent::setUp();

        $this->repository = app()->make(TestModelRepository::class);
    }
}
