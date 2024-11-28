<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bolao extends Model
{
    use HasFactory;

    protected $table = 'boloens'; // Nome da tabela no banco de dados

    protected $fillable = [
        'event_id',
        'value', // Valor do bolão
        'valor_base',  // Valor base do prêmio
        'meta_equipes', // Meta de equipes para o bolão
        'status', // Status do bolão (ativo ou não)
        'photo', // Foto do bolão
    ];

    // Relacionamento com a tabela de eventos (FantasyEvent)
    public function event()
    {
        return $this->belongsTo(FantasyEvent::class, 'event_id');
    }

    // Relacionamento com a tabela de equipes
    public function teams()
    {
        return $this->hasMany(Team::class, 'bolao_id');
    }
}
