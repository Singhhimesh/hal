@extends('layouts.master')
@section('title',__('Edit')." "." - $movie->title")
@section('breadcum')
	<div class="breadcrumbbar">
    <h4 class="page-title">{{ __('Edit Movie') }}</h4>
    <div class="breadcrumb-list">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('/admin')}}" title="{{ __('Dashboard') }}">{{ __('Dashboard') }}</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ __('Edit Movie') }}</li>
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
      <p>{{ $error}}<button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true" style="color:red;">&times;</span></button>
      </p>
      @endforeach  
    </div>
    @endif
    {{-- vimeo API Modal Start --}}
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleLargeModalLabel">{{__("Search From Vimeo API")}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" title="{{__('Close')}}">
            <span aria-hidden="true">&times;</span>
            </button>
          </div>
          @if(is_null(env('VIMEO_ACCESS')))
            <p>{{__('Make Sure You Have Added Vimeo API KeyIn')}} <a href="{{url('admin/api-settings')}}">{{__('API Settings')}}</a></p>
          @endif

          <div class="modal-body">
            <div class="box box-danger">
              <div class="box-header">
                <div class="box-title">{{__('Instructions')}}</div>
              </div>
              <form action="" method="post" name="vimeo-yt-search" id="vimeo-yt-search">
                <input type="search" name="vimeo-search" id="vimeo-search" placeholder="{{__('Search')}}..." class="ui-autocomplete-input" autocomplete="off">
                <button class="icon" id="vimeo-searchBtn"></button>
              </form>
              <input type="hidden" id="vpageToken" value="">
              <div class="btn-group" role="group" aria-label="...">
                <button type="button" id="vpageTokenPrev" value="" class="btn btn-default">{{__('Prev')}}</button>
                <button type="button" id="vpageTokenNext" value="" class="btn btn-default">{{__('Next')}}</button>
              </div>
            </div>
            <div id="vimeo-watch-content" class="vimeo-watch-main-col vimeo-card vimeo-card-has-padding">
                <ul id="vimeo-watch-related" class="vimeo-video-list">
                </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    {{----vimeo API ModalEnd --}}

    {{-- youtube API Modal Start --}}
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleLargeModalLabel">{{__("Search From YouTube API")}}</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close" title="{{__('Close')}}">
                  <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              @if(is_null(env('YOUTUBE_API_KEY')))
            <p>{{__('Make Sure You Have Added YouTube APIKey In')}} <a href="{{url('admin/api-settings')}}">{{__('API Settings')}}</a></p>
            @endif

              <div class="modal-body">
                  <div class="box box-danger">
                      <div class="box-header">
                        <div class="box-title">{{__('Instructions')}}</div>
                      </div>
                      <form action="" method="post" name="hyv-yt-search" id="hyv-yt-search">
                        <input type="search" name="hyv-search" id="hyv-search" placeholder="{{__('Search')}}..." class="ui-autocomplete-input" autocomplete="off">
                        <button class="icon" id="hyv-searchBtn"></button>
                    </form>
                    <input type="hidden" id="vpageToken" value="">
                    <div>
                      <input type="hidden" id="pageToken" value="">
                      <div class="btn-group" role="group" aria-label="...">
                        <button type="button" id="pageTokenPrev" value="" class="btn btn-default">{{__('Prev')}}</button>
                        <button type="button" id="pageTokenNext" value="" class="btn btn-default">{{__('Next')}}</button>
                      </div>
                  </div>
                  <div id="hyv-watch-content" class="hyv-watch-main-col hyv-card hyv-card-has-padding">
                      <ul id="hyv-watch-related" class="hyv-video-list">
                      </ul>
                  </div>
                    </div>
              </div>
          </div>
      </div>
    </div>
    {{----youtube API ModalEnd --}}

    <!-- <div class="col-lg-7 col-xl-8"> -->
    <div class="col-lg-12">
      <div class="card m-b-50 movie-create-card">
        <div class="card-header">
          <a href="{{url('admin/movies')}}" class="float-right btn btn-primary-rgba mr-2" title="{{ __('Back') }}"><i
            class="feather icon-arrow-left mr-2"></i>{{ __('Back') }}</a>
          <h5 class="box-title">{{__('Edit Movie')}}</h5>
        </div>
        <div class="card-body ml-2">
          {!! Form::model($movie, ['method' => 'PATCH', 'action' => ['MovieController@update',$movie->id], 'files' => true]) !!}
          <div class="bg-info-rgba p-4 mb-4 rounded">
            <div class="row">
              <div class="col-lg-4 col-md-4">
                @if($movie->fetch_by == "byID")
                  <label id="txt1">{{__('Movie Created By TMDB ID')}} :</label>
                @else
                  <label id="txt2">{{__('Movie Created By Movie Name')}} :</label>
                @endif
                <small class="badge badge-pill badge-secondary" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{ __('Autofetch Movie by TMDB Name or ID.')}}">
                      <i class="fa fa-info"></i>
                  </small>
                <br>
                <label class="switch">
                  <input type="checkbox" {{ $movie->fetch_by == "title" ? "checked" : "" }} name="movie_by_id" class="custom_toggle" id="movi_id">
                  <span class="slider round"></span>
                </label>
              </div>
              <div class="col-lg-4 col-md-4">
                <div id="movie_title" class="form-group text-dark{{ $errors->has('title') ? ' has-error' : '' }}">
                  {!! Form::label('title', __('Movie Name')) !!}<sup class="text-danger">*</sup>
                  <small class="badge badge-pill badge-secondary" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{ __('Autofetch Movie by TMDB Name. Add movie name.')}}">
                      <i class="fa fa-info"></i>
                  </small>
                  <input {{ $movie->fetch_by == 'byID' ? "readonly=readonly" : "" }} id="mv_t" type="text" class="form-control" name="title" value="{{ $movie->title }}">
                  <small class="text-danger">{{ $errors->first('title') }}</small>
                </div>
                <div id="movie_id" style="display: none;" class="form-group text-dark{{ $errors->has('title') ? ' has-error' : '' }}">
                  {!! Form::label('title2',__('Movie By TMDB ID')) !!}<sup class="text-danger">*</sup>
                  <small class="badge badge-pill badge-secondary" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{ __('Autofetch Movie by TMDB ID. Add Movie TMDB ID.')}}">
                      <i class="fa fa-info"></i>
                  </small>
                  <input {{ $movie->fetch_by == 'title' ? "readonly=readonly" : "" }} type="text" class="form-control" name="title2" value="{{ $movie->tmdb_id }}" id="mv_i">
                  <small class="text-danger">{{ $errors->first('title') }}</small>
                </div>
              </div>
              <div class="col-lg-4 col-md-4">
                <div id="movie_slug" class="form-group text-dark{{ $errors->has('slug') ? ' has-error' : '' }}">
                  {!! Form::label('slug', __('Movie Slug')) !!}<sup class="text-danger">*</sup>
                  <small class="badge badge-pill badge-secondary" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{ __('A slug is a part of a URL that identifies a particular page or resource on a website. The slug is often used to generate a unique, search-engine-friendly URL for each movie. Add Slug without space and special charater.')}}">
                      <i class="fa fa-info"></i>
                  </small>
                  {!! Form::text('slug', null, ['class' => 'form-control', 'placeholder' => __('Enter Movie Slug')]) !!}
                  <small class="text-danger">{{ $errors->first('slug') }}</small>
                </div>
              </div>
              <div class="col-lg-4 col-md-4">
                @if($button->kids_mode==1)
                <div class="form-group text-dark{{ $errors->has('is_kids') ? ' has-error' : '' }}">
                  {!! Form::label('is_kids', __('Only for kids ?')) !!}
                  <br>
                  <label class="switch">
                    {!! Form::checkbox('is_kids', 1, $movie->is_kids, ['class' => 'custom_toggle','id'=>'kids_mode']) !!}
                    <span class="slider round"></span>
                  </label>
                  <div class="col-xs-12">
                    <small class="text-danger">{{ $errors->first('is_kids') }}</small>
                  </div>
                </div>
                @endif
              </div>
              <div class="col-lg-4 col-md-4">
                <div class="form-group text-dark{{ $errors->has('is_custom_label') ? ' has-error' : '' }}">
                  {!! Form::label('is_custom_label',__('Allow Custom Label ?')) !!}
                  <br>
                  <div class="row">
                    <div class="col-lg-3">
                      <label class="switch">
                        <input type="checkbox" name="is_custom_label" @if($movie->is_custom_label == '1') checked @endif   class="custom_toggle" id="is_custom_label">
                        <span class="slider round"></span>
                      </label>
                      <div class="col-xs-12">
                        <small class="text-danger">{{ $errors->first('is_custom_label') }}</small>
                      </div>
                    </div>
                    <div class="col-lg-9">
                      <div id="label_box" style="{{isset($movie['is_custom_label']) && $movie['is_custom_label'] == 1 ? ' ' : "display: none" }}" class="custom-label-input form-group{{ $errors->has('label_id') ? ' has-error' : '' }}">
                        {!! Form::label('label_id', __('Custom Label')) !!}
                        
                        <select name="label_id" id="" class="select2 form-control">
                          @foreach($labels as $label)
                          <option value="{{$label->id}}" {{isset($movie->label_id) && $label->id == $movie->label_id ? 'selected' : ''}}>{{$label->name}}</option>
                          @endforeach
                        </select>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#AddCustomLabel"><i class="fa fa-plus"></i></button>
                        <small class="text-danger">{{ $errors->first('label_id') }}</small>
                      </div>
                    </div> 
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="bg-info-rgba p-4 mb-4 rounded">
            <div class="row">
              <div class="col-lg-2 col-md-12">
                <div class="form-group text-dark{{ $errors->has('is_upcoming') ? ' has-error' : '' }}">
                  {!! Form::label('is_upcoming',__('Upcoming Movie')) !!}
                  <br>
                  <label class="switch">
                    <input type="checkbox" name="is_upcoming" @if($movie->is_upcoming == '1') checked @endif class="custom_toggle" id="is_upcoming">
                    <span class="slider round"></span>
                  </label>
                  <div class="col-xs-12">
                    <small class="text-danger">{{ $errors->first('is_upcoming') }}</small>
                  </div>
                </div>
              </div>
              <div class="col-lg-10 col-md-12">
                <div class="row">
                  <div class="col-lg-4">
                  
                    <div id="upcoming_box" style="{{isset($movie['is_upcoming']) && $movie['is_upcoming'] == 1 ? ' ' : "display: none" }}" class="form-group{{ $errors->has('upcoming_date') ? ' has-error' : '' }}">
                      {!! Form::label('upcoming_date', __('Upcoming Date')) !!}
                      <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Upcoming Date')}}"></i>
                      {!! Form::date('upcoming_date', null, ['class' => 'form-control']) !!}
                      <small class="text-danger">{{ $errors->first('upcoming_date') }}</small>
                    </div>
                    {{-- select to upload code start from here --}}
                    <div class="form-group text-dark{{ $errors->has('selecturl') ? ' has-error' : '' }} video_url" style="{{$movie['is_upcoming'] !=  1 ? ' ' : "display: none" }}">
                      {!! Form::label('selecturls', __('Video Type')) !!}<sup class="text-danger">*</sup>
                      <select class="form-control select2" id="selecturl" name="selecturl">
                    
                        @if(isset($video_link['iframeurl']) && $video_link['iframeurl'] != '')
                        <option value="iframeurl" selected="">{{__('IFrame URL')}}</option>
                        @else
                        <option value="iframeurl">{{__('IFrame URL')}}</option>
                        @endif       
                        <option value="youtubeapi">{{__('YouTube Api')}}</option>
                        <option value="vimeoapi">{{__('Vimeo Api')}}</option>
                        @if(isset($video_link['ready_url']) && $video_link['ready_url'] != '')
                        <option value="customurl" selected="">{{__('Custom URL YouTube URL Vimeo URL')}} </option>
                          @else
                          <option value="customurl">{{__('Custom URL YouTube URL Vimeo URL')}}</option>
                        @endif
                        @if(isset($video_link['upload_video']) && $video_link['upload_video'] != '')
                          <option value="uploadvideo" selected="">{{__('Upload Video')}}</option>
                          @else
                            <option value="uploadvideo">{{__('Upload Video')}}</option>
                        @endif
                    
                        @if(isset($video_link['url_360']) && $video_link['url_360'] || isset($video_link['url_480']) && $video_link['url_480'] || isset($video_link['url_720']) && $video_link['url_720'] || isset($video_link['url_1080']) && $video_link['url_1080'] !='')
                        <option selected=""  value="multiqcustom">{{__('Multi Quality Custom URL And URL Upload')}}</option>
                        @else
                        <option value="multiqcustom">{{__('Multi Quality Custom URL And URL Upload')}}</option>
                        @endif
                      
                      </select>
                      <small class="text-danger">{{ $errors->first('selecturl') }}</small>
                    </div>  
                  </div>
                  <div class="col-lg-8">
                    <div id="ifbox"  style="{{isset($video_link['iframeurl']) && $video_link['iframeurl'] != '' ? ' ' : "display: none" }}" class="form-group text-dark">
                      <label for="iframeurl">{{__('IFRAME URL')}}: </label> <a data-toggle="modal" data-target="#embdedexamp"></a>
                      <input  type="text" value="{{ isset($video_link['iframeurl']) && $video_link['iframeurl'] ? $video_link['iframeurl'] : NULL }}" class="form-control" name="iframeurl" placeholder="Iframe URL">
                    </div>

                    <div style="{{ isset($video_link['url_360']) && $video_link['url_360'] || isset($video_link['url_480']) && $video_link['url_480'] || isset($video_link['url_720']) && $video_link['url_720'] || isset($video_link['url_1080']) && $video_link['url_1080'] != '' ? "" : "display:none" }}" id="custom_url">
                  
                      <p style="color: red" class="inline info">{{__('Upload Videos Not Support')}}</p>
                      <br>
                      <p class="inline info">{{__('Open load Google Drive And Other URL Add Here')}}!</p>
                      <br>
                      <div class="row mb-3">
                        <div class="col-lg-8 col-md-6">
                          <div class="form-group text-dark{{ $errors->has('url_360') ? ' has-error' : '' }}">
                            {!! Form::label('url_360', __('Video Url For 360 Quality')) !!}
                            {!! Form::text('url_360', isset($video_link['url_360']) && $video_link['url_360'] ? $video_link['url_360'] : NULL, ['class' => 'form-control']) !!}
                            <small class="text-danger">{{ $errors->first('url_360') }}</small>
                          </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                          <div class="form-group text-dark">
                            {!! Form::label('upload_video', __('Upload Video In 360p')) !!}
                          
                            <div class="input-group">
                              <input type="text" class="form-control" id="upload_video_360" name="upload_video_360" >
                              <span class="input-group-addon midia-toggle-upload_video_360" data-input="upload_video_360">{{__('Choose A Video')}}</span>
                            </div>
                            <small class="text-danger">{{ $errors->first('upload_video_360') }}</small>
                          </div>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <div class="col-lg-8 col-md-6">
                          <div class="form-group text-dark{{ $errors->has('url_480') ? ' has-error' : '' }}">
                            {!! Form::label('url_480', __('Video Url For 480 Quality')) !!}
                            {!! Form::text('url_480', isset($video_link['url_480']) && $video_link['url_480'] ? $video_link['url_480'] : NULL, ['class' => 'form-control']) !!}
                            <small class="text-danger">{{ $errors->first('url_480') }}</small>
                          </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                          <div class="form-group text-dark">
                            {!! Form::label('upload_video', __('Upload Video In 480p')) !!} 
                            <div class="input-group">
                              <input type="text" class="form-control" id="upload_video_480" name="upload_video_480" >
                              <span class="input-group-addon midia-toggle-upload_video_480" data-input="upload_video_480">{{__('Choose A Video')}}</span>
                            </div>
                            <small class="text-danger">{{ $errors->first('upload_video_480') }}</small>
                          </div>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <div class="col-lg-8 col-md-6">
                          <div class="form-group text-dark{{ $errors->has('url_720') ? ' has-error' : '' }}">
                            {!! Form::label('url_720',__('Video Url For 720 Quality')) !!}
                            {!! Form::text('url_720', isset($video_link['url_720']) && $video_link['url_720'] ? $video_link['url_720'] : NULL, ['class' => 'form-control']) !!}
                            <small class="text-danger">{{ $errors->first('url_720') }}</small>
                          </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                          <div class="form-group text-dark">
                            {!! Form::label('upload_video',  __('Upload Video In 720p')) !!}
                            <div class="input-group">
                              <input type="text" class="form-control" id="upload_video_720" name="upload_video_720" >
                              <span class="input-group-addon midia-toggle-upload_video_720" data-input="upload_video_720">{{__('Choose A Video')}}</span>
                            </div>
                            <small class="text-danger">{{ $errors->first('upload_video_720') }}</small>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-lg-8 col-md-6">
                          <div class="form-group text-dark{{ $errors->has('url_1080') ? ' has-error' : '' }}">
                            {!! Form::label('url_1080', __('Video Url For 1080 Quality')) !!}
                            {!! Form::text('url_1080', isset($video_link['url_1080']) && $video_link['url_1080'] ? $video_link['url_1080'] : NULL, ['class' => 'form-control']) !!}
                            <small class="text-danger">{{ $errors->first('url_1080') }}</small>
                          </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                          <div class="form-group text-dark">
                            {!! Form::label('upload_video', __('Upload Video In 1080p')) !!}
                            <div class="input-group">
                              <input type="text" class="form-control" id="upload_video_1080" name="upload_video_1080" >
                              <span class="input-group-addon midia-toggle-upload_video_1080" data-input="upload_video_1080">{{__('Choose A Video')}}</span>
                            </div>
                            <small class="text-danger">{{ $errors->first('upload_video') }}</small>
                          </div> 
                        </div>
                      </div>
                    </div>

                    <!-- Modal -->
                    <div  class="modal fade" id="embdedexamp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h6 class="modal-title" id="myModalLabel">{{__('Embedded URL Examples')}}: </h6>
                          </div>
                          <div class="modal-body">
                            <p style="font-size: 15px;"><b>{{__('YouTube')}}:</b> {{__('YouTube URL Link')}} </p>

                            <p style="font-size: 15px;"><b>{{__('Google Drive')}}:</b> {{__('Google Drive Link')}}</p>

                            <p style="font-size: 15px;"><b>{{__('Openload')}}:</b> {{__('Openload Link')}} </p>

                            <p style="font-size: 15px;"><b>{{__('Note')}}:</b> {{__('Do Not Include')}} &lt;iframe&gt; {{__('Tag Before URL')}}</p>
                          </div>
                          
                        </div>
                      </div>
                    </div>

                    {{-- YouTube and Vimeo url --}}
                    <div id="ready_url" style="{{isset($video_link['ready_url']) && $video_link['ready_url'] != '' ? '' : "display: none" }}" class="form-group text-dark{{ $errors->has('ready_url') ? ' has-error' : '' }}">
                      <label id="ready_url_text">{{__('Enter Custom URL or Vimeo or YouTube URL')}}</label>
                      <p class="inline info"> {{__('Please Enter Your Video Url')}}</p> <button type="button" onclick="encript()" id="encryptlink" class="btn-primary-rgba">{{__('Encrypt Link')}}</button>
                      {!! Form::text('ready_url',isset($video_link['ready_url']) && $video_link['ready_url'] ? $video_link['ready_url'] : NULL , ['class' => 'form-control','id'=>'apiUrl']) !!}
                      <small class="text-danger">{{ $errors->first('ready_url') }}</small>
                    </div>
                    {{-- upload video --}}
                    <div id="uploadvideo" style="{{isset($video_link['upload_video']) && $video_link['upload_video']!='' ? '' : "display: none" }}" class="form-group text-dark{{ $errors->has('upload_video') ? ' has-error' : '' }} input-file-block">
                      <label>File Name: <span>{{isset($video_link['upload_video']) && $video_link['upload_video'] != NULL ? $video_link['upload_video'] : '' }}</span></label>
                      <br>
                        {!! Form::label('upload_video', 'Upload Video') !!} - <p class="inline info">Choose A Video</p>
                      
                      <div class="input-group">
                      
                        <input type="text" class="form-control" id="upload_video" name="upload_video" >
                        <span class="input-group-addon midia-toggle-upload_video" data-input="upload_video">{{__('Choose A Video')}}</span>
                        
                      </div>
                      <small class="text-danger">{{ $errors->first('upload_video') }}</small>
                      @php
                      $config=App\Config::first();
                      $aws=$config->aws;
                      @endphp
                      @if($aws==1)
                      <label for="">Upload To AWS </label>
                      <br>
                      <label class="switch">
                        <input type="checkbox" name="upload_aws" @if(isset($movie->aws) && $movie->aws == 1) checked @endif class="custom_toggle" id="upload_aws">
                        <span class="slider round"></span>
                    
                      </label>
                      @else
                        <small>if you haven't added AWS key. Set in <a href="{{url('admin/api-settings')}}"> API setting</a> To Upload Videos to AWS</small>
                      @endif
                    </div>
                    {{-- select to upload or add links code ends here --}}
                  </div>
                </div> 
              </div>
            </div>
          </div>  
          <div class="bg-info-rgba p-4 mb-4 rounded">
            <div class="row">
              <div class="col-lg-3 col-md-6">
                <div class="form-group text-dark{{ $errors->has('a_language') ? ' has-error' : '' }}">
                  {!! Form::label('a_language',  __('Audio Languages')) !!}<sup class="text-danger">*</sup>
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
              <div class="col-lg-2 col-md-6">
                {{-- Allage Maturity --}}
                <div class="form-group text-dark{{ $errors->has('maturity_rating') ? ' has-error' : '' }}">
                  {!! Form::label('maturity_rating',__('Maturity Rating')) !!}<sup class="text-danger">*</sup>
                  {!! Form::select('maturity_rating', array('all age' =>__('AllAge'), '18+' =>'18+', '16+' => '16+', '13+'=>'13+','10+' =>'10+', '8+' => '8+', '5+'=>'5+','2+'=>'2+'), null, ['class' => 'form-control select2']) !!}
                  <small class="text-danger">{{ $errors->first('maturity_rating') }}</small>
                </div>
              </div>
              <div class="col-lg-3 col-md-6">
                <!-- country start -->
                  <div class="form-group text-dark">
                    <label>{{ __('Country') }}: </label>
                    <select class="form-control select2" name="country[]" multiple="multiple">
                      @foreach($countries as $country)
                      <option {{in_array($country->name, $movie->country ?: []) ? "selected": ""}}  value="{{ $country->name }}">{{ $country->name }}</option>
                      @endforeach
                    </select>
                    <small class="text-danger"><i class="fa fa-question-circle"></i> ({{ __('Select those countries where you want to block Movies')}} )</small>
                  </div>
                <!-- country end -->
              </div>
              <div class="col-lg-4 col-md-6">
                <div class="form-group text-dark">
                  <label for="">{{__('Meta Keyword')}}: </label><sup class="text-danger">*</sup>
                  <input name="keyword" type="text" class="form-control" value="{{ $movie->keyword }}" data-role="tagsinput"/>
                </div>
              </div>
              <div class="col-lg-12 col-md-12">
                <div class="form-group text-dark">
                  <label for="">{{__('Meta Description')}}: </label><sup class="text-danger">*</sup>
                  <textarea name="description" id="" cols="30" rows="02" class="form-control">{{ $movie->description }}</textarea>
                </div>
              </div>
            </div>
          </div>
          <div class="bg-info-rgba p-4 mb-4 rounded">
            <div class="row">
              <div class="col-lg-4 col-md-4">
                <div class="form-group text-dark{{ $errors->has('series') ? ' has-error' : '' }}">
                  {!! Form::label('series', __('Series')) !!}
                  <small class="badge badge-pill badge-secondary" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{ __('For conect 2nd, 3rd etc part for movies.')}}">
                            <i class="fa fa-info"></i>
                          </small>
                  <br>
                  <label class="switch">
                    {!! Form::checkbox('series', 1, $movie->series, ['class' => 'seriescheck custom_toggle']) !!}

                    <span class="slider round"></span>
                  </label>
                  <div class="col-xs-12">
                    <small class="text-danger">{{ $errors->first('series') }}</small>
                  </div>
                </div>
                <small class="text-danger">{{ $errors->first('movie_id') }}</small>
                <div class="form-group text-dark{{ $errors->has('movie_id') ? ' has-error' : '' }} movie_id">
                  {!! Form::label('movie_id', __('Select Movie of Series')) !!}
                  {!! Form::select('movie_id', [(isset($this_movie_series_detail) ? $this_movie_series_detail[0]->id : '')=>(isset($this_movie_series_detail) ? $this_movie_series_detail[0]->title : '')]+$movie_list_exc_series, null, ['class' => 'form-control select2 mseries']) !!}
                
                </div>
              </div>             

              <div class="col-lg-4 col-md-4">
                <div class="form-group text-dark{{ $errors->has('featured') ? ' has-error' : '' }}">
                  {!! Form::label('featured', __('Featured')) !!}
                  <small class="badge badge-pill badge-secondary" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{ __('Enable for make featured movie.')}}">
                            <i class="fa fa-info"></i>
                          </small>
                  <br>
                  <label class="switch">                
                    {!! Form::checkbox('featured', 1, $movie->featured, ['class' => 'custom_toggle']) !!}
                    <span class="slider round"></span>
                  </label>
                  <div class="col-xs-12">
                    <small class="text-danger">{{ $errors->first('featured') }}</small>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-4">
                <div class="pad_plus_border" id="subtitle_section">
                  <div class="form-group text-dark{{ $errors->has('subtitle') ? ' has-error' : '' }}">
                    {!! Form::label('subtitle', __('Subtitle')) !!}
                    <br>
                    <label class="switch">
                      <input {{ $movie->subtitle == 1 ? "checked" : "" }} type="checkbox" class ="custom_toggle"id="subtitle_check" name="subtitle">
                      <span class="slider round"></span>
                    </label>
                    <div class="col-xs-12">
                      <small class="text-danger">{{ $errors->first('subtitle') }}</small>
                    </div>
                  </div>
                
                  <div>
                    <div class="subtitle-box" style="{{ $movie->subtitle == 1 ? "" : "display: none" }}">
                      <label>{{__('Subtitle')}}:</label>
                      <div class="table-responsive">
                        <table class="table table-bordered" id="dynamic_field">  
                          <tr> 
                            <td>
                              <div class="form-group text-dark{{ $errors->has('sub_t') ? ' has-error' : '' }} input-file-block">
                                <input class="subtitle-input" type="file" name="sub_t[]"/>

                                <small class="text-danger">{{ $errors->first('sub_t') }}</small>
                              </div>
                            </td>

                            <td>
                              <input type="text" name="sub_lang[]" placeholder="{{__('Subtitle Language')}}" class="form-control name_list" />
                            </td>  
                            <td><button type="button" name="add" id="add" class="btn btn-xs btn-success">
                                <i class="fa fa-plus"></i>
                              </button>
                            </td>  
                          </tr>  
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-4">
                <div class="form-group text-dark{{ $errors->has('is_protect') ? ' has-error' : '' }}">
                  {!! Form::label('is_protect', __('Protected Video?')) !!}
                  <br>
                  <label class="switch">
                    <input type="checkbox" name="is_protect" {{ $movie->is_protect == 1 ? 'checked' : '' }} class="custom_toggle" id="is_protect">
                    <span class="slider round"></span>
                  </label>
                  <div class="col-xs-12">
                    <small class="text-danger">{{ $errors->first('is_protect') }}</small>
                  </div>
                </div>
                <div class="search form-group text-dark{{ $errors->has('password') ? ' has-error' : '' }} is_protect" style="{{ $movie->is_protect == 1 ? '' : 'display:none' }}" >
                  {!! Form::label('password', __('Protected Password ForVideo')) !!}        
                  <input type="password" id="password" name="password"  class="form-control">
                  <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>                  
                </div>
                <small class="text-danger">{{ $errors->first('password') }}</small>
              </div>
              <div class="col-lg-8 col-md-8">
                <div class="form-group text-dark">
                  {!! Form::label('', __('Choose Custom Thumbnail And Poster')) !!}
                  <br>
                  <label class="switch for-custom-image">
                    {!! Form::checkbox('', 1, 0, ['class' => 'custom_toggle']) !!}
                    <span class="slider round"></span>
                  </label>
                </div>
                <div class="upload-image-main-block" id="custom_thumb_hide" >
                  {{-- <form method="post" enctype="multipart/form-data" id="mainform"> --}}
                    <div class="row">
                      <div class="col-lg-4 col-md-5 mb-4">
                        <label>{{__('Thumbnail')}}</label>
                        <div class="thumbnail-img-block">
                          @if(isset($movie->thumbnail) && $movie->thumbnail != NULL)
                          <img src="{{url('/images/movies/thumbnails/'.$movie->thumbnail)}}" class="img-fluid" alt="">
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
                          @if(isset($movie->poster) && $movie->poster != NULL)
                            <img src="{{url('/images/movies/posters/'.$movie->poster)}}" class="img-fluid" alt="">
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
              <div class="col-lg-12 col-md-12 permissionTable">
                <div class="menu-block menu-block-input" id="kids_mode_hide"  style="{{$movie->is_kids == 1 ? 'display:none' : ''}}" >
                  <h6 class="menu-block-heading mb-3">{{__('Select Menu')}}<sup class="text-danger">*</sup>
                  <small class="badge badge-pill badge-secondary" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{ __('Select menu for show movie in particular menu.')}}">
                            <i class="fa fa-info"></i>
                    </small>
                    </h6>
                  
                  @if (isset($menus) && count($menus) > 0)
                  <div class="row">
                    <div class="col-lg-3 col-md-6">
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
                    <div class="col-lg-3 col-md-6">
                      <div class="row">
                        <div class="col-lg-4 col-md-8 col-6">
                          {{$menu->name}}
                        </div>
                        @php
                        $checked = null;
                        if (isset($menu->menu_data) && count($menu->menu_data) > 0) {
                          if ($menu->menu_data->where('movie_id', $movie->id)->where('menu_id', $menu->id)->first() != null) {
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
                <br>
                <div class="col-xs-12">
                  <small class="text-danger">{{ $errors->first('menu') }}</small>
                </div>
                <div class="menu-block  kids_mode_show" style="display: none;">
                </div>
              </div>
            </div>
          </div>
          <div class="bg-info-rgba p-4 mb-4 rounded">
            <div class="row">
              <div class="col-lg-12 col-md-12">
                <div class="switch-field">
                  <div class="switch-title text-dark">{{__('More Details : TMDB Or Custom')}}?</div>
                  <input type="radio" id="switch_left" class="imdb_btn" name="tmdb" value="Y" {{$movie->tmdb == 'Y' ? 'checked' : ''}}/>
                  <label for="switch_left">{{__('TMDB')}}</label>
                  <input type="radio" id="switch_right" class="custom_btn" name="tmdb" value="N" {{$movie->tmdb != 'Y' ? 'checked' : ''}}/>
                  <label for="switch_right">{{__('Custom')}}</label>
                </div>
                <div id="custom_dtl" class="custom-dtl">
                  <div class="row">
                    <div class="col-lg-4 col-md-6">
                      <div class="form-group text-dark{{ $errors->has('trailer_url') ? ' has-error' : '' }}">
                        {!! Form::label('trailer_url', __('Trailer URL')) !!}<sup class="text-danger">*</sup>
                         <small class="badge badge-pill badge-secondary" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{__('Please Use Youtube URL for Trailor.')}}">
                            <i class="fa fa-info"></i>
                          </small>
                        {!! Form::text('trailer_url', null, ['class' => 'form-control']) !!}
                        <small class="text-danger">{{ $errors->first('trailer_url') }}</small>
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                      <div class="form-group text-dark{{ $errors->has('director_id') ? ' has-error' : '' }}">
                        {!! Form::label('director_id', __('Directors')) !!}<sup class="text-danger">*</sup>
                        <div class="input-group">
                          <select name="director_id[]" id="director_id" class="form-control select2 directorList" multiple="multiple">
                            @if(isset($old_director) && count($old_director) > 0)
                            @foreach($old_director as $old)
                            <option value="{{$old->id}}" selected="selected">{{$old->name}}</option> 
                            @endforeach
                            @endif
                            @if(isset($director_ls))
                            @foreach($director_ls as $rest)
                            <option value="{{$rest->id}}">{{$rest->name}}</option> 
                            @endforeach
                            @endif
                          </select>  
                          <a href="#" class="add-audio-lang" data-toggle="modal" data-target="#AddDirectorModal" class="input-group-addon"><i class="feather icon-plus"></i></a>
                        </div>
                        <small class="text-danger">{{ $errors->first('director_id') }}</small>
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                      <div class="form-group text-dark{{ $errors->has('actor_id') ? ' has-error' : '' }}">
                        {!! Form::label('actor_id',__('Actors')) !!}<sup class="text-danger">*</sup>
                        <div class="input-group">
                          <select name="actor_id[]" id="actor_id" class="form-control select2" multiple="multiple">
                            @if(isset($old_actor) && count($old_actor) > 0)
                            @foreach($old_actor as $old)
                            <option value="{{$old->id}}" selected="selected">{{$old->name}}</option> 
                            @endforeach
                            @endif
                            @if(isset($actor_ls))
                            @foreach($actor_ls as $rest)
                            <option value="{{$rest->id}}">{{$rest->name}}</option> 
                            @endforeach
                            @endif
                          </select>  
                          <a href="#" class="add-audio-lang" data-toggle="modal" data-target="#AddActorModal" class="input-group-addon"><i class="feather icon-plus"></i></a>
                        </div>
                        <small class="text-danger">{{ $errors->first('actor_id') }}</small>
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                      <div class="form-group text-dark{{ $errors->has('genre_id') ? ' has-error' : '' }}">
                        {!! Form::label('genre_id', __('Genre')) !!}<sup class="text-danger">*</sup>
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
                    <div class="col-lg-2 col-md-6">
                      <div class="form-group text-dark{{ $errors->has('duration') ? ' has-error' : '' }}">
                        {!! Form::label('duration', __('Duration in Mins.')) !!}
                        {!! Form::text('duration', null, ['class' => 'form-control']) !!}
                        <small class="text-danger">{{ $errors->first('duration') }}</small>
                      </div>
                    </div>
                    <div class="col-lg-2 col-md-6">
                      <div class="form-group text-dark{{ $errors->has('publish_year') ? ' has-error' : '' }}">
                        {!! Form::label('publish_year', __('Publish Year')) !!}<sup class="text-danger">*</sup>
                        {!! Form::number('publish_year', null, ['class' =>   'form-control']) !!}
                        <small class="text-danger">{{ $errors->first('publish_year') }}</small>
                      </div>
                    </div>
                    <div class="col-lg-2 col-md-6">
                      <div class="form-group text-dark{{ $errors->has('rating') ? ' has-error' : '' }}">
                        {!! Form::label('rating', __('Ratings')) !!}<sup class="text-danger">*</sup>
                        <small class="badge badge-pill badge-secondary" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{__('Rate Movie 1 to 5 star.')}}">
                            <i class="fa fa-info"></i>
                          </small>
                        {!! Form::text('rating', null, ['class' => 'form-control']) !!}
                        <small class="text-danger">{{ $errors->first('rating') }}</small>
                      </div>
                    </div>
                    <div class="col-lg-2 col-md-6">
                      <div class="form-group text-dark{{ $errors->has('released') ? ' has-error' : '' }}">
                        {!! Form::label('released', __('Released')) !!}<sup class="text-danger">*</sup>
                        {!! Form::date('released', null, ['class' => 'form-control']) !!}
                        <small class="text-danger">{{ $errors->first('released') }}</small>
                      </div>
                    </div>
                    <div class="col-lg-12 col-md-12">
                      <div class="form-group text-dark{{ $errors->has('detail') ? ' has-error' : '' }}">
                        {!! Form::label('detail',__('Description')) !!}<sup class="text-danger">*</sup>
                        {!! Form::textarea('detail', null, ['class' => 'form-control materialize-textarea', 'rows' => '1']) !!}
                        <small class="text-danger">{{ $errors->first('detail') }}</small>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="form-group ">
                <button type="reset" class="btn btn-success-rgba">{{__('Reset')}}</button>
                <button type="submit" class="btn btn-primary-rgba"><i class="fa fa-check-circle"></i>
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
  <div class="card m-b-30">
    <div class="card-header">
      <h5 class="card-title"> {{__('Sub title')}}</h5>
    </div>
    <div class="card-body">
      <table class="table table-borderd">
        <thead>
          <tr>
            <th>#</th>
            <th>{{__('Subtitle Language')}}</th>
            <th>Action</th>
          </tr>
        </thead>
  
        <tbody>
          @foreach($movie->subtitles as $key=> $subtitle)
          <tr>
            <td>{{ $key+1 }}</td>
            <td>{{ $subtitle->sub_lang }}</td>
            <td>
              <button type="button" class="btn-danger btn-floating" data-toggle="modal" data-target="#{{$subtitle->id}}deleteModal"><i class="material-icons">delete</i> </button>
            </td>
          </tr>
  
          <div id="{{$subtitle->id}}deleteModal" class="delete-modal modal fade" role="dialog">
            <div class="modal-dialog modal-sm">
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <div class="delete-icon"></div>
                </div>
                <div class="modal-body text-center">
                  <h4 class="modal-heading">{{__('Are You Sure')}} ?</h4>
                  <p>{{__('Delete Warrning')}}</p>
                </div>
                <div class="modal-footer">
                  {!! Form::open(['method' => 'POST', 'action' => ['SubtitleController@delete', $subtitle->id]]) !!}
                  <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">{{__('No')}}</button>
                  <button type="submit" class="btn btn-danger">{{__('Yes')}}</button>
                  {!! Form::close() !!}
                </div>
              </div>
            </div>
          </div>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  </div>
