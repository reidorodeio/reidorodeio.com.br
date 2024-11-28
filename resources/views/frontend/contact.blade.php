@extends('frontend.layouts.master')
@section('content')
    <div class="contact-area contact-area-cust bg-navy-2 pd-top-100 pd-bottom-220">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title style-white text-center">
                        <h5 class="sub-title">{{ __('Entre em Contato') }}</h5>
                        <h2 class="title">{{ __('Fale Conosco') }}</h2>
                    </div>
                </div>
            </div>
            <div class="contact-inner contact-inner-cust">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <form action="{{ route('frontend.contact.send') }}" method="POST">
                            @csrf
                            <div class="single-input-inner style-border">
                                <span class="input-group-text">{{ __('Seu Nome Completo') }}</span>
                                <span class="icon"><i class="fa fa-user"></i></span>
                                <input name="name" placeholder="{{ __('John Doe') }}" type="text">
                            </div>
                            <div class="single-input-inner style-border">
                                <span class="input-group-text">{{ __('Endereço de Email') }}</span>
                                <span class="icon"><i class="fa fa-envelope"></i></span>
                                <input name="email" placeholder="exemplo@dominio.com" type="text">
                            </div>
                            <div class="single-input-inner style-border">
                                <span class="input-group-text">{{ __('Assunto') }}</span>
                                <span class="icon"><i class="fa fa-user"></i></span>
                                <input name="subject" type="text">
                            </div>
                            <div class="single-input-inner">
                                <span class="input-group-text">{{ __('Mensagem') }}</span>
                                <textarea name="message"></textarea>
                            </div>
                            <div class="text-center">
                                <button class="btn btn-base mt-3" type="submit">{{ __('Enviar') }} <i
                                        class="fas fa-arrow-circle-right ms-2"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
