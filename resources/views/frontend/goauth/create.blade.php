@extends('user.layouts.master')
@section('content')
    <div class="payment-area bg-navy-2 pd-bottom-120">
        <div class="container">
            <div class="row">
                @if (Auth::user()->tauth == '1')
                    <div class="col-lg-6">
                        <div class="payment-gateway-check form-check mb-4">
                            <h6 class="text-center">Autenticador de Dois Fatores</h6>
                            <div class="text-center">
                                <img src="{{ $prevqr }}" alt="img">
                                <button class="btn btn-base mt-4" data-bs-target="#disableModal"
                                    data-bs-toggle="modal">Desativar Autenticador de Dois Fatores</button>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-lg-6">
                        <div class="payment-gateway-check form-check">
                            <label class="form-check-label">
                                <h6 class="text-center">Autenticador de Dois Fatores</h6>
                            </label>
                            <div class="single-input-inner single-copy-icon style-border">
                                <span class="input-group-text copytext"> <i class="fa fa-copy"></i> </span>
                                <input type="text" name="key" value="{{ $secret }}" id="referralURL" readonly>
                            </div>
                            <div class="text-center">
                                <img src="{{ $qrCodeUrl }}" alt="img">
                                <button class="btn btn-base mt-4" data-bs-target="#enableModal"
                                    data-bs-toggle="modal">Ativar Autenticador de Dois Fatores</button>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="col-lg-6">
                    <div class="payment-gateway-check form-check">
                        <label class="form-check-label">
                            <h6 class="text-center">Google Authenticator</h6>
                        </label>
                        <div class="text-center">
                            <p class="text-success mb-4 mt-4">O Google Authenticator é um aplicativo multifator para
                                dispositivos móveis. Ele gera códigos temporizados usados durante o processo de verificação
                                em duas etapas. Para usar o Google Authenticator, instale o aplicativo Google Authenticator
                                em seu dispositivo móvel.</p>
                            <a class="btn btn-base"
                                href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2&hl=pt_BR"
                                target="_blank">BAIXAR APLICATIVO</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bet--model" id="enableModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content modal-content-cust">
                <div class="modal-header modal-title-cust">
                    <h5 class="modal-title" id="exampleModalLabel">Verifique seu OTP</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                {!! Form::open(['route' => 'go2fa.create', 'method' => 'POST']) !!}
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" name="key" value="{{ $secret }}">
                        <input type="text" class="form-control" name="code"
                            placeholder="Digite o Código do Google Authenticator">
                    </div>
                </div>
                <div class="modal-footer modal-footer-cust">
                    <button type="button" class="btn1 btn--danger text--white" data-bs-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn1 btn-base text--white">Verificar</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>


    <div class="modal fade bet--model" id="disableModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content modal-content-cust">
                <div class="modal-header modal-title-cust">
                    <h5 class="modal-title" id="exampleModalLabel">Verifique seu OTP para Desativar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                {!! Form::open(['route' => 'disable.2fa', 'method' => 'POST']) !!}
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" name="key" value="{{ $secret }}">
                        <input type="text" class="form-control" name="code"
                            placeholder="Digite o Código do Google Authenticator">
                    </div>
                </div>
                <div class="modal-footer modal-footer-cust">
                    <button type="button" class="btn1 btn--danger text--white" data-bs-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn1 btn-base text--white">Verificar</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
