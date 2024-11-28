@extends('user.layouts.master')
@section('content')
    <div class="signup-area bg-navy-2 pd-bottom-200">
        <div class="container-sub">
            <div class="contact-inner">
                <div class="row">
                    <div class="col-lg-12">
                        <form action="{{ route('ticket.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="single-input-inner style-border">
                                        <span class="input-group-text">Seu Nome Completo</span>
                                        <span class="icon"><i class="fa fa-user"></i></span>
                                        <input name="name" value="{{ @$user->name }}" placeholder="Digite seu nome *"
                                            type="text">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="single-input-inner style-border">
                                        <span class="input-group-text">Endereço de Email</span>
                                        <span class="icon"><i class="fa fa-envelope"></i></span>
                                        <input name="email" value="{{ @$user->email }}" placeholder="Digite seu email *"
                                            type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="single-input-inner style-border">
                                <span class="input-group-text">Assunto</span>
                                <span class="icon"><i class="fa fa-user"></i></span>
                                <input name="subject" value="{{ old('subject') }}" placeholder="Assunto *" type="text">
                            </div>
                            <div class="single-input-inner">
                                <span class="input-group-text">Mensagem</span>
                                <textarea name="comment" placeholder="Mensagem">{{ old('message') }}</textarea></textarea>
                            </div>
                            <div class="text-center">
                                <button class="btn btn-base mt-3" type="submit">Enviar <i
                                        class="fas fa-arrow-circle-right ms-2"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
