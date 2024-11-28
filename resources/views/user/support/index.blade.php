@extends('user.layouts.master')
@section('content')
    <div class="leaderboard-area pd-bottom-150 bg-navy-2">
        <div class="container-sub">
            <div class="row justify-content-end">
                <div class="col-lg-8 align-self-end">
                    <div class="section-title style-white text-lg-end mb-4">
                        <a href="{{ route('user.new.ticket') }}" class="btn btn-base mt-0">
                            <i class="fa fa-plus"></i> Novo Ticket
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="leaderboard-table table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nº</th>
                                    <th>Assunto</th>
                                    <th>Status</th>
                                    <th>Última Resposta</th>
                                    <th>Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($supports as $key => $data)
                                    <tr>
                                        <td class="number">{{ $key + 1 }}</td>
                                        <td class="prediction-wrap"><a
                                                href="{{ route('ticket.user.reply', $data->ticket) }}"
                                                class="font-weight-bold"> [Ticket#{{ $data->ticket }}] {{ $data->subject }}
                                            </a></td>
                                        <td class="prediction-amount">
                                            @if ($data->status == 0)
                                                <span class="badge bg-success">Aberto</span>
                                            @elseif($data->status == 1)
                                                <span class="badge bg-primary">Respondido</span>
                                            @elseif($data->status == 2)
                                                <span class="badge bg-warning">Resposta do Cliente</span>
                                            @elseif($data->status == 3)
                                                <span class="badge bg-dark">Fechado</span>
                                            @endif
                                        </td>
                                        <td class="prediction-time">
                                            {{ \Carbon\Carbon::parse($data->last_reply)->diffForHumans() }}</td>
                                        <td class="prediction-amount"><a
                                                href="{{ route('ticket.user.reply', $data->ticket) }}" type="button"
                                                class="btn btn-base btn-sm">
                                                Visualizar
                                            </a></td>
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
                        {{ $supports->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
