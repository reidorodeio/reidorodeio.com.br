@extends('admin.layouts.master')
@section('content')
    <div class="card">
        <div class="card-header">
            @can('social-create')
            <h4 class="card-title text-end"><button type="button" data-bs-toggle="modal" data-bs-target="#socialAddModel" class="btn btn-primary btn-sm">
                    <i class="las la-plus"></i>
                {{__('Add New')}}
            </button></h4>
            @endcan
        </div>
        <div class="card-body p-0">
            <table class="table s7__table">
                <thead>
                <tr>
                    <th>{{__('SL')}}</th>
                    <th>{{__('Icon Name')}}</th>
                    <th>{{__('Link')}}</th>
                    <th>{{__('Action')}}</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($social as $key => $data)
                    <tr>
                        <td>{{$social->firstItem() + $key}}</td>
                        <td>{{$data->icon}}</td>
                        <td>{{$data->link}}</td>
                        <td>
                            @can('social-update')
                            <a href="#editSocialModal" data-route="{{route('social.update',$data->id)}}" data-bs-toggle="modal" data-icon_name="{{$data->icon}}" data-link="{{$data->link}}" 
                                title="Edit" class="btn btn-dark btn-sm editSocialBtn"><i class="las la-edit"></i></a>
                            @endcan
                            @can('social-destroy')
                            {!! Form::open(['method' => 'DELETE', 'route' => ['social.destroy', $data->id], 'style' => 'display:inline']) !!}
                            {{ Form::button('<i class="las la-trash"></i>', ['type' => 'submit', 'title' => 'Delete', 'class' => 'btn btn-danger btn-sm myDeletebtn'] )  }}
                            {!! Form::close() !!}
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="py-4 justify-content-center pagination flex-wrap pagination-rounded-flat pagination-success">
                {{$social->links()}} 
                </div>
        </div>
    </div>

<div class="modal fade" id="socialAddModel" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="ModalLabel">{{__('Add New Social')}}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        {!! Form::open(array('route' => 'social.store', 'method' => 'POST')) !!}
            <div class="modal-body">
                <div class="form-group">
                    <label><strong>{{__('Icon')}}</strong></label>
                    {!! Form::text('icon', null, array('placeholder' => 'Icon Name','class' => 'form-control')) !!}
                </div>
                <div class="form-group">
                    <label><strong>{{__('Link')}}</strong></label>
                    {!! Form::url('link', null, array('placeholder' => 'https://example.com','class' => 'form-control')) !!}
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">{{__('Submit')}}</button>
            </div>
        {!! Form::close() !!}
      </div>
    </div>
</div>

<div class="modal fade" id="editSocialModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="ModalLabel">{{__('Edit Social')}}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        {!! Form::open(['id' => 'editSocial', 'method' => 'PATCH']) !!}
            @csrf
            @method('put')
            <div class="modal-body">
                <div class="form-group">
                    <label><strong>{{__('Icon')}}</strong></label>
                    {!! Form::text('icon', null, array('id' => 'editSocialIcon', 'placeholder' => 'Icon Name','class' => 'form-control')) !!}
                </div>
                <div class="form-group">
                    <label><strong>{{__('Link')}}</strong></label>
                    {!! Form::url('link', null, array('id' => 'editSocialLink', 'https://example.com' => 'Title','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">{{__('Update')}}</button>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

@endsection