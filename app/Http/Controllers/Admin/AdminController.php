<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Event;
use App\Models\Matche;
use App\Models\Deposit;
use App\Models\General;
use App\Models\Referral;
use App\Models\BetInvest;
use App\Models\Transaction;
use App\Models\WithdrawLog;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\DepositRequest;
use App\Models\WithdrawMethod;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Bolao;
use App\Models\Team;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function adminIndex()
    {
        $data['page_title'] = "Painel";
        $data['total_user'] = User::count();
        $data['total_ver_user'] = User::where('status', 1)->count();
        $data['total_unver_user'] = User::where('emailv', 0)->count();
        $data['total_bn_user'] = User::where('status', 0)->count();
        $data['total_deposit'] = Deposit::where('status', 1)->sum('amount');
        $data['total_deposit_crg'] = Deposit::where('status', 1)->sum('charge');
        $data['total_depo_pending'] = DepositRequest::where('status', 0)->count();
        $data['total_withdraw'] = WithdrawLog::where('status', 1)->sum('amount');
        $data['total_withdraw_crg'] = WithdrawLog::where('status', 1)->sum('charge');
        $data['total_withdraw_pending'] = WithdrawLog::where('status', 0)->count();

        $now = Carbon::now();
        $todayDate = Carbon::now()->format('d M Y');
        $data['runningMatches'] = Matche::where('end_date', '>', $now)->count();
        $data['endMatches'] = Matche::where('end_date', '<', $now)->count();
        $data['runing_turnament'] = Event::whereStatus(1)->count();
        $data['pridictionInvest'] = BetInvest::where('status', '!=', 2)->sum('invest_amount');
        $data['pridictionRefund'] = BetInvest::where('status', 2)->sum('invest_amount');
        $data['pridictionReturn'] = BetInvest::where('status', 1)->sum('return_amount');
        $data['totalProfit'] = number_format(($data['pridictionInvest'] - $data['pridictionReturn']), 2);
        $data['latestUser'] = User::latest()->paginate(15);

        // Pegando todos os bolões
        $data['boloens'] = Bolao::all();

        // Contagem de total de equipes
        $data['total_teams'] = Team::count();

        // Contagem de bolões que atingiram a meta
        $data['meta_atingida'] = Bolao::whereHas('teams', function ($query) {
            $query->havingRaw('COUNT(*) >= meta_equipes');
        })->count();

        // Relatórios de transações e meses
        $trxReport['date'] = collect([]);
        $trxReport['date'] = $trxReport['date']->unique()->toArray();

        $report['months'] = collect([]);
        $report['deposit_month_amount'] = collect([]);
        $report['withdraw_month_amount'] = collect([]);

        // Transações de depósito e saque por mês
        $plusTrx = Transaction::where('type', '+')->where('created_at', '>=', Carbon::now()->subYear())
            ->selectRaw("SUM(amount) as amount")
            ->selectRaw("DATE_FORMAT(created_at,'%M-%Y') as months")
            ->orderBy('created_at')
            ->groupBy('months')
            ->get();

        $plusTrx->map(function ($trxData) use ($report) {
            $report['months']->push($trxData->months);
        });

        $minusTrx = Transaction::where('type', '-')->where('created_at', '>=', Carbon::now()->subYear())
            ->selectRaw("SUM(amount) as amount")
            ->selectRaw("DATE_FORMAT(created_at,'%M-%Y') as months")
            ->orderBy('created_at')
            ->groupBy('months')
            ->get();

        $minusTrx->map(function ($trxData) use ($report) {
            $report['months']->push($trxData->months);
        });

        $depositsMonth = Deposit::where('created_at', '>=', Carbon::now()->subYear())
            ->where('status', 1)
            ->selectRaw("SUM(CASE WHEN status = 1 THEN amount END) as depositAmount")
            ->selectRaw("DATE_FORMAT(created_at,'%M-%Y') as months")
            ->orderBy('created_at')
            ->groupBy('months')
            ->get();

        $depositsMonth->map(function ($depositData) use ($report) {
            $report['months']->push($depositData->months);
            $report['deposit_month_amount']->push(getAmount($depositData->depositAmount));
        });

        $withdrawalMonth = WithdrawLog::where('created_at', '>=', Carbon::now()->subYear())->where('status', 1)
            ->selectRaw("SUM( CASE WHEN status = 1 THEN amount END) as withdrawAmount")
            ->selectRaw("DATE_FORMAT(created_at,'%M-%Y') as months")
            ->orderBy('created_at')
            ->groupBy('months')->get();

        $withdrawalMonth->map(function ($withdrawData) use ($report) {
            if (!in_array($withdrawData->months, $report['months']->toArray())) {
                $report['months']->push($withdrawData->months);
            }
            $report['withdraw_month_amount']->push(getAmount($withdrawData->withdrawAmount));
        });

        $months = $report['months'];

        for ($i = 0; $i < $months->count(); ++$i) {
            $monthVal = Carbon::parse($months[$i]);
            if (isset($months[$i + 1])) {
                $monthValNext = Carbon::parse($months[$i + 1]);
                if ($monthValNext < $monthVal) {
                    $temp = $months[$i];
                    $months[$i] = Carbon::parse($months[$i + 1])->format('F-Y');
                    $months[$i + 1] = Carbon::parse($temp)->format('F-Y');
                } else {
                    $months[$i] = Carbon::parse($months[$i])->format('F-Y');
                }
            }
        }

        $play2 = BetInvest::whereYear('created_at', date('Y'))->orderBy('created_at', 'asc')->get()->groupBy(function ($d) {
            return Carbon::parse($d->date)->format('m');
        });

        $monthly_play2 = [];
        $js2 = '';
        foreach ($play2 as $key => $value) {
            $date = date('Y') . '-' . $key . '-' . '01';
            $js2 .= collect([
                'y' => Carbon::parse($date)->format('M'),
                'a' => $value->sum('invest_amount'),
                'b' => $value->where('status', 1)->sum('return_amount'),
                'c' => $value->where('status', 2)->sum('invest_amount'),
            ])->toJson() . ',';
        }

        $monthly_play2 = '[' . $js2 . ']';

        $play3 = WithdrawMethod::with('method_log')->where('status', 1)->whereYear('created_at', '>=', Carbon::now()->subYear())->get();
        $monthly_play3 = [];
        $js3 = '';
        foreach ($play3 as $value) {
            $js3 .= collect([
                'label' => $value->name,
                'value' => $value->method_log()->sum('amount'),
            ])->toJson() . ',';
        }

        $monthly_play3 = '[' . $js3 . ']';

        return view('admin.home', $data, compact('report', 'months', 'depositsMonth', 'withdrawalMonth', 'trxReport', 'plusTrx', 'minusTrx', 'monthly_play2', 'monthly_play3', 'todayDate'));
    }

    protected function distribuirValorCompetidores($bolao, $valorCompetidores)
    {
        // Pega os times rankeados do bolão, com base no ranking
        $rankedTeams = Team::where('bolao_id', $bolao->id)
            ->orderBy('pontos', 'desc')
            ->take($this->definirLimitePorBolao($bolao->valor))
            ->get();

        // Calcula a distribuição entre os competidores com base na posição no ranking
        $valoresDistribuidos = $this->calcularDistribuicao($bolao, $valorCompetidores);

        // Iterar sobre os times rankeados e adicionar o valor distribuído
        foreach ($rankedTeams as $index => $team) {
            $valorRecebido = $valoresDistribuidos[$index] ?? 0;
            $team->user->saldo += $valorRecebido; // Adiciona ao saldo do usuário
            $team->user->save();
        }
    }

    protected function calcularDistribuicao($bolao, $valorTotal)
    {
        $distribuicao = [];

        // Distribuir de acordo com a posição: 30% para o primeiro, o restante é dividido
        $primeiroLugar = $valorTotal * 0.30;
        $restante = $valorTotal - $primeiroLugar;

        // Definir quantos competidores receberão o prêmio, de acordo com o valor do bolão
        $limite = $this->definirLimitePorBolao($bolao->valor);
        $porCompetidor = $restante / ($limite - 1); // Tirando o 1º lugar, dividir o restante

        // Preencher o array com os valores distribuídos
        for ($i = 0; $i < $limite; $i++) {
            if ($i == 0) {
                $distribuicao[] = $primeiroLugar; // Primeiro lugar recebe 30%
            } else {
                $distribuicao[] = $porCompetidor; // Os outros recebem uma parte igual
            }
        }

        return $distribuicao;
    }

    protected function definirLimitePorBolao($valorBolao)
    {
        switch ($valorBolao) {
            case 20:
                return 20; // Até o 20º lugar
            case 50:
                return 30; // Até o 30º lugar
            case 100:
                return 50; // Até o 50º lugar
            default:
                return 20; // Por padrão, 20 competidores
        }
    }

    public function checkBolaoMeta()
    {
        $boloens = Bolao::all(); // Pega todos os bolões cadastrados

        foreach ($boloens as $bolao) {
            // Pegar o total de equipes montadas no bolão
            $totalEquipes = $bolao->teams()->count();
            $meta = $bolao->meta_equipes; // Meta definida para o bolão

            if ($totalEquipes >= $meta) {
                // Calcular valor extra
                $valorExtra = ($totalEquipes - $meta) * $bolao->valor;

                // Distribuir 20% para os competidores
                $valorCompetidores = $valorExtra * 0.20;

                // Aqui você pode implementar a lógica de distribuição
                $this->distribuirValorCompetidores($bolao, $valorCompetidores);

                // Redirecionar de volta ao painel com mensagem de sucesso
                return redirect()->route('admin.home')->with('success', 'Valores atualizados para os bolões que atingiram a meta.');
            }
        }
    }
}
