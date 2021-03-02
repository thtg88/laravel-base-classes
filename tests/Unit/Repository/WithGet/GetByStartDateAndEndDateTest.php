<?php

namespace Tests\Unit\Repositories\WithGet;

use DateInterval;
use DateTime;
use Illuminate\Database\Eloquent\Collection;
use Tests\Unit\Repository\TestCase;
use Thtg88\LaravelBaseClasses\Tests\TestClasses\Models\TestModel;

class GetByStartDateAndEndDateTest extends TestCase
{
    /**
     * @test
     * @covers \Thtg88\LaravelBaseClasses\Repositories\Concerns\WithGet::getByStartDateAndEndDate
     */
    public function date_filter_created_at_get_by_start_date_and_end_date_returns_all_models(): void
    {
        $expected = TestModel::factory()->count(5)->create();

        $start = (new DateTime())->sub(new DateInterval('P1D'));
        $end = (new DateTime())->add(new DateInterval('P1D'));

        $actual = $this->repository->setDateFilterColumns(['created_at'])
            ->getByStartDateAndEndDate($start, $end);

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
     * @covers \Thtg88\LaravelBaseClasses\Repositories\Concerns\WithGet::getByStartDateAndEndDate
     */
    public function date_filter_created_at_get_by_start_date_and_end_date_does_not_return_soft_deleted_models(): void
    {
        $models = TestModel::factory()->softDeleted()->count(5)->create();

        $start = (new DateTime())->sub(new DateInterval('P1D'));
        $end = (new DateTime())->add(new DateInterval('P1D'));

        $actual = $this->repository->setDateFilterColumns(['created_at'])
            ->getByStartDateAndEndDate($start, $end);

        $this->assertNotNull($actual);
        $this->assertInstanceOf(Collection::class, $actual);
        $this->assertEquals(0, $actual->count());
    }

    /**
     * @test
     * @covers \Thtg88\LaravelBaseClasses\Repositories\Concerns\WithGet::getByStartDateAndEndDate
     */
    public function date_filter_created_at_get_by_start_date_and_end_date_does_not_return_anything_if_no_models(): void
    {
        $start = (new DateTime())->sub(new DateInterval('P1D'));
        $end = (new DateTime())->add(new DateInterval('P1D'));

        $actual = $this->repository->setDateFilterColumns(['created_at'])
            ->getByStartDateAndEndDate($start, $end);

        $this->assertNotNull($actual);
        $this->assertInstanceOf(Collection::class, $actual);
        $this->assertEquals(0, $actual->count());
    }

    /**
     * @test
     * @covers \Thtg88\LaravelBaseClasses\Repositories\Concerns\WithGet::getByStartDateAndEndDate
     */
    public function date_filter_created_at_get_by_start_date_and_end_date_does_not_return_anything_if_no_models_within_start_and_end_dates(): void
    {
        $start = (new DateTime())->sub(new DateInterval('P10D'));
        $end = (new DateTime())->sub(new DateInterval('P1D'));

        $actual = $this->repository->setDateFilterColumns(['created_at'])
            ->getByStartDateAndEndDate($start, $end);

        $this->assertNotNull($actual);
        $this->assertInstanceOf(Collection::class, $actual);
        $this->assertEquals(0, $actual->count());
    }

    /**
     * @test
     * @covers \Thtg88\LaravelBaseClasses\Repositories\Concerns\WithGet::getByStartDateAndEndDate
     */
    public function date_filter_start_date_and_end_date_get_by_start_date_and_end_date_returns_specified_amount_of_models(): void
    {
        $expected = TestModel::factory()->count(5)->create();

        $start = (new DateTime())->sub(new DateInterval('P1D'));
        $end = (new DateTime())->add(new DateInterval('P1D'));

        $actual = $this->repository->setDateFilterColumns([
            'start_date',
            'end_date',
        ])->getByStartDateAndEndDate($start, $end);

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
     * @covers \Thtg88\LaravelBaseClasses\Repositories\Concerns\WithGet::getByStartDateAndEndDate
     */
    public function date_filter_start_date_and_end_date_get_by_start_date_and_end_date_does_not_return_soft_deleted_models(): void
    {
        $models = TestModel::factory()->softDeleted()->count(5)->create();

        $start = (new DateTime())->sub(new DateInterval('P1D'));
        $end = (new DateTime())->add(new DateInterval('P1D'));

        $actual = $this->repository->setDateFilterColumns([
            'start_date',
            'end_date',
        ])->getByStartDateAndEndDate($start, $end);

        $this->assertNotNull($actual);
        $this->assertInstanceOf(Collection::class, $actual);
        $this->assertEquals(0, $actual->count());
    }

    /**
     * @test
     * @covers \Thtg88\LaravelBaseClasses\Repositories\Concerns\WithGet::getByStartDateAndEndDate
     */
    public function date_filter_start_date_and_end_date_get_by_start_date_and_end_date_does_not_return_anything_if_no_models(): void
    {
        $start = (new DateTime())->sub(new DateInterval('P1D'));
        $end = (new DateTime())->add(new DateInterval('P1D'));

        $actual = $this->repository->setDateFilterColumns([
            'start_date',
            'end_date',
        ])->getByStartDateAndEndDate($start, $end);

        $this->assertNotNull($actual);
        $this->assertInstanceOf(Collection::class, $actual);
        $this->assertEquals(0, $actual->count());
    }

    /**
     * @test
     * @covers \Thtg88\LaravelBaseClasses\Repositories\Concerns\WithGet::getByStartDateAndEndDate
     */
    public function date_filter_start_date_and_end_date_get_by_start_date_and_end_date_does_not_return_anything_if_no_models_within_start_and_end_dates(): void
    {
        $start = (new DateTime())->sub(new DateInterval('P10D'));
        $end = (new DateTime())->sub(new DateInterval('P1D'));

        $actual = $this->repository->setDateFilterColumns([
            'start_date',
            'end_date',
        ])->getByStartDateAndEndDate($start, $end);

        $this->assertNotNull($actual);
        $this->assertInstanceOf(Collection::class, $actual);
        $this->assertEquals(0, $actual->count());
    }
}
