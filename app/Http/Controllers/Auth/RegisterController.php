<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Social;
use App\Models\General;
use App\Models\Extension;
use App\Models\ExtraPage;
use App\Models\Subscriber;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\PaymentGateway;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

   protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'cpf' => ['required', 'string', 'max:255', 'cpf', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'mobile' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'cpf.required' => 'O campo CPF é obrigatório.',
            'cpf.cpf' => 'O CPF informado não é válido.',
            'cpf.unique' => 'Este CPF já está em uso.',
            'email.required' => 'O campo de email é obrigatório.',
            'email.email' => 'O email informado não é válido.',
            'email.unique' => 'Este email já está em uso.',
            'mobile.required' => 'O campo número de celular é obrigatório.',
            'mobile.unique' => 'Este número de celular já está em uso.',
        ]);
    }

    protected function create(array $data)
    {
        $general = General::first();

        if ($general->emailver == 1) {
            $email_verify = 1;
        } else {
            $email_verify = 0;
        }

        $subscriberExists = Subscriber::where('email', $data['email'])->exists();

        $user = User::create([
            'name' => $data['name'],
            'cpf' => $data['cpf'],
            'email' => $data['email'],
            'emailv' => $email_verify,
            'mobile' => $data['mobile'],
            'tfver' => 0,
            'balance' => 0,
            'password' => Hash::make($data['password']),
            'referral_token' => uniqid(),
            'ref_id' => isset($data['ref_id']) ? $data['ref_id'] : null,
        ]);

        if (!$subscriberExists) {
            Subscriber::create([
                'email' => $user->email,
            ]);
        }

        return $user;
    }


    public function showRegistrationForm($referral_token = null)
    {
        if ($referral_token) {
            $data['refName'] = User::where('referral_token', $referral_token)->first();
        }
        $data['page_title'] = 'Cadastre-se';
        $data['social'] = Social::get();
        $data['extra_page'] = ExtraPage::get();
        $data['gateways'] = PaymentGateway::where('status', 1)->get();
        return view('user.auth.register', $data);
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $ex = Extension::where('act', 'google-recaptcha')->first();
        if (($ex->status == 1) && ($request->input('g-recaptcha-response') == '')) {
            return back()->with('alert', 'Captcha inválido');
        }
        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        $adminNotification = new Notification();
        $adminNotification->user_id = $user->id;
        $adminNotification->title = 'Novo membro registrado';
        $adminNotification->click_url = urlPath('user.view', $user->id);
        $adminNotification->save();

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 201)
            : redirect($this->redirectPath());
    }
}
