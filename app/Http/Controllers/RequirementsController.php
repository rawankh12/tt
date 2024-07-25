<?php

namespace App\Http\Controllers;

use App\Models\Requirements;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RequirementsController extends Controller
{

    public function index()
    {
        $Requirements = DB::table('reqruitment_form')->
        join('users' , 'users.id' , 'reqruitment_form.user_id')->
       get(['reqruitment_form.id','name' ]);
        return response()->json(['Requirements' => $Requirements]);
    }


    public function create(Request $request)
    {

        $user = Requirements::where('user_id' , Auth::user()->id)->value('id');
        if($user == null)
        {
        $validate = $request->validate([

            'photo_of_univercity_degree'=>'required',
            'driving_licence'=> 'required',
            'description'=>'required',
            'cv'=>'required',
            'place' => 'required'
        ]);


        $photo_of_univercity_degree = $request->file('photo_of_univercity_degree');
        $newImage = time().$photo_of_univercity_degree->getClientOriginalName();
        $photo_of_univercity_degree->move(public_path('upload') , $newImage);
        $path = "public/upload/$newImage";

        $driving_licence = $request->file('driving_licence');
        $newImage1 = time().$driving_licence->getClientOriginalName();
        $driving_licence->move(public_path('upload') , $newImage1);
        $path1 = "public/upload/$newImage1";

        $cv = $request->file('cv');
        $newImage1 = time().$cv->getClientOriginalName();
        $cv->move(public_path('upload') , $newImage1);
        $path2 = "public/upload/$newImage1";

        if($request->place == 1)
        {
            $place = 'الشركة';
        }
        else{
            $place = 'الفرع';
        }

        $Requirements= Requirements::create([

            'user_id' => Auth::user()->id,
            'section_id'  => $request->section_id,
            'photo_of_univercity_degree'  => $path,
            'driving_licence'  => $path1,
            'description'  => $request->description,
            'cv'  => $path2,
            'place' => $place
        ]);

      return response()->json([
        'status'=>  true,
        'Requirements'=>  $Requirements
      ]);
    }else{

        return response()->json(['you are already send your cv ']);
    }
    }

    public function show($id)
    {
        $Requirements = DB::table('reqruitment_form')->where('reqruitment_form.id' , $id)->
        join('users' , 'users.id' , 'reqruitment_form.user_id')->
        join('section' , 'section.id' , 'reqruitment_form.section_id')->
        join('address' , 'address.id' , 'section.address_id')->
       get(['photo_of_univercity_degree' , 'driving_licence' , 'description' , 'cv' ,'users.name', 'phone' ,'address.name' ,'place', ]);
        return response()->json(['Requirements' => $Requirements]);
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
        $photo_of_univercity_degree = $request->file('photo_of_univercity_degree');
        $newImage = time().$photo_of_univercity_degree->getClientOriginalName();
        $photo_of_univercity_degree->move(public_path('upload') , $newImage);
        $path = "public/upload/$newImage";

        $driving_licence = $request->file('driving_licence');
        $newImage1 = time().$driving_licence->getClientOriginalName();
        $driving_licence->move(public_path('upload') , $newImage1);
        $path1 = "public/upload/$newImage1";

        $cv = $request->file('cv');
        $newImage1 = time().$cv->getClientOriginalName();
        $cv->move(public_path('upload') , $newImage1);
        $path2 = "public/upload/$newImage1";

        $Requirements = Requirements::find($request->id);

            $Requirements->photo_of_univercity_degree  = $path;
            $Requirements->driving_licence  = $path1;
            $Requirements->description  = $request->description;
            $Requirements->cv  = $path2;


            $Requirements->save();
        return response()->json(['Requirements'=>$Requirements]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $section = Requirements::find($request->id);
        $section->delete();
        return response()->json([
            'succes' =>true,
            'msg' => 'deleted succesfully'
        ]);
    }
}
