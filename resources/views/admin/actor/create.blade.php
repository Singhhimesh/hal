@extends('layouts.master')
@section('title',__('Create Actor'))
@section('breadcum')
	<div class="breadcrumbbar">
      <h4 class="page-title">{{ __('Create Actor') }}</h4>
      <div class="breadcrumb-list">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/admin')}}" title="{{ __('Dashboard') }}">{{ __('Dashboard') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('Create Actor') }}</li>
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
          <a href="{{url('admin/actors')}}" class="float-right btn btn-primary-rgba mr-2" title="{{ __('Back') }}"><i
            class="feather icon-arrow-left mr-2"></i>{{ __('Back') }}</a>
          <h5 class="box-title">{{__('Create Actor')}}</h5>
        </div>
        <div class="card-body ml-2">
          {!! Form::open(['method' => 'POST', 'action' => 'ActorController@store', 'files' => true]) !!}
            <div class="row">
              <div class="col-md-3">
                <div class="form-group text-dark{{ $errors->has('name') ? ' has-error' : '' }}">
                  {!! Form::label('name',__('Actor Name')) !!} <sup class="text-danger">*</sup>
                  {!! Form::text('name', old('name'), ['class' => 'form-control', 'required' => 'required', 'placeholder' => __('Please enter Actor Name')]) !!}
                  <small class="text-danger">{{ $errors->first('name') }}</small>
                </div>
              </div>              
            <div class="col-md-3">
                <div class="form-group text-dark{{ $errors->has('place_of_birth') ? ' has-error' : '' }}">
                  {!! Form::label('place_of_birth', __('Place of Birth')) !!}
                  {!! Form::text('place_of_birth', old('place_of_birth'), ['class' => 'form-control','row'=>'3', 'placeholder' => __('Please enter place of birth')]) !!}
                  <small class="text-danger">{{ $errors->first('place_of_birth') }}</small>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group text-dark{{ $errors->has('DOB') ? ' has-error' : '' }}">
                  {!! Form::label('DOB', __('Date of Birth')) !!}
                  {!! Form::date('DOB', old('DOB'), ['class' => 'form-control','placeholder' => __('Please enter date of birth')]) !!}
                  <small class="text-danger">{{ $errors->first('DOB') }}</small>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group text-dark{{ $errors->has('image') ? ' has-error' : '' }} input-file-block">
                  {!! Form::label('image', __('Actor Image')) !!} <br/>
                  {!! Form::file('image', ['class' => 'input-file', 'id'=>'image']) !!}
                  <!-- <label for="image" class="btn btn-danger js-labelFile" data-toggle="tooltip" data-original-title="{{ __('Actor Image')}}">
                    <i class="icon fa fa-check"></i>
                    <span class="js-fileName">{{__('Choose A File')}}</span>
                  </label> -->
    
                  <small class="text-danger">{{ $errors->first('image') }}</small>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group text-dark{{ $errors->has('biography') ? ' has-error' : '' }}">
                  {!! Form::label('biography', __('Biography')) !!}
                  {!! Form::textarea('biography', old('biography'), ['class' => 'form-control','row'=>'1', 'placeholder' => __('Please Enter Actor Biography')]) !!}
                  <small class="text-danger">{{ $errors->first('biography') }}</small>
                </div>
              </div>     
              </div>        
              
                <div class="form-group">
                  <button type="reset" class="btn btn-success-rgba" title="{{ __('Reset') }}">{{__('Reset')}}</button>
                  <button type="submit" class="btn btn-primary-rgba" title="{{ __('Create') }}"><i class="fa fa-check-circle"></i>
                    {{ __('Create') }}</button>
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
@endsection