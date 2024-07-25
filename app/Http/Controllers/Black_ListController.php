<?php

namespace App\Http\Controllers;

use App\Models\Black_List;
use App\Models\Block_List;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Block;

class Black_ListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index_block()
    {
        $Block_list = DB::table('block_list')->
        join('users' , 'users.id' , 'block_list.user_id')->get(['users.name' , 'email' ]);
        return response()->json(["Block_list"=> $Block_list ]);
    }


    public function index_section_black()
    {
        $Black_list = DB::table('black_list')->where('admin_id' , Auth::user()->id)->
        join('users' , 'users.id' , 'black_list.user_id')->get(['name' , 'email'  ,'num']);
        return response()->json(["Black_list"=> $Black_list ]);

    }

    public function insert(Request $request)
    {


        $num_Black_List = Black_List::where('user_id' , $request->user_id)->value('num');
        $block = Block_List::where('user_id', $request->user_id)->value('id');


        if($num_Black_List >0 && $num_Black_List < 3)
        {

            $num_Black_List = $num_Black_List + 1;
            $id = Black_List::where('user_id' , $request->user_id)->value('id');

            Black_ListController::update($id , $num_Black_List);


        }
        elseif($num_Black_List == 3 && $block == 0)
        {
            Block_List::insert([

                'admin_id' => Auth::user()->id,
                'user_id' => $request->user_id,
            ]);

        }
        elseif($num_Black_List == null){

            $num = 1;

            $Black_list= Black_List::insert([

                'admin_id' => Auth::user()->id,
                'user_id' => $request->user_id,
                'num' => $num
            ]);

        }else
        {
            return response()->json(['he is block']);
        }

        return response()->json(['success']);

    }


    /**
     * Store a newly created resource in storage.
     */


    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $Black_list = Black_List::where('id' , $request->id)->get('num');
        return response()->json([
            $Black_list
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    ///////////////////////////////////// في حال قام الادمن بإلغاء الحظر
    public function edit_Black(Request $request)
    {
        if($request->accept == 0)
        {
            $num_Black_List = Black_List::where('id' , $request->id)->value('num');
            $num_Black_List = $num_Black_List -1 ;

            if($num_Black_List != 0)
            {
            $Black_list = Black_List::find($request->id);
            $Black_list->num = $num_Black_List;
            $Black_list->save();
            }
            else{
            $Black_list = Black_List::find($request->id);
            $Black_list->delete();
            }
        }
    }

    public function edit_Block(Request $request)
    {
        if($request->accept == 0)
        {

            $Block_list = Block_List::find($request->id);
            $Block_list->delete();

        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id , $num_Black_List)
    {
        $Black_list = Black_List::find($id);
        $Black_list->num = $num_Black_List;

        $Black_list->save();
        return response()->json(['Black_list'=>$Black_list]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy_Black(Request $request)
    {
        $Black_list = Black_List::find($request->id);
        $Black_list->delete();
        return response()->json([
            'succes' =>true,
            'msg' => 'deleted succesfully'
        ]);
    }
}
