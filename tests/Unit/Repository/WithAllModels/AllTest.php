<?php

namespace Tests\Unit\Repository\WithAllModels;

use Illuminate\Database\Eloquent\Collection;
use Tests\Unit\Repository\TestCase;
use Thtg88\LaravelBaseClasses\Tests\TestClasses\Models\TestModel;

class AllTest extends TestCase
{
    /**
     * @test
     * @covers \Thtg88\LaravelBaseClasses\Repositories\Repository::all
     */
    public function all_returns_all_models(): void
    {
        $expected = TestModel::factory()->count(3)->create();

        $actual = $this->repository->all();

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
     * @covers \Thtg88\LaravelBaseClasses\Repositories\Repository::all
     */
    public function all_does_not_return_soft_deleted_models(): void
    {
        TestModel::factory()->softDeleted()->count(3)->create();

        $actual = $this->repository->all();

        $this->assertNotNull($actual);
        $this->assertInstanceOf(Collection::class, $actual);
        $this->assertEquals(0, $actual->count());
    }

    /**
     * @test
     * @covers \Thtg88\LaravelBaseClasses\Repositories\Repository::all
     */
    public function all_does_not_return_anything_if_no_models(): void
    {
        $actual = $this->repository->all();

        $this->assertNotNull($actual);
        $this->assertInstanceOf(Collection::class, $actual);
        $this->assertEquals(0, $actual->count());
    }
}
