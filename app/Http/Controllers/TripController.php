<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Avg_Rate;
use App\Models\Price_Trip;
use App\Models\Reservation;
use App\Models\Section;
use App\Models\Trips;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TripController extends Controller
{

    public function index_t()
    {
    $type = Type::all();
    return response()->json(['type' => $type]);
    }
      /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Trips = DB::table('trips')->where('type_id' , 2)->
        join('section' , 'section.id' , 'trips.section_id')->join('transporting' , 'transporting.id', 'trips.transport_id')
        ->join('type_transporting' , 'type_transporting.id' , 'transporting.type_tra_id')->
        join('address' , 'address.id' , 'section.address_id')->join('avg_rate' , 'avg_rate.trip_id' , 'trips.id')->join('price_trip' , 'price_trip.trip_id' , 'trips.id')
        ->get(['address.name' , 'section_end' , 'date' , 'time' , 'num_seat' , 'name_t' ,'avg_rate' ,'price' ]);
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
          'num_seat'=> 'required'
        ]);
        if($validate->fails()){
            return response()->json($validate->errors(),400);
        }
        $Trips= Trips::create([

            'section_id' => $request->section_id,
            'transport_id' => $request->transport_id,
            'type_id' => 2,
            'section_end' => $request->section_end,
            'date' => $request->date,
            'time' => $request->time,
            'num_seat' => $request->num_seat
        ]);

        Avg_Rate::insert([
            'trip_id' => $Trips->id,
            'avg_rate' => 0
        ]);
        Price_Trip::insert([
            'trip_id' => $Trips->id,
            'price' => $request->price
        ]);

      return response()->json([
        'status'=>  true,
        'Trips'=>  $Trips
      ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function trip_res()
    {
        // $res = Reservation::where('user_id' , Auth::user()->id)->get('trip_id');
        // $trip = Trips::whereIn('id' , $res)->get();
        // return response()->json([
        //     $trip
        // ]);

        $Trips = DB::table('trips')->where('type_id' , 2)->
        join('section' , 'section.id' , 'trips.section_id')->join('transporting' , 'transporting.id', 'trips.transport_id')
        ->join('type_transporting' , 'type_transporting.id' , 'transporting.type_tra_id')->
        join('address' , 'address.id' , 'section.address_id')->join('avg_rate' , 'avg_rate.trip_id' , 'trips.id')->join('price_trip' , 'price_trip.trip_id' , 'trips.id')
        ->join('reservation' , 'reservation.trip_id' , 'trips.id')
        ->get(['address.name' , 'section_end' , 'date' , 'time' , 'num_seat' , 'name_t' ,'avg_rate' ,'price' ,'attachments']);
        return response()->json(['Trips' => $Trips]);

    }



    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        //  $Trips = Trips::where('id' , $request->id)->get();
        // return response()->json([
        //     $Trips
        // ]);

        $Trips = DB::table('trips')->where('type_id' , 2)->where('trips.id' , $request->id)->
        join('section' , 'section.id' , 'trips.section_id')->join('transporting' , 'transporting.id', 'trips.transport_id')
        ->join('type_transporting' , 'type_transporting.id' , 'transporting.type_tra_id')->
        join('address' , 'address.id' , 'section.address_id')->join('avg_rate' , 'avg_rate.trip_id' , 'trips.id')->join('price_trip' , 'price_trip.trip_id' , 'trips.id')
        ->get(['address.name' , 'section_end' , 'date' , 'time' , 'num_seat' , 'name_t' ,'avg_rate' ,'price' ]);
        return response()->json(['Trips' => $Trips]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $Trips = Trips::find($request->id);
        $Trips->section_end = $request->section_end;
        $Trips->date = $request->date;
        $Trips->time = $request->time;
        $Trips->num_seat = $request->num_seat;

        $Trips->save();
        return response()->json(['Trips'=>$Trips]);
    }

    static function update_num($trip , $id)
    {
        $Trips = Trips::find($id);
        $Trips->num_seat = $trip;

        $Trips->save();
        return response()->json(['Trips'=>$Trips]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $section = Trips::find($request->id);
        $section->delete();
        return response()->json([
            'succes' =>true,
            'msg' => 'deleted succesfully'
        ]);
    }

    public function searchbytime(Request $request)
    {
        $search = $request->time;
        $time = DB::table('trips')->where('time' , 'LIKE' , '%'.$search.'%')->get();
        return response()->json([$time]);
    }


    public function searchbydate(Request $request)
    {
        $search = $request->date;
        $date = DB::table('trips')->whereDate('date' , 'LIKE' , '%'.$search.'%')->get();
        return response()->json([$date]);
    }

    public function searchbysection(Request $request)
    {

        $address = DB::table('address')->where('name' , $request->name)->value('id');
        $section = DB::table('section')->where('address_id',$address)->value('id');
        $search = $section;
        $se = DB::table('trips')->where('section_id' , 'LIKE' , '%'.$search.'%')->get();


        $searc = $request->name;
        $trip = DB::table('trips')->where('section_end' , 'LIKE' , '%'.$searc.'%')->get();

        return response()->json([$se , $trip]);
    }

    // public function searchbysectionandtype(Request $request)
    // {
    //     // $search = $request->date;
    //     // $date = DB::table('trips')->whereDate('date' , 'LIKE' , '%'.$search.'%')->get();
    //     // return response()->json([$date]);

    //     $address = DB::table('address')->where('name' , $request->name)
    //     ->join('section','address.id','section.address_id')->value('section.id');
    //     $address = DB::table('trips')->where('section_id' , $address)->get();
    //     $address = DB::table('type')->where('name' , $request->name)
    //     ->join('trips','ad.id','section.address_id')->value('section.id');
    //     $search = $request->name;
    //     $trip = DB::table('trips')->where('section_end' , 'LIKE' , '%'.$search.'%')->get();

    //     return response()->json([$address , $trip]);
    // }


}
