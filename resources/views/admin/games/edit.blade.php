@extends('admin.layouts.master')
@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="card-title text-end"><a href="{{route('games.index')}}" class="btn btn-sm btn-primary @if(Request::routeIs('games.index')) active @endif">
            <i class="las la-arrow-left"></i> {{__('All Games')}}
            </a>
        </h4>
    </div>
    <div class="card-body">
        {!! Form::model($games, ['method' => 'PATCH','route' => ['games.update', $games->id], 'class' => 'forms-sample', 'enctype' => 'multipart/form-data']) !!}
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label><strong>{{__('Image')}} <small>{{__('(PNG format is standard)')}}</small></strong></label>
                        {!! Form::file('image', array('id' => 'file-input', 'class' => 'form-control')) !!}
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <div id='img_contain'>
                                    <img id="image-preview" class="img-fluid" src="{{asset('public/images/games/'.$games->image)}}" alt="your image"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><strong>{{__('Name')}}</strong></label>
                                {!! Form::text('name', null, array('placeholder' => 'Game Name','class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label><strong>{{__('Minimum Amount')}}</strong></label>
                                {!! Form::text('min', null, array('placeholder' => '0','class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label><strong>{{__('Maximum Amount')}}</strong></label>
                                {!! Form::text('max', null, array('placeholder' => '0','class' => 'form-control')) !!}
                            </div>
                        </div>

                        @if ($games->id == 1)

                        <div class="col-md-3">
                            <div class="form-group">
                                <label><strong>{{__('Inside Whole Amount (X times)')}}</strong></label>
                                {!! Form::text('rate1', null, array('placeholder' => 'Inside Whole','class' => 'form-control')) !!}
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label><strong>{{__('Zero Amount (X times)')}}</strong></label>
                                {!! Form::text('rate2', null, array('placeholder' => 'zero','class' => 'form-control')) !!}
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label><strong>{{__('Outside Column Amount (X times)')}}</strong></label>
                                {!! Form::text('rate3', null, array('placeholder' => 'Outside Column','class' => 'form-control')) !!}
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label><strong>{{__('Outside Oerb Amount (X times)')}}</strong></label>
                                {!! Form::text('rate4', null, array('placeholder' => 'Outside Oerb','class' => 'form-control')) !!}
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label><strong>{{__('Outside Dozen Amount (X times)')}}</strong></label>
                                {!! Form::text('rate5', null, array('placeholder' => 'Outside Dozen','class' => 'form-control')) !!}
                            </div>
                        </div>

                        @endif

                        <div class="col-md-3">
                            <div class="form-group">
                                <label><strong>{{__('Status')}}</strong></label>
                                <select class="form-select" name="status">
                                    <option value="1" {{$games->status==1?'selected':''}}>{{__('Active')}}</option>
                                    <option value="0" {{$games->status==0?'selected':''}}>{{__('Inactive')}}</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label><strong>{{__('Rules')}}</strong></label>
                                {!! Form::textarea('rules', null, array('class' => 'form-control')) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary mt-3 me-2">@lang('Update')</button>
                </div>
            </div>
        {!! Form::close() !!}
    </div>
</div>

@endsection

