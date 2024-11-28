<?php

namespace App\Jobs;

use App\Models\Competitor;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateCompetitorPoints implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $competitorId;
    protected $points;

    public function __construct($competitorId, $points)
    {
        $this->competitorId = $competitorId;
        $this->points = $points;
    }

    public function handle()
    {
        // Localizar o competidor
        $competitor = Competitor::find($this->competitorId);
        
        if ($competitor) {
            // Atualizar os pontos
            $competitor->points += $this->points;
            $competitor->save();
        }
    }
}
