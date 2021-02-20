<?php

namespace Tests\Unit\Repository\WithAllModels;

use Illuminate\Database\Eloquent\Collection;
use Tests\Unit\Repository\TestCase;
use Thtg88\LaravelBaseClasses\Tests\TestClasses\Models\TestModel;

class FindLastTest extends TestCase
{
    /**
     * @test
     * @covers \Thtg88\LaravelBaseClasses\Repositories\Repository::findLast
     */
    public function find_last_returns_all_models(): void
    {
        $models = TestModel::factory()->count(3)->create();

        $expected = $models->last();

        $actual = $this->repository->findLast();

        $this->assertNotNull($actual);
        $this->assertInstanceOf(TestModel::class, $actual);
        $this->assertTrue($actual->is($expected));
    }

    /**
     * @test
     * @covers \Thtg88\LaravelBaseClasses\Repositories\Repository::findLast
     */
    public function find_last_does_not_return_soft_deleted_models(): void
    {
        TestModel::factory()->softDeleted()->count(3)->create();

        $actual = $this->repository->findLast();

        $this->assertNull($actual);
    }

    /**
     * @test
     * @covers \Thtg88\LaravelBaseClasses\Repositories\Repository::findLast
     */
    public function find_last_does_not_return_anything_if_no_models(): void
    {
        $actual = $this->repository->findLast();

        $this->assertNull($actual);
    }
}
