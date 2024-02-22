<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 11; $i < 100; $i++) {
            DB::table('categories')->insert([
                'name' => 'Category ' . $i . ' name',
                'parent_id' => 1,
                'slug' => Str::slug('Category ' . $i . ' name')
            ]);
        }
    }
}
