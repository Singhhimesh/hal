@extends('layouts.master')
@section('title',__('Edit')." "." - $audio->title")
@section('breadcum')
	<div class="breadcrumbbar">
    <h4 class="page-title">{{ __('Edit Audio') }}</h4>
    <div class="breadcrumb-list">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('/admin')}}" title="{{ __('Dashboard') }}">{{ __('Dashboard') }}</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ __('Edit Audio') }}</li>
        </ol>
    </div> 
  </div>
@endsection
@section('maincontent')
<div class="contentbar">
  <div class="row">
    <div class="col-lg-12">
      <div class="card m-b-30">
        <div class="card-header">
          <a href="{{url('admin/audio')}}" class="float-right btn btn-primary-rgba mr-2" title="{{ __('Back') }}"><i
            class="feather icon-arrow-left mr-2"></i>{{ __('Back') }}</a>
          <h5 class="box-title">{{__('Edit Audio')}}</h5>
        </div>
        <div class="card-body ml-2">
          {!! Form::model($audio, ['method' => 'PATCH', 'action' => ['AudioController@update',$audio->id], 'files' => true]) !!}
          <div class="bg-info-rgba p-4 mb-4 rounded">
            <div class="row">
              <div class="col-lg-4 col-md-4">
                <div id="movie_title" class="form-group text-dark{{ $errors->has('title') ? ' has-error' : '' }}">
                  {!! Form::label('title', __('Audio Title')) !!} <sup class="text-danger">*</sup>
                  <input  type="text" class="form-control" name="title" value="{{ $audio->title }}">
                  <small class="text-danger">{{ $errors->first('title') }}</small>
                </div>
              </div>
              <div class="col-lg-2 col-md-2">
                <div class="form-group text-dark{{ $errors->has('maturity_rating') ? ' has-error' : '' }}">
                  {!! Form::label('maturity_rating', __('Maturity Rating')) !!} <sup class="text-danger">*</sup>
                  {!! Form::select('maturity_rating', array('all age' => __('All Age'), '13+' =>'13+', '16+' => '16+', '18+'=>'18+'), null, ['class' => 'form-control select2']) !!}
                  <small class="text-danger">{{ $errors->first('maturity_rating') }}</small>
                </div>
              </div>
              <div class="col-lg-2 col-md-2">
                <div class="form-group text-dark{{ $errors->has('rating') ? ' has-error' : '' }}">
                  {!! Form::label('rating', __('Ratings')) !!} <sup class="text-danger">*</sup>
                  {!! Form::text('rating',  old('rating'), ['class' => 'form-control', ]) !!}
                  <small class="text-danger">{{ $errors->first('rating') }}</small>
                </div>
              </div>
              <div class="col-lg-2 col-md-2">
                <div class="form-group text-dark{{ $errors->has('a_language') ? ' has-error' : '' }}">
                  {!! Form::label('a_language',  __('Audio Languages')) !!} <sup class="text-danger">*</sup>
                  <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Select Audio Language')}}"></i>
                  <div class="input-group">
                    <select name="a_language[]" id="a_language" class="form-control select2" multiple="multiple">
                      @if(isset($old_lans) && count($old_lans) > 0)
                      @foreach($old_lans as $old)
                      <option value="{{$old->id}}" selected="selected">{{$old->language}}</option> 
                      @endforeach
                      @endif
                      @if(isset($a_lans))
                      @foreach($a_lans as $rest)
                      <option value="{{$rest->id}}">{{$rest->language}}</option> 
                      @endforeach
                      @endif
                    </select>  
                    <a href="#" class="add-audio-lang" data-toggle="modal" data-target="#AddLangModal" class="input-group-addon"><i class="feather icon-plus"></i></a>
                  </div>
                  <small class="text-danger">{{ $errors->first('a_language') }}</small>
                </div>
              </div>
              <div class="col-lg-2 col-md-2">
                <div class="form-group text-dark{{ $errors->has('genre_id') ? ' has-error' : '' }}">
                  {!! Form::label('genre_id', __('Genre')) !!} <sup class="text-danger">*</sup>
                  <div class="input-group">
                    <select name="genre_id[]" id="genre_id" class="form-control select2" multiple="multiple">
                      @if(isset($old_genre) && count($old_genre) > 0)
                      @foreach($old_genre as $old)
                      <option value="{{$old->id}}" selected="selected">{{$old->name}}</option> 
                      @endforeach
                      @endif
                      @if(isset($genre_ls))
                      @foreach($genre_ls as $rest)
                      <option value="{{$rest->id}}">{{$rest->name}}</option> 
                      @endforeach
                      @endif
                    </select>  
                    <a href="#" class="add-audio-lang" data-toggle="modal" data-target="#AddGenreModal" class="input-group-addon"><i class="feather icon-plus"></i></a>
                  </div>
                  <small class="text-danger">{{ $errors->first('genre_id') }}</small>
                </div>
              </div>
              <div class="col-lg-4 col-md-4">
                <div class="form-group text-dark">
                  <label for="">{{__('Meta Keyword:')}} <sup class="text-danger">*</sup> </label>
                  <input name="keyword" value="{{old('keyword')}}" type="text" class="form-control" data-role="tagsinput"/>
                </div>
              </div>
              <div class="col-lg-3 col-md-3">
                <div class="form-group text-dark{{ $errors->has('selecturl') ? ' has-error' : '' }}">
                  {!! Form::label('selecturls', __('Add Audio')) !!} <sup class="text-danger">*</sup>
                  <select class="form-control select2" id="selecturl" name="selecturl">
                 
                    @if($audio['audiourl']!='')
                    <option value="audiourl" selected="">{{__('Audio URL')}}</option>
                    @else
                      <option value="audiourl">{{__('Audio URL')}}</option>
                    @endif
                    
                   
                     @if(isset($audio['upload_audio']) && $audio['upload_audio'] != '')
                     <option value="upload_audio" selected="">{{__('Upload Audio')}}</option>
                      @else
                       <option value="upload_audio">{{__('Upload Audio')}}</option>
                    @endif
                    
        
                   
                  </select>
                  <small class="text-danger">{{ $errors->first('selecturl') }}</small>
                </div>
                <div id="ifbox" style="{{$audio['audiourl']!='' ? '' : "display: none" }}" class="form-group text-dark">
                  <label for="audiourl">{{__('Audio URL:')}} </label> 
                  <input  type="text" class="form-control" name="audiourl" placeholder="" value="{{$audio['audiourl']}}">
                </div>
                {{-- upload Audio --}}
                <div style="{{$audio['upload_audio']!='' ? '' : "display: none" }}"class="form-group text-dark{{ $errors->has('upload_audio') ? ' has-error' : '' }} input-file-block" id="uploadaudio" >
                  {!! Form::label('upload_audio',__('Upload Audio')) !!} 
                  <div class="input-group">
                  
                    <input type="text" class="form-control" id="upload_audio" name="upload_audio" value="{{$audio['upload_audio']}}">
                    <span class="input-group-addon midia-toggle-upload_audio" data-input="upload_audio">{{__('Choose A Audio')}}</span>
                    
                  </div>
                  <small class="text-danger">{{ $errors->first('upload_audio') }}</small>
                </div>
              </div>
              <div class="col-lg-5 col-md-5">
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
              <div class="col-lg-2 col-md-2">
                <div class="form-group text-dark{{ $errors->has('featured') ? ' has-error' : '' }}">
                  {!! Form::label('featured',__('Featured')) !!}
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
              <div class="col-lg-3 col-md-3">
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
                  <input type="password" name="password" id="password" class="form-control" value="">
                  
                  <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                  <small class="text-danger">{{ $errors->first('password') }}</small>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 permissionTable">
                <div class="menu-block menu-block-input" >
                  <h6 class="menu-block-heading mb-3">{{__('Please Select Menu')}}</h6><sup class="text-danger">*</sup>
                  
                  @if (isset($menus) && count($menus) > 0)
                  <div class="row">
                    <div class="col-lg-6 col-md-6">
                      <div class="row">
                        <div class="col-lg-4 col-md-8 col-6">
                          {{__('All Menus')}}
                        </div>
                        <div class="col-lg-8 col-md-4 col-6 pad-0">
                          <div class="inline">
                            <input type="checkbox" class="grand_selectallm grand_selectallm filled-in material-checkbox-input all" name="menu[]" value="100" id="checkbox{{100}}" >
                            <label for="checkbox{{100}}" class="material-checkbox"></label>
                          </div>
                        </div>
                      </div>
                    </div>
                    @foreach ($menus as $menu)
                    <div class="col-lg-6 col-md-6">
                      <div class="row">
                        <div class="col-lg-4 col-md-8 col-6">
                          {{$menu->name}}
                        </div>
                        @php
                        $checked = null;
                        if (isset($menu->menu_data) && count($menu->menu_data) > 0) {
                          if ($menu->menu_data->where('audio_id', $audio->id)->where('menu_id', $menu->id)->first() != null) {
                            $checked = 1;
                          }
                        }
                        @endphp
                        <div class="col-lg-8 col-md-4 col-6 pad-0">
                          <div class="inline">
                            @if ($checked == 1)
                            <input type="checkbox" class="permissioncheckbox filled-in material-checkbox-input" name="menu[]" value="{{$menu->id}}" id="checkbox{{$menu->id}}" checked>
                            <label for="checkbox{{$menu->id}}" class="material-checkbox"></label>
                            @else
                            <input type="checkbox" class=" permissioncheckbox filled-in material-checkbox-input" name="menu[]" value="{{$menu->id}}" id="checkbox{{$menu->id}}">
                            <label for="checkbox{{$menu->id}}" class="material-checkbox"></label>
                            @endif
                          </div>
                        </div>
                      </div>
                    </div>
                    @endforeach
                  </div>
                  @endif
                </div>
              </div>
              <div class="col-lg-8 col-md-8">
                {{-- select to upload or add links code ends here --}}
                <div class="form-group text-dark" style="display: none">
                  {!! Form::label('', __('Choose Custom Thumbnail And Poster')) !!}
                  <br>
                  <label class="switch for-custom-image">
                    {!! Form::checkbox('', 1, 1, ['class' => 'custom_toggle']) !!}
                    <span class="slider round"></span>
                  </label>
                </div>
                <div class="upload-image-main-block">
                  {{-- <form method="post" enctype="multipart/form-data" id="mainform"> --}}
                    <div class="row">
                      <div class="col-lg-4 col-md-5 mb-4">
                        <label>{{__('Thumbnail')}}</label>
                        <div class="thumbnail-img-block">
                          @if(isset($audio->thumbnail) && $audio->thumbnail != NULL)
                          <img src="{{url('/images/audio/thumbnails/'.$audio->thumbnail)}}" class="img-fluid" alt="">
                        @else
                        <img src="{{ url('images/default-thumbnail.jpg')}}" id="thumbnail" class="img-fluid" alt="">
                        @endif
                        </div>
                        <div class="input-group">
                          <input id="img_upload_input" type="file" name="thumbnail" class="form-control" onchange="readURL(this);" />
                        </div>
                      </div>
                      <div class="col-lg-8 col-md-7 mb-4">
                        <label>{{__('Posters')}}</label>
                        <div class="poster-img-block">
                          @if(isset($audio->poster) && $audio->poster != NULL)
                            <img src="{{url('/images/audio/posters/'.$audio->poster)}}" class="img-fluid" alt="">
                          @else
                          <img src="{{ url('images/default-poster.jpg')}}" id="poster" class="img-fluid" alt="">
                          @endif
                        </div>
                        <div class="input-group">
                          <input id="img_upload_input_one" type="file" name="poster" class="form-control" onchange="readURL(this);" />
                        </div>
                      </div>
                      
                    </div>
                  {{-- </form> --}}
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="form-group ">
                <button type="submit" class="btn btn-primary-rgba" title="{{ __('Update') }}"><i class="fa fa-check-circle"></i>
                  {{ __('Update') }}</button>
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
        <button type="button" class="close" data-dismiss="modal">&times;</button>
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
          <button type="reset" class="btn btn-success-rgba">{{__('Reset')}}</button>
          <button type="submit" class="btn btn-primary-rgba">{{__('Create')}}</button>
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
        <button type="button" class="close" data-dismiss="modal">&times;</button>
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
          <button type="reset" class="btn btn-success-rgba"> {{__('Reset')}}</button>
          <button type="submit" class="btn btn-primary-rgba"> {{__('Create')}}</button>
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
  $(document).ready(function(){
   
    $('#selecturl').change(function(){  
     selecturl = document.getElementById("selecturl").value;
     if (selecturl == 'audiourl') {
    $('#ifbox').show();
    $('#uploadaudio').hide();
    


  }else if (selecturl == 'upload_audio') {
   $('#uploadaudio').show();
   $('#ifbox').hide();
   

 }

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
{{-- vimeo api code --}}


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
<script>
  $(".midia-toggle-upload_audio").midia({
		base_url: '{{url('')}}',
    dropzone : {
          acceptedFiles: '.mp3'
        },
    directory_name: 'audio'
	});
</script>  
@endsection