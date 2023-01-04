<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Balance extends Model
{
    use HasFactory;

    public $fillable = ['user_id','current_balance','description','amount','created_at'];

    protected $casts = [
        'created_at' => 'datetime:d/m/Y H:i A',
        'updated_at' => 'datetime:d/m/Y H:i A',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getCurrentBalance($user_id = null)
    {
        $user_id = is_null($user_id) ? Auth::id() : $user_id;
        return  Balance::where('user_id', $user_id)->latest()->orderByDesc('id')->first();
    }
}
