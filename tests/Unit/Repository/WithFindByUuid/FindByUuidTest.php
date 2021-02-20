<?php

namespace Tests\Unit\Repository\WithAllModels;

use Illuminate\Support\Str;
use Tests\Unit\Repository\TestCase;
use Thtg88\LaravelBaseClasses\Tests\TestClasses\Models\TestModel;

class FindByUuidTest extends TestCase
{
    /**
     * @test
     * @covers \Thtg88\LaravelBaseClasses\Repositories\Concerns\WithFindByUuid::findByUuid
     */
    public function find_returns_a_model(): void
    {
        $expected = TestModel::factory()->create();

        $actual = $this->repository->findByUuid($expected->uuid);

        $this->assertNotNull($actual);
        $this->assertInstanceOf(TestModel::class, $actual);
        $this->assertTrue($actual->is($expected));
    }

    /**
     * @test
     * @covers \Thtg88\LaravelBaseClasses\Repositories\Concerns\WithFindByUuid::findByUuid
     */
    public function find_does_not_return_soft_deleted_model(): void
    {
        $expected = TestModel::factory()->softDeleted()->create();

        $actual = $this->repository->findByUuid($expected->uuid);

        $this->assertNull($actual);
    }

    /**
     * @test
     * @covers \Thtg88\LaravelBaseClasses\Repositories\Concerns\WithFindByUuid::findByUuid
     */
    public function find_does_not_return_anything_if_no_models(): void
    {
        $actual = $this->repository->findByUuid((string) Str::uuid());

        $this->assertNull($actual);
    }

    /**
     * @test
     * @covers \Thtg88\LaravelBaseClasses\Repositories\Concerns\WithFindByUuid::findByUuid
     */
    public function find_does_not_return_anything_if_model_name_zero(): void
    {
        $actual = $this->repository->findByUuid(0);

        $this->assertNull($actual);
    }

    /**
     * @test
     * @covers \Thtg88\LaravelBaseClasses\Repositories\Concerns\WithFindByUuid::findByUuid
     */
    public function find_does_not_return_anything_if_model_name_empty_string(): void
    {
        $actual = $this->repository->findByUuid('');

        $this->assertNull($actual);
    }
}
