@extends('user.layouts.master')
@section('content')
    <div class="payment-area bg-navy-2 pd-bottom-220">
        <div class="container-sub">
            <div class="row">
                @foreach ($gateways as $data)
                    <div class="col-lg-3 align-self-center">
                        <div class="single-payment-wrap">
                            <div class="thumb">
                                <img src="{{ $data->image_url }}" alt="{{ $data->name }}" style="width: 176px; height: 107px;">
                            </div>
                            <div class="details">
                                <h4>{{ $data->name }}</h4>
                                <button class="btn btn-base" data-bs-target="#withdrawModal{{ $data->id }}"
                                    data-bs-toggle="modal">Sacar Agora</button>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="withdrawModal{{ $data->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="ModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title text-dark">Sacar via <strong>{{ $data->name }}</strong></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                {!! Form::open(['route' => 'withdraw.preview.user', 'method' => 'POST']) !!}
                                <div class="modal-body text-center">
                                    <p class="text-success">Mínimo {{ $data->min_amo }} {{ $general->currency }} &
                                        Máximo {{ $data->max_amo }} {{ $general->currency }}</p>
                                    <hr />
                                    <input type="hidden" name="gateway" value="{{ $data->id }}">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input name="amount" placeholder="Valor que deseja sacar" type="text"
                                                class="form-control" autocomplete="off" min="0" required>
                                            <span class="input-group-text">{{ $general->currency }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer modal-footer-cust justify-content-center">
                                    <button type="submit" class="btn1 btn-base text--white">Sacar</button>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
