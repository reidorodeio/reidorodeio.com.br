<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Bolao;

class DashboardController extends Controller
{
    public function getDashboardData()
    {
        $totalUsers = User::count();
        $totalAwards = 'R$ ' . number_format(Bolao::sum('valor_base'), 2, ',', '.');
        $totalBolao = Bolao::count(); // Contagem de bolões em andamento

        return response()->json([
            'totalUsers' => $totalUsers,
            'totalAwards' => $totalAwards,
            'totalBolao' => $totalBolao,
        ]);
    }
}
