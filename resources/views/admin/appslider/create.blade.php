@extends('layouts.master')
@section('title',__('Create App Slider'))
@section('breadcum')
	<div class="breadcrumbbar">
      <h4 class="page-title">{{ __('Create Mobile App Slider') }}</h4>
      <div class="breadcrumb-list">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/admin')}}" title="{{ __('Dashboard') }}">{{ __('Dashboard') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('Create Mobile App Slider') }}</li>
          </ol>
      </div>  
  </div>
@endsection
@section('maincontent')
<div class="contentbar">
  <div class="row">
    @if ($errors->any())  
  <div class="alert alert-danger" role="alert">
  @foreach($errors->all() as $error)     
  <p>{{ $error}}<button type="button" class="close" data-dismiss="alert" aria-label="Close" title="{{ __('Close') }}">
  <span aria-hidden="true" style="color:red;">&times;</span></button></p>
      @endforeach  
  </div>
  @endif
    <div class="col-lg-12">
      <div class="card m-b-30">
        <div class="card-header">
          <a href="{{url('admin/appslider')}}" class="float-right btn btn-primary-rgba mr-2" title="{{ __('Back') }}"><i
            class="feather icon-arrow-left mr-2"></i>{{ __('Back') }}</a>
          <h5 class="box-title">{{__('Create Mobile App Slider')}}</h5>
        </div>
        <div class="card-body ml-2">
          {!! Form::open(['method' => 'POST', 'action' => 'AppSliderController@store', 'files' => true]) !!}
            <div class="row">
              <div class="col-md-4">
                <div class="bootstrap-checkbox slide-option-switch form-group text-dark{{ $errors->has('prime_main_slider') ? ' has-error' : '' }}">
                  <div class="row">
                    <div class="col-md-4">
                      <h5 class="bootstrap-switch-label">{{__('App Slide For')}}</h5>
                    </div>
                    <div class="col-md-5 pad-0">
                      <div class="make-switch">                       
                        {!! Form::checkbox('', 1, 1, ['class' => 'bootswitch', 'id' => 'TheCheckBox', "data-on-text"=>"Movies", "data-off-text"=>"Tv Series", "data-size"=>"small"]) !!}
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <small class="text-danger">{{ $errors->first('prime_main_slider') }}</small>
                </div>
              </div>
              <div class="col-md-4">              
                <div id="movie_id_block" class="form-group text-dark{{ $errors->has('movie_id') ? ' has-error' : '' }}">
                  {!! Form::label('movie_id', __('Select App Slide For Movie')) !!}
                  {!! Form::select('movie_id', $movie_list, null, ['class' => 'form-control select2', 'placeholder' => '']) !!}
                  <small class="text-danger">{{ $errors->first('movie_id') }}</small>
                </div>
                <div id="tv_series_id_block" class="form-group text-dark{{ $errors->has('tv_series_id') ? ' has-error' : '' }}">
                  {!! Form::label('tv_series_id', __('Select App Slide For TV Show')) !!}
                  {!! Form::select('tv_series_id', $tv_series_list, null, ['class' => 'form-control select2', 'placeholder' => '']) !!}
                  <small class="text-danger">{{ $errors->first('tv_series_id') }}</small>
                </div>
              </div>
              <div class="col-md-4">      
                <div class="form-group text-dark{{ $errors->has('slide_image') ? ' has-error' : '' }} input-file-block" id="slider_image" >
                  {!! Form::label('slide_image', __('Mobile App Slider Image')) !!} <sup class="text-danger">*</sup>
                  <small class="badge badge-pill badge-secondary" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{ __('Best Image size')}}">
                    <i class="fa fa-info"></i>
                  </small>


                  {!! Form::file('slide_image', ['class' => 'input-file', 'id'=>'slide_image']) !!}
                  <small class="text-danger">{{ $errors->first('slide_image') }}</small>
                </div>  
              </div>  
            </div>
              <div class="col-md-4">  
                <div class="form-group text-dark{{ $errors->has('active') ? ' has-error' : '' }}">
                  <div class="row">
                    <div class="col-md-6">
                      {!! Form::label('active', __('Status')) !!}
                    </div>
                     <div class="col-md-5 pad-0">
                      <label class="switch">
                        {!! Form::checkbox('active', 1, 1, ['class' => 'custom_toggle']) !!}
                        <span class="slider round"></span>
                      </label>
                    </div>
                  </div>
                  <div class="col-xs-12">
                    <small class="text-danger">{{ $errors->first('series') }}</small>
                  </div>
                </div>
              </div> 

              <div class="form-group">
                <button type="reset" class="btn btn-success-rgba" title="{{ __('Reset') }}">{{__('Reset')}}</button>
                <button type="submit" class="btn btn-primary-rgba" title="{{ __('Create') }}"><i class="fa fa-check-circle"></i> {{ __('Create') }}</button>
              </div>
              {!! Form::close() !!}
              <div class="clear-both"></div>    
    </div>
  </div>
</div>
</div>
@endsection 
@section('script')
<script>
  $(document).ready(function(){

    $('#tv_series_id_block').hide();

    $('#TheCheckBox').on('switchChange.bootstrapSwitch', function (event, state) {

        if (state == true) {

          $('#tv_series_id_block').hide();
          $('#movie_id_block').show();

        } else if (state == false) {

          $('#tv_series_id_block').show();
          $('#movie_id_block').hide(); 

        };

    });  
    
  });
</script> 
<script>
  (function($){
    $.noConflict();    
  })(jQuery);    
</script>  

@endsection