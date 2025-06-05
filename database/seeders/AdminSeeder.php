<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = [
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'image' => '',
            'status' => 'approved',
            'contact' => '',
            'created_by' => '',
            'address' => '',
            'created_at' => date('Y-m-d H:i:s')
        ];
        Admin::insert($admin);
    }
}
