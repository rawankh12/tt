<?php

namespace App\Http\Controllers;


use App\Models\Block_List;
use App\Models\Price_Trip;
use App\Models\Reservation;
use App\Models\Trips;
use App\Models\Walet_section;
use App\Models\Walet_user;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use GuzzleHttp\Psr7\Response;
use ResponseTrait;

use function Laravel\Prompts\error;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    $Reservation = DB::table('reservation')->
    join('users' , 'users.id' , 'reservation.user_id')->join('trips' , 'trips.id', 'reservation.trip_id')->join('transporting' , 'transporting.id', 'trips.transport_id')
    ->join('type_transporting' , 'type_transporting.id' , 'transporting.type_tra_id')->
    join('section' , 'section.id' , 'trips.section_id')->
    join('address' , 'address.id' , 'section.address_id')->
   get(['reservation.id','image_identity' , 'attachments' , 'date' , 'time' ,'users.name' ,'address.name', 'name_t' , 'number' ]);
    return response()->json(['Reservation' => $Reservation]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $price = Price_Trip::where('trip_id' , $request->trip_id)->value('price');
        $amount = Walet_user::where('user_id' , Auth::user()->id)->value('amount');
        $num_seat = Trips::where('id' , $request->trip_id)->value('num_seat');
       // $black = Black_List::where('user_id' , Auth::user()->id)->value('user_id');
        $block = Block_List::where('user_id' , Auth::user()->id)->value('user_id');
        $trip = Trips::where('id' , $request->trip_id)->value('date');
        $date = Carbon::now();


        $ti = Trips::where('id' , $request->trip_id)->value('time');
        $tim = Carbon::create($ti);
       $t = $tim->subHour(1)->format('H:i:s');
       $MM =now()->format('H:i:s');



        if($block != Auth::user()->id && Carbon::parse($date->format('Y-m-d')) < Carbon::parse($trip))
        {
        if($num_seat >= $request->num_s && $price * $request->num_s <= $amount)
        {

        $validate = Validator::make($request->all(),
        [
            'image_identity' =>'required',
            'attachments' => 'required',
            'num_s' => 'required'
        ]);

        if($validate->fails()){
            return response()->json($validate->errors(),400);
        }

        $image_identity = $request->file('image_identity');
        $newImage = time().$image_identity->getClientOriginalName();
        $image_identity->move(public_path('upload') , $newImage);
        $path = "public/upload/$newImage";

        $Reservation= Reservation::create([

            'user_id' => Auth::user()->id,
            'trip_id'=> $request->trip_id,
            'image_identity' => $path,
            'attachments' => $request->attachments,
            'num_s' => $request->num_s
        ]);

        $trip = Trips::where('id' , $request->trip_id)->value('num_seat');

        $trip = $trip - $request->num_s;
        $id = $request->trip_id;
        TripController::update_num($trip , $id);
        $price = $price * $request->num_s;
        $am = $amount - $price  ;
        WaletUserController::update($am , Auth::user()->id);
        WaletSectController::insert($price , $request->trip_id);

      return response()->json([
        'status'=>true,
        'Reservation'=>  $Reservation
      ]);
    }
    else{

        return response()->json([
            'status'=> false,
            'msg'=> 'you can not reservation you dont have mony or the trips full',
            'error' => 400
          ])->setStatusCode(400);

    }
}elseif(Carbon::parse($date->format('Y-m-d')) == Carbon::parse($trip) && $MM  < $t)
{
    if($num_seat >= $request->num_s && $price * $request->num_s <= $amount)
    {

    $validate = Validator::make($request->all(),
    [
        'image_identity' =>'required',
        'attachments' => 'required',
        'num_s' => 'required'
    ]);

    if($validate->fails()){
        return response()->json($validate->errors(),400);
    }

    $image_identity = $request->file('image_identity');
    $newImage = time().$image_identity->getClientOriginalName();
    $image_identity->move(public_path('upload') , $newImage);
    $path = "public/upload/$newImage";

    $Reservation= Reservation::create([

        'user_id' => Auth::user()->id,
        'trip_id'=> $request->trip_id,
        'image_identity' => $path,
        'attachments' => $request->attachments,
        'num_s' => $request->num_s
    ]);

    $trip = Trips::where('id' , $request->trip_id)->value('num_seat');

    $trip = $trip - $request->num_s;
    $id = $request->trip_id;
    TripController::update_num($trip , $id);
    $price = $price * $request->num_s;
    $am = $amount - $price  ;
    WaletUserController::update($am , Auth::user()->id);
    WaletSectController::insert($price , $request->trip_id);

  return response()->json([
    'status'=>true,
    'Reservation'=>  $Reservation
  ]);
}
else{
    return response()->json([
        'status'=> false,
        'msg'=> 'you can not reservation you dont have mony or the trips full',
        'error' => 400
      ])->setStatusCode(400);
    }
}else{

    return response()->json([
        'status'=> false,
        'msg'=> 'you can not reservation because you are in a block list or this trip not allowed'
      ]);

}


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $Reservation = Reservation::where('id' , $id)->get(['image_identity' , 'attachments']);
        return response()->json([
            $Reservation
        ]);
    }


    public function update(Request $request)
    {
        $trip = Reservation::where('id' , $request->id)->value('trip_id');
        $block = Block_List::where('user_id' , Auth::user()->id)->value('user_id');
        $tripp = Trips::where('id' , $trip)->value('date');
        $date = Carbon::now();


        $ti = Trips::where('id' , $trip)->value('time');
        $tim = Carbon::create($ti);
        $t = $tim->subHour(1)->format('H:i:s');
        $MM =now()->format('H:i:s');
        if($block != Auth::user()->id && Carbon::parse($date->format('Y-m-d')) <= Carbon::parse($tripp) && $MM  < $t)
        {
        $num = Reservation::where('id' , $request->id)->value('num_s');
        $price = Price_Trip::where('trip_id' , $trip)->value('price');
        $section = Trips::where('id' , $trip)->value('section_id');
        $prices = $num * $price;
        $walet_s = Walet_section::where('section_id' , $section)->value('amount');
        $walet_s = $walet_s - $prices;
        $walet_us = Walet_user::where('user_id' , Auth::user()->id)->value('amount');
        $walet_us = $walet_us + $prices;


        if($request->num_s * $price <= $walet_us && $request->num_s != 0)
        {

            $id = Walet_user::where('user_id' , Auth::user()->id)->value('id');
            $Walet_user = Walet_user::find($id);
            $Walet_user->amount = $walet_us;
            $Walet_user->save();



        WaletSectController::update($walet_s , $section);
        $num_seat = Trips::where('id' , $trip)->value('num_seat');
        $num_seat = $num_seat + $num;
        TripController::update_num($num_seat , $trip);

        $Reservation = Reservation::find($request->id);
        $Reservation->attachments = $request->attachments;
        $Reservation->num_s = $request->num_s;

        $num_seat = $num_seat - $request->num_s;
        TripController::update_num($num_seat , $trip);
        $pr = $request->num_s * $price;
        $m = $walet_us - $pr;

           $id = Walet_user::where('user_id' , Auth::user()->id)->value('id');
            $n = Walet_user::find($id);
            $n->amount = $m;
            $n->save();

        WaletSectController::insert($price , $trip);


        $Reservation->save();

        return response()->json([$Reservation]);
        }else{
            return response()->json(['you do not have mony']);
        }
    }else{

        return response()->json([
            'status'=> false,
            'msg'=> 'you can not reservation because you are in a block list or this trip not allowed'
          ]);

    }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $trrr = Reservation::where('id' , $request->id)->value('trip_id');
        $num = Reservation::where('id' , $request->id)->value('num_s');
        $section = Trips::where('id' , $trrr)->value('section_id');
     //   $user = Reservation::where('id' , $request->id)->value('user_id');
        $am = Walet_user::where('user_id' , Auth::user()->id)->value('amount');
        $id = Walet_user::where('user_id' ,  Auth::user()->id)->value('id');
        $price = Price_Trip::where('trip_id' , $trrr )->value('price');
        $dates = Carbon::now();
        $trip = Trips::where('id' , $trrr)->value('date');


        $ti = Trips::where('id' ,  $trrr)->value('time');

        $tim = Carbon::create($ti);
        $t = $tim->subHour(1)->format('H:i:s');
        $MM =now()->format('H:i:s');

        if(Carbon::parse($dates->format('Y-m-d'))< Carbon::parse($trip))
        {
            $p = $num * $price;
             $am = $am + $p ;

            $id = Walet_user::where('user_id' , Auth::user()->id)->value('id');
            $Walet_user = Walet_user::find($id);
            $Walet_user->amount = $am;
            $Walet_user->save();

            $num_seat = Trips::where('id' , $trrr)->value('num_seat');
            $nu = $num_seat + $num;
            TripController::update_num($nu , $trrr);

            $walet_s = Walet_section::where('section_id' , $section)->value('amount');
            $wale= $walet_s - $p;
            WaletSectController::update($wale , $section);




            $Reservation = Reservation::find($request->id);
            $Reservation->delete();



        return response()->json([
            'succes' =>true,
            'msg' => 'deleted succesfully'
        ]);
    }elseif(Carbon::parse($dates->format('Y-m-d')) == Carbon::parse($trip)&& $MM  < $t)
    {
        $Reservation = Reservation::find($request->id);
        $Reservation->delete();
        return response()->json([
            'succes' =>true,
            'msg' => 'deleted succesfully'
        ]);

        $p = $num * $price;
        $am = $am + $p ;

       $id = Walet_user::where('user_id' , Auth::user()->id)->value('id');
       $Walet_user = Walet_user::find($id);
       $Walet_user->amount = $am;
       $Walet_user->save();

       $num_seat = Trips::where('id' , $trrr)->value('num_seat');
       $nu = $num_seat + $num;
       TripController::update_num($nu , $trrr);

       $walet_s = Walet_section::where('section_id' , $section)->value('amount');
       $wale= $walet_s - $p;
       WaletSectController::update($wale , $section);

    }else{
        return response()->json('you can not because you are late');
    }
}
    }

