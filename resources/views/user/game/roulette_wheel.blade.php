@extends('user.layouts.master')
@section('css')
    <link rel="stylesheet" href="{{ asset('public/frontend/css/roulette_wheel_two.css') }}">
    <meta name="viewport" content="width=1024">
@endsection
@section('content')
    <div class="gaming_page_section pd-bottom-60">
        <div class="container">
            <div class="gaming_page_inner pd-bottom-30" id="gaming_page_inner">

            </div>
            <div class="card cust--card">
                <div class="card-body bg-success cust--success">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="font--color" for="betAmout">{{ __('Bet Amount') }}</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="betAmout">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon1">{{$general->currency}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label class="font--color" for="winBonus">{{ __('Win Bonus') }}</label>
                            <div class="input-group">
                                <input type="text" class="form-control" disabled id="winBonus">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon3">X</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="font--color" for="payAmount">{{ __('Payout Amount') }}</label>
                            <div class="input-group">
                                <input type="text" class="form-control" disabled id="payAmount">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">{{$general->currency}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('public/frontend/js/roulette_wheel_two.js?id=').rand() }}" data-balance="{{ auth()->user()->balance }}" data-games="{{$games}}" data-route="{{route('user.roulette.post')}}"></script>
@endsection
