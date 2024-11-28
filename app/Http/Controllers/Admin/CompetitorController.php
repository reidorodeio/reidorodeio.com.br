<?php

namespace App\Http\Controllers\Admin;

use App\Models\Competitor;
use App\Models\FantasyEvent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CompetitorController extends Controller
{
    // Listar todos os competidores
    public function index()
    {
        $competitors = Competitor::with('event')->paginate(10); // Carregar evento
        $page_title = 'Lista de Competidores';
        return view('admin.fantasy.competitor.index', compact('competitors', 'page_title'));
    }

    // Formulário para criar um novo competidor
    public function create()
    {
        $events = FantasyEvent::all(); // Carregar eventos
        $page_title = 'Adicionar Novo Competidor';
        return view('admin.fantasy.competitor.create', compact('events', 'page_title'));
    }

    // Armazenar um novo competidor
    public function store(Request $request)
    {
       $request->validate([
          'name' => 'required|string|max:255',
          'event_id' => 'required|exists:fantasy_events,id',
          'type' => 'required|string',
          'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
       ]);

       // Coleta os dados do formulário
       $input = $request->all();

       // Buscar o evento selecionado para obter a categoria
       $event = FantasyEvent::find($request->event_id);

       if (!$event) {
           return redirect()->back()->withErrors('Evento não encontrado.');
       }

        // Preencher o campo category com o valor do evento
       $input['category'] = $event->category;

       // Verifica se uma foto foi enviada
       if ($request->hasFile('photo')) {
           $photoName = time() . '.' . $request->photo->extension();
           $request->photo->move(public_path('images/competitors'), $photoName);
           $input['photo'] = $photoName;  // Salvar o nome da imagem no banco
        }

        // Cria o competidor no banco de dados
        Competitor::create($input);

        return redirect()->route('admin.fantasy.competitors.index')->with('success', 'Competidor cadastrado com sucesso!');
    }

    // Formulário para editar um competidor
    public function edit($id)
    {
        $competitor = Competitor::findOrFail($id);
        $events = FantasyEvent::all(); // Carregar eventos
        $page_title = 'Editar Competidor';
        return view('admin.fantasy.competitor.edit', compact('competitor', 'events', 'page_title'));
    }

    // Atualizar competidor existente
    public function update(Request $request, $id)
    {
       $request->validate([
          'name' => 'required|string|max:255',
          'type' => 'required|string',
          'event_id' => 'required|exists:fantasy_events,id',
          'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
       ]);

      $competitor = Competitor::findOrFail($id);

      // Buscar o evento selecionado para obter a categoria
      $event = FantasyEvent::find($request->event_id);

      if (!$event) {
          return redirect()->back()->withErrors('Evento não encontrado.');
      }

      // Coletar os dados do formulário
      $input = $request->all();
      $input['category'] = $event->category;  // Definir a categoria com base no evento selecionado

      // Verifica se uma nova foto foi enviada
      if ($request->hasFile('photo')) {
          $photoName = time() . '.' . $request->photo->extension();
          $request->photo->move(public_path('images/competitors'), $photoName);
          $input['photo'] = $photoName;
       }

      // Atualiza o competidor no banco de dados
      $competitor->update($input);

      return redirect()->route('admin.fantasy.competitors.index')->with('success', 'Competidor atualizado com sucesso!');
    }

    // Excluir um competidor
    public function destroy($id)
    {
        $competitor = Competitor::findOrFail($id);
        $competitor->delete();

        return redirect()->route('admin.fantasy.competitors.index')->with('success', 'Competidor excluído com sucesso!');
    }
}
