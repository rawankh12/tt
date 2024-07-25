<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\Ship_Goods_Request;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class Ship_Goods_ReqController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum',['except'=>['login','register']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $Ship_Goods = DB::table('ship_goods_request')
        ->join('users', 'users.id','ship_goods_request.user_id')
        ->join('section' , 'section.id' , 'ship_goods_request.section_id')->
        join('address' , 'address.id' , 'section.address_id')
        ->get(['weight' , 'quantity' , 'description' , 'email' , 'phone' ,'users.name' , 'address.name' ]);
        return response()->json(["ship_goods_request"=>$Ship_Goods]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $validate = Validator::make($request->all(),
        [
            'weight' => 'required',
            'quantity' => 'required',
            'description' => 'required'
        ]);
        if($validate->fails()){
            return response()->json($validate->errors(),400);
        }
        $Ship_Goods= Ship_Goods_Request::create([

            'user_id' => Auth::user()->id,
            'section_end_id' => $request->section_end_id,
            'section_id' => $request->section_id,
            'weight' => $request->weight,
            'quantity' => $request->quantity,
            'description' => $request->description
        ]);

      return response()->json([
        'status'=>true,
        'Ship_Goods'=>  $Ship_Goods
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
        //$Ship_Goods = Ship_Goods_Request::where('id' , $request->id)->get();
        $Ship_Goods = DB::table('ship_goods_request')->where('id',$request->id)->get(['weight','quantity','description']);
        return response()->json([
            $Ship_Goods
        ]);
    }


    public function update(Request $request)
    {
        $Ship_Goods = Ship_Goods_Request::find($request->id);

        $Ship_Goods->weight = $request->weight;
        $Ship_Goods->quantity = $request->quantity;
        $Ship_Goods->description = $request->description;
        $Ship_Goods->save();
        return response()->json([$Ship_Goods]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $Ship_Goods = Ship_Goods_Request::find($request->id);
        $Ship_Goods->delete();
        return response()->json([
            'succes' =>true,
            'msg' => 'deleted succesfully'
        ]);
    }
}
