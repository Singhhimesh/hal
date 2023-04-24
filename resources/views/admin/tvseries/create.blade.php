@extends('layouts.master')
@section('title',__('Create Tv Series'))
@section('breadcum')
	<div class="breadcrumbbar">
    <h4 class="page-title">{{ __('HOME') }}</h4>
    <div class="breadcrumb-list">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/admin')}}">{{ __('Dashboard') }}</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ __('Create Tv Series') }}</li>
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
          <a href="{{url('admin/tvseries')}}" class="float-right btn btn-primary-rgba mr-2"><i
            class="feather icon-arrow-left mr-2"></i>{{ __('Back') }}</a>
          <h5 class="box-title">{{__('Create Tv Series')}}</h5>
        </div>
        <div class="card-body ml-2">
          {!! Form::open(['method' => 'POST', 'action' => 'TvSeriesController@store', 'files' => true]) !!}
            <div class="bg-info-rgba p-4 mb-4 rounded">
              <div class="row">
                <div class="col-lg-4 col-md-4">
                  <label for="" class="text-dark">{{__('Search Tv Series By Title')}} :</label>
                  <br>
                  <label class="switch">
                    <input type="checkbox" name="tv_by_id" checked="" class="custom_toggle" id="tv_id">
                    <span class="slider round"></span>
                  </label>
                </div>
                <div class="col-lg-4 col-md-4">
                  <div id="tv_title" class="form-group text-dark{{ $errors->has('title') ? ' has-error' : '' }}">
                    {!! Form::label('title', __('Series Title')) !!}
                    {!! Form::text('title', null, ['class' => 'form-control', 'autofocus', 'placeholder'=> __('Enter Tvseries Title')]) !!}
                    <small class="text-danger">{{ $errors->first('title') }}</small>
                  </div>
                  <div id="tvs_id" style="display: none;" class="form-group text-dark{{ $errors->has('title2') ? ' has-error' : '' }}">
                    {!! Form::label('title',__('Tv Series ID')) !!}
                    {!! Form::text('title2', null, ['class' => 'form-control', 'placeholder' => __('Please Enter TVID (TMDBID)')]) !!}
                    <small class="text-danger">{{ $errors->first('title2') }}</small>
                  </div>
                </div>
                <div class="col-lg-4 col-md-4">
                  <div class="form-group text-dark{{ $errors->has('maturity_rating') ? ' has-error' : '' }}">
                    {!! Form::label('maturity_rating',__('Maturity Rating')) !!}
                    {!! Form::select('maturity_rating', array('all age' =>__('All Age'), '18+' =>'18+', '16+' => '16+', '13+'=>'13+','10+' =>'10+', '8+' => '8+', '5+'=>'5+','2+'=>'2+'), null, ['class' => 'form-control select2']) !!}
                    <small class="text-danger">{{ $errors->first('maturity_rating') }}</small>
                  </div>
                </div>
                <div class="col-lg-4 col-md-4">
                  <!-- country start -->
                    <div class="form-group text-dark">
                      <label>{{ __('Country') }}: </label>
                      <select class="form-control select2" name="country[]" multiple="multiple">
                        @foreach($countries as $country)
                            <option >{{ $country->name }}</option>
                        @endforeach
                      </select>
                      <small class="text-info"><i class="fa fa-question-circle"></i> ({{ __('Select those countries where you want to block Movies')}} )</small>
                    </div>
                  <!-- country end -->
                </div>
                <div class="col-lg-4 col-md-4">
                  <div class="form-group text-dark">
                    <label for="">{{__('Meta Keyword')}}: </label>
                    <input name="keyword" type="text" class="form-control" data-role="tagsinput"/>
                  </div>
                </div>  
                <div class="col-lg-12 col-md-12">
                  <div class="form-group text-dark">
                    <label for="">{{__('Meta Description')}}: </label>
                    <textarea name="description" id="" cols="30" rows="5" class="form-control"></textarea>
                  </div>
                </div>
              </div>
            </div>
            <div class="bg-info-rgba p-4 mb-4 rounded">
              <div class="row">
                <div class="col-lg-4 col-md-5">
                  <div class="form-group text-dark{{ $errors->has('is_custom_label') ? ' has-error' : '' }}">
                    {!! Form::label('is_custom_label',__('Allow Custom Label ?')) !!}
                    <br>
                    <label class="switch">
                      <input type="checkbox" name="is_custom_label" class="custom_toggle" id="is_custom_label">
                      <span class="slider round"></span>
                    </label>
                    <div class="col-xs-12">
                      <small class="text-danger">{{ $errors->first('is_custom_label') }}</small>
                    </div>
                  </div>
                  <div id="label_box" style="display:none" class="form-group text-dark{{ $errors->has('label_id') ? ' has-error' : '' }}">
                    {!! Form::label('label_id', __('Custom Label')) !!}
                    <select name="label_id" id="" class="select2 form-control">
                      @foreach($labels as $label)
                      <option value="{{$label->id}}">{{$label->name}}</option>
                      @endforeach
                    </select>
                    <small class="text-danger">{{ $errors->first('label_id') }}</small>
                  </div>
                </div>
                <div class="col-lg-4 col-md-3">
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
                <div class="col-lg-4 col-md-4">
                  @if($button->kids_mode==1)
                  <div class="form-group text-dark{{ $errors->has('is_kids') ? ' has-error' : '' }}">
                      {!! Form::label('is_kids',__('Only for kids?')) !!}
                      <br>
                      <label class="switch">
                        {!! Form::checkbox('is_kids', 1, 0, ['class' => 'custom_toggle' ,'id' => 'kids_mode']) !!}
                        <span class="slider round"></span>
                      </label>
                    <div class="col-xs-12">
                      <small class="text-danger">{{ $errors->first('is_kids') }}</small>
                    </div>
                  </div>
                  @endif
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
                <div class="col-lg-8 col-md-8"> 
                  <div class="form-group text-dark">
                    {!! Form::label('', __('Choose Custom Thumbnail And Poster')) !!}
                    <br>
                    <label class="switch for-custom-image">
                      {!! Form::checkbox('', 1, 0, ['class' => 'custom_toggle']) !!}
                      <span class="slider round"></span>
                    </label>
                  </div>
                  <div class="upload-image-main-block">
                    {{-- <form method="post" enctype="multipart/form-data" id="mainform"></form> --}}
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
                      <!-- <div class="col-md-6">
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
                        <div class="form-group text-dark{{ $errors->has('poster') ? ' has-error' : '' }} input-file-block">
                          {!! Form::label('poster', __('Poster')) !!} 
                          {!! Form::file('poster', ['class' => 'input-file', 'id'=>'poster']) !!}
                          <label for="poster" class="btn btn-danger js-labelFile" data-toggle="tooltip" data-original-title="{{__('Poster')}}">
                          
                            <span class="js-fileName">{{__('Choose A File')}}</span>
                          </label>
                          <p class="info">{{__('Choose Custom Poster')}}</p>
                          <small class="text-danger">{{ $errors->first('poster') }}</small>
                        </div>
                      </div> -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="bg-info-rgba p-4 mb-4 rounded">
              <div class="row">
                <div class="col-lg-12 col-md-12">
                  <div class="switch-field">
                    <div class="switch-title">{{__('Want IMDB Ratings And More Or Custom')}}?</div>
                    <input type="radio" id="switch_left" class="imdb_btn" name="tmdb" value="Y" checked/>
                    <label for="switch_left">{{__('TMDB')}}</label>
                    <input type="radio" id="switch_right" class="custom_btn" name="tmdb" value="N" />
                    <label for="switch_right">{{__('Custom')}}</label>
                  </div>
                  <div id="custom_dtl" class="custom-dtl">
                    <div class="row">
                      <div class="col-lg-6 col-md-6">
                        <div class="form-group text-dark{{ $errors->has('genre_id') ? ' has-error' : '' }}">
                          {!! Form::label('genre_id', __('Genre')) !!}
                          {!! Form::select('genre_id[]', $genre_ls, null, ['class' => 'form-control select2', 'multiple']) !!}
                          <small class="text-danger">{{ $errors->first('genre_id') }}</small>
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6">
                        <div class="form-group text-dark{{ $errors->has('rating') ? ' has-error' : '' }}">
                          {!! Form::label('rating', __('Ratings')) !!}
                          {!! Form::text('rating', null, ['class' => 'form-control']) !!}
                          <small class="text-danger">{{ $errors->first('rating') }}</small>
                        </div>
                      </div>
                      <div class="col-lg-12 col-md-12">
                        <div class="form-group text-dark{{ $errors->has('detail') ? ' has-error' : '' }}">
                          {!! Form::label('detail',__('Description')) !!}
                          {!! Form::textarea('detail', null, ['class' => 'form-control materialize-textarea', 'rows' => '5']) !!}
                          <small class="text-danger">{{ $errors->first('detail') }}</small>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- <div class="menu-block  kids_mode_show" style="display: none;">
            </div> -->
            <div class="row">
              <div class="col-lg-12">
                <div class="form-group text-dark ">
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
</div>
@endsection 
@section('script')
<script>

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
</script>

 <script>
  $('#tv_id').on('change',function(){
    if ($('#tv_id').is(':checked')){
      $('#tv_title').show('fast');
      $('#tvs_id').hide('fast');
    }else{
       $('#tvs_id').show('fast');
      $('#tv_title').hide('fast');
    }
  });

  $('#kids_mode').on('change',function(){
    if ($('#kids_mode').is(':checked')){
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
  

   $('input[name="is_custom_label"]').click(function(){
    if($(this).prop("checked") == true){
      $('#label_box').show();
    }
    else if($(this).prop("checked") == false){
      $('#label_box').hide();
    }
  });

</script>  
@endsection