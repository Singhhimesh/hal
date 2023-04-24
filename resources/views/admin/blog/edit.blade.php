@extends('layouts.master')
@section('title',__('Edit Post'))
@section('breadcum')
	<div class="breadcrumbbar">
      <h4 class="page-title">{{ __('Edit Post') }}</h4>
      <div class="breadcrumb-list">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/admin')}}" title="{{ __('Dashboard') }}">{{ __('Dashboard') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('Edit Post') }}</li>
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
          <h5 class="box-title">{{__('Edit Post')}}</h5>
        </div>
        <div class="card-body ml-2">
          {!! Form::model($blog, ['method' => 'PATCH', 'action' => ['BlogController@update', $blog->id], 'files' => true]) !!}
            <div class="row">
              <div class="col-md-4">
                <div class="form-group text-dark{{ $errors->has('title') ? ' has-error' : '' }}">
                  {!! Form::label('title', __('Post Title')) !!} <sup class="text-danger">*</sup>
                  {!! Form::text('title', old('name'), ['class' => 'form-control','autocomplete'=>'off','required']) !!}
                  <small class="text-danger">{{ $errors->first('title') }}</small>
                </div> 
              </div>
              <div class="col-md-4">
                <div class="form-group text-dark{{ $errors->has('image') ? ' has-error' : '' }} input-file-block">
                  {!! Form::label('image', __('Image')) !!} <sup class="text-danger">*</sup>
                  <br/> 
                  {!! Form::file('image', ['class' => 'input-file', 'id'=>'image']) !!}
                                
                  <small class="text-danger">{{ $errors->first('image') }}</small>
                </div> 
              </div>              
              <div class="col-md-4">    
                <div class="form-group text-dark {{ $errors->has('poster') ? ' has-error' : '' }} input-file-block">
                  {!! Form::label('poster', __('Poster')) !!} <sup class="text-danger">*</sup>
                  <br/> 
                  {!! Form::file('poster', ['class' => 'input-file', 'id'=>'poster']) !!}
                              
                  <small class="text-danger">{{ $errors->first('poster') }}</small>
                </div> 
              </div>
              <div class="col-md-12">
                <div class=" form-group text-dark{{ $errors->has('detail') ? ' has-error' : '' }}">
                      {!! Form::label('detail',__('Post Description')) !!} <sup class="text-danger">*</sup>
                      {!! Form::textarea('detail', old('detail'), ['id' => 'editor1','autocomplete'=>'off', 'class' => 'form-control ckeditor editor1', '']) !!}
                      <small class="text-danger">{{ $errors->first('detail') }}</small>
                </div>
              </div>
            </div>
              <div class="form-group{{ $errors->has('is_active') ? ' has-error' : '' }} switch-main-block">
                <div class="row">
                  <div class="col-md-1">
                    {!! Form::label('is_active', __('Status')) !!}
                    <span class="text-danger">*</span>
                  </div>
                  <div class="col-md-1">
                    <label class="switch">                
                      {!! Form::checkbox('is_active', null, null, ['class' => 'custom_toggle']) !!}
                      <span class="slider round"></span>
                    </label>
                  </div>
                <div class="col-xs-12">
                  <small class="text-danger">{{ $errors->first('is_active') }}</small>
                </div>
                <div class="col-md-4">              
                  <div class="form-group">
                    <button type="reset" class="btn btn-success-rgba" title="{{ __('Reset') }}">{{__('Reset')}}</button>
                    <button type="submit" class="btn btn-primary-rgba" title="{{ __('Update') }}"><i class="fa fa-check-circle"></i>
                      {{ __('Update') }}</button>
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
{{--   <script>
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
    $(document).ready(function(){
      var check = [];
    
    $('.one').each(function(index){

      if($(this).is(':checked')){
        check.push(1);
      }else{
        check.push(0);
      }

    });
   
    var flag = 1;

    if (jQuery.inArray(0, check) == -1) {
            flag = 1;

        } else {
            flag = 0;
        }

     if(flag == 0){
      $('.all').prop('checked',false);
     }else{
       $('.all').prop('checked',true);
     }

  });

    // if one checkbox is unchecked remove checked on all menu option

    $(".one").click(function(){
      if($(this).is(':checked'))
      {
       
        var checked = [];
       $('.one').each(function(){
        if($(this).is(':checked')){
          checked.push(1);
        }else{
          checked.push(0);
        }
       })
       
       var flag = 1;

    if (jQuery.inArray(0, checked) == -1) {
            flag = 1;

        } else {
            flag = 0;
        }

       if(flag == 0){
        $('.all').prop('checked',false);
       }else{
         $('.all').prop('checked',true);
       }
      }
      else{
        
        $('.all').prop('checked',false);
      }
    });

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