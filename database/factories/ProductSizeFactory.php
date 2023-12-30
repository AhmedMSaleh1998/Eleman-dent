<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductSize>
 */
class ProductSizeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $sizeId = DB::table('sizes')->pluck('id');
        $productId = DB::table('products')->pluck('id');
        return [
            'size_id' => $this->faker->randomElement($sizeId),
            'product_id' => $this->faker->randomElement($productId),
            'quantity' => $this->faker->numberBetween($min = 10, $max = 50),
        ];
    }
}
