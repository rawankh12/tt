<?php

namespace App\Http\Controllers;

use App\Models\Price_Trip;
use App\Models\Reservation;
use App\Models\Trip_Request;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PriceTripController extends Controller
{


    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $validate = Validator::make($request->all(),
        [
            'price' => 'required',
        ]);
        if($validate->fails()){
            return response()->json($validate->errors(),400);
        }
        $Price_Trip= Price_Trip::create([

            'trip_id' => $request->trip_id,
            'price' => $request->price
        ]);

        $d = Trip_Request::where('trip_id' , $request->trip_id)->value('tr_id');
        $des = Trip_Request::find($d);
        $des->description_admin = 'accept';
        $des->save();

      $p = PriceTripController::show($Price_Trip->id);

      return response()->json([
        'status'=>  true,
        'Price_Trip'=>  $p
      ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    static function show($request)
    {
        $Price_Trip = DB::table('price_trip')->where('id' , $request)->value('price');
        return $Price_Trip ;

    }




    public function show_p($id)
    {
        $Price_Trip = DB::table('price_trip')->where('id' , $id)->get('price');
        return response()->json([
            $Price_Trip
          ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $Price_Trip = Price_Trip::find($request->id);

        $Price_Trip->price = $request->price;
        $Price_Trip->save();
        return response()->json([$Price_Trip]);
    }


}
