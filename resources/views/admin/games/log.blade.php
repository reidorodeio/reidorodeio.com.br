@extends('admin.layouts.master')
@section('content')
<div class="card">
    <div class="card-body p-0">
        <table class="table s7__table">
            <thead>
            <tr>
                <th>{{('SL')}}</th>
                <th>{{__('User')}}</th>
                <th>{{__('TRX')}}</th>
                <th>{{__('Amount')}}</th>
                <th>{{__('Details')}}</th>
                <th>{{__('Win Date')}}</th>
                <th>{{__('Status')}}</th>
            </tr>
            </thead>
            <tbody>
                @forelse ($trx as $key => $data)
                <tr>
                    <td>{{$trx->firstItem() + $key}}</td>
                    <td><p><a href="{{route('user.view', $data->user->id)}}">{{$data->user->name}}</a> </p>
                        <p>{{$data->user->email}}</p></td>
                    <td>{{$data->trans_id}}</td>
                    <td>{{round($data->amount,2)}} {{$general->currency}}</td>
                    <td>{{$data->description}}</td>
                    <td>{{date('g:ia \o\n l jS F Y', strtotime($data->created_at))}}</td>
                    <td>
                        @if($data->status == 10)
                            <span class="badge bg-success">{{__('Win')}}</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td class="text-center" colspan="8">{{__('No Data Found!')}}</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="py-4 justify-content-center pagination flex-wrap pagination-rounded-flat pagination-success">
            {{$trx->links()}} 
        </div>
    </div>
</div>

@endsection

