@extends('frontend.layouts.master')
@section('content')
    <div class="signup-container">
        <h2 class="subtitle text-center mb-4">Cadastre-se</h2>
        {!! Form::open(['route' => 'register', 'method' => 'POST']) !!}
        @csrf
        @isset($refName)
            <div class="single-input-inner">
                <span class="input-group-text">Indicação</span>
                <input type="text" disabled value="{{ $refName->name }}">
                <input type="hidden" value="{{ $refName->id }}" name="ref_id">
            </div>
        @endisset
        <div class="single-input-inner">
            <span class="input-group-text">Seu Nome Completo</span>
            <input name="name" id="name" placeholder="Nome" type="text" value="{{ old('name') }}" required>
        </div>
        <div class="single-input-inner">
            <span class="input-group-text">CPF Válido</span>
            <input name="cpf" id="cpf" placeholder="CPF" type="text" value="{{ old('cpf') }}" required>
        </div>
        <div class="single-input-inner">
            <span class="input-group-text">Endereço de Email</span>
            <input name="email" id="email" placeholder="Email" type="email" value="{{ old('email') }}" required>
        </div>
        <div class="single-input-inner">
            <span class="input-group-text">Número de Celular</span>
            <input name="mobile" id="mobile" placeholder="Celular" type="text" value="{{ old('mobile') }}" required>
        </div>
        <div class="single-input-inner">
            <span class="input-group-text">Senha</span>
            <input name="password" id="password" placeholder="**********" type="password" required>
        </div>
        <div class="single-input-inner">
            <span class="input-group-text">Confirme a Senha</span>
            <input name="password_confirmation" id="password-confirm" placeholder="**********" type="password" required>
        </div>
        @include('partials.custom_captcha')
        @include('partials.google_recaptcha')
        <div class="text-center mb-3">
            <button class="btn-base" type="submit">Cadastrar</button>
        </div>
        <p class="text-center">Já possui conta? 
            <a href="{{ route('login') }}" class="btn-base">Jogar agora!</a>
        </p>
        {!! Form::close() !!}
    </div>

    <link rel="stylesheet" href="{{ asset('public/frontend/css/register.css') }}">
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#cpf').mask('000.000.000-00');
            $('#mobile').mask('(00) 00000-0000');
        });
    </script>
@endsection