</div>

<div id="AddCustomLabel" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">{{__('Add Custom Label')}}</h5>
        <button type="button" class="close" data-dismiss="modal" title="{{__('Close')}}">&times;</button>
      </div>
      {!! Form::open(['method' => 'POST', 'action' => 'LabelController@store']) !!}
        <div class="modal-body">
          <div class="form-group">
          {!! Form::label('name', __('Custom Label')) !!}<sup class="text-danger">*</sup>
                {!! Form::text('name', old('name'), ['class' => 'form-control', 'required' => 'required', 'placeholder' => __('Please Enter Label name')]) !!}
                <small class="text-danger">{{ $errors->first('name') }}</small>
          </div>
        </div>
        <div class="modal-footer">
          <div class="btn-group pull-right">
            <button type="reset" class="btn btn-success-rgba" title="{{__('Reset')}}">{{__('Reset')}}</button>
            <button type="submit" class="btn btn-primary-rgba" title="{{__('Create')}}">{{__('Create')}}</button>
          </div>
        </div>
        {!! Form::close() !!}
    </div>
  </div>
</div>
    <!-- Add Subtitle Modal -->
<div id="submodal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">{{__('Add Subtitle')}}</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form action="{{ route('add.subtitle',$movie->id) }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="modal-body">
          <table class="table table-bordered" id="dynamic_field">  
            <tr> 
              <td>
                <div class="form-group{{ $errors->has('sub_t') ? ' has-error' : '' }} input-file-block">
                  <input type="file" name="sub_t[]"/>
                  <p class="info">{{__('Choose Subtitle File')}} ex. subtitle.srt, or. txt</p>
                  <small class="text-danger">{{ $errors->first('sub_t') }}</small>
                </div>
              </td>

              <td>
                <input type="text" name="sub_lang[]" placeholder="Subtitle Language" class="form-control name_list" />
              </td>  
              <td><button type="button" name="add" id="add" class="btn btn-xs btn-success">
                <i class="fa fa-plus"></i>
                </button>
              </td>  
            </tr>  
          </table>
        </div>
        <div class="modal-footer">
          <div class="btn-group pull-right">
            <button type="reset" class="btn btn-success-rgba">{{__('Reset')}}</button>
            <button type="submit" class="btn btn-primary-rgba">{{__('Create')}}</button>
          </div>
        </div>
      </form>
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
<!-- Add Director Modal -->
<div id="AddDirectorModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">{{__('Add Director')}}</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div style="display:none;" class="alert alert-success" id="msg_div">
              <center><span id="res_message"></span></center>
      </div>
      <form method="POST" enctype="multipart/form-data" id="director">
       
      <div class="modal-body admin-form-block">
        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
          {!! Form::label('name', __('Name')) !!}
          {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
          <small class="text-danger">{{ $errors->first('name') }}</small>
        </div>
        <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }} input-file-block">
          {!! Form::label('image', __('Director Image')) !!} - <p class="inline info">{{__('HelpBlockText')}}</p>
          {!! Form::file('image', ['class' => 'input-file', 'id'=>'image']) !!}
          <label for="image" class="btn btn-danger js-labelFile" data-toggle="tooltip" data-original-title="{{ __('DirectorImage')}}">
            <i class="icon fa fa-check"></i>
            <span class="js-fileName">{{__('Choose A File')}}</span>
          </label>
          <p class="info">{{__('Choose Custom Image')}}</p>
          <small class="text-danger">{{ $errors->first('image') }}</small>
        </div>
      </div>
      <div class="modal-footer">
        <div class="btn-group pull-right">
          <button type="reset" class="btn btn-success-rgba"> {{__('Reset')}}</button>
          <button type="submit" class="btn btn-primary-rgba" id="send_form"> {{__('Create')}}</button>
        </div>
        <div class="clear-both"></div>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- Add Actor Modal -->

