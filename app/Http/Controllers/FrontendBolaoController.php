<?php

namespace App\Http\Controllers;

use App\Models\Bolao;
use App\Models\FantasyEvent;
use Illuminate\Http\Request;

class FrontendBolaoController extends Controller
{
    public function show($event_id, $category)
    {
        // Recupera o evento com base no ID
        $event = FantasyEvent::findOrFail($event_id);
        // Recupera os bolões associados ao evento
        $boloens = Bolao::where('event_id', $event_id)->get();

        // Retorna a view passando os bolões e o evento
        return view('frontend.boloes.index', compact('event', 'boloens', 'category'));
    }


    public function createTeam($bolao_id)
    {
         // Recupera o bolão e os competidores
       $bolao = Bolao::findOrFail($bolao_id);
       $competitors = Competitor::where('fantasy_event_id', $bolao->event_id)->get(); // Certifique-se de que há competidores vinculados ao evento correto

       // Separar os competidores por tipo
       $capitaes = $competitors->where('type', 'capitao');
       $meios = $competitors->where('type', 'meio');
       $presilhas = $competitors->where('type', 'presilha');

       return view('frontend.boloes.createteam', compact('bolao', 'capitaes', 'medios', 'presilhas'));
   }


}
