@extends('user.layouts.master')
@section('content')
    <div class="leaderboard-area pd-bottom-60 bg-navy-2">
        <div class="container-sub">
            <div class="row">
                <div class="col-lg-12">
                    <div class="leaderboard-table table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nº</th>
                                    <th>Evento</th>
                                    <th>Pergunta</th>
                                    <th>Aposta</th>
                                    <th>Valor Apostado</th>
                                    <th>Valor Retornado</th>
                                    <th>Resultado</th>
                                    <th>Tempo</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($logs as $key => $data)
                                    <tr>
                                        <td class="number">{{ $key + 1 }}</td>
                                        <td>
                                            <div class="prediction-wrap">
                                                @if (!is_null($data->match->team_1_image))
                                                    <img class="bet-user-img"
                                                        src="{{ asset('public/images/match/' . $data->match->team_1_image) }}"
                                                        alt="img">
                                                @endif
                                                <span>{{ $data->match->team_1 }}</span> <span class="vs">VS</span>
                                                @if (!is_null($data->match->team_2_image))
                                                    <img class="bet-user-img"
                                                        src="{{ asset('public/images/match/' . $data->match->team_2_image) }}"
                                                        alt="img">
                                                @endif
                                                <span>{{ $data->match->team_2 }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            {{ $data->ques ? $data->ques->question : '-' }}
                                        </td>
                                        <td>
                                            {{ $data->betoption ? $data->betoption->option_name : '' }}
                                        </td>
                                        <td class="prediction-amount">{{ $data->invest_amount }} {{ $general->currency }}
                                        </td>
                                        <td class="prediction-amount">{{ $data->return_amount }} {{ $general->currency }}
                                            <br>
                                            @if ($data->status == 1)
                                                <span class="badge bg-danger">(Cobrança: {{ $data->charge }}
                                                    {{ $general->currency }})</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($data->status == 1)
                                                <label class="badge bg-success">Ganhou</label>
                                            @elseif($data->status == -1)
                                                <label class="badge bg-danger">Perdeu</label>
                                            @elseif($data->status == 2)
                                                <label class="badge bg-primary">Reembolsado</label>
                                            @else
                                                <label class="badge bg-warning">Processando</label>
                                            @endif
                                        </td>
                                        <td class="prediction-time">
                                            {{ date('d M, Y h:i A', strtotime($data->created_at)) }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="8">Nenhum dado encontrado!</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-12 text-center">
                    <div class="py-4 pagination flex-wrap pagination-rounded-flat pagination-success">
                        {{ $logs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