<div id="AddActorModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">{{__('Add Actor')}}</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div style="display:none;" class="alert alert-success" id="msg_div1">
              <center><span id="res_message2"></span></center>
      </div>
      <form method="POST" enctype="multipart/form-data" id="actorform">
       
      <div class="modal-body admin-form-block">
        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
          {!! Form::label('name',__('Name')) !!}
          {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
          <small class="text-danger">{{ $errors->first('name') }}</small>
        </div>
        <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }} input-file-block">
          {!! Form::label('image', __('Actor Image')) !!} - <p class="inline info">{{__('HelpBlockText')}}</p>
          {!! Form::file('image', ['class' => 'input-file', 'id'=>'image']) !!}
          <label for="image" class="btn btn-danger js-labelFile" data-toggle="tooltip" data-original-title="{{__('ActorImage')}}">
            <i class="icon fa fa-check"></i>
            <span class="js-fileName">{{__('Choose A File')}}</span>
          </label>
          <p class="info">{{__('Choose Custom Image')}}</p>
          <small class="text-danger">{{ $errors->first('image') }}</small>
        </div>
      </div>
      <div class="modal-footer">
        <div class="btn-group pull-right">
          <button type="reset" class="btn btn-success-rgba"> {{__('Reset')}}</button>
          <button type="submit" class="btn btn-primary-rgba" id="send_form_actor">{{__('Create')}}</button>
        </div>
        <div class="clear-both"></div>
      </div>
      </form>
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
{{-- <script>
  function readURL(input) {

    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function (e) {
        $('#' + input.name).attr('src', e.target.result);
      }
      
      reader.readAsDataURL(input.files[0]);
    }
  }
</script> --}}
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script> -->

