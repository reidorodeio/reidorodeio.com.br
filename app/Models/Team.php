<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'owner_id', 'points', 'ranking']; // Ajustar conforme os campos do banco

    // Relacionamento entre equipe e seus membros
    public function members()
    {
        return $this->hasMany(Member::class, 'team_id'); // Supondo que exista uma tabela de membros relacionada aos times
    }

    // Relacionamento com o proprietário da equipe (cliente)
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id'); // Supondo que um time tenha um dono (usuário)
    }

    public function bolao()
    {
    return $this->belongsTo(Bolao::class, 'bolao_id');
    }

}
