<?php

namespace Database\Factories;

use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        //$parentIds = DB::table('categories')->where('parent_id',null)->pluck('id');

        return [
            'name'      => $this->faker->name(),
            'image' => '1.jpg',
            //'parent_id' => $this->faker->randomElement($parentIds),
        ];
    }
}