<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Facades\JWTFactory;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Tymon\JWTAuth\JWTManager as JWT;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Illuminate\Support\Facades\Config;
use Tymon\JWTAuth\JWTAuth as JWTAuthJWTAuth;
use Tymon\JWTAuth\JWTGuard;

class AdminController extends Controller
{
    // public function __construct()
    // {
    //     Config::set('jwt.user', 'App\Admin');
    //     Config::set('auth.providers', ['users' => [
    //         'driver' => 'eloquent',
    //         'model' => Admin::class,
    //     ]]);
    // }

    public function __construct(){
        $this->admin = new Admin;
        Auth::shouldUse('admins');
    }
    //to create super admin one time
    public function admin_register(Request $request)
    {
        $validate = $request->validate([
            'username' => 'required|string|max:255|unique:admins',
            'email' => 'required|string|email|max:255|unique:admins',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $admin = Admin::create([
            'username' => $request->json()->get('username'),
            'email' => $request->json()->get('email'),
            'password' => Hash::make($request->json()->get('password')),
        ]);

        if($admin){
            return response()->json([
                'message' => 'admin created successfully'
            ]);
        }
    }

    public function admin_login(Request $request)

    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password'=> 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $credentials = $request->json()->all();
        try{
            if(!$token = JWTAuth::attempt($credentials)){
                return response()->json(
                ['error' => 'invalid Credentials'], 400);
            }
        }
        catch(JWTException $e){
            return response()->json(
                ['error' => 'could nor create token'], 500);
        }

        return response()->json(compact('token'));
    }

    public function admin_logout(Request $request)
    {
        $token = JWTAuth::getToken();
        if(JWTAuth::invalidate($token)){
        //dd($token);
        return response()->json(['message' => 'Successfully logged out']);
        }
    }
}
