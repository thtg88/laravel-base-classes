<?php

namespace Thtg88\LaravelBaseClasses\Tests\TestClasses\Factories;

use Illuminate\Support\Str;
use Thtg88\LaravelBaseClasses\Database\Factories\Factory;
use Thtg88\LaravelBaseClasses\Tests\TestClasses\Models\TestModel;

class TestModelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TestModel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'end_date'   => $this->faker->dateTime(),
            'start_date' => function (array $data) {
                return $this->faker->dateTime($data['end_date']);
            },
            'uuid' => (string) Str::uuid(),
        ];
    }
}
