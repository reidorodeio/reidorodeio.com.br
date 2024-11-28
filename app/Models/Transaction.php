<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $appends = ['title','trx','main_amo','charge'];
    
    protected $casts = [
        'status' => 'string',
        'trans_id' => 'string',
        'user_id' => 'string'
    ];

    public function getTitleAttribute(){
        return $this->description;
    }

    public function getTrxAttribute(){
        return (string) $this->trans_id;
    }

    public function getMainAmoAttribute(){
        return $this->old_bal;
    }

    public function getChargeAttribute(){
        return '0';
    }

    public function user(){
    	return $this->belongsTo(User::class,'user_id','id');
    }
}
