<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competitor extends Model
{
    use HasFactory;

    // Definir a tabela Competitor (se for necessário, caso seja diferente do nome padrão)
    protected $table = 'competitors';

    // Colunas que podem ser preenchidas
    protected $fillable = [
        'name', 'event_id', 'points', // Outros campos que existem no modelo Competitor
    ];

    // Relacionamento com a tabela FantasyEvent
    public function event()
    {
        return $this->belongsTo(FantasyEvent::class);
    }
}
