<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Models\Trips;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ComplaintController extends Controller
{
   /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $Complaint = Complaint::all();
        // return response()->json(["Complaint"=>$Complaint]);

        $Complaint = DB::table('complaint')->
        join('trips' , 'trips.id' , 'complaint.trip_id')-> join('section' , 'section.id' , 'trips.section_id')->join('transporting' , 'transporting.id', 'trips.transport_id')
        ->join('type_transporting' , 'type_transporting.id' , 'transporting.type_tra_id')->
        join('address' , 'address.id' , 'section.address_id')
        ->get(['name' , 'section_end' , 'date' , 'time' ,'number', 'type_transporting.name' , 'description' ]);

        return response()->json(["Complaint"=> $Complaint ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $validate = Validator::make($request->all(),
        [
            'description' => 'required'
        ]);
        if($validate->fails()){
            return response()->json($validate->errors(),400);
        }
        $Complaint= Complaint::create([

            'user_id' => Auth::user()->id,
            'trip_id' => $request->trip_id,
            'description' => $request->description
        ]);

        $t = Trips::where('id' , $request->trip_id)->get();

      return response()->json([
        'status'=>  true,
        'Complaint'=>  $Complaint
      ]);
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
    public function show(Request $request)
    {
        $Complaint = Complaint::where('id' , $request->id)->get('complaint');
        return response()->json([
            $Complaint
        ]);
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
        $Complaint = Complaint::find($request->id);

        $Complaint->description = $request->description;
        $Complaint->save();
        return response()->json([$Complaint]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $Complaint = Complaint::find($request->id);
        $Complaint->delete();
        return response()->json([
            'succes' =>true,
            'msg' => 'deleted succesfully'
        ]);
    }
}
