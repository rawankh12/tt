<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\Address;
use App\Models\User;
use App\Models\Section;
use App\http\Requests\validationrequest;

class SupervisorController extends Controller
{
    public function index()
    {
        $supervisors = User::where('role_id', '=' ,'2')->get(); 
        $supervisors->load('section.address');
        return view('supervisor.index', compact('supervisors'));
    }

    public function createaddres()
    {
    $addresses = Address::all(); // جلب جميع الفروع
    return view('supervisors.create', compact('addresses')); // تمرير الفروع إلى العرض
    }

    public function create()
    {
        $supervisor = Address::get();
        return view('supervisor.createsupervisor', compact('supervisor'));
    }

    public function store(validationrequest $request)
    {
    
        // $request->validated();

        try {
            // Create a new user record
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->phone = $request->phone;
            $user->role_id = 2; // Assuming supervisor role ID is 2
            // $user->address_id = $addressid;
            $user->save();

            // Flash success message
            Session::flash('success', 'تم إضافة المشرف بنجاح.');

        } catch (\Exception $e) {
            // Flash error message if an exception occurs
            Session::flash('error', 'حدث خطأ أثناء إضافة المشرف: ' . $e->getMessage());
        }

        // Redirect back to where the form was submitted from
        return redirect()->route('supervisors.index');
    }

    public function destroy(Request $request, $id)
    {
        $supervisor = User::findOrFail($id); 
    
        if ($supervisor->section) {
            return redirect()->route('supervisors.index')->with('error', 'لا يمكنك حذف هذا المشرف لأنه مرتبط بفرع. استبدله بآخر ثم احذفه.');
        } else {
            $supervisor->delete();
            return redirect()->route('supervisors.index')->with('success', 'تم حذف المشرف بنجاح.');
        }
    }

    public function edit($id)
    {
        $supervisor = User::findOrFail($id);
        return view('supervisor.updatesupervisor', compact('supervisor'));
    }

    public function update(ValidationRequest $request, $id)
    {
        $supervisor = User::findOrFail($id);

        try {
            // تحديث بيانات المشرف
            $supervisor->name = $request->name;
            $supervisor->email = $request->email;
            if ($request->password) {
                $supervisor->password = Hash::make($request->password);
            }
            $supervisor->phone = $request->phone;
            $supervisor->save();

             // رسالة نجاح
             Session::flash('success', 'تم تحديث المشرف بنجاح.');
            } catch (\Exception $e) {
                // رسالة خطأ
                Session::flash('error', 'حدث خطأ أثناء تحديث المشرف: ' . $e->getMessage());
            }
            // رسالة خطأ
            return redirect()->route('supervisors.index');
        
    }

}
