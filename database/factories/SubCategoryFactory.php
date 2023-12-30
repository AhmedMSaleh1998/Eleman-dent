<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class SubCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $parentIds = DB::table('categories')->where('parent_id',null)->pluck('id');
        return [
            'name'      => $this->faker->name(),
            'image' => '2.jpg',
            'parent_id' => $this->faker->randomElement($parentIds),
        ];
    }
}