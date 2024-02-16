<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'name'              => 'Admin',
            'email'             => 'admin@admin.com',
            'password'          => bcrypt('1234567890'), // password
            'created_at'        => now(),
            'updated_at'        => now(),
        ]);
    }
}
