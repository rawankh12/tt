<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name'=>'super_admin' , 'id'=> 1]);
        Role::create(['name'=>'admin' , 'id' =>2]);
        Role::create(['name'=>'user' , 'id' =>3]);
    }
}
