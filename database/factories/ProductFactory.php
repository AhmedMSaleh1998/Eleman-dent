<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $categoryId = DB::table('categories')->where('parent_id','!=',null)->pluck('id');
        $modelId = DB::table('shoe_models')->pluck('id');
        $materialId = DB::table('materials')->pluck('id');
        $soleId = DB::table('soles')->pluck('id');
        $colorId = DB::table('colors')->pluck('id');
        return [
            'name' => $this->faker->name(),
            'image' => '1.jpg',
            'price' => $this->faker->numberBetween($min = 1000, $max = 2000),
            'discount_price' => $this->faker->numberBetween($min = 100, $max = 1000),
            'description' => $this->faker->text('80'),
            'category_id' => $this->faker->randomElement($categoryId),
            'model_id' => $this->faker->randomElement($modelId),
            'material_id' => $this->faker->randomElement($materialId),
            'sole_id' => $this->faker->randomElement($soleId),
            'color_id' => $this->faker->randomElement($colorId),
        ];
    }
}
