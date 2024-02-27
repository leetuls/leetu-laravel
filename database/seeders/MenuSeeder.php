<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 100; $i++) {
            DB::table('menus')->insert([
                'name' => 'Menu ' . $i . ' name',
                'parent_id' => 0,
                'slug' => Str::slug('Menu ' . $i . ' name')
            ]);
        }
    }
}
