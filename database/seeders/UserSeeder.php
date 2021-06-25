<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        DB::table('users')->insert([
//            'name' => 'Le Trong Nghia',
//            'username' => 'nghialt',
//            'email' => 'nghialt@haposoft.com',
//            'email_verified_at' => now(),
//            'password' => Hash::make('12345678'),
//            'role_id' => '0',
//            'phone_number' => '0123456789',
//            'address' => 'Hà Nội',
//            'created_at' => now(),
//            'updated_at' => now(),
//        ]);

        DB::table('users')->insert([
            'name' => 'User Test 2',
            'username' => 'user02',
            'email' => 'user02@haposoft.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
            'role_id' => '1',
            'phone_number' => '0123456789',
            'address' => 'Hà Nội',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

}
