<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
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

        if ( Auth::guard('admin')->attempt($credentials) ) {
            $success = true;
            $messages = ['message' => ['Admin successfully logged']];
            $user = Auth::guard('admin')->user();
            $token = $user->createToken(now()->timestamp,['admin'])->plainTextToken;
        } else {
            $success = false;
            $messages = ['Credentials' => ['Unauthorised']];
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

    public function getUser(Request $request)
    {
        $user = Auth::user();
        return response()->json($user);
    }

    public function logout(Request $request)
    {
         try {
            auth()->user()->currentAccessToken()->delete();
            Session::flush();
            $success = true;
            $message = 'Successfully logged out';
        } catch (\Illuminate\Database\QueryException $ex) {
            $success = false;
            $message = $ex->getMessage();
        }

        // response
        $response = [
            'success' => $success,
            'message' => $message,
        ];
        return response()->json($response);
    }
}
