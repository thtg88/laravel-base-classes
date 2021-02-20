<?php

namespace Tests\Unit\Repository\WithFind;

use Tests\Unit\Repository\TestCase;
use Thtg88\LaravelBaseClasses\Tests\TestClasses\Models\TestModel;

class FindRandomTest extends TestCase
{
    /**
     * @test
     * @covers \Thtg88\LaravelBaseClasses\Repositories\Repository::findRandom
     */
    public function find_by_model_name_returns_a_model(): void
    {
        $models = TestModel::factory()->count(3)->create();

        $actual = $this->repository->findRandom();

        $this->assertNotNull($actual);
        $this->assertInstanceOf(TestModel::class, $actual);
        $this->assertNotNull($models->firstWhere('id', $actual->id));
    }

    /**
     * @test
     * @covers \Thtg88\LaravelBaseClasses\Repositories\Repository::findRandom
     */
    public function find_by_model_name_does_not_return_soft_deleted_models(): void
    {
        TestModel::factory()->softDeleted()->count(3)->create();

        $actual = $this->repository->findRandom();

        $this->assertNull($actual);
    }

    /**
     * @test
     * @covers \Thtg88\LaravelBaseClasses\Repositories\Repository::findRandom
     */
    public function find_by_model_name_does_not_return_anything_if_no_models(): void
    {
        $actual = $this->repository->findRandom();

        $this->assertNull($actual);
    }
}
