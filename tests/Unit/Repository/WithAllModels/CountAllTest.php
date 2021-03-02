<?php

namespace Tests\Unit\Repository\WithAllModels;

use Tests\Unit\Repository\TestCase;
use Thtg88\LaravelBaseClasses\Tests\TestClasses\Models\TestModel;

class CountAllTest extends TestCase
{
    /**
     * @test
     * @covers \Thtg88\LaravelBaseClasses\Repositories\Repository::countAll
     */
    public function count_all_returns_all_models(): void
    {
        $expected = 3;

        TestModel::factory()->count($expected)->create();

        $actual = $this->repository->countAll();

        $this->assertIsInt($actual);
        $this->assertEquals($expected, $actual);
    }

    /**
     * @test
     * @covers \Thtg88\LaravelBaseClasses\Repositories\Repository::countAll
     */
    public function count_all_does_not_return_soft_deleted_models(): void
    {
        $expected = 0;

        TestModel::factory()->softDeleted()->count(3)->create();

        $actual = $this->repository->countAll();

        $this->assertIsInt($actual);
        $this->assertEquals($expected, $actual);
    }

    /**
     * @test
     * @covers \Thtg88\LaravelBaseClasses\Repositories\Repository::countAll
     */
    public function count_all_does_not_return_anything_if_no_models(): void
    {
        $expected = 0;

        $actual = $this->repository->countAll();

        $this->assertIsInt($actual);
        $this->assertEquals($expected, $actual);
    }
}
