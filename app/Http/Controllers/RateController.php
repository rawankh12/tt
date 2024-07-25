<?php

namespace App\Http\Controllers;

use App\Models\Avg_Rate;
use App\Models\Rate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RateController extends Controller
{


    public function insert(Request $request)
    {

            Rate::insert([
                'trip_id' => $request->trip_id,
                'user_id' =>Auth::user()->id,
                'love' => $request->love,
            ]);



            RateController::avg_trip_rate($request->trip_id);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function avg_trip_rate($trip_id)
    {
        $avg =0;
        $r = DB::table('rate')->where('trip_id' , $trip_id)->pluck('love');
        $rate = $r->toArray();

        for($i = 1 ; $i<count($rate) ; $i++)
        {
         $avg = $avg + $rate[$i] ;
        }
        $avg1 = $avg /count($r) *10;

    //     $Avg_R = Avg_Rate::where('trip_id',$trip_id)->value('avg_rate');

    //     if($Avg_R == null)
    //     {
    //     Avg_Rate::insert([
    //         'trip_id' => $trip_id,
    //         'avg_rate' => $avg1
    //     ]);
    // }
    //   elseif($Avg_R > 0){
        $id = Avg_Rate::where('trip_id',$trip_id)->value('id');
        $a = Avg_Rate::find($id);
        $a->avg_rate = $avg1;
        $a->save();


    }


    public function edit(Request $request)
    {
        $id = Rate::where('trip_id' , $request->trip_id)->value('id');
        $Rate = Rate::find($id);

        $Rate->love = $request->love;
        $Rate->save();
        return response()->json([$Rate]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $Rate = Rate::find($request->id);

        $Rate->love = $request->love;
        $Rate->save();
        return response()->json([$Rate]);
    }


}
