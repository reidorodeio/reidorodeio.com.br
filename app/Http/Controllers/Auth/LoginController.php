<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Extension;
use Illuminate\Http\Request;
use App\Models\Social;
use Illuminate\Http\JsonResponse;
use App\Models\ExtraPage;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Controlador de Login
    |--------------------------------------------------------------------------
    |
    | Este controlador lida com a autenticação de usuários para a aplicação e
    | os redireciona para a tela inicial. O controlador utiliza um trait
    | para fornecer convenientemente sua funcionalidade para suas aplicações.
    |
    */

    use AuthenticatesUsers;

    /**
     * Para onde redirecionar os usuários após o login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Cria uma nova instância do controlador.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        $data['page_title'] = 'Jogar agora Conta';
        return view('user.auth.loginbtns', $data);
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);
        $usr = User::where('email', $request->email)->first();

        if (($usr instanceof User) && ($usr->status != 1)) {
            return back()->withErrors(['Conta Banida']);
        }

        $ex = Extension::where('act', 'google-recaptcha')->first();
        if (($ex->status == 1) && ($request->input('g-recaptcha-response') == '')) {
            return back()->with('alert', 'Captcha inválido');
        }

        // Se a classe estiver usando o ThrottlesLogins trait, podemos automaticamente limitar
        // as tentativas de login para esta aplicação. Vamos chavear isso pelo nome de usuário e
        // o endereço IP do cliente que faz essas solicitações para esta aplicação.
        if (
            method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)
        ) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        // Se a tentativa de login não foi bem-sucedida, iremos incrementar o número de tentativas
        // de login e redirecionar o usuário de volta para o formulário de login. Claro, quando isso
        // usuário ultrapassar o número máximo de tentativas, ele será bloqueado.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    public function logout(Request $request)
    {
        $user = User::findOrFail(Auth::id());
        if (Auth::user()->tauth == 1) {
            $user['tfver'] = 1;
        } else {
            $user['tfver'] = 0;
        }
        $user->save();
        $this->guard()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        if ($response = $this->loggedOut($request)) {
            return $response;
        }
        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('/');
    }
}
