<?php

namespace App\Http\Controllers\Admin;

use App\Models\Team;
use App\Models\FantasyEvent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Competitor;

class TeamController extends Controller
{
    // Exibir lista de equipes montadas pelos clientes
    public function index()
    {
        // Buscar todas as equipes e seus membros
        $teams = Team::with('members')->paginate(10); // 'members' seria o relacionamento com os competidores ou usuários
        $page_title = 'Times Fantasy: Lista de Equipes';

        // Retornar a view com as equipes e o título da página
        return view('admin.fantasy.teams.index', compact('teams', 'page_title'));
    }

    // Visualizar detalhes de uma equipe
    public function show($team_id)
    {
        $team = Team::with('members')->find($team_id); // Puxar a equipe e seus membros
        if (!$team) {
            return redirect()->back()->with('error', 'Equipe não encontrada');
        }

        $page_title = "Detalhes do Time: {$team->name}";

        return view('admin.fantasy.teams.show', compact('team', 'page_title'));
    }

    public function destroy($id)
    {
        $team = Team::findOrFail($id);
        $team->delete();

          return redirect()->route('admin.teams.index')->with('success', 'Equipe excluída com sucesso!');
     }

}