<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    
    protected $casts = [
        'status' => 'string',
        'cat_id' => 'string',
    ];

    public function inplayes(){
        return $this->hasMany(Matche::class)->whereStatus(1)->latest()->limit(5);
    }

    public function matches(){
        return $this->hasMany(Matche::class);
    }
    

    public function cat(){
        return $this->belongsTo(Category::class)->withDefault();
    }
    
    public function boloes(){
        return $this->hasMany(Bolao::class, 'event_id'); // Relaciona os bolões com os eventos
    }

    public function calcularTotalPremios(){
        return $this->boloes()->sum('valor_base'); // Soma o valor base de todos os bolões relacionados
    }



    
}
