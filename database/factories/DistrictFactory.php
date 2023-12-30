<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\District>
 */
class DistrictFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition()
    {
        $citiesIDs = DB::table('cities')->pluck('id');
        return [
            'name' => $this->faker->name(),
            'city_id' => $this->faker->randomElement($citiesIDs),
        ];
    }
}
