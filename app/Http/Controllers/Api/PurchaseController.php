<?php

namespace App\Http\Controllers\Api;

use App\Models\Purchase;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PurchaseController extends Controller
{
    public function purchase(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'amount' => 'required|numeric',
            'created_at' => 'required|date_format:Y-m-d',
            'description' => 'required',
        ]);

        if($validation->fails()){
            $response = [
                'success' => false,
                'messages' => $validation->messages()
            ];
             return response()->json($response);
        }

        try {
            $all = array_merge($request->all(), ['user_id' => Auth::id()]);
            Purchase::create($all);
            $success = true;
            $message = 'Purchase added successfully';
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
