<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\Address;
use App\Models\User;
use App\Models\Block_List;

class userController extends Controller
{
    public function index()
    {
        $users = User::where('role_id', '=' ,'3')->get(); 
        // $users->load('section.address');
        return view('user.users', compact('users'));
    }

    public function showblock()
    {
        $users = Block_List::get(); 
        // $users->load('section.address');
        return view('user.blockuser', compact('users'));
    }

    public function destroy($id)
    {
        $section=User::findOrFail($id);
        $section->delete();
        return redirect()->route('users.index')->with('success', 'تم حذف المستخدم بنجاح');
    }
    public function block($id , Request $request)
    {
        $user = User::find($id);
         $Block_List=Block_List::where('user_id',$user->id)->exists();
         if($Block_List)
         {
            return redirect()->route('users.index')->with('error', 'انه محظور ');
         }
         else{
        Block_List::create([

            'admin_id' => 1,
            'user_id' => $id,
        ]);
        return redirect()->route('users.index')->with('success', 'تم حظر المستخدم بنجاح');
    }
}

    public function unblock($id)
    {
        $Block_List=Block_List::findOrFail($id);
        $Block_List->delete();
        return redirect()->route('users.showblock')->with('success', 'تم فك حظر المستخدم بنجاح');
    }

}