<!------------------------- ajax directors ------------------>
<script type="text/javascript">
  $(document).ready(function(){

     $(".directorList").select2({
      ajax: { 
       url: "{{ route('listofd') }}",
       type: "GET",
       dataType: 'json',
       delay: 250,
       data: function (params) {
        return {
          searchTerm: params.term // search term
        };
       },
       processResults: function (response) {
         return {
            results: response
         };
       },
       cache: true
      }
     });
});

$(document).ready(function(){
$('#send_form').click(function(e){
   e.preventDefault();
   /*Ajax Request Header setup*/
   $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

   $('#send_form').html('Creating..');
   
   /* Submit form data using ajax*/
   $.ajax({
      url: "{{ route('ajax.director')}}",
      method: 'GET',
      data: $('#editdirector').serialize(),
      datatype : 'html',
      success: function(response){
        
         //------------------------
            $('#send_form').html('Create');
            $('#msg_div').show();
            $('#res_message').html(response.msg);

            document.getElementById("editdirector").reset(); 
            setTimeout(function(){
            $('#res_message').hide();
            $('#msg_div').hide();
            $('#AddDirectorModal').modal('hide');

            },1000);
         //--------------------------
      }});
   });
});
</script>
<!-------------- end ajax director---------------->


<!------------------------- ajax actor ------------------>
<script type="text/javascript">
  $(document).ready(function(){

     $(".actorList").select2({
      ajax: { 
       url: "{{ route('listofactor') }}",
       type: "GET",
       dataType: 'json',
       delay: 250,
       data: function (params) {
        return {
          searchTerm: params.term // search term
        };
       },
       processResults: function (response) {
         return {
            results: response
         };
       },
       cache: true
      }
     });
});

