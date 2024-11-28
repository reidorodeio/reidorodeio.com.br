<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FantasyEvent;

class Competitor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'event_id', 'category_id', 'type', 'points', 'photo'
    ];

    // Relacionamento entre Competidor e Evento
    public function event()
    {
        return $this->belongsTo(FantasyEvent::class, 'event_id');
    }
}
