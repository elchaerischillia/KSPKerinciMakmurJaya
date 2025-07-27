<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            [
                'nama_lengkap'   => 'MANAGER',
                'username'       => 'manager',
                'password'       => Hash::make('manager'),
                'role'           => 'Manager',
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ],
            [
                'nama_lengkap'   => 'TELLER',
                'username'       => 'teller',
                'password'       =>  Hash::make('teller'),
                'role'           => 'Teller',
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ],
            [
                'nama_lengkap'   => 'DEBT COLLECTOR',
                'username'       => 'collector',
                'password'       => Hash::make('collector'),
                'role'           => 'Collector',
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ],
            [
                'nama_lengkap'   => 'ADMIN',
                'username'       => 'admin',
                'password'       => Hash::make('admin1'),
                'role'           => 'Admin',
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ],

        ];


        User::insert($user);
    }
}
