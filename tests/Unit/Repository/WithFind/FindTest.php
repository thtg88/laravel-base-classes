<?php

namespace Tests\Unit\Repository\WithAllModels;

use Tests\Unit\Repository\TestCase;
use Thtg88\LaravelBaseClasses\Tests\TestClasses\Models\TestModel;

class FindTest extends TestCase
{
    /**
     * @test
     * @covers \Thtg88\LaravelBaseClasses\Repositories\Repository::find
     */
    public function find_returns_a_model(): void
    {
        $expected = TestModel::factory()->create();

        $actual = $this->repository->find($expected->id);

        $this->assertNotNull($actual);
        $this->assertInstanceOf(TestModel::class, $actual);
        $this->assertTrue($actual->is($expected));
    }

    /**
     * @test
     * @covers \Thtg88\LaravelBaseClasses\Repositories\Repository::find
     */
    public function find_does_not_return_soft_deleted_model(): void
    {
        $expected = TestModel::factory()->softDeleted()->create();

        $actual = $this->repository->find($expected->id);

        $this->assertNull($actual);
    }

    /**
     * @test
     * @covers \Thtg88\LaravelBaseClasses\Repositories\Repository::find
     */
    public function find_does_not_return_anything_if_no_models(): void
    {
        $actual = $this->repository->find(1);

        $this->assertNull($actual);
    }

    /**
     * @test
     * @covers \Thtg88\LaravelBaseClasses\Repositories\Repository::find
     */
    public function find_does_not_return_anything_if_model_name_null(): void
    {
        $actual = $this->repository->find(null);

        $this->assertNull($actual);
    }

    /**
     * @test
     * @covers \Thtg88\LaravelBaseClasses\Repositories\Repository::find
     */
    public function find_does_not_return_anything_if_model_name_zero(): void
    {
        $actual = $this->repository->find(0);

        $this->assertNull($actual);
    }

    /**
     * @test
     * @covers \Thtg88\LaravelBaseClasses\Repositories\Repository::find
     */
    public function find_does_not_return_anything_if_model_name_empty_string(): void
    {
        $actual = $this->repository->find('');

        $this->assertNull($actual);
    }

    /**
     * @test
     * @covers \Thtg88\LaravelBaseClasses\Repositories\Repository::find
     */
    public function find_does_not_return_anything_if_model_name_not_numeric(): void
    {
        $actual = $this->repository->find([]);

        $this->assertNull($actual);
    }
}
