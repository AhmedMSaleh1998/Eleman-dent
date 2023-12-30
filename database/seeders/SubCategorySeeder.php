<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;
use App\Models\Category;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $parentIds = DB::table('categories')->where('parent_id',null)->pluck('id');
        $i = 1;
        
        foreach (range(1,30) as $index) {
            $parent_id = $parentIds->random(1);

            Category::create([
                'name' => 'Sub Category ' . $i,
                'image' => '2.jpg',
                'parent_id' => $parent_id[0]
            ]);
            $i++;
        }
    }
}
