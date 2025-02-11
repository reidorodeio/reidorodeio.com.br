@extends('user.layouts.master')
@section('content')
    <div class="signup-area bg-navy-2 pd-bottom-120">
        <div class="container-sub">
            <div class="contact-inner">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-12 mx-auto mb-50">
                        {!! Form::open(['route' => 'password.update', 'method' => 'POST']) !!}
                        <div class="single-input-inner style-border">
                            <span class="input-group-text">Senha Atual</span>
                            <span class="icon"><i class="fa fa-key"></i></span>
                            <input name="current_password" placeholder="*************" type="password" required
                                autocomplete="current-password">
                        </div>
                        <div class="single-input-inner style-border">
                            <span class="input-group-text">Nova Senha</span>
                            <span class="icon"><i class="fa fa-key"></i></span>
                            <input name="password" placeholder="*************" type="password" required
                                autocomplete="new-password">
                        </div>
                        <div class="single-input-inner style-border">
                            <span class="input-group-text">Confirmar Senha</span>
                            <span class="icon"><i class="fa fa-key"></i></span>
                            <input name="password_confirmation" placeholder="*************" type="password" required
                                autocomplete="confirm-password">
                        </div>
                        <div class="text-center mb-3">
                            <button class="btn btn-base" type="submit">Alterar Senha</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
