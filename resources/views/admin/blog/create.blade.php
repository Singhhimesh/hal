@extends('layouts.master')
@section('title',__('Create Post'))
@section('breadcum')
	<div class="breadcrumbbar">
    <h4 class="page-title">{{ __('Create Post') }}</h4>
      <div class="breadcrumb-list">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/admin')}}" title="{{ __('Dashboard') }}">{{ __('Dashboard') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('Create Post') }}</li>
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
          <a href="{{url('admin/blog')}}" class="float-right btn btn-primary-rgba mr-2" title="{{ __('Back') }}"><i
            class="feather icon-arrow-left mr-2"></i>{{ __('Back') }}</a>
          <h5 class="box-title">{{__('Create Post')}}</h5>
        </div>
        <div class="card-body ml-2">
          {!! Form::open(['method' => 'POST', 'action' => 'BlogController@store', 'files' => true]) !!}
            <div class="row">
              <div class="col-md-4">
                <div class="form-group text-dark{{ $errors->has('title') ? ' has-error' : '' }}">
                  {!! Form::label('title', __('Post Title')) !!}<sup class="text-danger">*</sup>                                 
                  {!! Form::text('title', old('title'), ['class' => 'form-control', 'autofocus', 'autocomplete'=>'off','required', 'placeholder'=> __('Enter Post Title')]) !!}
                  <small class="text-danger">{{ $errors->first('title') }}</small>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group text-dark{{ $errors->has('image') ? ' has-error' : '' }} input-file-block">
                  {!! Form::label('image', __('Image')) !!}<span class="text-danger">*</span>
                  <br/> 
                  {!! Form::file('image', ['class' => 'input-file','required', 'id'=>'image']) !!}
                 <!--  <label for="image" class="btn btn-danger js-labelFile" data-toggle="tooltip" data-original-title="{{__('Blog Thumbnail')}}">
                    <i class="icon fa fa-check"></i>
                    <span class="js-fileName">{{__('Choose A File')}}</span>
                  </label>                  -->
                  <small class="text-danger">{{ $errors->first('image') }}</small>
                </div>
              </div>
              
              <div class="col-md-4">
                <div class="form-group text-dark{{ $errors->has('poster') ? ' has-error' : '' }} input-file-block">
                  {!! Form::label('poster', __('Poster')) !!} <span class="text-danger">*</span>
                  <br/> 
                  {!! Form::file('poster', ['class' => 'input-file','required', 'id'=>'poster']) !!}
                 <!--  <label for="poster" class="btn btn-danger js-labelFile" data-toggle="tooltip" data-original-title="{{__('Blog Poster')}}">
                    <i class="icon fa fa-check"></i>
                    <span class="js-fileName">{{__('Choose A File')}}</span>
                  </label> -->
                  <small class="text-danger">{{ $errors->first('poster') }}</small>
                </div>
              </div>
              <div class="col-md-12">
                <div class=" form-group text-dark{{ $errors->has('detail') ? ' has-error' : '' }}">
                  {!! Form::label('detail', __('Post Description')) !!} <sup class="text-danger">*</sup>
                  {!! Form::textarea('detail', old('detail'), ['id' => '','autocomplete'=>'off', 'class' => 'form-control ckeditor', 'required']) !!}
                  <small class="text-danger">{{ $errors->first('detail') }}</small>
                </div>  
              </div>
            </div>            

            <div class="form-group text-dark{{ $errors->has('is_active') ? ' has-error' : '' }} switch-main-block">
              <div class="row">
                <div class="col-md-1">
                  {!! Form::label('is_active', __('Status')) !!}
                  <small class="text-danger">*</small>
                </div>
                <div class="col-md-1">
                  <label class="switch">                
                    {!! Form::checkbox('is_active', 1, 1, ['class' => 'custom_toggle']) !!}
                    <span class="slider round"></span>
                  </label>
                </div>              
                <div class="col-xs-12">
                    <small class="text-danger">{{ $errors->first('is_active') }}</small>
                </div>
                            
                <div class="col-md-4">
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary-rgba" title="{{ __('Create') }}"><i class="fa fa-check-circle"></i>
                      {{ __('Create') }}</button>
                  </div>
                  {!! Form::close() !!}
                </div>
              </div>
            </div>
            <div class="clear-both"></div>           

      </div>
    </div>
  </div>
</div>
</div>
@endsection 
@section('script')
{{--  <script>
    $(document).ready(function(){

      $('.upload-image-main-block').hide();
      $('.for-custom-image input').click(function(){
        if($(this).prop("checked") == true){
          $('.upload-image-main-block').fadeIn();
        }
        else if($(this).prop("checked") == false){
          $('.upload-image-main-block').fadeOut();
        }
      });
    });
  </script> --}}
  <script type="text/javascript">
    // when click all menu  option all checkbox are checked

    $(".all").click(function(){
      if($(this).is(':checked')){
        $('.one').prop('checked',true);
      }
      else{
        $('.one').prop('checked',false);
      }
    })
  </script>
  
    
@endsection