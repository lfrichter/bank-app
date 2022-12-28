<?php

namespace App\Http\Controllers\Api;

use App\Models\Balance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BalanceController extends Controller
{

  public function balance(Request $request)
  {

    $balances = Balance::where('user_id', Auth::id());

    if ($request->has('month')) {
        $month = $request->input('month')+1;
        $balances->whereRaw('MONTH(created_at) = '.$month);
    }

    if ($request->has('year')) {
        $year = $request->input('year');
        $balances->whereRaw('YEAR(created_at) = '.$year);
    }

    $balances = $balances->get();
    $incomes = $balances->where('amount','>', 0)->sum('amount');
    $expenses = abs($balances->where('amount','<', 0)->sum('amount'));

    return response()->json(compact('balances','incomes','expenses'));
  }

  public function currentBalance()
  {
    return response()->json((new Balance())->getCurrentBalance());
  }

  public function expenses(Request $request)
  {
    $balances = Balance::where('user_id', Auth::id())->where('amount','<', 0);

    if ($request->has('month')) {
        $month = $request->input('month')+1;
        $balances->whereRaw('MONTH(created_at) = '.$month);
    }

    if ($request->has('year')) {
        $year = $request->input('year');
        $balances->whereRaw('YEAR(created_at) = '.$year);
    }

    return response()->json($balances->get());
  }


}

?>
