<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User; // Altere para o modelo User
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminUserController extends Controller
{
    /**
     * Exibe a lista de todos os usuários.
     */
    public function usersIndex()
    {
        $users = User::orderBy('id', 'DESC')->paginate(10); // Use o modelo User
        $page_title = 'User Management';
    
        return view('admin.acl.users.index', compact('users','page_title'));
    }
    
    /**
     * Exibe os detalhes de um usuário específico.
     */
    public function indexUserDetail($id)
    {
        $user = User::findOrFail($id);
        return view('admin.acl.users.detail', compact('user'));
    }

    /**
     * Atualiza as informações de um usuário.
     */
    public function userUpdate(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->only(['name', 'email', 'status']));
        return back()->with('success', 'User updated successfully');
    }

    /**
     * Exibe os usuários ativos.
     */
    public function usersActiveIndex()
    {
        $activeUsers = User::where('status', 1)->get();
        return view('admin.acl.users.active', compact('activeUsers'));
    }

    /**
     * Exibe os usuários banidos.
     */
    public function usersBanndedIndex()
    {
        $bannedUsers = User::where('status', 0)->get();
        return view('admin.acl.users.banned', compact('bannedUsers'));
    }

    /**
     * Exibe os usuários com email não verificado.
     */
    public function usersUnverifiedIndex()
    {
        $unverifiedUsers = User::whereNull('email_verified_at')->get();
        return view('admin.acl.users.unverified', compact('unverifiedUsers'));
    }

    /**
     * Busca usuários pelo nome.
     */
    public function userSearch(Request $request)
    {
        $users = User::where('name', 'like', '%' . $request->query('username') . '%')->get();
        return view('admin.acl.users.search', compact('users'));
    }

    /**
     * Busca usuários pelo email.
     */
    public function userSearchEmail(Request $request)
    {
        $users = User::where('email', 'like', '%' . $request->query('email') . '%')->get();
        return view('admin.acl.users.search_email', compact('users'));
    }

    /**
     * Exibe a tela de configuração de senha de um usuário específico.
     */
    public function passwordSetting($id)
    {
        $user = User::findOrFail($id);
        return view('admin.acl.users.password', compact('user'));
    }

    /**
     * Atualiza a senha de um usuário.
     */
    public function updatePassword(Request $request, $id)
    {
        $request->validate([
            'password' => 'required|confirmed|min:6',
        ]);

        $user = User::findOrFail($id);
        $user->password = Hash::make($request->input('password'));
        $user->save();

        return back()->with('success', 'Password updated successfully');
    }

    /**
     * Exibe o saldo do usuário.
     */
    public function indexUserBalance($id)
    {
        $user = User::findOrFail($id);
        return view('admin.acl.users.balance', compact('user'));
    }

    /**
     * Atualiza o saldo do usuário.
     */
    public function indexBalanceUpdate(Request $request, $id)
    {
        $request->validate([
            'balance' => 'required|numeric',
        ]);

        $user = User::findOrFail($id);
        $user->balance = $request->input('balance');
        $user->save();

        return back()->with('success', 'Balance updated successfully');
    }

    /**
     * Exibe a tela para enviar um email a um usuário específico.
     */
    public function userSendMail($id)
    {
        $user = User::findOrFail($id);
        return view('admin.acl.users.send_mail', compact('user'));
    }

    /**
     * Lida com o envio de email para o usuário.
     */
    public function userSendMailUser(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Lógica para enviar email ao usuário
        // Exemplo: Mail::to($user->email)->send(new CustomMail($request->subject, $request->message));

        return back()->with('success', 'Mail sent successfully');
    }
}
