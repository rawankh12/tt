<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Trips;

class TrippController extends Controller
{
    public function index($id)
    {
        $trips = Trips::with('section.address','transporter.type_tran','type')
        ->where('id','=',$id)
        ->get(); 
        return view('trip.index', compact('trips'));
    }
}
