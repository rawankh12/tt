<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        User::create([

            'name' => 'Admin',
            'email' => 'Admin@gmail.com',
            'password'=> bcrypt('password'),
            'role_id'=> 1,
            'phone'=> '12345678',
            'id' => 1

        ]);
        User::create([

            'name' => 'ae',
            'email' => 'ae@gmail.com',
            'password'=> bcrypt('password'),
            'role_id'=> 2,
            'phone'=> '12345678',
            'id' => 2

        ]);
        User::create([

            'name' => 'aa',
            'email' => 'aa@gmail.com',
            'password'=> bcrypt('password'),
            'role_id'=> 2,
            'phone'=> '12345678',
            'id' => 3

        ]);
        User::create([

            'name' => 'ad',
            'email' => 'ad@gmail.com',
            'password'=> bcrypt('password'),
            'role_id'=> 2,
            'phone'=> '12345678',
            'id' => 4

        ]);
        User::create([

            'name' => 'ar',
            'email' => 'ar@gmail.com',
            'password'=> bcrypt('password'),
            'role_id'=> 2,
            'phone'=> '12345678',
            'id' => 5

        ]);


    }
}
