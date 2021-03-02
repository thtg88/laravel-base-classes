<?php

namespace Tests\Unit\Repository\WithAllModels;

use Illuminate\Database\Eloquent\Collection;
use Tests\Unit\Repository\TestCase;
use Thtg88\LaravelBaseClasses\Tests\TestClasses\Models\TestModel;

class LatestTest extends TestCase
{
    /**
     * @test
     * @covers \Thtg88\LaravelBaseClasses\Repositories\Concerns\WithGet::latest
     */
    public function latest_returns_specified_amount_of_models(): void
    {
        $models = TestModel::factory()->count(5)->create();

        $limit = 3;

        $actual = $this->repository->latest($limit);

        $this->assertNotNull($actual);
        $this->assertInstanceOf(Collection::class, $actual);
        $this->assertEquals($limit, $actual->count());
        // Make sure that all actual models are contained in the result
        $this->assertEquals(
            $limit,
            count(array_intersect_key(
                $actual->pluck('id')->toArray(),
                $models->pluck('id')->toArray()
            ))
        );
    }

    /**
     * @test
     * @covers \Thtg88\LaravelBaseClasses\Repositories\Concerns\WithGet::latest
     */
    public function latest_does_not_return_soft_deleted_models(): void
    {
        $models = TestModel::factory()->softDeleted()->count(5)->create();

        $limit = 3;

        $actual = $this->repository->latest($limit);

        $this->assertNotNull($actual);
        $this->assertInstanceOf(Collection::class, $actual);
        $this->assertEquals(0, $actual->count());
    }

    /**
     * @test
     * @covers \Thtg88\LaravelBaseClasses\Repositories\Concerns\WithGet::latest
     */
    public function latest_does_not_return_anything_if_no_models(): void
    {
        $actual = $this->repository->latest(3);

        $this->assertNotNull($actual);
        $this->assertInstanceOf(Collection::class, $actual);
        $this->assertEquals(0, $actual->count());
    }

    /**
     * @test
     * @covers \Thtg88\LaravelBaseClasses\Repositories\Concerns\WithGet::latest
     */
    public function latest_does_not_return_anything_if_limit_is_of_type_string(): void
    {
        TestModel::factory()->count(3)->create();

        $actual = $this->repository->latest('abcd');

        $this->assertNotNull($actual);
        $this->assertInstanceOf(Collection::class, $actual);
        $this->assertEquals(0, $actual->count());
    }

    /**
     * @test
     * @covers \Thtg88\LaravelBaseClasses\Repositories\Concerns\WithGet::latest
     */
    public function latest_does_not_return_anything_if_limit_is_of_type_array(): void
    {
        TestModel::factory()->count(3)->create();

        $actual = $this->repository->latest([2]);

        $this->assertNotNull($actual);
        $this->assertInstanceOf(Collection::class, $actual);
        $this->assertEquals(0, $actual->count());
    }

    /**
     * @test
     * @covers \Thtg88\LaravelBaseClasses\Repositories\Concerns\WithGet::latest
     */
    public function latest_does_not_return_anything_if_limit_is_null(): void
    {
        TestModel::factory()->count(3)->create();

        $actual = $this->repository->latest(null);

        $this->assertNotNull($actual);
        $this->assertInstanceOf(Collection::class, $actual);
        $this->assertEquals(0, $actual->count());
    }

    /**
     * @test
     * @covers \Thtg88\LaravelBaseClasses\Repositories\Concerns\WithGet::latest
     */
    public function latest_does_not_return_anything_if_limit_is_zero(): void
    {
        TestModel::factory()->count(3)->create();

        $actual = $this->repository->latest(0);

        $this->assertNotNull($actual);
        $this->assertInstanceOf(Collection::class, $actual);
        $this->assertEquals(0, $actual->count());
    }
}
