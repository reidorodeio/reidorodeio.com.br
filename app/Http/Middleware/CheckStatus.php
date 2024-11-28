<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        // Verifica se o usuário está autenticado e se possui todas as verificações necessárias
        if ($user && $user->tfver == '0' && $user->status == '1' && $user->emailv == '0') {
            // Verifica se o CPF ou o número de celular é nulo
            if ($user->cpf == null && $user->phone == null) {
                // Verifica se a rota atual não é a rota de perfil ou de atualização de perfil
                if (!in_array($request->route()->getName(), ['profile.index', 'profile.update'])) {
                    // Redireciona o usuário para completar o perfil com a mensagem
                    return redirect()->route('profile.index')->with('success', 'Por favor, atualize suas informações para continuar.');
                }
            }
            // Se o CPF e o número de celular não forem nulos, continua com a requisição
            return $next($request);
        }

        // Verifica se a rota atual é diferente da rota de autorização
        if ($request->route()->getName() !== 'authorization') {
            // Redireciona para a rota de autorização caso não atenda aos requisitos
            return redirect()->route('authorization');
        }

        // Se já estiver na rota de autorização, retorna o próximo middleware ou a rota final
        return $next($request);
    }
}
 