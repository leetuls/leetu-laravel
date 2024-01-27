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
        for ($i = 0; $i < 100000; $i++) {
            DB::table('categories')->insert([
                'name' => 'Category ' . $i . ' name',
                'parent_id' => $i,
                'slug' => Str::slug('Category ' . $i . ' name')
            ]);
        }
    }
}
