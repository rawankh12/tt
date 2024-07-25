<?php

namespace App\Http\Controllers;

use App\Models\Black_List;
use App\Models\Block_List;
use App\Models\Price_Trip;
use App\Models\Reservation;
use App\Models\Trips;
use App\Models\Walet_user;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\Block;

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

        if($block != Auth::user()->id)
        {
        if($num_seat > $request->num_s && $price * $request->num_s <= $amount)
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
            'msg'=> 'you can not reservation you dont have mony or the trips full'
          ]);

    }
}else{

    return response()->json([
        'status'=> false,
        'msg'=> 'you can not reservation because you are in a block list'
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

        $Reservation = Reservation::find($request->id);
        $Reservation->attachments = $request->attachments;
        $Reservation->save();

        return response()->json([$Reservation]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $Reservation = Reservation::find($request->id);
        $Reservation->delete();
        return response()->json([
            'succes' =>true,
            'msg' => 'deleted succesfully'
        ]);
    }
}
