<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\http\Requests\ValidationRequestsection;
use App\Models\Address;
use App\Models\User;
use App\Models\Section;
use App\Models\Requirements;

class EmployeeController extends Controller
{
    public function index()
    { 
      
      $employees = Requirements::with(['user'])->get();
      return view('employee.employee', compact('employees'));

    }

    public function upgrade($id)
    {
        // احصل على الموظف بناءً على الـ ID
        $employee = User::find($id);

        // تحقق ما إذا كان الموظف موجودًا
        if (!$employee) {
            return redirect()->route('employees.index')->with('error', 'لم يتم العثور على الموظف');
        }

        // قم بترقية الموظف (تغيير نوع المستخدم)
        $employee->role_id = 2; // أو أي قيمة تناسب النوع الإداري لديك
        $employee->save();
        Requirements::where('user_id', $id)->delete();
        // ارجع إلى صفحة الموظفين مع رسالة نجاح
        return redirect()->route('employees.index')->with('success', 'تم ترقية الموظف بنجاح');
    }
  

    public function destroy($id)
    {
        $employee=Requirements::findOrFail($id);
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'تم حذف الموظف بنجاح');
    }
}
