<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Section;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Address::create(['name'=>'لاذقية','id'=> 1]);
        Address::create(['name'=>'الشام' ,'id'=> 2]);
        Address::create(['name'=>'سويداء','id'=> 3]);
        Address::create(['name'=>'طرطوس','id'=> 4]);


    }

    // static function sed($name , $opened , $closed , $admin)
    // {

    //     $i = Section::value('id');
    //     if($i >= 0)
    //     $id = 1 + $i  ;
    //     Section::create(['name'=>$name , 'time_opened'=>$opened ,'time_closed'=>$closed ,'admin_id'=>$admin, 'id'=> $id ]);


    // }
}
