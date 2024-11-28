<?php

namespace App\Http\Controllers\Admin;

use App\Models\Bolao;
use App\Models\FantasyEvent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BolaoController extends Controller
{
    // Listar todos os bolões
    public function index()
    {
        $boloens = Bolao::with('event')->paginate(10); // Carrega os bolões com os eventos relacionados
        $page_title = 'Lista de Bolões'; // Definindo o título da página
        return view('admin.fantasy.boloens.index', compact('boloens', 'page_title'));
    }

    // Formulário para criar um novo bolão
    public function create()
    {
        $events = FantasyEvent::all(); // Carregar todos os eventos
        $page_title = 'Adicionar Novo Bolão';
        return view('admin.fantasy.boloens.create', compact('events', 'page_title'));
    }

    // Armazenar um novo bolão
    public function store(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:fantasy_events,id',
            'value' => 'required|numeric',
            'valor_base' => 'required|numeric',
            'meta_equipes' => 'required|integer',
            'status' => 'required|boolean',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        try {
            $bolao = new Bolao();
            $bolao->event_id = $request->event_id;
            $bolao->value = $request->value;
            $bolao->status = $request->status;
            $bolao->valor_base = $request->valor_base;
            $bolao->meta_equipes = $request->meta_equipes;

            // Upload da imagem
            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('storage/boloens'), $filename); 
                $bolao->photo = $filename; 
            }

            $bolao->save();

            return redirect()->route('admin.fantasy.boloens.index')->with('success', 'Bolão cadastrado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao cadastrar o bolão: ' . $e->getMessage());
        }
    }

    // Formulário para editar um bolão
    public function edit($id)
    {
        $bolao = Bolao::findOrFail($id);
        $events = FantasyEvent::all();
        $page_title = 'Editar Bolão';
        return view('admin.fantasy.boloens.edit', compact('bolao', 'events', 'page_title'));
    }

    // Atualizar um bolão existente
    public function update(Request $request, $id)
    {
        $request->validate([
            'event_id' => 'required|exists:fantasy_events,id',
            'value' => 'required|numeric',
            'valor_base' => 'required|numeric',
            'meta_equipes' => 'required|integer',
            'status' => 'required|boolean',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        try {
            $bolao = Bolao::findOrFail($id);
            $input = $request->all();

            // Atualizar a imagem, se fornecida
            if ($request->hasFile('photo')) {
                $photoName = time() . '.' . $request->photo->extension();
                $request->photo->move(public_path('storage/boloens'), $photoName);
                $input['photo'] = $photoName;
            }

            $bolao->update($input);

            return redirect()->route('admin.fantasy.boloens.index')->with('success', 'Bolão atualizado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao atualizar o bolão: ' . $e->getMessage());
        }
    }

    // Excluir um bolão
    public function destroy($id)
    {
        try {
            $bolao = Bolao::findOrFail($id);

            // Excluir a imagem associada, se existir
            if ($bolao->photo && file_exists(public_path('storage/boloens/' . $bolao->photo))) {
                unlink(public_path('storage/boloens/' . $bolao->photo)); // Excluir a imagem
            }

            $bolao->delete();

            return redirect()->route('admin.fantasy.boloens.index')->with('success', 'Bolão excluído com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao excluir o bolão: ' . $e->getMessage());
        }
    }

    // Calcular o prêmio a ser pago com base no total de equipes
    public function calcularPremio(Bolao $bolao)
    {
        $arrecadado = $bolao->teams->count() * $bolao->value;

        if ($bolao->teams->count() < $bolao->meta_equipes) {
            $premio_a_pagar = $arrecadado * 0.80; // Paga 80% se a meta não for atingida
        } else {
            $premio_a_pagar = $arrecadado; // Paga o valor total arrecadado se a meta for atingida
        }

        return $premio_a_pagar;
    }
     
    public function show($event_id, $category)
    {
       // Recupera o evento com base no ID
       $event = FantasyEvent::findOrFail($event_id);
       // Recupera os bolões associados ao evento
       $boloens = Bolao::where('event_id', $event_id)->get();

       // Retorna a view passando os bolões e o evento
       return view('frontend.boloes', compact('event', 'boloens', 'category'));
   }





}
