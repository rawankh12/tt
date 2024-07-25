<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Type::create(['name'=>'رحلة عائلية' , 'id'=> 1]);
        Type::create(['name'=>'رحلة خاصة بالشركة' , 'id' =>2]);

    }
}
