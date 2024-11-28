<div class="mt-4 schedule-area">
    @forelse($matches as $key => $data)
        <div class="text-center single-schedule-inner">
            <div class="row no-gutters">
                <div class="col-xl-6 align-self-center">
                    <div class="schedule-left">
                        <div class="row">
                            <div class="col-sm-4 empty-schedule-top">
                                @if (!is_null($data->team_1_image))
                                    <img src="{{ asset('public/images/match/' . $data->team_1_image) }}" alt="img">
                                @endif
                                <p class="mt-3 mb-0">{{ $data->team_1 }}</p>
                            </div>
                            <div class="col-sm-4">
                                <p>{{ $data->event->name }}</p>
                                <h4 class="color-base">Aposte agora</h4>
                                @if (\Carbon\Carbon::parse($data->end_date) > \Carbon\Carbon::now())
                                    <p class="time" id="counter{{ $data->id }}"></p>
                                    <script>
                                        createCountDown('counter<?php echo $data->id; ?>', {{ \Carbon\Carbon::parse($data->end_date)->diffInSeconds() }});
                                    </script>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @if ($data->questions->count())
                    <div class="col-xl-6 align-self-center">
                        <div class="mt-4 schedule-right pl-xl-4 ps-xl-4 mt-xl-0">

                            <div class="px-2 mt-4 mb-2 text-center mx-xl-3">
                                <a class="color-base fw-bold"
                                    href="{{ route('frontend.moreQus', $data->id) }}">{{ __('Ver opções') }}</a>
                            </div>

                        </div>
                    </div>
                @else
                    <div class="col-xl-6 align-self-center">
                        <div class="mt-4 schedule-right pl-xl-4 ps-xl-4 mt-xl-0">

                            <div class="px-2 mt-4 mb-2 text-center mx-xl-3">
                                <span><small>Nenhuma pergunta ainda</small></span>
                            </div>

                        </div>
                    </div>
                @endif
            </div>
        </div>
    @empty
        <p class="text-center text-danger">Nenhum jogo aberto encontrado</p>
    @endforelse

    <div class="flex-wrap py-4 justify-content-center pagination pagination-rounded-flat pagination-success">
        {{ $matches->links() }}
    </div>
</div>

@if (Auth::user())
    <div class="modal fade bet--model" id="sportModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content modal-content-cust">
                <div class="modal-header modal-title-cust">
                    <h5 class="modal-title" id="ModalLabel">Aposte Agora</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                {!! Form::open(['route' => 'user.prediction', 'method' => 'POST']) !!}
                <div class="text-center modal-body">

                    <div class="form-group">
                        <strong>Valor</strong>
                        <input name="invest_amount"
                            class="ctrl_counter-input form-input invest_amount_min subro_bet get_amount_for_ratio"
                            maxlength="10" type="text" value="" min="" max="">
                        <input type="hidden" name="betoption_id" id="betoption_id">
                        <input type="hidden" name="match_id" id="match_id">
                        <input type="hidden" name="betquestion_id" id="questionid">
                        <input class="ratio1" type="hidden" id="ratioOne">
                        <input class="ratio2" type="hidden" id="ratioTwo">
                        <input class="form-control input-lg subro_ratio" name="return_amount" type="hidden">
                    </div>
                    <hr>
                    <div class="form-group">
                        <span class="font-weight-bold text--white">MÍNIMO POR BILHETE
                            {{ $general->currency_symbol . ':' }}<span class="minamo text--white"></span> </span>
                    </div>
                    <small class="text--white">(SE VOCÊ GANHAR)</small>
                    <p class="modal-sport-win">
                        <span class="font-weight-bold text--white">VALOR DE RETORNO</span>
                        {{ $general->currency_symbol . ':' }}<span class="font-weight-bold text--white"><span
                                class="wining-rate"></span></span>
                    </p>

                </div>
                <div class="modal-footer modal-footer-cust justify-content-center">
                    <button type="submit" class="btn1 btn-base text--white">Apostar Agora</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@else
    <div class="modal fade bet--model" id="sportModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content modal-content-cust">
                <div class="modal-header modal-title-cust">
                    <h5 class="modal-title" id="exampleModalLabel">Aviso!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="bet-predict-content">
                        <h6 class="subtitle">Para realizar a sua aposta, é necessário acessar a sua conta.</h6>
                    </div>
                </div>
                <div class="modal-footer modal-footer-cust">
                    <a href="{{ route('login') }}" type="button" class="btn1 btn-base text--white">Jogar agora</a>
                    <a href="{{ route('register') }}" type="button" class="btn1 btn-base text--white">Cadastrar</a>
                </div>
            </div>
        </div>
    </div>
@endif
