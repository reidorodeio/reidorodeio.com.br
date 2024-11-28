<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Competitor;
use App\Models\FantasyEvent;
use App\Models\Team;
use App\Models\Ranking;

class PointsController extends Controller
{
    // Exibir todos os eventos para pontuar 
    public function index()
    {
        // Pegar todos os eventos da tabela FantasyEvent
        $events = FantasyEvent::all(); 
        $page_title = 'Pontuar Fantasy: Lista de Eventos';

        // Retornar a view com os eventos e o título da página
        return view('admin.fantasy.points.index', compact('events', 'page_title'));
    }

    // Exibir todos os competidores para um evento específico
    public function showCompetitors($event_id)
    {
        // Buscar o evento pelo ID
        $event = FantasyEvent::find($event_id);
        if (!$event) {
            return redirect()->back()->with('error', 'Evento não encontrado');
        }

        // Buscar os competidores relacionados ao evento com ordenação
        $competitors = Competitor::where('event_id', $event_id)->paginate(10);

        // Definir o título da página
        $page_title = "Competidores do Evento: {$event->name}";

        // Retornar a view com o evento, competidores e o título da página
        return view('admin.fantasy.points.competitors', compact('event', 'competitors', 'page_title'));
    }

    // Atualizar os pontos de um competidor via Ajax
    public function updatePoints(Request $request)
    {
        // Validação dos dados de entrada
        $request->validate([
            'competitor_id' => 'required|integer',
            'points' => 'required|integer',
        ]);

        // Encontrar o competidor pelo ID
        $competitor = Competitor::find($request->competitor_id);

        if ($competitor) {
            // Atualizar a pontuação, somando ou subtraindo os pontos enviados
            $competitor->points += $request->points;
            $competitor->save();  // Salvar as alterações

            // Atualizar o ranking
            $this->updateRanking($competitor);

            return response()->json([
                'success' => true,
                'new_points' => $competitor->points,
                'message' => 'Pontuação atualizada com sucesso!',
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Competidor não encontrado.',
        ]);
    }

    // Função para atualizar o ranking
    public function updateRanking($competitor)
    {
        // Encontrar o time ao qual o competidor pertence
        $team = Team::where('capitao_id', $competitor->id)
            ->orWhere('meio1_id', $competitor->id)
            ->orWhere('meio2_id', $competitor->id)
            ->orWhere('presilha_id', $competitor->id)
            ->first();

        if ($team) {
            // Calcular a pontuação total do time com base nos competidores
            $totalPoints = Competitor::whereIn('id', [
                $team->capitao_id,
                $team->meio1_id,
                $team->meio2_id,
                $team->presilha_id
            ])->sum('points');

            // Atualizar o ranking do time
            Ranking::updateOrCreate(
                ['team_id' => $team->id],
                ['points' => $totalPoints]
            );
        }
    }
}
