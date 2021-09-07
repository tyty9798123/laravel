<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('products')->insert([
            'name' => Str::random(10),
            'price' => 100,
            'image_url' => 'http://localhost:8000/storage/products/orange_01.jpeg',
            "brand_name" => "Apple",
            "category_name" => "Fruit",
            "category_id" => 1
        ]);
        DB::table('products')->insert([
            'name' => Str::random(10),
            'price' => 33,
            'image_url' => 'http://localhost:8000/storage/products/orange_02.jpeg',
            "brand_name" => "Apple",
            "category_name" => "Fruit",
            "category_id" => 1
        ]);
    }
}
