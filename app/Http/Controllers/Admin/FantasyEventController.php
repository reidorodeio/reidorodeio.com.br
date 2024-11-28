<?php

namespace App\Http\Controllers\Admin;

use App\Models\FantasyEvent; 
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;  // Adicione essa linha ao topo do arquivo


class FantasyEventController extends Controller
{
    // Listar todos os eventos
    public function index()
    {
        $events = FantasyEvent::paginate(10);
        $page_title = 'Lista de Eventos de Fantasy'; 
        return view('admin.fantasy.events.index', compact('events', 'page_title'));
    }

    // Mostrar formulário de criação de evento
    public function create()
    {
        $page_title = 'Adicionar Novo Evento'; // Defina o título da página
        return view('admin.fantasy.events.create', compact('page_title')); // Passe a variável para a view
    }

    // Armazenar um novo evento
    public function store(Request $request)
    {
        $request->validate([
          'name' => 'required|string|max:255',
          'category' => 'required|string|max:255', // Alterado de 'cat_id' para 'category'
          'status' => 'required|boolean',
          'photo' => 'nullable|image',
        ]);

        $event = new FantasyEvent($request->all());

        // Upload da foto
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('storage/events'), $filename);
            $event->photo = $filename;
        }

        // Salva o evento
        $event->save();

        return redirect()->route('admin.fantasy.events.index')->with('success', 'Evento criado com sucesso!');
    }

    // Mostrar formulário de edição de evento
    public function edit($id)
    {
        $event = FantasyEvent::findOrFail($id);
        $page_title = 'Editar Evento'; // Defina o título da página
        return view('admin.fantasy.events.edit', compact('event', 'page_title')); // Passe a variável para a view
    }

    // Atualizar um evento existente
    public function update(Request $request, $id)
    {
       // Validação dos dados
       $request->validate([
          'name' => 'required|string|max:255',
          'category' => 'required|string|max:255', // Categoria como texto
          'status' => 'required|boolean',
          'photo' => 'nullable|image',
        ]);

        // Busca o evento pelo ID
         $event = FantasyEvent::findOrFail($id);

        // Atualiza os dados do evento
        $event->name = $request->input('name');
        $event->category = $request->input('category');
        $event->status = $request->input('status');

        // Verifica se uma nova foto foi enviada
        if ($request->hasFile('photo')) {
           $file = $request->file('photo');
           $filename = time() . '.' . $file->getClientOriginalExtension();
           $file->move(public_path('storage/events'), $filename);
           $event->photo = $filename; // Atualiza a foto no evento
        }

       // Salva as atualizações
       $event->save();

       return redirect()->route('admin.fantasy.events.index')->with('success', 'Evento atualizado com sucesso!');
    }

    // Excluir um evento
    public function destroy($id)
    {
        $event = FantasyEvent::findOrFail($id);
        $event->delete();

        return redirect()->route('admin.fantasy.events.index')->with('success', 'Evento excluído com sucesso!');
    }
}
