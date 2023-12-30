<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Coupon>
 */
class CouponFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'code' => $this->faker->hexcolor(),
            'value' => $this->faker->numberBetween($min = 200, $max = 5000),
            'type'  => $this->faker->text('6'),
            'uses' => $this->faker->numberBetween(1, 5),
            'valid_from' => now(),
            'valid_to'  => now()->addDays(100),
        ];
    }
}
