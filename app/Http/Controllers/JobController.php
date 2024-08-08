<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function create(Request $request)
     {
         $validate = Validator::make($request->all(),
         [
            'job_name' => 'required',
            'date' => 'required',
            'description' => 'required'
         ]);
         if($validate->fails()){
             return response()->json($validate->errors(),400);
         }
         $job= Job::create([

            'job_name' => $request->job_name,
            'date' => $request->date,
            'description' => $request->description
         ]);



       return response()->json([
         'status'=>  true,
         'Price_Trip'=>  $job
       ]);
     }

    public function index()
    {

        $job = DB::table('jobs')->get(['id','job_name' , 'date'  , 'description' ]);

        return response()->json(["job"=> $job ]);
    }


}
