@extends('user.layouts.master')
@section('content')
<div class="payment-area bg-navy-2 pd-bottom-220">
    <div class="container-sub">
        <div class="row">
            @foreach ($games as $data)
            <div class="col-lg-3 align-self-center">
                <div class="single-payment-wrap">
                    <div class="thumb">
                        <img src="{{asset('public/images/games/'.$data->image)}}" alt="{{$data->name}}">
                    </div>
                    <div class="details">
                        <h4>{{__($data->name)}}</h4>
                        <a class="btn btn-base" href="{{route('game.details.index',$data->slug)}}">{{__('Play')}}</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
