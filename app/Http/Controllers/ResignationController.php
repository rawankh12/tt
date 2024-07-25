<?php

namespace App\Http\Controllers;

use App\Models\Resignation;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ResignationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum',['except'=>['login','register']]);
    }

    public function create(Request $request)
    {
        $id  = Section::where('admin_id' , Auth::user()->id)->value('id');
        $re = Resignation::where('section_id' , $id)->value('id');

        $validate = Validator::make($request->all(),
        [
            'description' => 'required'
        ]);
        if($validate->fails()){
            return response()->json($validate->errors(),400);
        }

        $section  = Section::where('admin_id' , Auth::user()->id)->value('id');
        $Resignation= Resignation::create([

            'name' => Auth::user()->name,
            'section_id' => $section,
            'description' => $request->description
        ]);

      return response()->json([
        'status'=>true,
        'Resignation'=>  $Resignation
      ]);
    }

    public function show($id)
    {
        $Resignation = Resignation::where('id' , $id)->get(['description' , 'name']);
        return response()->json([
            $Resignation
        ]);
    }


    public function destroy(Request $request)
    {
        $Resignation = Resignation::find($request->id);
        $Resignation->delete();
        return response()->json([
            'succes' =>true,
            'msg' => 'deleted succesfully'
        ]);
    }
}
