<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\Trips;
use App\Models\Walet_section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class WaletSectController extends Controller
{
    public function create(Request $request)
    {
        $validate = Validator::make($request->all(),
        [
            'amount' => 'required'
        ]);
        if($validate->fails()){
            return response()->json($validate->errors(),400);
        }
        $Walet_section= Walet_section::create([

            'section_id' => $request->section_id,
            'amount' => $request->amount
        ]);



      return response()->json([
        'status'=>  true,
        'Walet_section'=>  $Walet_section
      ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function add(Request $request)
    {

    }


    /**
     * Display the specified resource.
     */
    public function show()
    {
        $section = Section::where('admin_id' , Auth::user()->id)->value('id');
        $Walet_section = Walet_section::where('section_id' , $section)->get('amount');
        return response()->json([
            $Walet_section
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    static function insert($am , $trip_id)
    {
        $section = Trips::where('id' , $trip_id)->value('section_id');
        $amount = Walet_section::where('section_id' , $section)->value('amount');
        $amount = $am + $amount;
        $id = Walet_section::where('section_id' , $section)->value('id');
        if($id == null)
        {
            Walet_section::insert([
                'section_id' => $section,
                'amount' => $amount
            ]);
        }else{
            $id = Walet_section::where('section_id' , $section)->value('id');
            $Walet_user = Walet_section::find($id);
            $Walet_user->amount = $amount;
            $Walet_user->save();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    static function update($amount , $section_id)
    {
        $amo= Walet_section::where('section_id' , $section_id)->value('amount');
        $price = $amo + $amount;
        $id = Walet_section::where('section_id' , $section_id)->value('id');
        $Walet_user = Walet_section::find($id);
        $Walet_user->amount = $price;
        $Walet_user->save();
    }
}
