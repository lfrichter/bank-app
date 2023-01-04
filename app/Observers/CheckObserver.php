<?php

namespace App\Observers;

use App\Models\Check;
use App\Models\Balance;
use Illuminate\Support\Facades\Log;

class CheckObserver
{
    /**
     * Handle events after all transactions are committed.
     *
     * @var bool
     */
    public $afterCommit = true;


    /**
     * Handle the Check "created" event.
     *
     * @param  \App\Models\Check  $check
     * @return void
     */
    public function created(Check $check)
    {
        //
    }

    /**
     * Handle the Check "updated" event.
     *
     * @param  \App\Models\Check  $check
     * @return void
     */
    public function updated(Check $check)
    {
        if($check->status === 'accepted'){
            try{
                $balance = new Balance();
                $currentBalance = $balance->getCurrentBalance($check->user_id);
                $balance->create([
                    'current_balance' => $currentBalance->current_balance+$check->amount,
                    'user_id' => $check->user_id,
                    'description' => $check->description,
                    'amount' => $check->amount
                ]);
            } catch (\Exception $e) {
                Log::error($e->getMessage());
            }
        }
    }

    /**
     * Handle the Check "deleted" event.
     *
     * @param  \App\Models\Check  $check
     * @return void
     */
    public function deleted(Check $check)
    {
        //
    }

    /**
     * Handle the Check "restored" event.
     *
     * @param  \App\Models\Check  $check
     * @return void
     */
    public function restored(Check $check)
    {
        //
    }

    /**
     * Handle the Check "force deleted" event.
     *
     * @param  \App\Models\Check  $check
     * @return void
     */
    public function forceDeleted(Check $check)
    {
        //
    }
}
