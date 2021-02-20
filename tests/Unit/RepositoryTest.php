<?php

namespace Tests\Unit;

use Illuminate\Database\Eloquent\Collection;
use Thtg88\LaravelBaseClasses\Tests\TestCase;
use Thtg88\LaravelBaseClasses\Tests\TestClasses\Models\TestModel;
use Thtg88\LaravelBaseClasses\Tests\TestClasses\Repositories\TestModelRepository;

class RepositoryTest extends TestCase
{
    /** @var \Thtg88\LaravelBaseClasses\Repositories\TestModelRepository */
    protected $repository;

    public function setUp(): void
    {
        parent::setUp();

        $this->repository = app()->make(TestModelRepository::class);
    }

    /** @test */
    public function all_returns_all_models(): void
    {
        $expected = TestModel::factory()->count(3)->create();

        $actual = $this->repository->all();

        $this->assertNotNull($actual);
        $this->assertInstanceOf(Collection::class, $actual);
        $this->assertEquals($expected->count(), $actual->count());
        foreach($expected as $expected_model) {
            $this->assertNotNull(
                $actual->firstWhere('id', $expected_model->id)
            );
        }
    }

    /** @test */
    public function all_does_not_return_soft_deleted_models(): void
    {
        TestModel::factory()->softDeleted()->count(3)->create();

        $actual = $this->repository->all();

        $this->assertNotNull($actual);
        $this->assertInstanceOf(Collection::class, $actual);
        $this->assertEquals(0, $actual->count());
    }
}
