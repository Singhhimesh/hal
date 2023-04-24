@extends('layouts.master')
@section('title',__('Create Live Event'))
@section('breadcum')
	<div class="breadcrumbbar">
    <h4 class="page-title">{{ __('Create Live Event') }}</h4>
    <div class="breadcrumb-list">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('/admin')}}" title="{{ __('Dashboard') }}">{{ __('Dashboard') }}</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ __('Create Live Event') }}</li>
        </ol>
    </div>  
  </div>
@endsection
@section('maincontent')
<div class="contentbar">
  <div class="row">
    <div class="col-lg-12">
      <div class="card m-b-50">
        <div class="card-header">
          <a href="{{url('admin/liveevent')}}" class="float-right btn btn-primary-rgba mr-2" title="{{ __('Back') }}"><i
            class="feather icon-arrow-left mr-2"></i>{{ __('Back') }}</a>
          <h5 class="box-title">{{__('Create Live Event')}}</h5>
        </div>
        <div class="card-body ml-2">
          {!! Form::open(['method' => 'POST', 'action' => 'LiveEventController@store', 'files' => true]) !!}
          <div class="bg-info-rgba p-4 mb-4 rounded">
            <div class="row">
              <div class="col-lg-4 col-md-4">
                <div id="movie_title" class="form-group text-dark{{ $errors->has('title') ? ' has-error' : '' }}">
                  {!! Form::label('title',__('Event Title')) !!}<sup class="text-danger">*</sup>
                  {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => __('Enter Live Event Title')]) !!}
                  <small class="text-danger">{{ $errors->first('title') }}</small>
                </div>
              </div>
              <div class="col-lg-4 col-md-4">
                <div class="form-group text-dark{{ $errors->has('start_time') ? ' has-error' : '' }}">
                  {!! Form::label('start_time', __('Event Start Time')) !!}<sup class="text-danger">*</sup>
                  <input type="datetime-local" name="start_time" class="form-control" >
                  <small class="text-danger">{{ $errors->first('start_time') }}</small>
                </div>
              </div>
              <div class="col-lg-4 col-md-4">
                 <div class="form-group text-dark{{ $errors->has('end_time') ? ' has-error' : '' }}">
                  {!! Form::label('end_time', __('Event End Time')) !!}<sup class="text-danger">*</sup>
                 {{--  {!! Form::datetime('end_time',  null, ['class' => 'form-control', ]) !!} --}}
                  <input type="datetime-local" name="end_time" class="form-control" >
                  <small class="text-danger">{{ $errors->first('end_time') }}</small>
                </div>
              </div>
              <div class="col-lg-4 col-md-4">
                 <div class="form-group text-dark{{ $errors->has('organized_by') ? ' has-error' : '' }}">
                  {!! Form::label('organized_by', __('Event Organized By')) !!}<sup class="text-danger">*</sup>
                  {!! Form::text('organized_by',  null, ['class' => 'form-control', ]) !!}
                  <small class="text-danger">{{ $errors->first('organized_by') }}</small>
                </div>
              </div>
              <div class="col-lg-8 col-md-8">
                {{-- select to upload code start from here --}}
                <div class="form-group text-dark{{ $errors->has('selecturl') ? ' has-error' : '' }}">
                  {!! Form::label('selecturls', __('Add Video')) !!}<sup class="text-danger">*</sup>
                  {!! Form::select('selecturl', array('iframeurl' =>__('IFrameURL'), 'customurl' => __('CustomURLAndM3u8URL')), null, ['class' => 'form-control select2','id'=>'selecturl']) !!}
                  <small class="text-danger">{{ $errors->first('selecturl') }}</small>
                </div>
                <div id="ifbox" style="display: none;" class="form-group">
                  <label for="iframeurl">{{__('IFRAMEURL')}}: </label> <a data-toggle="modal" data-target="#embdedexamp"></a>
                  <input  type="text" class="form-control" name="iframeurl" placeholder="">
                </div>
                {{-- custom /m3u8 --}}
                <div id="ready_url" style="display: none;" class="form-group {{ $errors->has('ready_url') ? ' has-error' : '' }}">
                  <label id="customurl">{{__('Custom URL')}}</label><sup class="text-danger">*</sup>
                  {!! Form::text('ready_url', null, ['class' => 'form-control','id'=>'apiUrl']) !!}
                  <small class="text-danger">{{ $errors->first('ready_url') }}</small>
                </div>
              </div>
              <div class="col-lg-12 col-md-12">
                <div class="form-group text-dark{{ $errors->has('description') ? ' has-error' : '' }}">
                  {!! Form::label('description',__('Description')) !!}<sup class="text-danger">*</sup>
                  {!! Form::textarea('description', null, ['class' => 'form-control materialize-textarea', 'rows' => '5']) !!}
                  <small class="text-danger">{{ $errors->first('description') }}</small>
                </div>
              </div>
            </div>
          </div>
          <div class="bg-info-rgba p-4 mb-4 rounded">
            <div class="row">
              <div class="col-lg-8 col-md-8">
                <div class="upload-image-main-block">
                  {{-- <form method="post" enctype="multipart/form-data" id="mainform"> --}}
                    <div class="row">
                      <div class="col-lg-4 col-md-5 mb-4">
                        <label>{{__('Thumbnail')}}</label>
                        <div class="thumbnail-img-block">
                          <img src="{{ url('images/default-thumbnail.jpg')}}" id="thumbnail" class="img-fluid" alt="">
                        </div>
                        <div class="input-group">
                          <input id="img_upload_input" type="file" name="thumbnail" class="form-control" onchange="readURL(this);" />
                        </div>
                      </div>
                      <div class="col-lg-8 col-md-7 mb-4">
                        <label>{{__('Posters')}}</label>
                        <div class="poster-img-block">
                          <img src="{{ url('images/default-poster.jpg')}}" id="poster" class="img-fluid" alt="">
                        </div>
                        <div class="input-group">
                          <input id="img_upload_input_one" type="file" name="poster" class="form-control" onchange="readURL(this);" />
                        </div>
                      </div>
                      
                    </div>
                  {{-- </form> --}}
                </div>
              </div>
              <div class="col-lg-12 col-md-12 permissionTable">
                <div class="menu-block" id="kids_mode_hide">
                  <h6 class="menu-block-heading mb-3">{{__('Please Select Menu')}}<sup class="text-danger">*</sup></h6>
                  <small class="text-danger">{{ $errors->first('menu') }}</small>
                  @if (isset($menus) && count($menus) > 0)
                  <div class="row">
                    <div class="col-lg-3 col-md-6">
                      <div class="row">
                        <div class="col-lg-4 col-md-8 col-6">
                          {{__('All Menus')}}
                        </div>
                        <div class="col-lg-8 col-md-4 col-6 pad-0">
                          <div class="inline">
                            <input type="checkbox" class="grand_selectallm filled-in material-checkbox-input all" name="menu[]" value="100" id="checkbox{{100}}" >
                            <label for="checkbox{{100}}" class="material-checkbox"></label>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                    @foreach ($menus as $menu)
                    <div class="col-lg-3 col-md-6">
                      <div class="row">
                        <div class="col-lg-4 col-md-8 col-6">
                          {{$menu->name}}
                        </div>
                        <div class="col-lg-8 col-md-4 col-6 pad-0">
                          <div class="inline">
                            <input type="checkbox" class="permissioncheckbox filled-in material-checkbox-input one" name="menu[]" value="{{$menu->id}}" id="checkbox{{$menu->id}}" >
                            <label for="checkbox{{$menu->id}}" class="material-checkbox"></label>
                          </div>
                        </div>
                      </div>
                    </div>
                    @endforeach
                  </div>
                  @endif
                
                </div>
              </div>
              <div class="col-lg-4 col-md-4">
                <div class="form-group text-dark{{ $errors->has('Status') ? ' has-error' : '' }}">
                  <div class="row">
                    <div class="col-md-6">
                      {!! Form::label('status', __('Status')) !!}
                    </div>
                    <div class="col-md-5 pad-0">
                      <label class="switch">
                        {!! Form::checkbox('status', 1, 0, ['class' => 'custom_toggle']) !!}
                        <span class="slider round"></span>
                      </label>
                    </div>
                  </div>
                  <div class="col-xs-12">
                    <small class="text-danger">{{ $errors->first('status') }}</small>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="form-group ">
                <button type="reset" class="btn btn-success-rgba" title="{{ __('Reset') }}">{{__('Reset')}}</button>
                <button type="submit" class="btn btn-primary-rgba" title="{{ __('Create') }}"><i class="fa fa-check-circle"></i>
                  {{ __('Create') }}</button>
              </div>
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
  $(document).ready(function(){

    $('#ifbox').show();

    $('#selecturl').change(function(){  
       selecturl = document.getElementById("selecturl").value;
        if (selecturl == 'iframeurl') {
          $('#ifbox').show();
          $('#ready_url').hide();
        }else if(selecturl=='customurl'){
         $('#ifbox').hide();
         $('#ready_url').show();
         $('#ready_url_text').text('Enter Custom URL or M3U8 URL');
       }
    });
  });
   
</script>  
@endsection