<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Job para atualizar pontos de competidores a cada minuto
        $schedule->call(function () {
            // Exemplo de atualização, você pode ajustar conforme suas necessidades
            DB::table('competitors')
                ->where('event_id', 1) // Ajuste o 'event_id' conforme necessário
                ->increment('points', 10); // Adiciona 10 pontos a cada minuto
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
