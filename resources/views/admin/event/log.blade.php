@extends('admin.layouts.master')
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <div class="flex-wrap d-flex justify-content-between align-items-center">
                    <form class="s7__nav-search-form" method="GET">
                        <input type="text" name="search" placeholder="Search..." autocomplete="off">
                        <button type="submit"><i data-feather="search"></i></button>
                    </form>
                </div>
            </div>
        </div>
        <div class="p-0 card-body">
            <table class="table s7__table">
                <thead>
                    <tr>
                        <th>{{ __('SL') }}</th>
                        <th>{{ __('User') }}</th>
                        <th>{{ __('Match') }}</th>
                        <th>{{ __('Question') }}</th>
                        <th>{{ __('Option') }}</th>
                        <th>{{ __('Rate') }}</th>
                        <th>{{ __('Invest') }}</th>
                        <th>{{ __('Return') }}</th>
                        <th>{{ __('Status') }}</th>
                        <th>{{ __('Action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bets as $key => $data)
                        <tr>
                            <td>{{ $bets->firstItem() + $key }}</td>
                            <td>
                                <span class="font-weight-bold">{{ __($data->user->name) }}</span>
                                <br>
                                <span class="small">
                                    <a
                                        href="{{ route('user.view', $data->user->id) }}"><span>@</span>{{ $data->user->name }}</a>
                                </span>
                            </td>
                            <td>
                                @if ($data->match)
                                    {{ $data->match->team_1 ?? 'N/A' }} <label class="badge bg-info"> {{ __('VS') }}
                                    </label> {{ $data->match->team_2 ?? 'N/A' }}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>{{ __($data->ques->question) }}</td>
                            <td><span class="text-primary">{{ __($data->betoption->option_name) }}</span></td>
                            <td>{{ $data->ratio }}</td>
                            <td><span class="text-primary">{{ getAmount($data->invest_amount) }}
                                    {{ $general->currency }}</span></td>
                            <td><span class="text--primary">{{ getAmount($data->return_amount) }}
                                    {{ $general->currency }}</span></td>
                            <td>
                                @if ($data->status == 1)
                                    <span class="badge bg-success">{{ __('Won') }}</span>
                                @elseif ($data->status == 2)
                                    <span class="badge bg-secondary">{{ __('Refunded') }}</span>
                                @elseif ($data->status == 0)
                                    <span class="badge bg-warning">{{ __('Pending') }}</span>
                                @elseif ($data->status == -1)
                                    <span class="badge bg-danger">{{ __('Lost') }}</span>
                                @endif
                            </td>
                            <td>
                                <button type="button" class="btn s7__btn-danger btn-sm refund_prelist_bet"
                                    title="Refund Prediction Amount" data-bs-toggle="modal"
                                    data-bs-target="#refundPrelistMyModal" data-act="Refund" data-id="{{ $data->id }}">
                                    <i class="las la-times"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
            <div class="flex-wrap py-4 justify-content-center pagination pagination-rounded-flat pagination-success">
                {{ $bets->links() }}
            </div>
        </div>
    </div>

    <div class="modal fade" id="refundPrelistMyModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">{{ __('Refund Amount Confirmation') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                {!! Form::open(['route' => 'admin.refundBetInvestSingleUser', 'method' => 'POST']) !!}
                <div class="modal-body">
                    <div class="form-group">
                        <p>{{ __('Are You want sure refund Amount') }}?</p>
                        <input class="form-control refund_prelist_id" type="hidden" name="id">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn s7__btn-danger" data-bs-dismiss="modal">{{ __('No') }}</button>
                    <button type="submit" class="btn s7__btn-success">{{ __('Yes') }}</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
