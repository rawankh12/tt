<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Walet_user;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum',['except'=>['login','register']]);
    }

    public function register(Request $request)
    {
        try{
            $validate = $request->validate([

                'email' => 'required|string|email|max:100|unique:users',
                'password' => 'required|string|min:6',
                'user_name' => 'required|string|max:20|min:2',
                'confirm_password' => 'required|required_with:password|same:password|min:6',
                'phone'=>'required'
            ]);

            $user = User::create([
                'email' => $validate['email'],
                'password' => bcrypt($validate['password']),
                'user_name' => $validate['user_name'],
                'phone' => $validate['phone'],
                'confirm_password' => $validate['confirm_password'],
                'role_id'=> $request->role_id
            ]);
            Walet_user::insert([
                'user_id' => $user->id,
                'amount' => 0
            ]);
            return response()->json([
                'status' => true,
                'message' => 'تم التسجيل الدخول بنجاح',
                'token' => $user->createToken("API TOKEN")->plainTextToken,
                'role_id' => $user->role_id
            ],200);
        }
        catch(\Throwable $th)
        {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ],500);
        }

    }

    public function login(Request $request)
    {
        try {
            $validateUser = Validator::make($request->all(),
            [
                'email' => 'required|email',
                'password' => 'required'
            ]);
            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ],401);
            }
            if(!Auth::attempt($request->only(['email', 'password']))){
                return response()->json([
                    'status' => false,
                    'message' => 'كلمة السر والبريد الإلكتروني غير متطابقين أو عليك التسجيل أولا ',
                ], 401);

            }
            $user = User::where('email', $request->email)->first();

            return response()->json([
                'status' => true,
                'message' => 'تم تسجيل الدخول النجاح',
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);
        }
        catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    public function logout()
    {
        Auth::user()->tokens()->delete();
        return response()->json(['تم تسجيل الخروج بنجاح']);
    }

    public function deleted()
    {
        Auth::user()->tokens()->delete();
        $user =User::find(Auth::user()->id);
        $user->delete();
        return response()->json(['the user delete his account']);
    }

    public function index()
    {
        $user = DB::table('users')->where('role_id' , 3)->get(['user_name' ,'email']);
        return response()->json( $user );
    }
}
