@extends('user.layouts.master')
@section('content')
    <div class="currency-area">
        <div class="row">
            <div class="col-lg-12">
                <p class="text-base">Indique e ganhe até 30% de comissão.</p>
                <div class="mb-3 input-group referral-input-box">

                    <input type="text" class="form-control" id="myInputref" readonly
                        value="{{ url('/') }}/cadastro/{{ auth()->user()->referral_token }}">
                    <button class="input-group-text btn btn-base myrefButtonFunction fw-bold" type="button"
                        onclick="myrefButtonFunction()">Copiar Link</button>
                </div>
            </div>
            <div class="col-xl-3">
                <div class="media single-currency-inner image-hover-rotate">
                    <div class="media-left align-self-center">
                        <img class="rotate-img" src="{{ asset('public/frontend/img/corrency/1.png') }}" alt="img">
                    </div>
                    <div class="media-body">
                        <p>SALDO TOTAL</p>
                        <h3>{{ number_format(auth()->user()->balance, 2) }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-xl-3">
                <div class="media single-currency-inner image-hover-rotate">
                    <div class="media-left align-self-center">
                        <img class="rotate-img" src="{{ asset('public/frontend/img/corrency/1.png') }}" alt="img">
                    </div>
                    <div class="media-body">
                        <p>PREDIÇÃO TOTAL</p>
                        <h3>{{ @number_format($totalPrediction, 2) }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-xl-3">
                <div class="media single-currency-inner image-hover-rotate">
                    <div class="media-left align-self-center">
                        <img class="rotate-img" src="{{ asset('public/frontend/img/corrency/1.png') }}" alt="img">
                    </div>
                    <div class="media-body">
                        <p>VITÓRIA TOTAL</p>
                        <h3>{{ @number_format($win_turnament, 2) }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
