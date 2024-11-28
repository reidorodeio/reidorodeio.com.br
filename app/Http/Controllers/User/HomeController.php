<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        Log::info('Método index chamado para exibir o perfil do usuário.');
        $data['page_title'] = "Painel";
        $data['user'] = Auth::user();

        return view('user.profile.myprofile', $data);
    }

    public function profileUpdate(Request $request)
    {
        Log::info('Método profileUpdate chamado.');

        $validatedData = $request->validate([
            'name' => 'required|string',
            'cpf' => ['required', 'cpf', Rule::unique('users')->ignore(Auth::id())],
            'chave_pix' => ['nullable', Rule::unique('users')->ignore(Auth::id())],
            'mobile' => ['nullable', Rule::unique('users')->ignore(Auth::id())],
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        try {
            $user = Auth::user();
            Log::info('Usuário autenticado: ', $user->toArray());

            if ($request->hasFile('photo')) {
                Log::info('Arquivo de foto enviado.');

                $imagePath = public_path('users/images');
                if (!is_dir($imagePath)) {
                    mkdir($imagePath, 0777, true);
                    Log::info("Pasta criada: {$imagePath}");
                }

                if ($user->image && file_exists("{$imagePath}/{$user->image}")) {
                    unlink("{$imagePath}/{$user->image}");
                    Log::info("Imagem antiga excluída: {$imagePath}/{$user->image}");
                }

                $image = $request->file('photo');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move($imagePath, $imageName);
                Log::info("Nova imagem salva: {$imagePath}/{$imageName}");

                $user->image = $imageName;
                Log::info("Imagem atualizada no banco de dados: {$imageName}");
            }

            $user->name = $validatedData['name'];
            $user->cpf = $validatedData['cpf'];
            $user->chave_pix = $validatedData['chave_pix'] ?? $user->chave_pix;
            $user->mobile = $validatedData['mobile'] ?? $user->mobile;

            $user->save();
            Log::info('Dados do usuário salvos: ', $user->toArray());

            return back()->with('success', 'Perfil atualizado com sucesso.');
        } catch (\Exception $e) {
            Log::error('Erro ao atualizar o perfil: ' . $e->getMessage());
            return back()->with('alert', 'Erro ao atualizar o perfil.');
        }
    }
}
