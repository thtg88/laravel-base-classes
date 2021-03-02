<?php

namespace Thtg88\LaravelBaseClasses\Database\Factories;

use Illuminate\Support\Str;
use Thtg88\LaravelBaseClasses\Models\User;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // 'first_name' => $this->faker->firstName,
            // 'last_name' => $this->faker->lastName,
            'email'             => $this->faker->unique()->safeEmail,
            'email_verified_at' => now()->toDateTimeString(),
            'password'          => 'password',
            'remember_token'    => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return ['email_verified_at' => null];
    }
}
