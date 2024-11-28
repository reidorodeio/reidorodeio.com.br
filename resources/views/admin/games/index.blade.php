@extends('admin.layouts.master')
@section('content')
<div class="card">
    <div class="card-body p-0">
        <table class="table s7__table">
            <thead>
            <tr>
                <th>{{('SL')}}</th>
                <th>{{__('Image')}}</th>
                <th>{{__('Name')}}</th>
                <th>{{__('Status')}}</th>
                <th>{{__('Action')}}</th>
            </tr>
            </thead>
            <tbody>
                @forelse ($games as $key => $data)
                <tr>
                    <td>{{$games->firstItem() + $key}}</td>
                    <td><img class="gateway_image_size" src="{{asset('public/images/games/'.$data->image)}}" alt="img"></td>
                    <td>{{$data->name}}</td>
                    <td>
                        @if ($data->status == 1)
                        <span class="badge bg-success">{{__('Active')}}</span>
                        @else
                        <span class="badge bg-warning">{{__('Disabled')}}</span>
                        @endif
                    </td>
                    <td>
                        @can('games-edit')
                        <a href="{{route('games.edit', $data->id)}}" class="btn btn-dark btn-rounded btn-sm"><i class="las la-edit"></i></a>
                        @endcan
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
            {{$games->links()}} 
        </div>
    </div>
</div>
@endsection

