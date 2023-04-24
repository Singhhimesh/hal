@extends('layouts.master')
@section('title',__('Create Tv Chanel'))
@section('breadcum')
	<div class="breadcrumbbar">
                <h4 class="page-title">{{ __('Create TV Chanel') }}</h4>
                <div class="breadcrumb-list">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{url('/admin')}}" title="{{ __('Dashboard') }}">{{ __('Dashboard') }}</a></li>
                      <li class="breadcrumb-item active" aria-current="page">{{ __('Create TV Chanel') }}</li>
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
          <a href="{{url('admin/livetv')}}" class="float-right btn btn-primary-rgba mr-2" title="{{ __('Close') }}"><i
            class="feather icon-arrow-left mr-2"></i>{{ __('Back') }}</a>
          <h5 class="box-title">{{__('Create TV Chanel')}}</h5>
        </div>
        <div class="card-body ml-2">
          {!! Form::open(['method' => 'POST', 'action' => 'LiveTvController@store', 'files' => true]) !!}
          <div class="bg-info-rgba p-4 mb-4 rounded">
            <div class="row">
              <div class="col-lg-4 col-md-4">
                <div id="movie_title" class="form-group text-dark{{ $errors->has('title') ? ' has-error' : '' }}">
                  {!! Form::label('title',__('TV Chanel Title')) !!}<sup class="text-danger">*</sup>
                  {!! Form::text('title', old('title'), ['class' => 'form-control', 'placeholder' => __('Enter Livetv Title')]) !!}
                  <small class="text-danger">{{ $errors->first('title') }}</small>
                </div>
              </div>
              <div class="col-lg-4 col-md-4">
                <div id="movie_slug" class="form-group text-dark{{ $errors->has('slug') ? ' has-error' : '' }}">
                  {!! Form::label('slug', __('Live Tv Slug')) !!}<sup class="text-danger">*</sup>
                  {!! Form::text('slug', old('slug'), ['class' => 'form-control', 'placeholder' => 'Please enter livetv slug']) !!}
                  <small class="text-danger">{{ $errors->first('slug') }}</small>
                </div>
                <input type="text" name="live" value="1" hidden="true">
              </div>
              <div class="col-lg-4 col-md-4">
                <div class="form-group text-dark{{ $errors->has('maturity_rating') ? ' has-error' : '' }}">
                  {!! Form::label('maturity_rating',__('Maturity Rating')) !!}<sup class="text-danger">*</sup>
                  {!! Form::select('maturity_rating', array('all age' => __('All Age'), '13+' =>'13+', '16+' => '16+', '18+'=>'18+'), null, ['class' => 'form-control select2']) !!}
                  <small class="text-danger">{{ $errors->first('maturity_rating') }}</small>
                </div>
              </div>
              <div class="col-lg-4 col-md-4">
                <input type="text" name="director_id" value="0" hidden="true">
                <input type="text" name="actor_id" value="0" hidden="true">
                <input type="text" name="duration" value="0" hidden="true">
                <div class="form-group text-dark{{ $errors->has('rating') ? ' has-error' : '' }}">
                  {!! Form::label('rating', __('Ratings')) !!}<sup class="text-danger">*</sup>
                  {!! Form::text('rating',  old('rating'), ['class' => 'form-control', ]) !!}
                  <small class="text-danger">{{ $errors->first('rating') }}</small>
                </div>
              </div>
              <div class="col-lg-4 col-md-4">
                <div class="form-group text-dark{{ $errors->has('a_language') ? ' has-error' : '' }}">
                  {!! Form::label('a_language', __('Audio Languages')) !!}<sup class="text-danger">*</sup>
                  <div class="input-group">
                    {!! Form::select('a_language[]', $a_lans, null, ['class' => 'form-control select2', 'multiple']) !!}
                    <a href="#" class="add-audio-lang" data-toggle="modal" data-target="#AddLangModal" class="input-group-addon"><i class="feather icon-plus"></i></a>
                  </div>
                  <small class="text-danger">{{ $errors->first('a_language') }}</small>
                </div>
              </div>
              <div class="col-lg-4 col-md-4">
                <div class="form-group text-dark{{ $errors->has('genre_id') ? ' has-error' : '' }}">
                  {!! Form::label('genre_id', __('Genre')) !!}<sup class="text-danger">*</sup>
                  <div class="input-group">
                    {!! Form::select('genre_id[]', $genre_ls, null, ['class' => 'form-control select2', 'multiple']) !!}
                    <a href="#" class="add-audio-lang" data-toggle="modal" data-target="#AddGenreModal" class="input-group-addon"><i class="feather icon-plus"></i></a>
                  </div>
                  <small class="text-danger">{{ $errors->first('genre_id') }}</small>
                </div>
              </div>
              <div class="col-lg-4 col-md-4">
                <div class="form-group text-dark">
                  <label for="">{{__('Meta Keyword')}}:<sup class="text-danger">*</sup> </label>
                  <input name="keyword" value="{{old('keyword')}}" type="text" class="form-control" data-role="tagsinput"/>
                </div>
              </div>
              <div class="col-lg-8 col-md-8">
                {{-- select to upload code start from here --}}
                <div class="form-group text-dark{{ $errors->has('selecturl') ? ' has-error' : '' }}">
                  {!! Form::label('selecturls',__('Add Video')) !!}<sup class="text-danger">*</sup>
                  {!! Form::select('selecturl', array('iframeurl' => __('IFrame URL'),
              
                  
                  'customurl' => __('Custom URL Youtube URL Vimeo URL')), null, ['class' => 'form-control select2','id'=>'selecturl']) !!}
                  <small class="text-danger">{{ $errors->first('selecturl') }}</small>
                </div>
                <div id="ifbox" style="display: none;" class="form-group text-dark">
                  <label for="iframeurl">{{__('IFrame URL')}}: </label> <a data-toggle="modal" data-target="#embdedexamp"></a>
                  <input  type="text" class="form-control" name="iframeurl" placeholder="">
                </div>
                <div class="modal fade" id="embdedexamp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h6 class="modal-title" id="myModalLabel">{{__('Embed URL Examples')}}: </h6>
                      </div>
                      <div class="modal-body">
                        <p style="font-size: 15px;"><b>{{__('YouTube')}}:</b> {{__('YouTube URL Link')}} </p>

                        <p style="font-size: 15px;"><b>{{__('GoogleDrive')}}:</b> {{__('Google Drive Link')}} </p>

                        <p style="font-size: 15px;"><b>{{__('Openload')}}:</b> {{__('Openload Link')}} </p>

                        <p style="font-size: 15px;"><b>{{__('Note')}}:</b> {{__('Do Not Include')}} &lt;iframe&gt; {{__('Tag Before URL')}}</p>
                      </div>

                    </div>
                  </div>
                </div>
                {{-- YouTube and vimeo URL --}}
                <div id="ready_url" style="display: none;" class="form-group text-dark{{ $errors->has('ready_url') ? ' has-error' : '' }}">
                <label id="ready_url_text"></label>
                {!! Form::text('ready_url', null, ['class' => 'form-control','id'=>'apiUrl']) !!}
                <small class="text-danger">{{ $errors->first('ready_url') }}</small>
                </div>
              </div>
              <div class="col-lg-6 col-md-6">
                <div class="form-group text-dark">
                  <label for="">{{__('Meta Description')}}: <sup class="text-danger">*</sup></label>
                  <textarea name="description" id="" cols="30" rows="5" class="form-control">{{old('description')}}</textarea>
                </div>
              </div>
              <div class="col-lg-6 col-md-6">
                <div class="form-group text-dark{{ $errors->has('detail') ? ' has-error' : '' }}">
                  {!! Form::label('detail', __('Description')) !!}
                  {!! Form::textarea('detail', old('detail'), ['class' => 'form-control materialize-textarea', 'rows' => '5']) !!}
                  <small class="text-danger">{{ $errors->first('detail') }}</small>
                </div>
              </div>
            </div>
          </div>
          <div class="bg-info-rgba p-4 mb-4 rounded">
            <div class="row">
              <div class="col-lg-4 col-md-4">
                <div class="form-group text-dark{{ $errors->has('featured') ? ' has-error' : '' }}">
                  {!! Form::label('featured', __('Featured')) !!}
                  <br>
                  <label class="switch">
                    {!! Form::checkbox('featured', 1, 0, ['class' => 'custom_toggle']) !!}
                    <span class="slider round"></span>
                  </label>
                  <div class="col-xs-12">
                    <small class="text-danger">{{ $errors->first('featured') }}</small>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-4">
                <div class="form-group text-dark{{ $errors->has('livetvicon') ? ' has-error' : '' }}">
                  {!! Form::label('livetvicon', __('Live Tv Icon Show')) !!}
                  <br>
                  <label class="switch">
                    {!! Form::checkbox('livetvicon', 1, 0, ['class' => 'custom_toggle']) !!}
                    <span class="slider round"></span>
                  </label>
                  <div class="col-xs-12">
                    <small class="text-danger">{{ $errors->first('livetvicon') }}</small>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-4">
                <div class="form-group text-dark{{ $errors->has('is_protect') ? ' has-error' : '' }}">
                  {!! Form::label('is_protect', __('Protected Video?')) !!}
                  <br>
                  <label class="switch">
                    <input type="checkbox" name="is_protect" class="custom_toggle" id="is_protect">
                    <span class="slider round"></span>
                  </label>
                  <div class="col-xs-12">
                    <small class="text-danger">{{ $errors->first('is_protect') }}</small>
                  </div>
                </div>
                <div class="search form-group text-dark{{ $errors->has('password') ? ' has-error' : '' }} is_protect" style="display: none;">
                  {!! Form::label('password', __('Protected Password For Video')) !!}
                  <input type="password" id="password" name="password"  class="form-control">
                  
                  <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                  <small class="text-danger">{{ $errors->first('password') }}</small>
                </div>
              </div>
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
<!-- Add Language Modal -->
<div id="AddLangModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">{{__('Add Language')}}</h5>
        <button type="button" class="close" data-dismiss="modal" title="{{ __('Close') }}">&times;</button>
      </div>
      {!! Form::open(['method' => 'POST', 'action' => 'AudioLanguageController@store']) !!}
      <div class="modal-body">
        <div class="form-group{{ $errors->has('language') ? ' has-error' : '' }}">
          {!! Form::label('language', __('Language')) !!}
          {!! Form::text('language', null, ['class' => 'form-control', 'required' => 'required']) !!}
          <small class="text-danger">{{ $errors->first('language') }}</small>
        </div>
      </div>
      <div class="modal-footer">
        <div class="btn-group pull-right">
          <button type="reset" class="btn btn-success-rgba" title="{{ __('Reset') }}">{{__('Reset')}}</button>
          <button type="submit" class="btn btn-primary-rgba" title="{{ __('Create') }}">{{__('Create')}}</button>
        </div>
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>
<!-- Add Genre Modal -->
<div id="AddGenreModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">{{__('Add Genre')}}</h5>
        <button type="button" class="close" data-dismiss="modal" title="{{ __('Close') }}">&times;</button>
      </div>
      {!! Form::open(['method' => 'POST', 'action' => 'GenreController@store']) !!}
      <div class="modal-body admin-form-block">
        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
          {!! Form::label('name',__('Name')) !!}
          {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
          <small class="text-danger">{{ $errors->first('name') }}</small>
        </div>
      </div>
      <div class="modal-footer">
        <div class="btn-group pull-right">
          <button type="reset" class="btn btn-success-rgba" title="{{ __('Reset') }}"> {{__('Reset')}}</button>
          <button type="submit" class="btn btn-primary-rgba" title="{{ __('Create') }}"> {{__('Create')}}</button>
        </div>
      </div>
      <div class="clear-both"></div>
      {!! Form::close() !!}
    </div>
  </div>
</div>
@endsection 
@section('script')
<script>
  $(document).ready(function() {
   var SITEURL = '{{URL::to('')}}';
 
 
   $.ajax({
     type: "GET",
     url: SITEURL + "/admin/movie/upload_video/converting",
     success: function (data) {
      console.log('Success:',data);
    },
    error: function (data) {
     console.log('Error:', data);
   }
 });
 
 
 });
 </script>
 <script>
   $(document).ready(function(){
    $('#ifbox').show();
    $('#selecturl').change(function(){  
      selecturl = document.getElementById("selecturl").value;
       if (selecturl == 'iframeurl') {
     $('#ifbox').show();
     $('#uploadvideo').hide();
     $('#audio_url').hide();
     $('#ready_url').hide();
     $('#subtitle_section').hide();
 
   }else if (selecturl == 'uploadvideo') {
    $('#uploadvideo').show();
    $('#ready_url').hide();
   
    $('#ifbox').hide();
    $('#subtitle_section').show();
 
  }else if(selecturl=='customurl'){
    $('#ifbox').hide();
    $('#uploadvideo').hide();
    $('#ready_url').show();
   
    $('#subtitle_section').show();
    $('#ready_url_text').text('Enter Custom URL or Vimeo or Youtube URL');
  }
  else if (selecturl == 'youtubeapi') {
    $('#uploadvideo').hide();
    $('#ready_url').show();
 
    $('#ifbox').hide();
    $('#subtitle_section').hide();
   
    $('#ready_url_text').text('Import From Youtube API');
 
  }else if(selecturl=='vimeoapi'){
    $('#ifbox').hide();
    $('#uploadvideo').hide();
    $('#ready_url').show();
 
    $('#subtitle_section').hide();
    $('#ready_url_text').text('Import From Vimeo API');
   
  }
 
 
 
 });
    var i= 1;
    $('#add').click(function(){  
      i++;  
      $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><input type="file" name="sub_t[]"/></td><td><input type="text" name="sub_lang[]" placeholder="Subtitle Language" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn-sm btn_remove">X</button></td></tr>');  
    });
 
    $(document).on('click', '.btn_remove', function(){  
      var button_id = $(this).attr("id");   
      $('#row'+button_id+'').remove();  
    });  
 
 
    $('form').on('submit', function(event){
     $('.loading-block').addClass('active');
   });
    $('#custom_url').hide();
 
    $('#TheCheckBox').on('switchChange.bootstrapSwitch', function (event, state) {
 
     if (state == true) {
 
      $('#ready_url').show();
      $('#custom_url').hide();
 
    } else if (state == false) {
 
     $('#ready_url').hide();
     $('#custom_url').show();
 
   };
 
 });
 
 
 
  
 
   $('input[name="is_protect"]').click(function(){
     if($(this).prop("checked") == true){
       $('.is_protect').fadeIn();
     }
     else if($(this).prop("checked") == false){
       $('.is_protect').fadeOut();
     }
   });
 });
 </script>
 
 
 <script type="text/javascript">
     $(".toggle-password").click(function() {
 
   $(this).toggleClass("fa-eye fa-eye-slash");
   var input = $($(this).attr("toggle"));
   if (input.attr("type") == "password") {
     input.attr("type", "text");
   } else {
     input.attr("type", "password");
   }
 });
 </script>  
@endsection