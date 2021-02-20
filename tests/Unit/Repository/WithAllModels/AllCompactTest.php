<?php

namespace Tests\Unit\Repository\WithAllModels;

use Tests\Unit\Repository\TestCase;
use Thtg88\LaravelBaseClasses\Tests\TestClasses\Models\TestModel;

class AllCompactTest extends TestCase
{
    /**
     * @test
     * @covers \Thtg88\LaravelBaseClasses\Repositories\Repository::allCompact
     */
    public function all_compact_returns_all_models(): void
    {
        $expected = TestModel::factory()->count(3)->create();

        $actual = $this->repository->allCompact();

        $model_name = $this->repository->getModelName();

        $this->assertNotNull($actual);
        $this->assertIsArray($actual);
        $this->assertEquals(count($expected), count($actual));
        foreach ($expected as $expected_model) {
            $this->assertArrayHasKey($expected_model->id, $actual);
            $this->assertEquals(
                $expected_model->$model_name,
                $actual[$expected_model->id]
            );
        }
    }

    /**
     * @test
     * @covers \Thtg88\LaravelBaseClasses\Repositories\Repository::allCompact
     */
    public function all_compact_does_not_return_soft_deleted_models(): void
    {
        TestModel::factory()->softDeleted()->count(3)->create();

        $actual = $this->repository->allCompact();

        $this->assertNotNull($actual);
        $this->assertIsArray($actual);
        $this->assertEquals(0, count($actual));
    }

    /**
     * @test
     * @covers \Thtg88\LaravelBaseClasses\Repositories\Repository::allCompact
     */
    public function all_compact_does_not_return_anything_if_no_models(): void
    {
        $actual = $this->repository->allCompact();

        $this->assertNotNull($actual);
        $this->assertIsArray($actual);
        $this->assertEquals(0, count($actual));
    }
}
