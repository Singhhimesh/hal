@extends('layouts.master')
@section('title', __('Adsense'))
@section('breadcum')
	<div class="breadcrumbbar">
      <h4 class="page-title">{{ __('Google Adsense') }}</h4>
      <div class="breadcrumb-list">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/admin')}}" title="{{ __('Dashboard') }}">{{ __('Dashboard') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('Google Adsense') }}</li>
          </ol>
      </div>                  
    </div>
@endsection
@section('maincontent')
<div class="contentbar"> 
  <div class="row">
    <div class="col-md-12">

        <div class="card m-b-50">
            <div class="card-header">
                <h5 class="card-title">{{ __('Google Adsense') }}</h5>
            </div> 

            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                @if ($ad)
                  {!! Form::model($ad, ['method' => 'PUT', 'action' => ['AdsenseController@update', $ad->id], 'files' => true]) !!}

                    <div class="form-group{{ $errors->has('code') ? ' has-error' : '' }}">
                        {!! Form::label('code', __('Enter Your Adsense Script Code')) !!}
                        {!! Form::textarea('code', null, ['placeholder' => __('Enter Your Google Adsense Script Code'),'id' => 'textarea', 'class' => 'form-control']) !!}
                        <small class="text-danger">{{ $errors->first('code') }}</small>
                    </div>
                </div>
                <div class="col-md-3">
                      <!-- is Home -->
                        <div class="bootstrap-checkbox form-group{{ $errors->has('ishome') ? ' has-error' : '' }}">
                        <div class="row">
                          <div class="col-md-8">
                            <h5 class="bootstrap-switch-label">{{__('Visible On Home')}}</h5>
                          </div>
                          <div class="col-md-1 pad-0">
                            <div class="make-switch">
                              {!! Form::checkbox('ishome', 1, ($ad->ishome == '1' ? true : false), ['class' => 'custom_toggle']) !!}
                            </div>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <small class="text-danger">{{ $errors->first('ishome') }}</small>
                        </div>
                      </div>
                </div>
                <div class="col-md-3">
                      <!-- is wishlist -->
                        <div class="bootstrap-checkbox form-group{{ $errors->has('iswishlist') ? ' has-error' : '' }}">
                        <div class="row">
                          <div class="col-md-83">
                            <h5 class="bootstrap-switch-label">{{__('Visible On Wishlist')}}</h5>
                          </div>
                          <div class="col-md-1 pad-0">
                            <div class="make-switch">
                              {!! Form::checkbox('iswishlist', 1, ($ad->iswishlist == '1' ? true : false), ['class' => 'custom_toggle']) !!}
                            </div>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <small class="text-danger">{{ $errors->first('iswishlist') }}</small>
                        </div>
                      </div>
                </div>
                <!-- is View All -->
                <div class="col-md-3">                     
                        <div class="bootstrap-checkbox form-group{{ $errors->has('isviewall') ? ' has-error' : '' }}">
                        <div class="row">
                          <div class="col-md-8">
                            <h5 class="bootstrap-switch-label">{{__('Visible On All')}}</h5>
                          </div>
                          <div class="col-md-1 pad-0">
                            <div class="make-switch">
                              {!! Form::checkbox('isviewall', 1, ($ad->isviewall == '1' ? true : false), ['class' => 'custom_toggle']) !!}
                            </div>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <small class="text-danger">{{ $errors->first('isviewall') }}</small>
                        </div>
                      </div>
                </div>
                <div class="col-md-3">
                      <div class="bootstrap-checkbox form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                        <div class="row">
                          <div class="col-md-6">
                            <h5 class="bootstrap-switch-label">{{__('Status')}}</h5>
                          </div>
                          <div class="col-md-1 pad-0">
                            <div class="make-switch">
                              {!! Form::checkbox('status', 1, ($ad->status == '1' ? true : false), ['class' => 'custom_toggle']) !!}
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <small class="text-danger">{{ $errors->first('status') }}</small>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="btn-group pull-left">
                        <button type="submit" class="btn btn-primary-rgba" title="{{__('Save')}}"><i class="fa fa-check-circle"></i> {{__('Save')}}</button>
                      </div>
                    </div>
                    <div class="clear-both"></div>
                  {!! Form::close() !!}
                @endif
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endsection 
@section('script')
<script>
  $(function () {
    CKEDITOR.replace('editor1');
  });
</script>
@endsection
