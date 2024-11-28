<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Deposit;
use Illuminate\Console\Command;

class DeleteUnpaidDepositsCommand extends Command
{
    /**
     * O nome e a assinatura do comando no console.
     *
     * @var string
     */
    protected $signature = 'app:delete-unpaid-deposits';

    /**
     * A descrição do comando no console.
     *
     * @var string
     */
    protected $description = 'Deleta os depósitos não pagos que têm mais de 24 horas';

    /**
     * Cria uma nova instância do comando.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Executa o comando no console.
     *
     * @return int
     */
    public function handle()
    {
        $pendingDeposits = Deposit::where('status', 0)->with('gateway', 'user')->get();

        foreach ($pendingDeposits as $payment) {
            if (Carbon::parse($payment->created_at)->diffInHours(Carbon::now()) > 72) {
                $payment->delete();
            }
        }

        $this->info('Depósitos não pagos antigos deletados com sucesso.');
    }
}