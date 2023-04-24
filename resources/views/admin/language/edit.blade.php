@extends('layouts.master')
@section('title',__('Edit Language') . ''." - $langs->name")
@section('breadcum')
	<div class="breadcrumbbar">
      <h4 class="page-title">{{ __('Edit Language') }}</h4>
      <div class="breadcrumb-list">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/admin')}}" title="{{ __('Dashboard') }}">{{ __('Dashboard') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('Edit Language') }}</li>
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
          <a href="{{url('admin/languages')}}" class="float-right btn btn-primary-rgba mr-2" title="{{ __('Back') }}"><i
              class="feather icon-arrow-left mr-2"></i>{{ __('Back') }}</a>
          <h5 class="box-title">{{__('Edit Language')}}</h5>
        </div>
        <div class="card-body ml-2">
          {!! Form::model($langs, ['method' => 'PATCH', 'action' => ['LanguageController@update', $langs->id]]) !!}
            <div class="row">
              <div class="col-md-3">
                <div class="form-group{{ $errors->has('local') ? ' has-error' : '' }}">
                  {!! Form::label('local', __('local')) !!}  <sup class="text-danger">*</sup>
                  <small class="badge badge-pill badge-secondary" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{ __('A locale is a set of parameters that defines the users language, region and any special variant preferences that the user wants to see in their user interface. Like: en')}}">
                    <i class="fa fa-info"></i>
                  </small>                 
                  {!! Form::text('local', null, ['class' => 'form-control', 'required' => 'required']) !!}
                  <small class="text-danger">{{ $errors->first('local') }}</small>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    {!! Form::label('name', __('Name')) !!}  <sup class="text-danger">*</sup>
                    <small class="badge badge-pill badge-secondary" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{ __('Enter language name. Like: English')}}">
                      <i class="fa fa-info"></i>
                    </small>                 
                    {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    <small class="text-danger">{{ $errors->first('name') }}</small>
                </div>
              </div>
              <div class="col-md-3">  
                <div class="form-group">
                  <label for="">{{__('Set Default')}}</label>
                  <br>
                  <label class="switch">
                         <input name="def" {{ $langs->def==1 ? "checked" : "" }} type="checkbox" class="custom_toggle" id="logo_chk">
                    </label>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="">{{__('RTL')}}</label>
                  <br>
                  <label class="switch">
                         <input name="rtl" {{ $langs->rtl==1 ? "checked" : "" }} type="checkbox" class="custom_toggle" id="logo_chk">
                    </label>
                </div>
              </div>
              <div class="col-md-3">              
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
  (function($){
    $.noConflict();    
  })(jQuery);    
</script>    
@endsection