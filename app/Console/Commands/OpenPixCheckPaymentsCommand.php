<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Deposit;
use App\Models\General;
use OpenPix\PhpSdk\Client;
use App\Models\Notification;
use App\Models\PaymentGateway;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class OpenPixCheckPaymentsCommand extends Command
{
    /**
     * O nome e a assinatura do comando do console.
     *
     * @var string
     */
    protected $signature = 'app:openpix-check-payments';

    /**
     * A descrição do comando do console.
     *
     * @var string
     */
    protected $description = 'Verifica as ordens de pagamento e realiza as baixas.';

    /**
     * Executa o comando do console.
     */
    public function handle()
    {
        // Obter as configurações gerais do sistema
        $settings = General::find(1);

        // Obter dados do gateway de pagamento
        $gatewayData = PaymentGateway::find(16);

        // Criar uma instância do cliente OpenPix
        $client = Client::create($gatewayData->gateway_key_two);

        // Obter todos os depósitos pendentes com informações adicionais de gateway e usuário
        $pendingDeposits = Deposit::where('status', 0)->with('gateway', 'user')->get();

        foreach ($pendingDeposits as $payment) {
            if ($payment->identifier) {
                try {
                    // Obter informações do pagamento do cliente OpenPix
                    $charge = $client->charges()->getOne($payment->identifier);

                    if (isset($charge['charge']['status']) && $charge['charge']['status'] === 'COMPLETED') {
                        if ($payment->status == 0) {
                            // Atualizar o status do pagamento para concluído
                            $payment->status = 1;
                            $payment->update();

                            // Adicionar o valor do depósito ao saldo do usuário
                            $user = User::find($payment->user_id);
                            $user->balance += $payment->amount;
                            $user->save();

                            // Forçar a inicialização da função levelCommision antes de criar a transação
                            levelCommision($payment->user_id, $payment->amount);

                          
                            createTransaction("Depósito via " . $payment->gateway->name, $payment->amount, $user->balance - $payment->amount, $user->balance, 1, $payment->user_id);
                        

                            // Enviar e-mail de confirmação para o usuário
                            $shortCodes = [
                                'trx' => $payment->trx,
                                'amount' => $payment->amount,
                                'charge' => $payment->charge,
                                'rate' => $payment->gateway->rate,
                                'currency' => $settings->currency,
                                'method_name' => $payment->gateway->name,
                                'method_currency' => $settings->currency,
                            ];
                            @send_email($user, 'DEPOSIT_COMPLETE', $shortCodes);

                            // Criar uma notificação para o usuário informando o depósito bem-sucedido
                            $adminNotification = new Notification();
                            $adminNotification->user_id = $user->id;
                            $adminNotification->title = 'Deposit Successful via ' . $payment->gateway->name;
                            $adminNotification->click_url = urlPath('adm.deposit.log');
                            $adminNotification->save();
                        }
                    } elseif ($charge['charge']['status'] === 'EXPIRED') {
                        // Excluir a cobrança expirada do cliente OpenPix
                        $client->charges()->delete($charge['id']);
                    }
                } catch (\Exception $e) {
                    // Registar um erro se ocorrer um problema no processamento do pagamento
                   // Log::error("Error processing payment: " . $payment->id . " - " . $e->getMessage());
                }
            }
        }
    }
}
