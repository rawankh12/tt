<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Transporting;
use App\Models\Trips;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RaportController extends Controller
{

    public function insert()
    {
       $num_tra = DB::table('transporting')->where('transporting.admin_id' , Auth::user()->id)->
       get('transporting.id');
       $num_trans = $num_tra->toArray();
       $num_transport = count($num_trans);

       $num_p = DB::table('section')->where('section.admin_id' , Auth::user()->id)->
       join('trips' , 'trips.section_id' , 'section.id')->where('type_id' , 2)->get('trips.id');
       $num_pu = $num_p->toArray();
       $num_trip_pr = count($num_pu);



       $num_t = DB::table('section')->where('section.admin_id' , Auth::user()->id)->
       join('trips' , 'trips.section_id' , 'section.id')->where('type_id' , 1)->get('trips.id');
       $num_te = $num_t->toArray();
       $num_trip_pu = count($num_te);

       $p = DB::table('section')->where('section.admin_id' , Auth::user()->id)->
       join('walet_section' , 'walet_section.section_id' , 'section.id')->value('amount');


       $id = Report::where('admin_id' , Auth::user()->id)->value('id');

       if($id == 0)
       {
        Report::insert([
        'num_transport' => $num_transport,
        'public_trip' => $num_trip_pu,
        'private_trip' => $num_trip_pr,
        'price_all' => $p,
        'admin_id' => Auth::user()->id
       ]);
    }elseif($id != null)
    {
        $report = Report::find($id);
        $report->num_transport = $num_transport;
        $report->public_trip = $num_trip_pu;
        $report->private_trip = $num_trip_pr;
        $report->save();
    }

    $report = DB::table('report')->where('admin_id' , Auth::user()->id)->get();
    return response()->json(["report"=> $report ]);


    }


}
