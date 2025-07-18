<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class UserController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;


    public function login(Request $request){

       $fields= $request->validate([
            'email'=>'required|email',
            'password'=>'required|string'
        ]);

       $user = User::where('email',$fields['email'])->first();
       
        if (!$user || !\Hash::check($fields['password'], $user->password)) {
            return response()->json([
                'message' => 'Invalid credentials',
            ], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
        ]);

        
    }

    public function register(Request $request){

        $validatedUser = $request->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|email|unique:users',
            'password'=>'required|string|min:8|confirmed'
        ]);

        $validatedUser['password'] = bcrypt($validatedUser['password']);

        $user = User::create($validatedUser);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'success'=>true,
            'message'=>'User registered successfully',
            'user'=>$user,
            'token'=>$token
        ],201);
        

    }
}
