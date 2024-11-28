<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WithdrawLog extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    
     protected $casts = [
        'status' => 'string',
        'withdraw_id' => 'string',
        'user_id' => 'string',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault();
    }

    public function method()
    {
        return $this->belongsTo(WithdrawMethod::class, 'withdraw_id','id')->withDefault();
    }
}
