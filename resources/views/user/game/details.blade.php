@extends('user.layouts.master')
@section('css')
    @if ($games->id == 1)
        <link rel="stylesheet" href="{{asset('public/frontend/css/roulette_wheel.css')}}">
    @elseif($games->id == 2)
        <link rel="stylesheet" href="{{asset('public/frontend/css/slot.css')}}">
    @else
        <link rel="stylesheet" href="{{asset('public/frontend/css/solitaire.css')}}">
    @endif
@endsection
@section('content')
<div class="gaming_page_section mb-125">
    <div class="container">
        @if ($games->id == 1)
        <div class="gaming_page_inner">
            <div class="row">
                <div class="main">
                    <button type="button" class="btn" id="spin"><span class="btn-label">{{__('Spin')}}</span></button>
                    <button type="button" class="btn btn-reset" id="reset"><span class="btn-label">{{__('New Game')}}</span></button>
                    <div class="plate" id="plate">
                        <ul class="inner">
                        <li class="number"><label><input type="radio" name="pit" value="32" /><span class="pit">32</span></label></li>
                        <li class="number"><label><input type="radio" name="pit" value="15" /><span class="pit">15</span></label></li>
                        <li class="number"><label><input type="radio" name="pit" value="19" /><span class="pit">19</span></label></li>
                        <li class="number"><label><input type="radio" name="pit" value="4" /><span class="pit">4</span></label></li>
                        <li class="number"><label><input type="radio" name="pit" value="21" /><span class="pit">21</span></label></li>
                        <li class="number"><label><input type="radio" name="pit" value="2" /><span class="pit">2</span></label></li>
                        <li class="number"><label><input type="radio" name="pit" value="25" /><span class="pit">25</span></label></li>
                        <li class="number"><label><input type="radio" name="pit" value="17" /><span class="pit">17</span></label></li>
                        <li class="number"><label><input type="radio" name="pit" value="34" /><span class="pit">34</span></label></li>
                        <li class="number"><label><input type="radio" name="pit" value="6" /><span class="pit">6</span></label></li>
                        <li class="number"><label><input type="radio" name="pit" value="27" /><span class="pit">27</span></label></li>
                        <li class="number"><label><input type="radio" name="pit" value="13" /><span class="pit">13</span></label></li>
                        <li class="number"><label><input type="radio" name="pit" value="36" /><span class="pit">36</span></label></li>
                        <li class="number"><label><input type="radio" name="pit" value="11" /><span class="pit">11</span></label></li>
                        <li class="number"><label><input type="radio" name="pit" value="30" /><span class="pit">30</span></label></li>
                        <li class="number"><label><input type="radio" name="pit" value="8" /><span class="pit">8</span></label></li>
                        <li class="number"><label><input type="radio" name="pit" value="23" /><span class="pit">23</span></label></li>
                        <li class="number"><label><input type="radio" name="pit" value="10" /><span class="pit">10</span></label></li>
                        <li class="number"><label><input type="radio" name="pit" value="5" /><span class="pit">5</span></label></li>
                        <li class="number"><label><input type="radio" name="pit" value="24" /><span class="pit">24</span></label></li>
                        <li class="number"><label><input type="radio" name="pit" value="16" /><span class="pit">16</span></label></li>
                        <li class="number"><label><input type="radio" name="pit" value="33" /><span class="pit">33</span></label></li>
                        <li class="number"><label><input type="radio" name="pit" value="1" /><span class="pit">1</span></label></li>
                        <li class="number"><label><input type="radio" name="pit" value="20" /><span class="pit">20</span></label></li>
                        <li class="number"><label><input type="radio" name="pit" value="14" /><span class="pit">14</span></label></li>
                        <li class="number"><label><input type="radio" name="pit" value="31" /><span class="pit">31</span></label></li>
                        <li class="number"><label><input type="radio" name="pit" value="9" /><span class="pit">9</span></label></li>
                        <li class="number"><label><input type="radio" name="pit" value="22" /><span class="pit">22</span></label></li>
                        <li class="number"><label><input type="radio" name="pit" value="18" /><span class="pit">18</span></label></li>
                        <li class="number"><label><input type="radio" name="pit" value="29" /><span class="pit">29</span></label></li>
                        <li class="number"><label><input type="radio" name="pit" value="7" /><span class="pit">7</span></label></li>
                        <li class="number"><label><input type="radio" name="pit" value="28" /><span class="pit">28</span></label></li>
                        <li class="number"><label><input type="radio" name="pit" value="12" /><span class="pit">12</span></label></li>
                        <li class="number"><label><input type="radio" name="pit" value="35" /><span class="pit">35</span></label></li>
                        <li class="number"><label><input type="radio" name="pit" value="3" /><span class="pit">3</span></label></li>
                        <li class="number"><label><input type="radio" name="pit" value="26" /><span class="pit">26</span></label></li>
                        <li class="number"><label><input type="radio" name="pit" value="0" /><span class="pit">0</span></label></li>
                        </ul>
                        <div class="data">
                        <div class="data-inner">
                            <div class="mask"></div>
                            <div class="result">
                            <div class="result-number">00</div>
                            <div class="result-color">{{__('red')}}</div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="previous-results">
                        <ol class="previous-list">
                        <li class='visuallyhidden placeholder'>{{__('No results yet')}}.</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        @elseif($games->id == 2)
            <div class="gaming_page_inner">
                <div class="row">
                    <div id="menu">
                        <nav>
                            <ul>
                                <li><button class="btn btn-primary" id="new-game" name="newGame" onClick="newGame()"> {{__('New Game')}} </button></li>
                                <li><button class="btn btn-primary" id="restart" name="restartGame" onClick="restartGame()"> {{__('Restart Game')}} </button></li>
                            </ul>
                        </nav>
                    </div>
                    <div id="field">
                        <div class="aligned" id="f1" style="grid-area:f1;"></div>
                        <div class="aligned" id="f2" style="grid-area:f2;"></div>
                        <div class="aligned" id="f3" style="grid-area:f3;"></div>
                        <div class="aligned" id="f4" style="grid-area:f4;"></div>
                        <div class="aligned" id="f5" style="grid-area:f5;"></div>
                        <div class="aligned" id="wp" style="grid-area:wp;"></div>
                        <div class="aligned" id="st" style="grid-area:st;" onClick="searchStock()"></div>
                    
                        <div id="tb" style="grid-area:tb;">
                        <div class="aligned" id="a1" style="grid-area:a1;"></div>
                        <div class="aligned" id="a2" style="grid-area:a2;"></div>
                        <div class="aligned" id="a3" style="grid-area:a3;"></div>
                        <div class="aligned" id="a4" style="grid-area:a4;"></div>
                        <div class="aligned" id="a5" style="grid-area:a5;"></div>
                        <div class="aligned" id="a6" style="grid-area:a6;"></div>
                        <div class="aligned" id="a7" style="grid-area:a7;"></div>
                        </div>
                    </div>
                    <div class="winner" id="winner">
                        <div class="content">
                        <h1> {{__('You Win!')}} </h1>
                        <input type="button" value="New Game" name="newGame" onclick="newGame()" />
                        </div>
                    </div>
                </div>
            </div>
        @else
        <div class="gaming_page_inner">
            <div class="row">
                <div class="container">
                    <div class="preview">
                      <img src="//oi63.tinypic.com/2u76br5.jpg">
                    </div>
                    <h2 class="text-center text-light my-3 gold"><i class="fab fa-phoenix-framework gold"></i> {{__('Slot Game')}}</h2>
                    <div class="row justify-content-center mb-3">
                      <div class="col col-auto">
                        <canvas id="slot" width="440" height="240"></canvas>
                      </div>
                    </div>
                    <div class="row justify-content-center mb-3">
                        <div class="col col-auto">
                            <div class="input-group mb-3">
                                <span class="input-group-text">{{__('Current WIN')}}</span>
                                <input type="text" class="form-control w-auto" id="cwin" value="0">
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center mb-3">
                    <div class="col col-auto">
                        <button class="btn btn-danger px-5" id="spin"><i class="fas fa-sync-alt"></i> {{__('SPIN')}}</button>
                        <button class="btn btn-secondary px-5" id="auto"><i class="fab fa-android"></i> {{__('AUTO (OFF)')}}</button>
                    </div>
                    </div>
                    <div class="row justify-content-center mb-3">
                    <div class="col col-auto">
                        <div class="input-group">
                            <span class="input-group-text">{{__('Credits')}}</span>
                            <input class="form-control" type="number" id="balance" min="1" max="5000">
                            <span class="input-group-text"><i class="fas fa-dollar-sign green"></i></span>
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
                        <div class="col-md-4">
                            <div class="row justify-content-center">
                                <div class="col-lg-4">
                                    <select id="mode" class="btn btn-default">
                                        <option value="random">{{__('Random')}}</option>
                                        <option value="fixed">{{__('Fixed')}}</option>
                                    </select>
                                </div>
                                <div class="col-lg-3">
                                    <select id="where" class="btn btn-default">
                                        <option value="top">{{__('top')}}</option>
                                        <option value="middle">{{__('middle')}}</option>
                                        <option value="bottom">{{__('bottom')}}</option>
                                    </select>
                                </div>
                                <div class="col-lg-2">
                                    <select id="what" class="btn btn-default">
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center my-3">
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
        @endif
    </div>
</div>
@endsection
@section('script')
    @if ($games->id == 1)
        <script src="{{asset('public/frontend/js/roulette_wheel.js')}}"></script>
    @elseif($games->id == 2)
      <script src="{{asset('public/frontend/js/slot.js')}}"></script>
    @else
      <script src="{{asset('public/frontend/js/solitaire.js')}}"></script>
    @endif
@endsection