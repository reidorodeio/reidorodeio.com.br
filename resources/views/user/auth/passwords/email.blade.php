@extends('frontend.layouts.master')
@section('content')
    <div class="signup-area bg-navy-2 pd-top-100 pd-bottom-120">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title style-white text-center">
                        <h2 class="title">Esqueci a Senha</h2>
                    </div>
                </div>
            </div>
            <div class="contact-inner">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        {!! Form::open(['route' => 'user.resetpassword.send', 'method' => 'POST']) !!}
                        <div class="single-input-inner style-border">
                            <span class="input-group-text">Endereço de Email</span>
                            <span class="icon"><i class="fa fa-envelope"></i></span>
                            <input name="resetEmail" placeholder="Email" type="email" id="email"
                                value="{{ old('resetEmail') }}" required autocomplete="resetEmail">
                        </div>
                        @include('partials.custom_captcha')
                        @include('partials.google_recaptcha')
                        <div class="text-center mb-3">
                            <button class="btn btn-base" type="submit">Enviar Link de Redefinição de Senha</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
