<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Color;
use App\Models\Coupon;
use App\Models\District;
use App\Models\Material;
use App\Models\Product;
use App\Models\ShoeModel;
use App\Models\Sole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */

    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(CategorySeeder::class);
        $this->call(ContactSeeder::class);
        $this->call(ColorSeeder::class);
        $this->call(CitySeeder::class);
        $this->call(DistrictSeeder::class);
        $this->call(CouponSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(SoleSeeder::class);
        $this->call(SizeSeeder::class);
        $this->call(ShoeModelSeeder::class);
        $this->call(MaterialSeeder::class);
        $this->call(SubCategorySeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(AddressSeeder::class);
        $this->call(ProductImageSeeder::class);
        $this->call(ProductSizeSeeder::class);
    }
}