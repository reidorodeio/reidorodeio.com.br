<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UnifiedAuthController extends Controller
{
    /**
     * Exibe a página de login e cadastro unificado.
     */
    public function showAuthForm()
    {
        return view('user.auth.loginbtns'); // Direciona para a página de login/cadastro unificado
    }

    /**
     * Lida com o registro de novos usuários.
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'cpf' => 'required|string|size:11|unique:users',
            'mobile' => 'required|string|max:15|unique:users',
            'chave_pix' => 'required|string|max:255', // Validação para a chave Pix
            'password' => 'required|string|min:6|confirmed',
        ], [
            'email.unique' => 'Este email já está cadastrado.',
            'cpf.unique' => 'Este CPF já está cadastrado.',
            'mobile.unique' => 'Este telefone já está cadastrado.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Criação do novo usuário
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'cpf' => $request->cpf,
            'mobile' => $request->mobile,
            'chave_pix' => $request->chave_pix, // Salvando a chave Pix
            'password' => Hash::make($request->password),
        ]);

        // Autenticar o usuário recém-cadastrado
        Auth::login($user);

        return redirect()->route('home')->with('success', 'Cadastro realizado com sucesso!');
    }

    /**
     * Lida com o login de usuários existentes.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('error', 'Email não encontrado.')->withInput();
        }

        if (!Hash::check($request->password, $user->password)) {
            return back()->with('error', 'A senha está incorreta.')->withInput();
        }

        Auth::login($user);
        $request->session()->regenerate();

        // Verifica se o usuário possui CPF, chave Pix e celular cadastrados
        if (is_null($user->cpf) || is_null($user->chave_pix) || is_null($user->mobile)) {
            $missingFields = [];

            if (is_null($user->cpf)) {
                $missingFields[] = 'CPF';
            }
            if (is_null($user->chave_pix)) {
                $missingFields[] = 'chave Pix';
            }
            if (is_null($user->mobile)) {
                $missingFields[] = 'celular';
            }

            // Cria uma mensagem personalizada para o usuário
            $missingFieldsMessage = 'Por favor, adicione os seguintes dados: ' . implode(', ', $missingFields) . '.';

            // Redireciona para a página de perfil se algum dado estiver ausente
            return redirect()->route('profile.index')->with('info', $missingFieldsMessage);
        }

        return redirect()->intended('home')->with('success', 'Login realizado com sucesso!');
    }

    /**
     * Lida com o logout do usuário.
     */
    public function logout(Request $request)
   {
       Auth::logout(); // Desconecta o usuário
       $request->session()->invalidate(); // Invalida a sessão
       $request->session()->regenerateToken(); // Regenera o token CSRF

       // Redireciona para a página inicial específica
       return redirect('/')->with('success', 'Você saiu com sucesso!');
   }

}
