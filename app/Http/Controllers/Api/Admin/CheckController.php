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

  public function index(Request $request)
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

}
