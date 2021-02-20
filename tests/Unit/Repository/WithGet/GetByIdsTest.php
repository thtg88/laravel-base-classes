<?php

namespace Tests\Unit\Repository\WithAllModels;

use Illuminate\Database\Eloquent\Collection;
use Tests\Unit\Repository\TestCase;
use Thtg88\LaravelBaseClasses\Tests\TestClasses\Models\TestModel;

class GetByIdsTest extends TestCase
{
    /**
     * @test
     * @covers \Thtg88\LaravelBaseClasses\Repositories\Concerns\WithGet::getByIds
     */
    public function get_by_ids_returns_all_models(): void
    {
        $expected = TestModel::factory()->count(3)->create();

        $actual = $this->repository->getByIds(
            $expected->pluck('id')->toArray()
        );

        $this->assertNotNull($actual);
        $this->assertInstanceOf(Collection::class, $actual);
        $this->assertEquals($expected->count(), $actual->count());
        foreach ($expected as $expected_model) {
            $this->assertNotNull(
                $actual->firstWhere('id', $expected_model->id)
            );
        }
    }

    /**
     * @test
     * @covers \Thtg88\LaravelBaseClasses\Repositories\Concerns\WithGet::getByIds
     */
    public function get_by_ids_does_not_return_soft_deleted_models(): void
    {
        $models = TestModel::factory()->softDeleted()->count(3)->create();

        $actual = $this->repository->getByIds(
            $models->pluck('id')->toArray()
        );

        $this->assertNotNull($actual);
        $this->assertInstanceOf(Collection::class, $actual);
        $this->assertEquals(0, $actual->count());
    }

    /**
     * @test
     * @covers \Thtg88\LaravelBaseClasses\Repositories\Concerns\WithGet::getByIds
     */
    public function get_by_ids_does_not_return_anything_if_no_models(): void
    {
        $actual = $this->repository->getByIds([1, 2, 3]);

        $this->assertNotNull($actual);
        $this->assertInstanceOf(Collection::class, $actual);
        $this->assertEquals(0, $actual->count());
    }

    /**
     * @test
     * @covers \Thtg88\LaravelBaseClasses\Repositories\Concerns\WithGet::getByIds
     */
    public function get_by_ids_does_not_return_anything_if_ids_are_of_type_string(): void
    {
        TestModel::factory()->count(3)->create();

        $actual = $this->repository->getByIds(['abcd']);

        $this->assertNotNull($actual);
        $this->assertInstanceOf(Collection::class, $actual);
        $this->assertEquals(0, $actual->count());
    }

    /**
     * @test
     * @covers \Thtg88\LaravelBaseClasses\Repositories\Concerns\WithGet::getByIds
     */
    public function get_by_ids_does_not_return_anything_if_ids_are_of_type_array(): void
    {
        TestModel::factory()->count(3)->create();

        $actual = $this->repository->getByIds([[2]]);

        $this->assertNotNull($actual);
        $this->assertInstanceOf(Collection::class, $actual);
        $this->assertEquals(0, $actual->count());
    }

    /**
     * @test
     * @covers \Thtg88\LaravelBaseClasses\Repositories\Concerns\WithGet::getByIds
     */
    public function get_by_ids_does_not_return_anything_if_ids_are_null(): void
    {
        TestModel::factory()->count(3)->create();

        $actual = $this->repository->getByIds([null]);

        $this->assertNotNull($actual);
        $this->assertInstanceOf(Collection::class, $actual);
        $this->assertEquals(0, $actual->count());
    }

    /**
     * @test
     * @covers \Thtg88\LaravelBaseClasses\Repositories\Concerns\WithGet::getByIds
     */
    public function get_by_ids_does_not_return_anything_if_ids_are_of_type_int(): void
    {
        TestModel::factory()->count(3)->create();

        $actual = $this->repository->getByIds([0]);

        $this->assertNotNull($actual);
        $this->assertInstanceOf(Collection::class, $actual);
        $this->assertEquals(0, $actual->count());
    }
}
