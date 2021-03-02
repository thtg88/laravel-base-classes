<?php

namespace Tests\Unit\Repository\WithAllModels;

use Tests\Unit\Repository\TestCase;
use Thtg88\LaravelBaseClasses\Tests\TestClasses\Models\TestModel;

class FindByModelNameTest extends TestCase
{
    /**
     * @test
     * @covers \Thtg88\LaravelBaseClasses\Repositories\Repository::findByModelName
     */
    public function find_by_model_name_returns_a_model(): void
    {
        $models = TestModel::factory()->count(3)->create();

        $expected = $models->random();

        $model_name = $this->repository->getModelName();

        $actual = $this->repository->findByModelName($expected->$model_name);

        $this->assertNotNull($actual);
        $this->assertInstanceOf(TestModel::class, $actual);
        $this->assertTrue($actual->is($expected));
    }

    /**
     * @test
     * @covers \Thtg88\LaravelBaseClasses\Repositories\Repository::findByModelName
     */
    public function find_by_model_name_does_not_return_soft_deleted_models(): void
    {
        $models = TestModel::factory()->softDeleted()->count(3)->create();

        $expected = $models->random();

        $model_name = $this->repository->getModelName();

        $actual = $this->repository->findByModelName($model_name);

        $this->assertNull($actual);
    }

    /**
     * @test
     * @covers \Thtg88\LaravelBaseClasses\Repositories\Repository::findByModelName
     */
    public function find_by_model_name_does_not_return_anything_if_no_models(): void
    {
        $actual = $this->repository->findByModelName(
            now()->toDateTimeString()
        );

        $this->assertNull($actual);
    }

    /**
     * @test
     * @covers \Thtg88\LaravelBaseClasses\Repositories\Repository::findByModelName
     */
    public function find_by_model_name_does_not_return_anything_if_model_name_null(): void
    {
        $actual = $this->repository->findByModelName(null);

        $this->assertNull($actual);
    }

    /**
     * @test
     * @covers \Thtg88\LaravelBaseClasses\Repositories\Repository::findByModelName
     */
    public function find_by_model_name_does_not_return_anything_if_model_name_zero(): void
    {
        $actual = $this->repository->findByModelName(0);

        $this->assertNull($actual);
    }

    /**
     * @test
     * @covers \Thtg88\LaravelBaseClasses\Repositories\Repository::findByModelName
     */
    public function find_by_model_name_does_not_return_anything_if_model_name_empty_string(): void
    {
        $actual = $this->repository->findByModelName('');

        $this->assertNull($actual);
    }
}
