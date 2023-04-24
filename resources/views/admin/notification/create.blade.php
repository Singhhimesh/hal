@extends('layouts.master')
@section('title',__('Create Notification'))
@section('breadcum')
	<div class="breadcrumbbar">
    <h4 class="page-title">{{ __('Create Notification') }}</h4>
    <div class="breadcrumb-list">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('/admin')}}" title="{{ __('Dashboard') }}">{{ __('Dashboard') }}</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ __('Create Notification') }}</li>
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
      <div class="card m-b-30">
        <div class="card-header">
          <a href="{{url('/admin')}}" class="float-right btn btn-primary-rgba mr-2" title="{{ __('Back') }}"><i
              class="feather icon-arrow-left mr-2"></i>{{ __('Back') }}</a>
          <h5 class="box-title">{{__('Create Notification')}}</h5>
        </div>
        <div class="card-body ml-2">
          {!! Form::open(['method' => 'POST', 'action' => 'NotificationController@store']) !!}
            <div class="row">
              <div class="col-md-3">
                <div class="form-group text-dark{{ $errors->has('title') ? ' has-error' : '' }}">
                  {!! Form::label('title', __('Notification Title')) !!} <sup class="text-danger">*</sup>
                  {!! Form::text('title', null, ['class' => 'form-control', 'required' => 'required']) !!}
                  <small class="text-danger">{{ $errors->first('title') }}</small>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group text-dark{{ $errors->has('description') ? ' has-error' : '' }}">
                  {!! Form::label('description', __('Notification Description')) !!} <sup class="text-danger">*</sup>
                  {!! Form::text('description', null, ['class' => 'form-control', 'required' => 'required']) !!}
                  <small class="text-danger">{{ $errors->first('description') }}</small>
                </div>
              </div>
              <div class="col-md-3">
                @php
                  $movie=App\Movie::orderBy('created_at', 'desc')->get();;
                @endphp
                <div class="form-group text-dark{{ $errors->has('movie_id') ? ' has-error' : '' }}">
                  {!! Form::label('movie_id', __('Select Movie')) !!}
                    <select class="form-control select2" name="movie_id" >
                      <option value="">{{__('Please Select')}}</option>
                        @foreach($movie as $movies)
                          <option value="{{$movies->id}}" name="{{$movies->id}}">{{$movies->title}}</option>
                        @endforeach
                    </select>
                    <small class="text-danger">{{ $errors->first('movie_id') }}</small>
                </div>
              </div>
              <div class="col-md-3">
                @php
                  $livetv=App\Movie::orderBy('created_at', 'desc')->where('live',1)->get();;
                @endphp
                <div class="form-group text-dark{{ $errors->has('livetv') ? ' has-error' : '' }}">
                  {!! Form::label('livetv', __('Select Live Event')) !!}
                    <select class="form-control select2" name="livetv">
                      <option value="">{{__('Please Select')}}</option>
                        @foreach($livetv as $movies)
                          <option value="{{$movies->id}}" name="{{$movies->id}}">{{$movies->title}}</option>
                        @endforeach
                    </select>
                    <small class="text-danger">{{ $errors->first('livetv') }}</small>
                </div>  
              </div>
              <div class="col-md-3">
                @php
                $tv=App\TvSeries::orderBy('created_at', 'desc')->get();
                @endphp
                <div class="form-group text-dark{{ $errors->has('tv_id') ? ' has-error' : '' }}">
                  {!! Form::label('tv_id', __('Select TV Series')) !!}
                    <select class="form-control select2" name="tv_id">
                      <option value="">{{__('Please Select')}}</option>
                        @foreach($tv as $tvs)
                          @php
                            $seasons=App\Season::where('tv_series_id',$tvs->id)->first();
                          @endphp
                          @if(isset($seasons) )
                            <option value="{{$seasons->id}}" name="{{$seasons->id}}">{{$tvs->title}}</option>
                          @endif
                         @endforeach
                    </select>
                    <small class="text-danger">{{ $errors->first('tv_id') }}</small>
                </div>
              </div>
              <div class="col-md-6">
                @php
                  $user=App\User::all();
                @endphp
                <div class="form-group text-dark{{ $errors->has('user_id') ? ' has-error' : '' }}">
                  {!! Form::label('user_id', __('Select Users')) !!}<sup class="text-danger">*</sup>
                    <select class="form-control select2" name="user_id[]" multiple="true" required="true">
                      <option value="0">{{__('All Users')}}</option>
                        @foreach($user as $users)
                          <option value="{{$users->id}}">{{$users->name}}</option>
                        @endforeach
                    </select>
                    <small class="text-danger">{{ $errors->first('user_id') }}</small>
                </div>
              </div>
            </div>
              <div class="form-group text-dark">
                <button type="reset" class="btn btn-success-rgba" title="{{__('Reset')}}">{{__('Reset')}}</button>
                <button type="submit" class="btn btn-primary-rgba" title="{{ __('Create') }}"><i class="fa fa-check-circle"></i> {{ __('Create') }}</button>
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
 
</script>


    
@endsection