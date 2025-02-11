@extends('user.layouts.master')
@section('content')
    <div class="leaderboard-area pd-bottom-150 bg-navy-2">
        <div class="container-sub">
            <div class="row">
                <div class="col-lg-12">
                    <div class="leaderboard-table table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nº</th>
                                    <th>Nome do Gateway</th>
                                    <th>Valor</th>
                                    <th>Taxa</th>
                                    <th>Valor</th>
                                    <th>Status</th>
                                    <th>ID da Transação</th>
                                    <th>Tempo</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($deposits as $key => $data)
                                    <tr>
                                        <td class="number">{{ $key + 1 }}</td>
                                        <td class="prediction-wrap">
                                            {{ $data->gateway->main_name ? $data->gateway->main_name : $data->gateway->name }}
                                        </td>
                                        <td class="prediction-amount">{{ round($data->amount, 8) }} {{ $general->currency }}
                                        </td>
                                        <td class="prediction-amount">{{ round($data->charge, 8) }} {{ $general->currency }}
                                        </td>
                                        <td class="prediction-amount">{{ round($data->usd_amo, 8) }} USD</td>
                                        @if (isset($data->deposit_request_table) && !is_null($data->deposit_request_table))
                                            @if ($data->deposit_request_table->accepted == 0)
                                                <td><span class="badge bg-warning">Pendente</span></td>
                                            @elseif($data->deposit_request_table->accepted == 1)
                                                <td><span class="badge bg-success">Completo</span></td>
                                            @else
                                                <td><span class="badge bg-Danger">Rejeitado</span></td>
                                            @endif
                                        @else
                                            <td><span
                                                    class="badge bg-success">{{ $data->status == 0 ? 'Incompleto' : 'Completo' }}</span>
                                            </td>
                                        @endif
                                        <td>{{ $data->trx }}</td>
                                        <td class="prediction-time">{{ $data->updated_at->format('d/m/y  h:i A') }}</td>
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
                        {{ $deposits->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
