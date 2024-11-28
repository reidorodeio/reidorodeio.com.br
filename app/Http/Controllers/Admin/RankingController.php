<?php

namespace App\Http\Controllers\Admin;

use App\Models\Ranking;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RankingController extends Controller
{
    // Listar Rankings
    public function index()
    {
        $rankings = Ranking::paginate(10); // Utilize paginate aqui
        $page_title = 'Lista de Rankings'; // Definindo o título da página
        return view('admin.fantasy.rankings.index', compact('rankings', 'page_title'));
    }



    // Criar Ranking
    public function create()
    {
        $teams = Team::all();
        $users = User::all();
        $page_title = 'Adicionar Novo Ranking';
        return view('admin.fantasy.rankings.create', compact('teams', 'users', 'page_title'));
    }

    // Armazenar Ranking
    public function store(Request $request)
    {
        $request->validate([
            'team_id' => 'required|exists:teams,id',
            'user_id' => 'required|exists:users,id',
            'points' => 'required|integer|min:0',
        ]);

        Ranking::create($request->all());

        return redirect()->route('admin.rankings.index')->with('success', 'Ranking criado com sucesso!');
    }

    // Editar Ranking
    public function edit($id)
    {
        $ranking = Ranking::findOrFail($id);
        $teams = Team::all();
        $users = User::all();
        $page_title = 'Editar Ranking';
        return view('admin.fantasy.rankings.edit', compact('ranking', 'teams', 'users', 'page_title'));
    }

    // Atualizar Ranking
    public function update(Request $request, $id)
    {
        $request->validate([
            'team_id' => 'required|exists:teams,id',
            'user_id' => 'required|exists:users,id',
            'points' => 'required|integer|min:0',
        ]);

        $ranking = Ranking::findOrFail($id);
        $ranking->update($request->all());

        return redirect()->route('admin.rankings.index')->with('success', 'Ranking atualizado com sucesso!');
    }

    // Excluir Ranking
    public function destroy($id)
    {
        $ranking = Ranking::findOrFail($id);
        $ranking->delete();

        return redirect()->route('admin.rankings.index')->with('success', 'Ranking excluído com sucesso!');
    }
}
