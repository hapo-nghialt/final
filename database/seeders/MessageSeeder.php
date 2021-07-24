<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('messages')->insert([
            'from' => '2',
            'to' => '1',
            'message' => 'Xin chào các bạn',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
