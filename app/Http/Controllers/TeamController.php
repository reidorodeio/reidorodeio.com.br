<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Competitor;
use App\Models\Bolao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
{
    // Exibe a página para montar a equipe
    public function create($bolao_id)
   {
      // Recupera o bolão e os competidores
       $bolao = Bolao::findOrFail($bolao_id);
       $competitors = Competitor::where('event_id', $bolao->event_id)->get(); // Recupera os competidores pelo event_id

        // Separar os competidores por tipo (capitão, médios e presilhas)
       $capitaes = $competitors->where('type', 'Capitão');
       $meios = $competitors->where('type', 'Médio'); // Corrigi para "Médio" com acento
       $presilhas = $competitors->where('type', 'Presilha');

       // Passar para a view
        return view('frontend.boloes.createteam', compact('bolao', 'capitaes', 'meios', 'presilhas'));
    }

    // Armazena a equipe montada
    public function store(Request $request, $bolao_id)
    {
        $request->validate([
            'capitao_id' => 'required|exists:competitors,id',
            'meio1_id' => 'required|exists:competitors,id',
            'meio2_id' => 'required|exists:competitors,id',
            'presilha_id' => 'required|exists:competitors,id',
        ]);

        // Criar e salvar a equipe no banco de dados
        Team::create([
            'user_id' => Auth::id(),
            'capitao_id' => $request->capitao_id,
            'meio1_id' => $request->meio1_id,
            'meio2_id' => $request->meio2_id,
            'presilha_id' => $request->presilha_id,
            'bolao_id' => $bolao_id,
            'fantasy_event_id' => $request->fantasy_event_id, // Se já tiver no request
            'category' => $request->category, // Se já tiver no request
            'pago' => false, // Inicialmente marcado como não pago
            'status' => 'pendente', // Pode ajustar conforme o status desejado
        ]);

        return redirect()->route('frontend.boloes.show', $bolao_id)->with('success', 'Equipe criada com sucesso!');
    }
}
