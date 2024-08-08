<?php

namespace App\Http\Controllers;

use App\Models\Requirements;
use App\Models\User;
use App\Models\UserJob;
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
            $request->validate([

            'image_identity'=>'required',
            'driving_licence'=> 'required',
            'description'=>'required',
            'cv'=>'required',
            'mobile_phone' => 'required'
        ]);


        $image_identity = $request->file('image_identity');
        $newImage = time().$image_identity->getClientOriginalName();
        $image_identity->move(public_path('upload') , $newImage);
        $path = "public/upload/$newImage";

        $driving_licence = $request->file('driving_licence');
        $newImage1 = time().$driving_licence->getClientOriginalName();
        $driving_licence->move(public_path('upload') , $newImage1);
        $path1 = "public/upload/$newImage1";

        $cv = $request->file('cv');
        $newImage1 = time().$cv->getClientOriginalName();
        $cv->move(public_path('upload') , $newImage1);
        $path2 = "public/upload/$newImage1";


        $Requirements= Requirements::create([

            'user_id' => Auth::user()->id,
            'section_id'  => $request->section_id,
            'image_identity'  => $path,
            'driving_licence'  => $path1,
            'description'  => $request->description,
            'cv'  => $path2,
            'mobile_phone' => $request->mobile_phone
        ]);

        UserJob::insert([
            'user_id' => Auth::user()->id,
            'job_id' => $request->job_id,
            'status'=>''
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
       get(['image_identity' , 'driving_licence' , 'description' , 'cv' ,'user_name','address.name' ,'mobile_phone', ]);
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
        $image_identity = $request->file('image_identity');
        $newImage = time().$image_identity->getClientOriginalName();
        $image_identity->move(public_path('upload') , $newImage);
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

            $Requirements->image_identity  = $path;
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