$(document).ready(function(){
$('#send_form_actor').click(function(e){
   e.preventDefault();
   /*Ajax Request Header setup*/
   $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

   $('#send_form_actor').html('Creating..');
   
   /* Submit form data using ajax*/
   $.ajax({
      url: "{{ route('ajax.actor')}}",
      method: 'GET',
      data: $('#editactor').serialize(),
      datatype : 'html',
      success: function(response){
        
         //------------------------
            $('#send_form_actor').html('Create');
            $('#msg_div').show();
            $('#res_message').html(response.msg);

            document.getElementById("editactor").reset(); 
            setTimeout(function(){
            $('#res_message').hide();
            $('#msg_div').hide();
            $('#AddActorModal').modal('hide');

            },1000);
         //--------------------------
      }});
   });
});
</script>
<!-------------- end ajax actor---------------->

<script>
  $(document).ready(function(){
    // $("#selecturl").select2({
    //   placeholder: "Add Video Through...",

    // });
    $('#selecturl').change(function(){  
     selecturl = document.getElementById("selecturl").value;
   if (selecturl == 'iframeurl') {
    $('#ifbox').show();
    $('#subtitle_section').hide();
    $('#ready_url').hide();
    $('#custom_url').hide();
    $('#uploadvideo').hide();

  }else if(selecturl=='customurl'){
       $('#ifbox').hide();
       $('#ready_url').show();
       $('#subtitle_section').show();
       $('#ready_url_text').text('Enter Custom URL or Vimeo or Youtube URL');
       $('#custom_url').hide();
       $('#uploadvideo').hide();
   }
   else if (selecturl == 'uploadvideo') {
     $('#uploadvideo').show();
     $('#subtitle_section').show();
     $('#ready_url').hide();
     $('#ifbox').hide();
     $('#custom_url').hide();

   }
    else if (selecturl == 'youtubeapi') {
   $('#ready_url').show();
   $('#subtitle_section').show();
   $('#custom_url').hide();
   $('#ifbox').hide();
   $('#ready_url_text').text('Import From Youtube API');
   $('#uploadvideo').hide();

 }else if(selecturl=='vimeoapi'){
   $('#ifbox').hide();
   $('#ready_url').show();
   $('#subtitle_section').show();
   $('#custom_url').hide();
   $('#ready_url_text').text('Import From Vimeo API');
   $('#uploadvideo').hide();
 }
 else if(selecturl=='multiqcustom'){
   $('#ifbox').hide();
   $('#ready_url').hide();
   $('#subtitle_section').show();
   $('#custom_url').show();
   $('#uploadvideo').hide();
 }



});
    var i= 1;
    $('#add').click(function(){  
     i++;  
     $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><input class="subtitle-input" type="file" name="sub_t[]"/></td><td><input type="text" name="sub_lang[]" placeholder="Subtitle Language" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn-sm btn_remove">X</button></td></tr>');  
   });

    $(document).on('click', '.btn_remove', function(){  
     var button_id = $(this).attr("id");   
     $('#row'+button_id+'').remove();  
   });  

   

    $('.upload-image-main-block').hide();
    @if($movie->tmdb == 'N')
    $('#custom_dtl').show();
    @endif
    @if ($movie->subtitle == 0)
    $('.subtitle_list').hide();
    $('#subtitle-file').hide();
    @endif 
    @if($movie->series == 0)
    $('.movie_id').hide();
    @endif
    $('input[name="subtitle"]').click(function(){
     if($(this).prop("checked") == true){
       $('.subtitle_list').fadeIn();
       $('#subtitle-file').fadeIn();
     }
     else if($(this).prop("checked") == false){
      $('.subtitle_list').fadeOut();
      $('#subtitle-file').fadeOut();
    }
  });
    $('.for-custom-image input').click(function(){
      if($(this).prop("checked") == true){
        $('.upload-image-main-block').fadeIn();
      }
      else if($(this).prop("checked") == false){
        $('.upload-image-main-block').fadeOut();
      }
    });
    $('input[name="series"]').click(function(){
     if($(this).prop("checked") == true){
       $('.movie_id').fadeIn();
     }
     else if($(this).prop("checked") == false){
      $('.movie_id').fadeOut();
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

  

      $('#kids_mode').on('change',function(){
    if($('#kids_mode').is(':checked')){
      $('#kids_mode_show').show('fast');
        $('#kids_mode_hide').hide('fast');
      $('#is_kids').show('fast');
      $('#is_not_kids').hide('fast');
    }else{
      $('#kids_mode_hide').show('fast');
        $('#kids_mode_show').hide('fast');
      $('#is_not_kids').show('fast');
      $('#is_kids').hide('fast');
    }
      
    });

    $('#custom_thumb').on('change',function(){
    if($('#custom_thumb').is(':checked')){
      $('#custom_thumb_hide').show('fast');
        $('#custom_thumb_show').hide('fast');
    
    }else{
      $('#custom_thumb_show').show('fast');
        $('#custom_thumb_hide').hide('fast');
    }
      
    });


  $('input[name="is_upcoming"]').click(function(){
    if($(this).prop("checked") == true){
      $('.video_url').fadeOut();
      $('#ifbox').fadeOut();
      $('#uploadvideo').fadeOut();
      $('#custom_url').fadeOut();
      $('#ready_url').fadeOut();
      $('#upcoming_box').show();
    }
    else if($(this).prop("checked") == false){
      $('.video_url').fadeIn();
      $('#ifbox').show();
      $('#uploadvideo').hide();
      $('#custom_url').hide();
      $('#ready_url').hide();
      $('#upcoming_box').hide();
      }
  });

   $('input[name="is_custom_label"]').click(function(){
      if($(this).prop("checked") == true){
        $('#label_box').show();
      }
      else if($(this).prop("checked") == false){
        $('#label_box').hide();
      }
    });

  });
</script>
{{-- vimeo api code --}}

<script>
      (function($) {
          var videourl;
          vimeoApiCall();
          $("#vpageTokenNext").on( "click", function( event ) {
              $("#vpageToken").val($("#vpageTokenNext").val());
              vimeoApiCall();
          });
          $("#vpageTokenPrev").on( "click", function( event ) {
              $("#vpageToken").val($("#vpageTokenPrev").val());
              vimeoApiCall();
          });
          $("#vimeo-searchBtn").on( "click", function( event ) {
              vimeoApiCall();
              return false;
          });
          $( "#vimeo-search" ).autocomplete({
            source: function( request, response ) {
              //console.log(request.term);
              var sqValue = [];
              var accesstoken='{{env('VIMEO_ACCESS')}}';
              var myvimeourl='https://api.vimeo.com/videos?query=videos'+'&access_token=' + accesstoken +'&per_page=1';
              console.log(myvimeourl);
              jQuery.ajax({
                  type: "GET",
                  url: myvimeourl,
                  dataType: 'jsonp',
                  
                  success: function(data){
                      console.log(data[1]);
                      obj = data[1];
                      jQuery.each( obj, function( key, value ) {
                          sqValue.push(value[0]);
                      });
                      response( sqValue);
                  }
              });
            },
            select: function( event, ui ) {
              setTimeout( function () { 
                  vimeoApiCall();
              }, 300);
            }
          });  
      })(jQuery);
function vimeoApiCall(){
  console.log('yeah i am here');
    var accesstoken='{{env('VIMEO_ACCESS')}}';
    var text=$("#vimeo-search").val();
   var next=  $("#vpageTokenNext").val();
   console.log('jxhh'+next);
   var prev= $("#vpageTokenPrev").val();
    var myvimeourl=null;
   if (next != null && next !='') {
     myvimeourl='https://api.vimeo.com'+next;
   }else if (prev != null && prev !='') {
       myvimeourl='https://api.vimeo.com'+prev;
   }else{
       myvimeourl='https://api.vimeo.com/videos?query='+ text + '&access_token=' + accesstoken+'&per_page=5';
   }
  
   console.log('url'+myvimeourl);
    $.ajax({
        cache: false,
     
        dataType: 'json',
        type: 'GET',
       
        url: myvimeourl,

    })
    .done(function(data) {
      console.log(data);
    // alert('duhjf');
        if ( data.paging.previous === null) {$("#vpageTokenPrev").hide();}else{$("#vpageTokenPrev").show();}
        if ( data.paging.next === null) {$("#vpageTokenNext").hide();}else{$("#vpageTokenNext").show();}
        var items = data.data, videoList = "";
     
        $("#vpageTokenNext").val(data.paging.next);
        $("#vpageTokenPrev").val(data.paging.previous);
        console.log(items);
        $.each(items, function(index,e) {
             
             videourl=e.link;
               // console.log(videourl);
            videoList = videoList 
            + '<li class="hyv-video-list-item" ><div class="hyv-thumb-wrapper"><p class="hyv-thumb-link"><span class="hyv-simple-thumb-wrap"><img alt="'+e.name+'" src="'+e.pictures.sizes[3].link+'" height="90"></span></p></div><div class="hyv-content-wrapper"><p  class="hyv-content-link">'+e.name+'<span class="title">'+e.description.substr(0, 105)+'</span><span class="stat attribution">by <span>'+e.user.name+'</span></span></p><button class="bn btn-info btn-sm inline" onclick=setVideovimeoURl("'+videourl+'")>Add</button></div></li>';
              
          
        });

        $("#vimeo-watch-related").html(videoList);
       
    });

}
</script>
<script>
  $('#movi_id').on('change',function(){
    if ($('#movi_id').is(':checked')){

      $('#txt2').text("Movie Created By Title:");
      $('#mv_t').removeAttr('readonly','readonly');
      $('#mv_i').attr('readonly','readonly');

    }else{
     $('#mv_i').removeAttr('readonly','readonly');
     $('#mv_t').attr('readonly','readonly');
     $('#txt2').text("Movie Created By ID:");
   }
 });

 
</script>
<script>
  $('#movi_id').on('change',function(){
    if ($('#movi_id').is(':checked')){
      $('#movie_title').show('fast');
      $('#movie_id').hide('fast');
    }else{
     $('#movie_id').show('fast');
     $('#movie_title').hide('fast');
   }
 });

 
</script>

{{-- youtube API code --}}
<script>
        (function($) {
           var videourl;
            youtubeApiCall();
            $("#pageTokenNext").on( "click", function( event ) {
                $("#pageToken").val($("#pageTokenNext").val());
                youtubeApiCall();
            });
            $("#pageTokenPrev").on( "click", function( event ) {
                $("#pageToken").val($("#pageTokenPrev").val());
                youtubeApiCall();
            });
            $("#hyv-searchBtn").on( "click", function( event ) {
                youtubeApiCall();
                return false;
            });
            $( "#hyv-search" ).autocomplete({
              source: function( request, response ) {
                //console.log(request.term);
                var sqValue = [];
                jQuery.ajax({
                    type: "POST",
                    url: "http://suggestqueries.google.com/complete/search?hl=en&ds=yt&client=youtube&hjson=t&cp=1",
                    dataType: 'jsonp',
                    data: jQuery.extend({
                        q: request.term
                    }, {  }),
                    success: function(data){
                        console.log(data[1]);
                        obj = data[1];
                        jQuery.each( obj, function( key, value ) {
                            sqValue.push(value[0]);
                        });
                        response( sqValue);
                    }
                });
              },
              select: function( event, ui ) {
                setTimeout( function () { 
                    youtubeApiCall();
                }, 300);
              }
            });  
        })(jQuery);
function youtubeApiCall(){
    $.ajax({
        cache: false,
        data: $.extend({
            key: '{{env('YOUTUBE_API_KEY')}}',
            q: $('#hyv-search').val(),
            part: 'snippet'
        }, {maxResults:15,pageToken:$("#pageToken").val()}),
        dataType: 'json',
        type: 'GET',
        timeout: 5000,
        url: 'https://www.googleapis.com/youtube/v3/search'
    })
    .done(function(data) {
        if (typeof data.prevPageToken === "undefined") {$("#pageTokenPrev").hide();}else{$("#pageTokenPrev").show();}
        if (typeof data.nextPageToken === "undefined") {$("#pageTokenNext").hide();}else{$("#pageTokenNext").show();}
        var items = data.items, videoList = "";
        $("#pageTokenNext").val(data.nextPageToken);
        $("#pageTokenPrev").val(data.prevPageToken);
        // console.log(items);
        $.each(items, function(index,e) {
             
             videourl="https://www.youtube.com/watch?v="+e.id.videoId;
               console.log(videourl);
            videoList = videoList 
            + '<li class="hyv-video-list-item" ><div class="hyv-content-wrapper"><p  class="hyv-content-link" title="'+e.snippet.title+'"><span class="title">'+e.snippet.title+'</span><span class="stat attribution">by <span>'+e.snippet.channelTitle+'</span></span></p><button class="bn btn-info btn-sm inline" onclick=setVideoURl("'+videourl+'")>Add</button></div><div class="hyv-thumb-wrapper"><p class="hyv-thumb-link"><span class="hyv-simple-thumb-wrap"><img alt="'+e.snippet.title+'" src="'+e.snippet.thumbnails.default.url+'" height="90"></span></p></div></li>';
              
          
        });

        $("#hyv-watch-related").html(videoList);
       
    });
}
    </script>
<script type="text/javascript">
  function setVideoURl(videourls){
    console.log(videourls);
  $('#apiUrl').val(videourls); 
    $('#myyoutubeModal').modal("hide");
  }
</script>
<script type="text/javascript">
  function setVideovimeoURl(videourls){
    console.log(videourls);
  $('#apiUrl').val(videourls); 
    $('#myvimeoModal').modal("hide");
  }
</script>
<script type="text/javascript">
  $(document).ready(function(){ 
    $('#selecturl').change(function() {
     $('#apiUrl').val('');  
        var opval = $(this).val(); //Get value from select element
        if(opval=="youtubeapi"){ //Compare it and if true
            $('#myyoutubeModal').modal("show"); //Open Modal
        }
        if(opval=="vimeoapi"){ //Compare it and if true
            $('#myvimeoModal').modal("show"); //Open Modal
        }
    });
});
</script>
<script>
  $('.seriescheck').on('change',function(){
      if($(this).is(':checked')){
        $('.mseries').attr('required','required');
      }else{
        $('.mseries').removeAttr('required');
      }
  });


</script>
<script>
  $('#subtitle_check').on('change',function(){

    if($('#subtitle_check').is(':checked')){
      $('.subtitle-box').show('fast');
    }else{
       $('.subtitle-box').hide('fast');
    }

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
<script>
  $(".midia-toggle-upload_video").midia({
		base_url: '{{url('')}}',
    dropzone : {
          acceptedFiles: '.mp4,.m3u8'
        },
    directory_name: 'movies_upload'
	});

  $(".midia-toggle-upload_video_360").midia({
		base_url: '{{url('')}}',
    dropzone : {
          acceptedFiles: '.mp4,.m3u8'
        },
    directory_name: 'movies_upload/url_360'
	});

  $(".midia-toggle-upload_video_480").midia({
		base_url: '{{url('')}}',
    dropzone : {
          acceptedFiles: '.mp4,.m3u8'
        },
    directory_name: 'movies_upload/url_480'
	});

  $(".midia-toggle-upload_video_720").midia({
		base_url: '{{url('')}}',
    dropzone : {
          acceptedFiles: '.mp4,.m3u8'
        },
    directory_name: 'movies_upload/url_720'
	});

  $(".midia-toggle-upload_video_1080").midia({
		base_url: '{{url('')}}',
    dropzone : {
          acceptedFiles: '.mp4,.m3u8'
        },
    directory_name: 'movies_upload/url_1080'
	});
</script>
<script type="text/javascript" src="{{url('js/encrypt.js')}}"></script> <!-- bootstrap js -->
<script>
  $(document).ready(function() {
    $apicurrentValue = $('#apiUrl').val();
    if($apicurrentValue.includes('encrypt:')){
      //console.log('true');
      $('#encryptlink').hide();
    }else{
      //console.log('false');
      $('#encryptlink').show();
    }
  });

  $('#apiUrl').on('change',function(){
    $apicurrentValue = $('#apiUrl').val();
    if($apicurrentValue.includes('encrypt:')){
      //console.log('true');
      $('#encryptlink').hide();
    }else{
      //console.log('false');
      $('#encryptlink').show();
    }
  });
</script> 
<script>
  (function($){
    $.noConflict();    
  })(jQuery);    
</script>    
@endsection