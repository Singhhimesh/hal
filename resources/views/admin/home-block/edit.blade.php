@extends('layouts.master')
@section('title',__('Edit Slider'))
@section('breadcum')
	  <div class="breadcrumbbar">
      <h4 class="page-title">{{ __('Edit Promotion') }}</h4>
      <div class="breadcrumb-list">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/admin')}}" title="{{ __('Dashboard') }}">{{ __('Dashboard') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('Edit Promotion') }}</li>
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
    <div class="col-lg-6">
      <div class="card m-b-30">
        <div class="card-header">
          <a href="{{url('admin/home-block')}}" class="float-right btn btn-primary-rgba mr-2" title="{{ __('Back') }}"><i
            class="feather icon-arrow-left mr-2"></i>{{ __('Back') }}</a>
          <h5 class="box-title">{{__('Edit Promotion')}}</h5>
        </div>
        <div class="card-body ml-2">
          {!! Form::model($home_block, ['method' => 'PATCH', 'action' => ['HomeBlockController@update', $home_block->id], 'files' => true]) !!}
            <div class="row">
              <div class="col-md-12">
                <div class="bootstrap-checkbox slide-option-switch form-group text-dark{{ $errors->has('home_block') ? ' has-error' : '' }}">
                  <div class="row">
                    <div class="col-md-7">
                      <h5 class="bootstrap-switch-label">{{__('Promotion For')}}</h5>
                    </div>
                    <div class="col-md-5 pad-0">
                      <div class="make-switch">
                        {!! Form::checkbox('', 1, (isset($movie_dtl) ? 1 : 0), ['class' => 'bootswitch', 'id' => 'TheCheckBox', "data-on-text"=>"Movies", "data-off-text"=>"Tv Series", "data-size"=>"small",]) !!}
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <small class="text-danger">{{ $errors->first('home_block') }}</small>
                  </div>
                </div>
                <div id="movie_id_block" class="form-group text-dark{{ $errors->has('movie_id') ? ' has-error' : '' }}">
                  {!! Form::label('movie_id', __('Select Promotion For Movie')) !!}
                  @if(isset($movie_dtl))
                    {!! Form::select('movie_id', [$movie_dtl->id => $movie_dtl->title] + $movie_list, null, ['class' => 'form-control select2', 'placeholder' => '']) !!}
                  @else
                    {!! Form::select('movie_id', $movie_list, null, ['class' => 'form-control select2', 'placeholder' => '']) !!}
                  @endif
                  <small class="text-danger">{{ $errors->first('movie_id') }}</small>
                </div>
                <div id="tv_series_id_block" class="form-group text-dark{{ $errors->has('tv_series_id') ? ' has-error' : '' }}">
                  {!! Form::label('tv_series_id', __('Select Promotion For TV Series')) !!}
                  <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Select Slide For Tv Show')}}"></i>
                  @if(isset($tv_series_dtl))
                    {!! Form::select('tv_series_id', [$tv_series_dtl->id => $tv_series_dtl->title] + $tv_series_list, null, ['class' => 'form-control select2', 'placeholder' => '']) !!}
                  @else
                    {!! Form::select('tv_series_id', $tv_series_list, null, ['class' => 'form-control select2', 'placeholder' => '']) !!}
                  @endif
                  <small class="text-danger">{{ $errors->first('tv_series_id') }}</small>
                </div>
                <div class="form-group text-dark{{ $errors->has('is_active') ? ' has-error' : '' }}">
                  <div class="row">
                    <div class="col-md-3">
                      {!! Form::label('is_active', __('Active')) !!}
                    </div>
                    <div class="col-md-5 pad-0">
                      <label class="switch">
                        {!! Form::checkbox('is_active', 1, $home_block->is_active, ['class' => 'custom_toggle']) !!}
                        <span class="slider round"></span>
                      </label>
                    </div>
                  </div>
                  <div class="col-xs-12">
                    <small class="text-danger">{{ $errors->first('series') }}</small>
                  </div>
                </div>
              </div>
                <div class="form-group">
                  <button type="reset" class="btn btn-success-rgba" title="{{ __('Reset') }}">{{__('Reset')}}</button>
                  <button type="submit" class="btn btn-primary-rgba" title="{{ __('Update') }}"><i class="fa fa-check-circle"></i>
                    {{ __('Update') }}</button>
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
    @if(isset($movie_dtl))
      $('#tv_series_id_block').hide();
    @elseif(isset($tv_series_dtl))
      $('#movie_id_block').hide();  
    @endif

    $('#TheCheckBox').on('switchChange.bootstrapSwitch', function (event, state) {

        if (state == true) {

          $('#tv_series_id').val("");
          $('#tv_series_id_block').hide();
          $('#movie_id_block').show();

        } else if (state == false) {

          $('#tv_series_id_block').show();
          $('#movie_id').val("");
          $('#movie_id_block').hide(); 

        };

    });
   
  });
</script>
@endsection