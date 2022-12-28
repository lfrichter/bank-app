<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Check;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CheckController extends Controller
{

  public function get(Check $check)
  {
    $check = $check->load('user');
    return response()->json($check);
  }

  public function update(Check $check, Request $request)
  {
    $check = $check->load('user');
    $check->status = $request->status;
    $check->update();

    return response()->json($check);
  }

}
