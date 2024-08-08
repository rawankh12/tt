<?php

namespace App\Http\Controllers;

use App\Models\Trip_Request;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\TripController;
use App\Models\Price_Trip;
use App\Models\Section;
use App\Models\Trips;
use App\Models\Walet_user;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Trip_RequestController extends Controller
{
       /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Trips = DB::table('trip_requests')->where('section.admin_id' , Auth::user()->id)->join('trips' , 'trips.id' , 'trip_requests.trip_id')->
        join('section' , 'section.id' , 'trips.section_id')->join('transporting' , 'transporting.id', 'trips.transport_id')
        ->join('type_transporting' , 'type_transporting.id' , 'transporting.type_tra_id')->
        join('address' , 'address.id' , 'section.address_id')->join('users' , 'users.id' , 'trip_requests.user_id')
        ->get(['trip_requests.tr_id', 'trips.id','section_end' , 'date' , 'time' , 'num_seat' , 'name_t' , 'number' , 'start_point' , 'email' ,'user_name'] );
        return response()->json(['Trips' => $Trips]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $validate = Validator::make($request->all(),
        [
            'section_end'=>'required|string',
            'date' => 'required',
            'time' => 'required',
            'num_seat'=> 'required',
            'start_point' => 'required',
        ]);
        if($validate->fails()){
            return response()->json($validate->errors(),400);
        }

        $Trips= Trips::create([

            'section_id' => $request->section_id,
            'transport_id' => $request->transport_id,
            'type_id' => 1,
            'section_end' => $request->section_end,
            'date' => $request->date,
            'time' => $request->time,
            'num_seat' => $request->num_seat
        ]);


           Trip_Request::create([

            'user_id' => Auth::user()->id,
            'trip_id' => $Trips->id,
            'start_point' => $request->start_point,
            'description_admin' => ''

        ]);
        // Price_Trip::insert([
        //     'trip_id' => $Trips->id,
        //     'price' => 0
        // ]);


      return response()->json([
        'status'=>  true,
      ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function accept_trip()
    {

            $trip = Trip_Request::where('user_id' , Auth::user()->id)->pluck('trip_id')->last();
            $price = Price_Trip::where('trip_id', $trip)->value('price');

         //   $price = Price_Trip::where('trip_id', $request->trip_id)->value('price');
            $amount = Walet_user::where('user_id' , Auth::user()->id)->value('amount');
            if($price <= $amount)
            {
            $section_id = Trips::where('id' , $trip)->value('section_id');
            $am = $amount - $price;
            WaletUserController::update($am , Auth::user()->id);
            WaletSectController::update($price ,$section_id);
            return response()->json(['accept']);
            }
            else{
                return response()->json(['you should add mony to your walet you dont have mony enough to trip']);
            }


        }




        public function cancle_trip()
        {


              $Trip_Request = Trip_Request::orderBy('tr_id', 'desc')->take(1)->first();
              $Trips = Trips::orderBy('id' , 'desc')->take(1)->first();
              $Trips->delete();
              $Trip_Request->delete();
              return response()->json(['not accept']);

        }


        public function cancle_trip_admin(Request $request)
        {


              $Trip_Request = Trip_Request::find($request->tr_id);
              $Trip_Request->description_admin = $request->description_admin;
              $Trip_Request->save();
              return response()->json(['not accept']);

        }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // $Trip_Request = Trip_Request::where('id' , $request->id)->get();
        // return response()->json([
        //     'Trip_Request' => $Trip_Request
        // ]);
        $Trips = DB::table('trip_requests')->where('trip_requests.tr_id' , $id)->join('trips' , 'trips.id' , 'trip_requests.trip_id')->
        join('section' , 'section.id' , 'trips.section_id')->join('transporting' , 'transporting.id', 'trips.transport_id')
        ->join('type_transporting' , 'type_transporting.id' , 'transporting.type_tra_id')->
        join('address' , 'address.id' , 'section.address_id')->join('users' , 'users.id' , 'trip_requests.user_id')
        ->get(['section_end' , 'date' , 'time' , 'num_seat' , 'name_t' , 'number' , 'start_point' , 'email' ,'users.name'] );
        return response()->json(['Trips' => $Trips]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit_price(Request $request)
    // {
    //     $id = Price_Trip::where('trip_id' , $request->trip_id)->value('id');
    //     $price = Price_Trip::find($id);
    //     $price->price = $request->price;
    //     $price->save();

    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $Trip_Request = Trip_Request::find($request->tr_id);
        $Trip_Request->start_point = $request->start_point;


        $Trip_Request->save();
        return response()->json(['Trip_Request' => $Trip_Request]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $section = Trip_Request::find($request->tr_id);
        $section->delete();
        return response()->json([
            'succes' => true,
            'msg' => 'deleted succesfully'
        ]);
    }
}
