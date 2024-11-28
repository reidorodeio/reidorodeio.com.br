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
                                    <th>SL</th>
                                    <th>Nome do Gateway</th>
                                    <th>Quantidade</th>
                                    <th>Taxa</th>
                                    <th>Quantidade Atual do Método</th>
                                    <th>Status</th>
                                    <th>ID da Transação</th>
                                    <th>Tempo</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($withdraw as $key => $data)
                                    <tr>
                                        <td class="number">{{ $key + 1 }}</td>
                                        <td class="prediction-wrap">{{ $data->method_name }}</td>
                                        <td class="prediction-amount">{{ round($data->amount, 8) }} {{ $general->currency }}
                                        </td>
                                        <td class="prediction-amount">{{ round($data->charge, 8) }} {{ $general->currency }}
                                        </td>
                                        <td class="prediction-amount">{{ round($data->amount * $data->method_rate, 8) }}
                                            {{ $data->method_cur }}</td>
                                        @if ($data->status == 0)
                                            <td><span class="badge bg-warning">pendente</span></td>
                                        @elseif($data->status == 1)
                                            <td><span class="badge bg-success">completo</span></td>
                                        @else
                                            <td><span class="badge bg-danger">rejeitado</span></td>
                                        @endif
                                        <td>{{ $data->withdraw_id }}</td>
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
                        {{ $withdraw->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
