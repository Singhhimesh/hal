@extends('layouts.master')
@section('title',__('Manage Season'))
@section('breadcum')
	<div class="breadcrumbbar">
                <h4 class="page-title">{{ __('HOME') }}</h4>
                <div class="breadcrumb-list">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{url('/admin')}}">{{ __('Dashboard') }}</a></li>
                      <li class="breadcrumb-item active" aria-current="page">{{ __(' Manage Season') }}</li>
                    </ol>
                </div>  
    </div>
@endsection
@section('maincontent')
<div class="contentbar">
  <div class="row">
    
    <div class="col-lg-6 col-xl-6">
      <div class="card m-b-30">
        <div class="card-header">

            <button type="button" id="createButton" onclick="showCreateForm()" class="float-right btn btn-primary-rgba mr-2 "><i class="feather icon-plus mr-2"></i> {{ __('Add Seasons') }} </button>
           
            <button type="button" class="float-right btn btn-success-rgba mr-2 " data-toggle="modal"
            data-target=".bd-example-modal-lg"><i class="fa fa-file-excel-o mr-2"></i> {{ __('Import  Seasons') }} </button>
    
            {{-- Impport Model Start --}}
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleLargeModalLabel">{{__("Bulk Import Seasons")}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <div class="col-md-12">
                        <div class="card-header">
                            <a href="{{ url('files/Seasons.xlsx') }}" class="float-right btn btn-success-rgba mr-2"><i
                                class="fa fa-file-excel-o mr-2"></i>{{ __('Download Example xls/csv File') }}</a>
                        </div>
                    </div>
      
                    <div class="card-header">
                        <h6 class="card-title">{{ __('Choose your xls/csv File :') }}</h6>
                        <form action="{{ url('/admin/import/seasons') }}" method="POST" enctype="multipart/form-data">
                          @csrf
                          <div class="form-group{{ $errors->has('file') ? ' has-error' : '' }} input-file-block col-md-12">
                            {!! Form::file('file', ['class' => 'input-file', 'id'=>'file']) !!}
                            <label for="file" class="btn btn-danger js-labelFile" data-toggle="tooltip" data-original-title="{{__('Choose your xls/csv File')}}">
                              <i class="icon fa fa-check"></i>
                              <span class="js-fileName">{{__('Choose A File')}}</span>
                            </label>
                            <small class="text-danger">{{ $errors->first('file') }}</small>
        
                            <button type="submit" class="float-right btn btn-danger-rgba mr-2 "><i class="feather icon-plus mr-2"></i> {{__('Import')}} </button>
                          </div>
                            
                        </form>
                    </div> 
                    
                <div class="modal-body">
                    <div class="box box-danger">
                        <div class="box-header">
                          <div class="box-title">{{__('Instructions')}}</div>
                        </div>
                        <div class="box-body table-responsive">
                          <h6><b>{{__('Follow the instructions carefully before importing the file.')}}</b></h6>
                          <small>{{__('The columns of the file should be in the following order.')}}</small>
                          <table class="table table-striped table-bordered">
                            <thead>
                              <tr>
                                <th>{{__('Column No')}}</th>
                                <th>{{__('Column Name')}}</th>
                                <th>{{__('Required')}}</th>
                                <th>{{__('Description')}}</th>
                              </tr>
                            </thead>
            
                            <tbody>
                              <tr>
                                <td>1</td>
                                <td><b>{{__('tvseries_id')}}</b></td>
                                <td><b>{{__('Yes')}}</b></td>
                                <td>{{__('Enter tvseries id')}} <b>{{__('i.e')}}</b> {{$tv_series->id}} </td>
                              </tr>
            
                              <tr>
                                <td>2</td>
                                <td><b>{{__('season_no')}}</b></td>
                                <td><b>{{__('Yes')}}</b></td>
                                <td>{{__('Enter season number')}}</td>
                              </tr>
                              <tr>
                                <td>3</td>
                                <td> <b>{{__('thumbnail')}}</b> </td>
                                <td><b>{{__('No')}}</b></td>
                                <td>{{__('Name your image eg: example.jpg')}} <b>{{__('(Image can be uploaded using Media Manager / Seasons / thumbnail Tab.)')}}</b></td>
                              </tr>
                              <tr>
                                <td>4</td>
                                <td> <b>{{__('poster')}}</b> </td>
                                <td><b>{{__('No')}}</b></td>
                                <td>{{__('Name your image eg: example.jpg')}} <b>{{__('(Image can be uploaded using Media Manager / Seasons / poster Tab.)')}}</b></td>
                              </tr>
            
                              <tr>
                                <td>5</td>
                                <td> <b>{{__('a_language')}}</b> </td>
                                <td><b>{{__('No')}}</b></td>
                                <td>{{__("Multiple a_language id can be pass here seprate by comma")}}</b></td>
                              </tr>
                              
                             
                              <tr>
                                <td>6</td>
                                <td> <b>{{__('featured')}}</b> </td>
                                <td><b>{{__('No')}}</b></td>
                                <td>{{__("seasons featured (1 = enabled, 0 = disabled)")}}</b></td>
                              </tr>
                          
                              <tr>
                                <td>7</td>
                                <td> <b>{{__('is_protect')}}</b> </td>
                                <td><b>{{__('No')}}</b></td>
                                <td>{{__("seasons protected video (1 = enabled, 0 = disabled)")}}</td>
                              </tr>
                              <tr>
                                <td>8</td>
                                <td> <b>{{__('password')}}</b> </td>
                                <td><b>{{__('No')}}</b></td>
                                <td>{{__("If is_protect = 1, then the enter password here ")}}</td>
                              </tr>
                              <tr>
                                <td>9</td>
                                <td> <b>{{__('actor_id')}}</b> </td>
                                <td><b>{{__('No')}}</b></td>
                                <td>{{__("Multiple actor id can be pass here seprate by comma .")}}</td>
                              </tr>
                              
                              
                              <tr>
                                <td>10</td>
                                <td> <b>{{__('publish_year')}}</b> </td>
                                <td><b>{{__('No')}}</b></td>
                                <td>{{__("Enter seasons publish year")}}</td>
                              </tr>
                             
                              <tr>
                                <td>11</td>
                                <td> <b>{{__('detail')}}</b> </td>
                                <td><b>{{__('No')}}</b></td>
                                <td>{{__("Enter seasons detail")}}</td>
                              </tr>
                              <tr>
                                <td>12</td>
                                <td> <b>{{__('trailer_url')}}</b> </td>
                                <td><b>{{__('No')}}</b></td>
                                <td>{{__("Enter seasons trailer_url")}}</td>
                              </tr>
            
                            </tbody>
                          </table>
                        </div>
                      </div>
                </div>
            </div>
        </div>
      </div>
      {{-- Import Model End --}}
      
      <a href="{{url('admin/tvseries')}}" class="float-right btn btn-primary-rgba mr-2"><i
        class="feather icon-arrow-left mr-2"></i>{{ __('Back') }}</a>
          <h5 class="box-title">{{__('Manage Season')}} </h5><h6><span>{{__('Of')}} {{$tv_series->title}}
            @if ($tv_series->tmdb == 'Y') 
            <span class="badge badge-pill badge-success">{!!$tv_series->tmdb == 'Y' ? '<i class="fa fa-check-circle"></i> by tmdb' : ''!!}</span>
          @endif
        </span></h6>
        </div>
        <div class="card-body ml-2">
          <div id="createForm">
          {!! Form::open(['method' => 'POST', 'action' => 'TvSeriesController@store_seasons', 'files' => true]) !!}
            <div class="row">
              <div class="col-md-12">
                <div class="form-group text-dark{{ $errors->has('season_no') ? ' has-error' : '' }}">
                  <input type="hidden" name="tvseries" value="{{$tv_series->title}}">
                  {!! Form::label('season_no', __('Season No.')) !!}
                  {!! Form::number('season_no', null, ['class' => 'form-control', 'min' => '0']) !!}
                  <small class="text-danger">{{ $errors->first('season_no') }}</small>
                </div>
                <div class="form-group text-dark{{ $errors->has('season_slug') ? ' has-error' : '' }}">
                  {!! Form::label('season_slug',__('Season Slug')) !!}
                  {!! Form::text('season_slug', null, ['class' => 'form-control', 'min' => '0']) !!}
                  <small class="text-danger">{{ $errors->first('season_slug') }}</small>
                </div>
                <div class="form-group text-dark{{ $errors->has('a_language') ? ' has-error' : '' }}">
                    {!! Form::label('a_language', __('Audio Languages')) !!}
                    <p class="inline info"> 
                    <div class="input-group">
                      {!! Form::select('a_language[]', $a_lans, null, ['class' => 'form-control select2', 'multiple']) !!}
                     <a href="#" class="add-audio-lang" data-toggle="modal" data-target="#AddLangModal" class="input-group-addon"><i class="feather icon-plus"></i></a>
                    </div>
                    <small class="text-danger">{{ $errors->first('a_language') }}</small>
                </div>
                <div class="form-group text-dark">
                  <div class="row">
                    <div class="col-md-6">
                      {!! Form::label('', __('Choose Custom Thumbnail And Poster')) !!}
                    </div>
                    <div class="col-md-5 pad-0">
                      <label class="switch for-custom-image">
                        {!! Form::checkbox('', 1, 0, ['class' => 'custom_toggle']) !!}
                        <span class="slider round"></span>
                      </label>
                    </div>
                  </div>
                </div>
                <div class="upload-image-main-block">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group text-dark{{ $errors->has('thumbnail') ? ' has-error' : '' }} input-file-block">
                        {!! Form::label('thumbnail', __('Thumbnail')) !!} 
                        {!! Form::file('thumbnail', ['class' => 'input-file', 'id'=>'thumbnail']) !!}
                        <label for="thumbnail" class="btn btn-danger js-labelFile" data-toggle="tooltip" data-original-title="{{__('Thumbnail')}}">
                     
                          <span class="js-fileName">{{__('Choose A File')}}</span>
                        </label>
                        <p class="info">{{__('Choose Custom Thumbnail')}}</p>
                        <small class="text-danger">{{ $errors->first('thumbnail') }}</small>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group{{ $errors->has('poster') ? ' has-error' : '' }} input-file-block">
                        {!! Form::label('poster',__('Poster')) !!} 
                        {!! Form::file('poster', ['class' => 'input-file', 'id'=>'poster']) !!}
                        <label for="poster" class="btn btn-danger js-labelFile" data-toggle="tooltip" data-original-title="{{__('Poster')}}">
                         
                          <span class="js-fileName">{{__('Choose A File')}}</span>
                        </label>
                        <p class="info">{{__('Choose Custom Poster')}}</p>
                        <small class="text-danger">{{ $errors->first('poster') }}</small>
                      </div>
                    </div>
                  </div>
                </div>
    
                <div class="form-group text-dark{{ $errors->has('is_protect') ? ' has-error' : '' }}">
                  <div class="row">
                    <div class="col-md-6">
                      {!! Form::label('is_protect', __('Protected Video?')) !!}
                    </div>
                    <div class="col-md-5 pad-0">
                      <label class="switch">
                        <input type="checkbox" name="is_protect" class="custom_toggle" id="is_protect">
                        <span class="slider round"></span>
                      </label>
                    </div>
                  </div>
                  <div class="col-xs-12">
                    <small class="text-danger">{{ $errors->first('is_protect') }}</small>
                  </div>
                </div>
                <div class="search form-group text-dark{{ $errors->has('password') ? ' has-error' : '' }} is_protect" style="display: none;">
                  {!! Form::label('password', __('Protected Password For Video')) !!}
                  {!! Form::password('password', null, ['class' => 'form-control','id'=>'password']) !!}
                  <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                 
                </div>
                 <small class="text-danger">{{ $errors->first('password') }}</small>
              
                {{ Form::hidden('tv_series_id', $id) }}
                <div class="switch-field">
                  <div class="switch-title">{{__('Want IMDB Ratings And More Or Custom')}}?</div>
                  <input type="radio" id="switch_left" class="imdb_btn" name="tmdb" value="Y" checked/>
                  <label for="switch_left">{{__('TMDB')}}</label>
                  <input type="radio" id="switch_right" class="custom_btn" name="tmdb" value="N" />
                  <label for="switch_right">{{__('Custom')}}</label>
                </div>
                <div id="custom_dtl" class="custom-dtl">
                  <div class="form-group text-dark{{ $errors->has('actor_id') ? ' has-error' : '' }}">
                      {!! Form::label('actor_id', __('Actors')) !!}
                      {!! Form::select('actor_id[]', $actor_ls, null, ['class' => 'form-control select2', 'multiple']) !!}
                      <small class="text-danger">{{ $errors->first('actor_id') }}</small>
                  </div>
                  <div class="form-group text-dark{{ $errors->has('publish_year') ? ' has-error' : '' }}">
                    {!! Form::label('publish_year', __('Publish Year')) !!}
                    {!! Form::number('publish_year', null, ['class' => 'form-control', 'min' => '0']) !!}
                    <small class="text-danger">{{ $errors->first('publish_year') }}</small>
                  </div>
                  <div class="form-group text-dark{{ $errors->has('trailer_url') ? ' has-error' : '' }}">
                    {!! Form::label('trailer_url',__('Trailer URL')) !!}
                    {!! Form::text('trailer_url', null, ['class' => 'form-control','placeholder'=>__('Please Enter Trailer Url')]) !!}
                    <small class="text-danger">{{ $errors->first('trailer_url') }}</small>
                  </div>
                  <div class="form-group text-dark{{ $errors->has('detail') ? ' has-error' : '' }}">
                    {!! Form::label('detail', __('Description')) !!}
                    {!! Form::text('detail', null, ['class' => 'form-control']) !!}
                    <small class="text-danger">{{ $errors->first('detail') }}</small>
                  </div>
                </div>

                <div class="form-group text-dark text-dark ">
                  <button type="reset" class="btn btn-success-rgba"> {{__('Reset')}}</button>
                  <button type="submit" class="btn btn-primary-rgba" id="send_form_actor">{{__('Create')}}</button>
                </div>
                {!! Form::close() !!}
              </div>
              <div class="clear-both"></div>
              <div class="col-lg-12">
                @if(isset($seasons))
                @foreach($seasons as $key => $season)
                  @php
                      $all_languages = App\AudioLanguage::all();
                      // get old audio language values
                      $old_lans = collect();
                      $a_lans = collect();
                      if ($season->a_language != null){
                        $old_list = explode(',', $season->a_language);
                        for ($i = 0; $i < count($old_list); $i++) {
                          $old1 = App\AudioLanguage::find($old_list[$i]);
                          if ( isset($old1) ) {
                            $old_lans->push($old1);
                          }
                        }
                      }
                      $a_lans = $all_languages->diff($old_lans);
                    
      
                  @endphp
                  <div id="editForm{{$season->id}}" class="edit-form">
                    {!! Form::model($season, ['method' => 'PATCH', 'files' => true, 'action' => ['TvSeriesController@update_seasons', $season->id]]) !!}
                    <input type="hidden" name="tvseries" value="{{$tv_series->title}}">
                      <div class="form-group text-dark{{ $errors->has('season_no') ? ' has-error' : '' }}">
                        {!! Form::label('season_no', __('Season No.')) !!}
                        {!! Form::number('season_no', null, ['class' => 'form-control', 'min' => '0']) !!}
                        <small class="text-danger">{{ $errors->first('season_no') }}</small>
                      </div>
                      <div class="form-group text-dark{{ $errors->has('season_slug') ? ' has-error' : '' }}">
                        {!! Form::label('season_slug',__('Season Slug')) !!}
                        {!! Form::text('season_slug', null, ['class' => 'form-control', 'min' => '0']) !!}
                        <small class="text-danger">{{ $errors->first('season_slug') }}</small>
                      </div>
                      {{ Form::hidden('tv_series_id', $id) }}
                      <div class="form-group text-dark{{ $errors->has('a_language') ? ' has-error' : '' }}">
                        {!! Form::label('a_language', __('Audio Languages')) !!}
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
                    
                      <div class="form-group text-dark">
                        <div class="row">
                          <div class="col-md-6">
                            {!! Form::label('', __('Choose Custom Thumbnail And Poster')) !!}
                          </div>
                          <div class="col-md-5 pad-0">
                            <label class="switch for-custom-image">
                              {!! Form::checkbox('', 1, 0, ['class' => 'custom_toggle']) !!}
                              <span class="slider round"></span>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="upload-image-main-block">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group text-dark{{ $errors->has('thumbnail') ? ' has-error' : '' }} input-file-block">
                              {!! Form::label('thumbnail',__('Thumbnail')) !!} 
                              {!! Form::file('thumbnail', ['class' => 'input-file', 'id'=>'thumbnail'.$season->id]) !!}
                              <label for="thumbnail{{$season->id}}" class="btn btn-danger js-labelFile" data-toggle="tooltip" data-original-title="{{isset($season->thumbnail) ? $season->thumbnail :__('Thumbnail')}}">
                                
                                <span class="js-fileName">{{isset($season->thumbnail) ? $season->thumbnail :__('Choose A File')}}</span>
                              </label>
                              <p class="info">{{__('Choose Custom Thumbnail')}}</p>
                              <small class="text-danger">{{ $errors->first('thumbnail') }}</small>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group text-dark{{ $errors->has('poster') ? ' has-error' : '' }} input-file-block">
                              {!! Form::label('poster', __('Poster')) !!} 
                              {!! Form::file('poster', ['class' => 'input-file', 'id'=>'poster'.$season->id]) !!}
                              <label for="poster{{$season->id}}" class="btn btn-danger js-labelFile" data-toggle="tooltip" data-original-title="{{isset($season->poster) ? $season->poster :__('Poster')}}">
                                
                                <span class="js-fileName">{{isset($season->poster) ? $season->poster :__('Choose A File')}}</span>
                              </label>
                              <p class="info">{{__('Choose Custom Poster')}}</p>
                              <small class="text-danger">{{ $errors->first('poster') }}</small>
                            </div>
                          </div>
                        </div>
                      </div>
                      
                      <div class="form-group text-dark{{ $errors->has('is_protect') ? ' has-error' : '' }}">
                        <div class="row">
                          <div class="col-md-6">
                            {!! Form::label('is_protect', __('Protected Video?')) !!}
                          </div>
                          <div class="col-md-5 pad-0">
                            <label class="switch">
                              <input type="checkbox" name="is_protect" {{ $season->is_protect == 1 ? 'checked' : '' }} class="custom_toggle" id="is_protect">
                              <span class="slider round"></span>
                            </label>
                          </div>
                        </div>
                        <div class="col-xs-12">
                          <small class="text-danger">{{ $errors->first('is_protect') }}</small>
                        </div>
                      </div>
                      <div class="mail-password-input search form-group text-dark{{ $errors->has('password') ? ' has-error' : '' }} is_protect" style="{{ $season->is_protect == 1 ? '' : 'display:none' }}">
                        {!! Form::label('password', __('Protected Password For Video')) !!}
                        <input type="password" id="passwordedit" name="password"  class="form-control">
                        <span toggle="#passwordedit" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                        
                      </div>
                      <small class="text-danger">{{ $errors->first('password') }}</small>
      
                      <div class="switch-field">
                        <div class="switch-title">{{__('Want IMDB Ratings And More Or Custom')}}?</div>
                        <input type="radio" id="switch_left{{$season->id}}" class="imdb_btn" name="tmdb" value="Y" {{$season->tmdb == 'Y' ? 'checked' : ''}}/>
                        <label for="switch_left{{$season->id}}" onclick="hide_custom({{$season->id}})">{{__('TMDB')}}</label>
                        <input type="radio" id="switch_right{{$season->id}}" class="custom_btn" name="tmdb" value="N" {{$season->tmdb != 'Y' ? 'checked' : ''}}/>
                        <label for="switch_right{{$season->id}}" onclick="show_custom({{$season->id}})">{{__('Custom')}}</label>
                      </div>
                      <div id="custom_dtl{{$season->id}}" class="custom-dtl">
                        @php
                          // get old actor list
                          $actor_ls = App\Actor::all();
                          $old_actor = collect();
                          if ($season->actor_id != null){
                            $old_list = explode(',', $season->actor_id);
                            for ($i = 0; $i < count($old_list); $i++) {
                              $old3 = App\Actor::find(trim($old_list[$i]));
                              if ( isset($old3) ) {
                                $old_actor->push($old3);
                              }
                            }
                          }
                          $old_actor = $old_actor->filter(function($value, $key) {
                            return  $value != null;
                          });
                          $actor_ls = $actor_ls->diff($old_actor);
      
                        @endphp
      
                        <div class="form-group text-dark{{ $errors->has('actor_id') ? ' has-error' : '' }}">
                            {!! Form::label('actor_id', __('Actors')) !!}
                            <p class="inline info"> 
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
                            </div>
                            <small class="text-danger">{{ $errors->first('actor_id') }}</small>
                        </div>
      
      
                        <div class="form-group text-dark{{ $errors->has('publish_year') ? ' has-error' : '' }}">
                          {!! Form::label('publish_year', __('Publish Year')) !!}
                          {!! Form::number('publish_year', null, ['class' => 'form-control', 'min' => '0']) !!}
                          <small class="text-danger">{{ $errors->first('publish_year') }}</small>
                        </div>
                        <div class="form-group text-dark{{ $errors->has('trailer_url') ? ' has-error' : '' }}">
                          {!! Form::label('trailer_url',__('Traile rURL')) !!}
                          {!! Form::text('trailer_url', null, ['class' => 'form-control','placeholder'=>__('Please Enter Trailer Url')]) !!}
                          <small class="text-danger">{{ $errors->first('trailer_url') }}</small>
                        </div>
                        <div class="form-group text-dark{{ $errors->has('detail') ? ' has-error' : '' }}">
                          {!! Form::label('detail',__('Description')) !!}
                          {!! Form::text('detail', null, ['class' => 'form-control']) !!}
                          <small class="text-danger">{{ $errors->first('detail') }}</small>
                        </div>
                      </div>
                      <div class="form-group text-dark text-dark ">
                        <button type="submit" class="btn btn-primary-rgba" id="send_form_actor">{{__('Update')}}</button>
                      </div>
                      {!! Form::close() !!}
                      <div class="clear-both"></div>
                  </div>
                @endforeach
                @endif
              </div>
            </div>
            

      </div>
    </div>
  </div>
