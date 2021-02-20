<?php

namespace Tests\Unit\Repository\WithAllModels;

use Illuminate\Database\Eloquent\Collection;
use Tests\Unit\Repository\TestCase;
use Thtg88\LaravelBaseClasses\Tests\TestClasses\Models\TestModel;

class FindFirstTest extends TestCase
{
    /**
     * @test
     * @covers \Thtg88\LaravelBaseClasses\Repositories\Repository::findFirst
     */
    public function find_first_returns_all_models(): void
    {
        $models = TestModel::factory()->count(3)->create();

        $expected = $models->first();

        $actual = $this->repository->findFirst();

        $this->assertNotNull($actual);
        $this->assertInstanceOf(TestModel::class, $actual);
        $this->assertTrue($actual->is($expected));
    }

    /**
     * @test
     * @covers \Thtg88\LaravelBaseClasses\Repositories\Repository::findFirst
     */
    public function find_first_does_not_return_soft_deleted_models(): void
    {
        TestModel::factory()->softDeleted()->count(3)->create();

        $actual = $this->repository->findFirst();

        $this->assertNull($actual);
    }

    /**
     * @test
     * @covers \Thtg88\LaravelBaseClasses\Repositories\Repository::findFirst
     */
    public function find_first_does_not_return_anything_if_no_models(): void
    {
        $actual = $this->repository->findFirst();

        $this->assertNull($actual);
    }
}
