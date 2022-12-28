<?php

namespace App\Http\Controllers\Api;

use App\Models\Check;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CheckController extends Controller
{

  public function checks(Request $request)
  {
    $checks = Check::query();

    if ($request->has('status')) {
        $status = $request->input('status');
        $checks->where('status', $status);
    }

    if ($request->has('month')) {
        $month = $request->input('month')+1;
        $checks->whereRaw('MONTH(created_at) = '.$month);
    }

    if ($request->has('year')) {
        $year = $request->input('year');
        $checks->whereRaw('YEAR(created_at) = '.$year);
    }

    $accepted = clone $checks;
    $rejected = clone $checks;

    $pendings = $checks->where('status', 'pending')->get();
    $accepted = $accepted->where('status', 'accepted')->get();
    $rejected = $rejected->where('status', 'rejected')->get();

    return response()->json(compact('pendings','accepted','rejected'));
  }


  public function deposit(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'amount' => 'required|numeric',
            'description' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        if($validation->fails()){
            $response = [
                'success' => false,
                'messages' => $validation->messages()
            ];
             return response()->json($response);
        }

        try {
            if($request->file()) {
                $file_name = time().'_'.$request->image->getClientOriginalName();
                $file_path = $request->file('image')->storeAs('uploads', $file_name, 'public');
                $all = array_merge($request->all(), ['user_id' => Auth::id(), 'image' => '/storage/' . $file_path]);
            }

            Check::create($all);
            $success = true;
            $message = 'Purchase added successfully';
        } catch (\Illuminate\Database\QueryException $ex) {
            $success = false;
            $message = $ex->getMessage();
        }

        $response = [
            'success' => $success,
            'message' => $message,
        ];
        return response()->json($response);
    }

}

?>
