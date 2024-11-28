@extends('user.layouts.master')
@section('content')
    <section class="match_details_section pd-bottom-120 bg-navy-2">
        <div class="container-sub">
            <div class="rows d-flex justify-content-center bg-black-2 p-4 rounded-3">
                <div class="col-md-10 mt-5 mb-5">
                    <div class="text-center">
                        <img src="{{ asset('public/images/withdraw/' . $method->image) }}" class="rounded" alt="Imagem de Retirada" style="width: 176px; height: 107px;">
                    </div>
                    {!! Form::open(['route' => 'confirm.withdraw.store', 'method' => 'POST']) !!}
                    @csrf
                    @php
                        $charge =
                            (floatval($amount) * floatval($method->chargepc)) / 100 +
                            floatval($amount) +
                            floatval($method->chargefx);
                    @endphp
                    <input type="hidden" name="amount" value="{{ $amount }}">
                    <input type="hidden" name="method_id" value="{{ $method->id }}">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="model-body table-responsive text-center">
                                <strong class="col-md-12">Informe seu pix.</strong>
                                <input class="form-control" name="detail" rows="5" placeholder="Chave PIX"></input>
                            </div>
                        </div>
                        <div class="col-md-12 mt-5 text-center">
                            <button class="btn btn-base withdrawBtn" type="submit" id="btn-confirm">Sacar
                                <i class="fas fa-arrow-circle-right ms-2"></i></button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </section>
@endsection
