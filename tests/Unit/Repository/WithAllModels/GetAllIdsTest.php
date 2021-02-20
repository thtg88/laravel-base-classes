<?php

namespace Tests\Unit\Repository\WithAllModels;

use Tests\Unit\Repository\TestCase;
use Thtg88\LaravelBaseClasses\Tests\TestClasses\Models\TestModel;

class GetAllIdsTest extends TestCase
{
    /**
     * @test
     * @covers \Thtg88\LaravelBaseClasses\Repositories\Repository::getAllIds
     */
    public function get_all_ids_returns_all_models(): void
    {
        $models = TestModel::factory()->count(3)->create();

        $expected = $models->pluck('id')->toArray();

        $actual = $this->repository->getAllIds();

        $this->assertNotNull($actual);
        $this->assertIsArray($actual);
        $this->assertEquals(count($expected), count($actual));
        foreach ($expected as $expected_id) {
            $this->assertContains($expected_id, $actual);
        }
    }

    /**
     * @test
     * @covers \Thtg88\LaravelBaseClasses\Repositories\Repository::getAllIds
     */
    public function get_all_ids_does_not_return_soft_deleted_models(): void
    {
        TestModel::factory()->softDeleted()->count(3)->create();

        $ids = $this->repository->getAllIds();

        $this->assertNotNull($ids);
        $this->assertIsArray($ids);
        $this->assertEquals(0, count($ids));
    }

    /**
     * @test
     * @covers \Thtg88\LaravelBaseClasses\Repositories\Repository::getAllIds
     */
    public function get_all_ids_does_not_return_anything_if_no_models(): void
    {
        $ids = $this->repository->getAllIds();

        $this->assertNotNull($ids);
        $this->assertIsArray($ids);
        $this->assertEquals(0, count($ids));
    }
}
