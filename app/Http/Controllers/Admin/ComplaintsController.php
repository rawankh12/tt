<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Complaint;

class ComplaintsController extends Controller
{
    public function index()
    {
        $complaints = Complaint::with('user','trip.section.address')->get(); 
        return view('complaint.index', compact('complaints'));
    }


}
