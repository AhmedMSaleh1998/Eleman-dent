<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'              => $this->faker->name(),
            'email'             => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password'          => '$2a$12$D5.fQgXAK5C8EnFXtL/Fwu0G3C3balnkl3XElt.iGdSfILHuHCjHe', // password
            'phone'             => $this->faker->phoneNumber(),
            'code'              => $this->faker->numberBetween($min = 1000, $max = 9000),
            'remember_token'    => Str::random(20),
            'created_at'        => now(),
            'updated_at'        => now(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
