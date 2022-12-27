<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required',
        ]);

        if($validation->fails()){
            $response = [
                'success' => false,
                'messages' => $validation->messages()
            ];
             return response()->json($response);
        }

        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            $success = true;
            $messages = ['credentials' => ['User register successfully']];
        } catch (\Illuminate\Database\QueryException $ex) {
            $success = false;
            $messages = ['error' => [$ex->getMessage()]];
        }

        $response = [
            'success' => $success,
            'messages' => $messages,
        ];

        return response()->json($response);
    }

    public function login(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if($validation->fails()){
            $response = [
                'success' => false,
                'messages' => $validation->messages()
            ];
             return response()->json($response);
        }

        $credentials = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];

        if (Auth::attempt($credentials)) {
            $success = true;
            $messages = ['message' => ['User successfully logged']];
            $user = Auth::user();
            $token = $user->createToken(now()->timestamp)->plainTextToken;
        } else {
            $success = false;
            $message = 'Unauthorised';
            $messages = ['credentials' => ['Unauthorised']];
            $user = $token = null;
        }

        $response = [
            'success' => $success,
            'messages' => $messages,
            'user' => $user,
            'token' => $token
        ];

        return response()->json($response);
    }

    public function logout()
    {
        try {
            if(auth()->user()->currentAccessToken()){
                auth()->user()->currentAccessToken()->delete();
            }
            Session::flush();
            $success = true;
            $messages = ['credentials' => ['User logged out successfully']];
        } catch (\Illuminate\Database\QueryException $ex) {
            $success = false;
            $messages = ['error' => [$ex->getMessage()]];
        }

        // response
        $response = [
            'success' => $success,
            'message' => $messages,
        ];
        return response()->json($response);
    }
}
