<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\http\Requests\Requesttransport;
use App\Models\Transporting;
use App\Models\TypeTran;
use App\Models\User;
use App\Models\Section;
use App\Models\Address;

class transportController extends Controller
{
    public function index()
    { 
      
      $transports = Transporting::get();
      return view('transport.transport', compact('transports'));

    }

    public function create()
    {
        $type_tras = TypeTran::all();
        $sections = Address::all(); 
        return view('transport.createtransport', compact( 'sections','type_tras'));
    }

      public function store(Requesttransport $request)
      {
  try{
          Transporting::create([
              'section_id' => $request->section_id,
              'type_tra_id' => $request->type_tra_id,
              'capacity' => $request->capacity,
              'number' => $request->number,
          ]);
    // Flash success message
    Session::flash('success', 'تم إضافة وسيلة نقل بنجاح.');

} catch (\Exception $e) {
    // Flash error message if an exception occurs
    Session::flash('error', 'حدث خطأ أثناء إضافة وسيلة نقل: ' . $e->getMessage());
}
          return redirect()->route('transport.index');
      }
    

    public function destroy($id)
    {
        $section=Transporting::findOrFail($id);
        $section->delete();
        return redirect()->route('transport.index')->with('success', 'تم حذف وسيلة النقل بنجاح');
    }
    public function edit($id)
    {
        $transport = Transporting::find($id);
        $type_tra = TypeTran::all();
        $addreses = Address::all();
        return view('transport.updatetransport', compact('transport','type_tra', 'addreses'));
    }
    public function update(Request $request, $id)
    {
        $transport = Transporting::find($id);
        try {
            $transport->section_id = $request->input('section_id');
            $transport->type_tra_id = $request->input('type_tra_id');
            $transport->capacity = $request->input('capacity');
            $transport->number = $request->input('number');
            $transport->save();
    
            // رسالة نجاح
            Session::flash('success', 'تم تحديث وسيلة النقل بنجاح.');
        } catch (\Exception $e) {
            // رسالة خطأ
            Session::flash('error', 'حدث خطأ أثناء تحديث وسيلة النقل: ' . $e->getMessage());
        }
    
        // إعادة التوجيه إلى واجهة عرض وسائل النقل
        return redirect()->route('transport.index');
    }
    
}
