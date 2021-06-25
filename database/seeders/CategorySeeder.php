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
            'name' => 'Điện thoại & Phụ kiện',
        ]);
        DB::table('categories')->insert([
            'name' => 'Máy tính & Laptop',
        ]);
        DB::table('categories')->insert([
            'name' => 'Đồ dùng nhà bếp & Phòng ăn',
        ]);
        DB::table('categories')->insert([
            'name' => 'Sức khỏe & Sắc đẹp',
        ]);
        DB::table('categories')->insert([
            'name' => 'Thời trang nam',
        ]);
        DB::table('categories')->insert([
            'name' => 'Thời trang nữ',
        ]);
    }
}
