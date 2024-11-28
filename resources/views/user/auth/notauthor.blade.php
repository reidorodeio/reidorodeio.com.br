@extends('frontend.layouts.master')
@section('content')
<div class="signup-area bg-navy-2 pd-top-100 pd-bottom-120">
    <div class="container">
        @if (Auth::user()->status != '1')
        <div class="row">
            <div class="col-12">
                <div class="section-title style-white text-center pd-bottom-60">
                    <h2 class="title">Sua conta está desativada</h2>
                </div>
            </div>
        </div>
        @elseif(Auth::user()->emailv != '0')
        <div class="contact-inner">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <form action="{{route('sendemailver')}}" method="POST">
                        @csrf
                        <h4 class="subtitle mb-4">Por favor, verifique seu email</h4>
                        <div class="single-input-inner style-border">
                            <span class="input-group-text">Endereço de Email</span>
                            <span class="icon"><i class="fa fa-envelope"></i></span>
                            <input type="text" readonly placeholder="Seu endereço de email" value="{{Auth::user()->email}}">
                        </div>
                        <div class="text-center mb-3">
                            <button class="btn btn-base" type="submit">Enviar Código de Verificação</button>
                        </div>
                    </form>
                </div>
                <div class="col-lg-6">
                    <form action="{{route('emailverify') }}" method="POST">
                        @csrf
                        <h4 class="subtitle mb-4">Verificar Código</h4>
                        <div class="single-input-inner style-border">
                            <span class="input-group-text">Digite o Código de Verificação</span>
                            <span class="icon"><i class="fa fa-envelope"></i></span>
                            <input type="text" name="code" placeholder="Seu Código de Verificação" required>
                        </div>
                        <form action="{{route('sendemailver')}}" method="POST">
                            @csrf
                            <div class="text-center mb-3">
                                <button class="btn btn-base" type="submit">Verificar</button>
                            </div>
                        </form>
                    </form>
                </div>
            </div>
        </div>
        @elseif(Auth::user()->tfver != '0')
        <div class="contact-inner">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                <form action="{{route('go2fa.verify') }}" method="POST">
                    @csrf
                    <h4 class="subtitle mb-4">Verificar Código do Google Authenticator</h4>
                    <div class="single-input-inner style-border">
                        <span class="input-group-text">Digite o Código do Google Authenticator</span>
                        <span class="icon"><i class="fa fa-envelope"></i></span>
                        <input type="text" name="code" placeholder="Seu Código do Google Authenticator" required>
                    </div>
                    <div class="text-center mb-3">
                        <button class="btn btn-base" type="submit">Verificar</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

@endsection
