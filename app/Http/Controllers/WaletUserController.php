<?php

namespace App\Http\Controllers;

use App\Models\Walet_user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class WaletUserController extends Controller
{


    // public function create(Request $request)
    // {
    //     $validate = Validator::make($request->all(),
    //     [
    //         'amount' => 'required'
    //     ]);
    //     if($validate->fails()){
    //         return response()->json($validate->errors(),400);
    //     }
    //     $Walet_user= Walet_user::create([

    //         'user_id' => Auth::user()->id,
    //         'amount' => $request->amount
    //     ]);



    //   return response()->json([
    //     'status'=>  true,
    //     'Walet_user'=>  $Walet_user
    //   ]);
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function add(Request $request)
    {
        $amount = Walet_user::where('user_id' , Auth::user()->id)->value('amount');
        $id = Walet_user::where('user_id' , Auth::user()->id)->value('id');
        $all = $amount + $request->amount;
        $Walet_user = Walet_user::find($id);
        $Walet_user->amount = $all;
        $Walet_user->save();
        return response()->json([$Walet_user]);
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $Walet_user = Walet_user::where('user_id' , Auth::user()->id)->get('amount');
        return response()->json([
            $Walet_user
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
    static function update($amount , $user_id)
    {

        $id = Walet_user::where('user_id' , $user_id)->value('id');
        $Walet_user = Walet_user::find($id);
        $Walet_user->amount = $amount;
        $Walet_user->save();
    }



}
