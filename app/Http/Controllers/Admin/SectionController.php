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

class SectionController extends Controller
{
    public function index()
    { 
      
      $sections = Section::with(['address', 'user'])->get();
      return view('section.branches', compact('sections'));

    }

    public function create()
    {
        $users = User::where('role_id', 2)->get();
        $addresses = Address::all(); 
        return view('section.createbranch', compact( 'addresses','users'));
    }

      public function store(ValidationRequestsection $request)
      {
  try{
          Section::create([
              'time_opened' => $request->time_opened,
              'time_closed' => $request->time_closed,
              'address_id' => $request->address_id,
              'admin_id' => $request->admin_id,
          ]);
    // Flash success message
    Session::flash('success', 'تم إضافة الفرع بنجاح.');

} catch (\Exception $e) {
    // Flash error message if an exception occurs
    Session::flash('error', 'حدث خطأ أثناء إضافة الفرع: ' . $e->getMessage());
}
          return redirect()->route('sections.index');
      }
    

    public function destroy($id)
    {
        $section=Section::findOrFail($id);
        $section->delete();
        return redirect()->route('sections.index')->with('success', 'تم حذف الفرع بنجاح');
    }
    public function edit($id)
    {
        $section = Section::find($id);
        $users = User::all();
        $addreses = Address::all();
        return view('section.updatebranch', compact('section','users', 'addreses'));
    }
    public function update(ValidationRequestsection $request, $id)
    {
        $section = Section::find($id);
        try {

        $section->admin_id = $request->input('admin_id');
        $section->address_id = $request->input('address_id');
        $section->time_opened = $request->input('time_opened');
        $section->time_closed = $request->input('time_closed');
        $section->save();
 // رسالة نجاح
 Session::flash('success', 'تم تحديث الفرع بنجاح.');
} catch (\Exception $e) {
    // رسالة خطأ
    Session::flash('error', 'حدث خطأ أثناء تحديث الفرع: ' . $e->getMessage());
}
// رسالة خطأ
return redirect()->route('sections.index');

    }
}
