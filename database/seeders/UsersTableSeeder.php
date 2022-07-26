<?php

namespace Database\Seeders;

use Ramsey\Uuid\Uuid;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => Uuid::uuid4()->toString(),
            'name' => 'Dhandydelic',
            'email' => 'admin@satyr.com',
            'phone' => '081234567890',
            'address' => 'Gowok',
            'province' => 'Yogyakarta',
            'city' => 'Sleman',
            'account_type' => '1',
            'account_role' => 'admin',
            'last_login' => now(),
            'status_id' => Uuid::uuid4()->toString(),
            'email_verified_at' => now(),
            'password' => Hash::make('123456'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
