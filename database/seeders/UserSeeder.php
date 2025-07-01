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
                'name' => 'vendor1',
                'username' => 'vendor1',
                'email' => 'vendor1@gmail.com',
                'password' => bcrypt('password'),
                'role' => 'vendor',
                'is_user' => '0',
                'user_status' => 'is_vendor',
                'is_vendor' => '1',
                'vendor_status' => 'approved',
                'document' => 'demo.pdf',
                'vendor_request' => '1'
            ],
             [
                'name' => 'vendor2',
                'username' => 'vendor2',
                'email' => 'vendor2@gmail.com',
                'password' => bcrypt('password'),
                'role' => 'vendor',
                'is_user' => '0',
                'user_status' => 'is_vendor',
                'is_vendor' => '1',
                'vendor_status' => 'approved',
                'document' => 'demo.pdf',
                'vendor_request' => '1'
            ],
            [
                'name' => 'user1',
                'username' => 'user1',
                'email' => 'user1@gmail.com',
                'password' => bcrypt('password'),
                'role' => 'user',
                'is_user' => '1',
                'user_status' => 'active',
                'is_vendor' => '0',
                'vendor_status' => 'is_user',
                'document' => '',
                'vendor_request' => 0
            ],
               [
                'name' => 'user2',
                'username' => 'user2',
                'email' => 'user2@gmail.com',
                'password' => bcrypt('password'),
                'role' => 'user',
                'is_user' => '1',
                'user_status' => 'active',
                'is_vendor' => '0',
                'vendor_status' => 'is_user',
                'document' => '',
                'vendor_request' => 0
            ]
        ];

        User::insert($users);
    }
}
