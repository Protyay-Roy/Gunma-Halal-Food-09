<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRecord =  [
            [
                'id' => 1, 'name' => 'Admin', 'email' => 'admin@admin.com', 'password' => Hash::make('11111111'), 'type' => 'admin', 'mobile' => '01869535334', 'address' => 'Dhaka', 'status' => 1
            ], [
                'id' => 2, 'name' => 'Vendor1', 'email' => 'vendor1@gmail.com', 'password' => Hash::make('11111111'), 'type' => 'vendor', 'mobile' => '01869535334', 'address' => 'Dhaka', 'status' => 1
            ], [
                'id' => 3, 'name' => 'Vendor2', 'email' => 'vendor2@admin.com', 'password' => Hash::make('11111111'), 'type' => 'vendor', 'mobile' => '01869535334', 'address' => 'Dhaka', 'status' => 1
            ]
        ];

        Admin::insert($adminRecord);
    }
}
