<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'vendor',
                'username' => 'vendor',
                'email' => 'vendor@gmail.com',
                'password' => bcrypt('password'),
                'role' => 'vendor',
                'is_user' => '0',
                'user_status' => 'is_vendor',
                'is_vendor' => '1',
                'vendor_status' => 'approved',
            ],
            [
                'name' => 'user',
                'username' => 'user',
                'email' => 'user@gmail.com',
                'password' => bcrypt('password'),
                'role' => 'user',
                'is_user' => '1',
                'user_status' => 'active',
                'is_vendor' => '0',
                'vendor_status' => 'is_user',
            ]
        ];

        User::insert($users);
    }
}
