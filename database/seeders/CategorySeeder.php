<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'title' => 'Phone & Tablet',
        ]);
        DB::table('categories')->insert([
            'title' => 'Laptop',
        ]);
        DB::table('categories')->insert([
            'title' => 'Home Life',
        ]);
        DB::table('categories')->insert([
            'title' => 'Beauty & Heart',
        ]);
        DB::table('categories')->insert([
            'title' => 'Fashion',
        ]);
    }
}
