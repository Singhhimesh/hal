@extends('layouts.master')
@section('title',__('Edit')." "." $a_lan->language")
@section('breadcum')
	<div class="breadcrumbbar">
    <h4 class="page-title">{{ __('Edit Audio Language') }}</h4>
    <div class="breadcrumb-list">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('/admin')}}" title="{{ __('Dashboard') }}">{{ __('Dashboard') }}</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ __('Edit Audio Language') }}</li>
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
          <a href="{{url('admin/audio_language')}}" class="float-right btn btn-primary-rgba mr-2" title="{{ __('Back') }}"><i
            class="feather icon-arrow-left mr-2"></i>{{ __('Back') }}</a>
          <h5 class="box-title">{{__('Edit Audio Language')}}</h5>
        </div>
        <div class="card-body ml-2">
          {!! Form::model($a_lan, ['method' => 'PATCH', 'action' => ['AudioLanguageController@update', $a_lan->id] ,'files'=> true]) !!}
            <div class="row">
              <div class="col-md-4">
                <div class="form-group {{ $errors->has('language') ? ' has-error' : '' }}">
                  <label for="language"> {{ __('Language') }}: <sup class="text-danger">*</sup>
                  </label>
                  <input value="{{ $a_lan->language }}" autofocus required name="name" type="text" class="form-control"
                    placeholder="{{ __('Please Enter Audio Language') }}" />
                  <small class="text-danger">{{ $errors->first('language') }}</small>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group{{ $errors->has('genre') ? ' has-error' : '' }} input-file-block">
                  {!! Form::label('image', __('Audio Language Image')) !!}<br/>
                  {!! Form::file('image', ['class' => 'input-file', 'id'=>'image']) !!}
                  <small class="text-danger">{{ $errors->first('image') }}</small>
                </div>

              </div>
              
              <div class="col-md-12">
                <div class="form-group">
                  <button type="reset" class="btn btn-success-rgba" title="{{ __('Reset') }}">{{__('Reset')}}</button>
                  <button type="submit" class="btn btn-primary-rgba" title="{{ __('Update') }}"><i class="fa fa-check-circle"></i>
                    {{ __('Update') }}</button>
                </div>
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
  $(function(){
    $('form').on('submit', function(event){
      $('.loading-block').addClass('active');
    });
    $(".toggle-password2").click(function() {
      $(this).toggleClass("fa-eye fa-eye-slash");
      var input = $($(this).attr("toggle"));
      if (input.attr("type") == "password") {
        input.attr("type", "text");
      } else {
        input.attr("type", "password");
      }
    });
  });

  
  
</script>


    
@endsection