</div>
<div class="col-lg-6 col-xl-6">
    <div class="card m-b-50">
        <div class="card-header">
        </div>
        <div class="card-body table-responsive">
          <table class="table table-hover">
            <thead>
            <tr class="table-heading-row side-table">
              <th>{{__('Thumbnail')}}</th>
              <th>{{__('Season')}}</th>
              <th>{{__('Episodes')}}</th>
              <th>{{__('ByTMDB')}}</th>
              <th>{{__('Actions')}}</th>
            </tr>
            </thead>
            @if ($seasons)
              <tbody>
              @foreach ($seasons as $key => $season)
                <tr>
                  <td>
                    @if ($season->thumbnail != null)
                      <img src="{{ asset('images/tvseries/thumbnails/'.$season->thumbnail) }}" width="45px" class="img-responsive" alt="image">
                     
                    @endif
                  </td>
                  <td>
                    Season {{$season->season_no}}
                  </td>
                  <td>
                    @if (isset($season->episodes) && count($season->episodes) > 0)
                      {{count($season->episodes)}} episodes
                    @else
                      N/A
                    @endif
                  </td> 
                  <td><span class="badge badge-pill badge-success">{!!$season->tmdb == 'Y' ? '<i class="fa fa-check-circle"></i>' : '-'!!}</span></td>
                  <td>
                    <div class="admin-table-action-block side-table-action">
                      @can('tvseries.edit')
                      <button type="button" id="editButton{{$season->id}}" onclick="showForms({{$season->id}})" data-toggle="tooltip" class="btn btn-round btn-outline-primary">
                        <i class="fa fa-pencil"></i>
                      </button>
                      @endcan
                      @can('tvseries.view')
                      <a href="{{route('show_episodes', $season->id)}}" data-toggle="tooltip" data-original-title="{{__('Manage Episodes')}}" class="btn btn-round btn-outline-success"><i class="fa fa-gears"></i></a>
                      @endcan
                      @can('tvseries.delete')
                      <button type="button" data-toggle="modal" data-target="#delete{{$season->id}}" class="btn btn-round btn-outline-danger">
                        <i class="fa fa-trash"></i>
                    </button>
                      @endcan
                    </div>
                  </td>
                </tr>
                
                <!-- Delete Modal -->
                <div id="delete{{$season->id}}" class="delete-modal modal fade" role="dialog">
                  <div class="modal-dialog modal-sm">
                      <!-- Modal content-->
                      <div class="modal-content">
                          <div class="modal-header">
                              <button type="button" class="close"
                                  data-dismiss="modal">&times;</button>
                              <div class="delete-icon"></div>
                          </div>
                          <div class="modal-body text-center">
                              <h4 class="modal-heading">{{__('Are You Sure ?')}}</h4>
                              <p>{{__('Do you really want to delete selected item names here? This
                                  process
                                  cannot be undone.')}}</p>
                          </div>
                          <div class="modal-footer">
                            {!! Form::open(['method' => 'DELETE', 'action' => ['TvSeriesController@destroy_seasons', $season->id]]) !!}
                              <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">{{__('No')}}</button>
                                  <button type="submit" class="btn btn-danger">{{__('Yes')}}</button>
                           {!! Form::close() !!}
                          </div>
                      </div>
                  </div>
              </div>
              @endforeach
              </tbody>
            @endif
          </table>
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
@endsection 
@section('script')
<script>
  $(document).ready(function(){
    $('#createForm').siblings().hide();
    $('.custom-dtl').hide();
    $('.upload-image-main-block').hide();
    $('.subtitle_list').hide();
    $('input[name="subtitle"]').click(function(){
      if($(this).prop("checked") == true){
        $('.subtitle_list').fadeIn();
      }
      else if($(this).prop("checked") == false){
        $('.subtitle_list').fadeOut();
      }
    });
  });

  $('input[name="is_protect"]').click(function(){
    if($(this).prop("checked") == true){
      $('.is_protect').fadeIn();
    }
    else if($(this).prop("checked") == false){
      $('.is_protect').fadeOut();
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
  let showCreateForm = () => {
    $('#createForm').show().siblings().hide();
  };
  let showForms = (id) => {
    let editForm = '#editForm' + id;
    $(editForm).show().siblings().hide();
    var custom_dtl = '#custom_dtl'+id;
    var custom_check = '#switch_right'+id;
    if ($(custom_check).is(':checked')) {
      $(custom_dtl).show();
    }
  };
  let hide_custom = (id) => {
    var custom_dtl = '#custom_dtl'+id;
    $(custom_dtl).hide();
  };
  let show_custom = (id) => {
    var custom_dtl = '#custom_dtl'+id;
    $(custom_dtl).show();
  };
</script>

<script>
   $(document).ready(function() {
var SITEURL = '{{URL::to('')}}';


      $.ajax({
          type: "GET",
          url: SITEURL + "/admin/tvshow/upload_video/converting",
          success: function (data) {
         console.log('Success:',data);
          },
          error: function (data) {
              console.log('Error:', data);
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