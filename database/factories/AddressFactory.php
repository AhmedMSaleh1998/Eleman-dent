<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $cityId = DB::table('cities')->pluck('id');
        $userId = DB::table('users')->pluck('id');
        $districtId = DB::table('districts')->pluck('id');
        return [
            'city_id' => $this->faker->randomElement($cityId),
            'district_id' => $this->faker->randomElement($districtId),
            'user_id' => $this->faker->randomElement($userId),
            'street'    => $this->faker->streetName(),
            'building'  => $this->faker->buildingNumber(),
            'floor'     => $this->faker->numberBetween(1, 20),
            'apartment' => $this->faker->numberBetween(1, 8),
            'phone'     => $this->faker->phoneNumber(),
            'lat'       => $this->faker->latitude($min = -90, $max = 90),
            'long'      => $this->faker->longitude($min = -180, $max = 180),
        ];
    }
}
