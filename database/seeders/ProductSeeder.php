<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            'name' => Str::random(10),
            'price' => rand(1000, 10000),
            'quantity' => random_int(1, 100),
            'category_id' => random_int(1, 20)
        ]);
    }
}
