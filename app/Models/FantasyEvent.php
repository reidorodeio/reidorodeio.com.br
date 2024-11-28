<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FantasyEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_name',
        'category_id',  // Certifique-se de que o campo no banco seja category_id para chave estrangeira
    ];

    // Relacionamento com a categoria
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function matches()
    {
        return $this->hasMany(Matche::class);
    }

    public function teams()
    {
        return $this->hasMany(Team::class);
    }

    public function boloes()
    {
        return $this->hasMany(Bolao::class, 'event_id'); // Relaciona os bolões com os eventos
    }

    public function calcularTotalPremios()
    {
        return $this->boloes()->sum('valor_base'); // Soma o valor base de todos os bolões relacionados
    }

    public function competitors()
    {
        return $this->hasMany(Competitor::class, 'event_id');
    }
}
