<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PasswordReset;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Controlador de Redefinição de Senha
    |--------------------------------------------------------------------------
    |
    | Este controlador é responsável por lidar com emails de redefinição de senha e
    | inclui um trait que auxilia no envio dessas notificações de
    | sua aplicação para seus usuários. Sinta-se à vontade para explorar este trait.
    |
    */

    use SendsPasswordResetEmails;

    public function showEmailForm()
    {
        $data['page_title'] = 'Esqueci a Senha';
        return view('user.auth.passwords.email', $data);
    }

    public function sendResetPassMail(Request $request)
    {
        $this->validate($request, [
            'resetEmail' => 'required',
        ]);
        $user = User::where('email', $request->resetEmail)->first();
        if ($user == null) {
            return back()->with('alert', 'Email Não Disponível');
        } else {
            $code = Str::random(30);
            $message = 'Use Este Link para Redefinir a Senha: ' . url('/') . '/reset/' . $code;
            $exist = DB::table('password_resets')->where('email', $user->email)->where('status', 0)->where('created_at', '<=', Carbon::now())->latest()->first();

            if ($exist) {
                $oneMin = Carbon::now()->addMinute(1);
                $dif = Carbon::parse($exist->created_at)->diffInMinutes($oneMin);
                if ($dif < 2) {
                    $secDif = 120 - intval(Carbon::parse($exist->created_at)->diffInSeconds($oneMin));
                    return back()->with('alert', 'Por favor, solicite novamente após ' . $secDif . ' segundos.');
                }
            }

            DB::table('password_resets')->insert(
                ['email' => $user->email, 'token' => $code, 'status' => 0, 'created_at' => date("Y-m-d h:i:s")]
            );

            $userIpInfo = getIpInfo();
            $userBrowserInfo = osBrowser();
            send_email($user, 'PASS_RESET_CODE', [
                'code' => '' . url('/') . '/reset/' . $code,
                'operating_system' => @$userBrowserInfo['os_platform'],
                'browser' => @$userBrowserInfo['browser'],
                'ip' => @$userIpInfo['ip'],
                'time' => @$userIpInfo['time']
            ]);
            return back()->with('success', 'Email de Redefinição de Senha Enviado com Sucesso');
        }
    }

    public function resetPasswordForm($code)
    {
        $ps = PasswordReset::where('token', $code)->first();

        if ($ps == null) {
            return redirect()->route('user.showEmailForm');
        } else {
            if ($ps->status == 0) {
                $emp = User::where('email', $ps->email)->first();
                $data['email'] = $emp->email;
                $data['code'] = $code;
                return view('user.auth.passwords.reset', $data);
            } else {
                return redirect()->route('user.showEmailForm');
            }
        }
    }

    public function resetPassword(Request $request)
    {
        $messages = [
            'password_confirmation.confirmed' => 'Senha não corresponde'
        ];

        $request->validate([
            'password' => 'required|confirmed',
        ], $messages);

        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            // Autenticação bem-sucedida...
            $userIpInfo = getIpInfo();
            $userBrowser = osBrowser();
            send_email($user, 'PASS_RESET_DONE', [
                'operating_system' => @$userBrowser['os_platform'],
                'browser' => @$userBrowser['browser'],
                'ip' => @$userIpInfo['ip'],
                'time' => @$userIpInfo['time']
            ]);
            return redirect()->route('home')->with('success', 'Senha Redefinida com Sucesso');
        }
    }
}
