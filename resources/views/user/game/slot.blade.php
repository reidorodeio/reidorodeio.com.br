@extends('user.layouts.master')
@section('css')
  <link rel="stylesheet" href="{{asset('public/frontend/css/slot.css')}}">
  <meta name="viewport" content="width=1024">
@endsection
@section('content')
<div class="gaming_page_section pd-bottom-60 bg-navy-2">
    <div class="container">
        <div class="gaming_page_inner">
            <div class="row">
                <div class="container">
                    <div class="preview">
                      <img src="//oi63.tinypic.com/2u76br5.jpg">
                    </div>
                    {{-- <h2 class="text-center text-light my-3 gold"><i class="fab fa-phoenix-framework gold"></i> {{$games->name}} </h2> --}}
                    <div class="row justify-content-center mb-3">
                      <div class="col col-auto">
                        <canvas id="slot" width="440" height="240"></canvas>
                      </div>
                    </div>
                    <div class="row justify-content-center mb-3">
                        <div class="col col-auto">
                            <div class="input-group mb-3">
                                <span class="input-group-text">{{__('Win Amount')}}</span>
                                <input type="text" class="form-control w-auto" id="cwin" value="0" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center mb-3">
                    <div class="col col-auto">
                        <button class="btn btn-danger px-5" id="spin"><i class="fas fa-sync-alt"></i> {{__('SPIN')}}</button>
                        <button  style="display: none" class="btn btn-secondary px-5" id="auto"><i class="fab fa-android"></i> {{__('AUTO (OFF)')}}</button>
                    </div>
                    </div>
                    <div class="row justify-content-center mb-3">
                    <div class="col col-auto">
                        <div class="input-group">
                            <span class="input-group-text">{{__('Balance')}}</span>
                            <input class="form-control" type="number" id="balance" readonly value="{{auth()->user()->balance}}" min="{{$games->min}}" max="{{$games->max}}">
                            <span class="input-group-text">{{$general->currency}}</span>
                        </div>
                    </div>
                    <div class="col col-auto">
                        <div class="input-group">
                            <span class="input-group-text">{{__('BETx')}}</span>
                            <input class="form-control" type="number" id="bet" min="1" value="1" max="3">
                            <span class="input-group-text"><i class="fas fa-coins gold"></i></span>
                        </div>
                    </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-4">
                            <select id="mode" class="form-control">
                                <option value="random">{{__('Random')}}</option>
                                <option value="fixed">{{__('Fixed')}}</option>
                            </select>
                        </div>
                        <div class="col-lg-3">
                            <select id="where" class="form-control">
                                <option value="top">{{__('Top')}}</option>
                                <option value="middle">{{__('Middle')}}</option>
                                <option value="bottom">{{__('Bottom')}}</option>
                            </select>
                        </div>
                        <div class="col-lg-2">
                            <select id="what" class="form-control">
                            </select>
                        </div>
                    </div>
                    <div class="row justify-content-center my-3" style="display: none">
                      <div class="col col-auto">
                        <button class="btn btn-warning w-auto" type="button" id="checkout"><i class="fas fa-money-bill-alt"></i> {{__('CHECKOUT')}}</button>
                        <button class="btn btn-primary w-auto" type="button" data-toggle="modal" data-target="#payTable"><i class="fas fa-money-bill-alt"></i> {{__('Pay Table')}}</button>
                      </div>
                    </div>
                  </div>

                  <div class="modal fade" id="payTable" tabindex="-1" role="dialog" aria-labelledby="payTableTitle" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="payTableTitle">{{__('Pay Table')}}</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <table class="table table-dark table-hover table-responsive" style="overflow:hidden">
                            <thead>
                              <tr>
                                <td>{{__('Reel1')}}</td>
                                <td>{{__('Reel2')}}</td>
                                <td>{{__('Reel3')}}</td>
                                <td>{{__('TOP')}}</td>
                                <td>{{__('MIDDLE')}}</td>
                                <td>{{__('BOTTOM')}}</td>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td><img src="https://n1md7.github.io/slot-game/img/Cherry.png" width="40"></td>
                                <td><img src="https://n1md7.github.io/slot-game/img/Cherry.png" width="40"></td>
                                <td><img src="https://n1md7.github.io/slot-game/img/Cherry.png" width="40"></td>
                                <td class="v-align">{{__('2000xBET')}}</td>
                                <td class="v-align">{{__('1000xBET')}}</td>
                                <td class="v-align">{{__('4000xBET')}}</td>
                              </tr>
                              <tr>
                                <td><img src="https://n1md7.github.io/slot-game/img/7.png" width="40"></td>
                                <td><img src="https://n1md7.github.io/slot-game/img/7.png" width="40"></td>
                                <td><img src="https://n1md7.github.io/slot-game/img/7.png" width="40"></td>
                                <td class="v-align">{{__('150xBET')}}</td>
                                <td class="v-align">{{__('150xBET')}}</td>
                                <td class="v-align">{{__('150xBET')}}</td>
                              </tr>
                              <tr>
                                <td>
                                  <img src="https://n1md7.github.io/slot-game/img/7.png" width="40">
                                  <img src="https://n1md7.github.io/slot-game/img/Cherry.png" width="40">
                                </td>
                                <td>
                                  <img src="https://n1md7.github.io/slot-game/img/7.png" width="40">
                                  <img src="https://n1md7.github.io/slot-game/img/Cherry.png" width="40">
                                </td>
                                <td>
                                  <img src="https://n1md7.github.io/slot-game/img/7.png" width="40">
                                  <img src="https://n1md7.github.io/slot-game/img/Cherry.png" width="40">
                                </td>
                                <td class="v-align">{{__('75xBET')}}</td>
                                <td class="v-align">{{__('75xBET')}}</td>
                                <td class="v-align">{{__('75xBET')}}</td>
                              </tr>
                              <tr>
                                <td><img src="https://n1md7.github.io/slot-game/img/3xBAR.png" width="40"></td>
                                <td><img src="https://n1md7.github.io/slot-game/img/3xBAR.png" width="40"></td>
                                <td><img src="https://n1md7.github.io/slot-game/img/3xBAR.png" width="40"></td>
                                <td class="v-align">{{__('50xBET')}}</td>
                                <td class="v-align">{{__('50xBET')}}</td>
                                <td class="v-align">{{__('50xBET')}}</td>
                              </tr>
                              <tr>
                                <td><img src="https://n1md7.github.io/slot-game/img/2xBAR.png" width="40"></td>
                                <td><img src="https://n1md7.github.io/slot-game/img/2xBAR.png" width="40"></td>
                                <td><img src="https://n1md7.github.io/slot-game/img/2xBAR.png" width="40"></td>
                                <td class="v-align">{{__('20xBET')}}</td>
                                <td class="v-align">{{__('20xBET')}}</td>
                                <td class="v-align">{{__('20xBET')}}</td>
                              </tr>
                              <tr>
                                <td><img src="https://n1md7.github.io/slot-game/img/BAR.png" width="40"></td>
                                <td><img src="https://n1md7.github.io/slot-game/img/BAR.png" width="40"></td>
                                <td><img src="https://n1md7.github.io/slot-game/img/BAR.png" width="40"></td>
                                <td class="v-align">{{__('10xBET')}}</td>
                                <td class="v-align">{{__('10xBET')}}</td>
                                <td class="v-align">{{__('10xBET')}}</td>
                              </tr>
                              <tr>
                                <td>
                                  <img src="https://n1md7.github.io/slot-game/img/BAR.png" width="40">
                                  <img src="https://n1md7.github.io/slot-game/img/2xBAR.png" width="40">
                                  <img src="https://n1md7.github.io/slot-game/img/3xBAR.png" width="40">
                                </td>
                                <td>
                                  <img src="https://n1md7.github.io/slot-game/img/BAR.png" width="40">
                                  <img src="https://n1md7.github.io/slot-game/img/2xBAR.png" width="40">
                                  <img src="https://n1md7.github.io/slot-game/img/3xBAR.png" width="40">
                                </td>
                                <td>
                                  <img src="https://n1md7.github.io/slot-game/img/BAR.png" width="40">
                                  <img src="https://n1md7.github.io/slot-game/img/2xBAR.png" width="40">
                                  <img src="https://n1md7.github.io/slot-game/img/3xBAR.png" width="40">
                                </td>
                                <td class="v-align">{{__('5xBET')}}</td>
                                <td class="v-align">{{__('5xBET')}}</td>
                                <td class="v-align">{{__('5xBET')}}</td>
                              </tr>

                            </tbody>
                          </table>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
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
    <script src="{{asset('public/frontend/js/slot.js?id=').rand()}}" data-balance="{{ auth()->user()->balance }}" data-games="{{$games}}" data-route="{{route('user.slot.post')}}" data-baseurl="{{asset('public')}}"></script>
@endsection
