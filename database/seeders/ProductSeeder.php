<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i < 100; $i++) {
            // products
            if ($i < 50) {
                DB::table('products')->insert([
                    'product_id' => 'LTS00' . $i,
                    'name' => 'Product ' . $i,
                    'price' => (int)(15000 . $i),
                    'feature_image' => asset('storage/products/test.jpg'),
                    'content' => 'Sản phẩm của Lee Tu Shop ' . $i,
                    'branch' => 'Nike',
                    'user_id' => 1,
                    'category_id' => 1
                ]);
            } else {
                DB::table('products')->insert([
                    'product_id' => 'LTS00' . $i,
                    'name' => 'Product ' . $i,
                    'price' => (int)(15000 . $i),
                    'feature_image' => asset('storage/products/test.jpg'),
                    'content' => 'Sản phẩm của Lee Tu Shop ' . $i,
                    'branch' => 'D&G',
                    'user_id' => 1,
                    'category_id' => 1
                ]);
            }
            // product_images
            DB::table('product_images')->insert([
                'image' => asset('storage/products/test.jpg'),
                'product_id' => 'LTS00' . $i,
            ]);
            // product_tags
            DB::table('product_tags')->insert([
                'product_id' => 'LTS00' . $i,
                'tag_id' => $i
            ]);
            // tags
            DB::table('tags')->insert([
                'name' => 'Áo chất ' . $i
            ]);
        }
    }
}
