@extends('layouts.master')
@section('title',__('Signin And SignUp Customization'))
@section('breadcum')
	  <div class="breadcrumbbar">
      <h4 class="page-title">{{ __('SignIn & SignUp Settings') }}</h4>
      <div class="breadcrumb-list">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/admin')}}" title="{{ __('Dashboard') }}">{{ __('Dashboard') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('SignIn & SignUp Settings') }}</li>
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
      <div class="card m-b-50">
        <div class="card-header">
          <h5 class="box-title">{{__('SignIn & SignUp Settings')}}</h5>
        </div>
        <div class="card-body ml-2">
          {!! Form::model($auth_customize, ['method' => 'POST', 'action' => 'AuthCustomizeController@store', 'files' => true]) !!}
            <div class="row">
              <div class="col-md-6">
                <div class="form-group text-dark{{ $errors->has('detail') ? ' has-error' : '' }}">
                  {!! Form::label('detail',__('Page Details')) !!}  <sup class="text-danger">*</sup>
                  {!! Form::textarea('detail', null, ['id' => 'editor1', 'class' => 'form-control']) !!}
                  <small class="text-danger">{{ $errors->first('detail') }}</small>
                </div>
              </div>
              <div class="col-md-6">
                <div class="row">
                  <div class="col-md-6 form-group text-dark auth-custom-img">
                     {!! Form::label('image', __('Image')) !!}
                    @if ($auth_customize->image != null)
                      <img src="{{ asset('images/login/'.$auth_customize->image) }}" class="img-responsive" alt="Login">
                    @else
                      <div class="image-block"></div>                    
                    @endif
                  </div>
                </div>
                <div class="form-group text-dark{{ $errors->has('image') ? ' has-error' : '' }} input-file-block">
                  {!! Form::file('image', ['class' => 'input-file', 'id'=>'image']) !!}                 
                  <small class="text-danger">{{ $errors->first('image') }}</small>
                </div>
              </div>
            </div>
              
              
                <div class="form-group">
                  <button type="submit" class="btn btn-primary-rgba" title="{{ __('Save') }}"><i class="fa fa-check-circle"></i>
                    {{ __('Save') }}</button>
                </div>
                {!! Form::close() !!}
                <div class="clear-both"></div>
            

      </div>
    </div>
  </div>
</div>
</div>
@endsection 
@section('script')
<script>
  (function ($) {
    // jQuery.noConflict();
    $(window).on('load', function (){
      CKEDITOR.replace('editor1');
    });
    
  })(jQuery);
</script>
@endsection