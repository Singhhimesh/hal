@extends('layouts.master')
@section('title', __('Seo Settings'))
@section('breadcum')
<div class="breadcrumbbar">
    <h4 class="page-title">{{ __('SEO Settings') }}</h4>
    <div class="breadcrumb-list">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('/admin')}}" title="{{ __('Dashboard') }}">{{ __('Dashboard') }}</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ __('SEO Settings') }}</li>
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
          <h5 class="box-title">{{__('SEO Settings')}}</h5>
        </div>
        <div class="card-body ml-2">
          @if ($seo)
          {!! Form::model($seo, ['method' => 'PATCH', 'action' => ['SeoController@update', $seo->id], 'files' => true]) !!}
          <div class="row">
            <div class="col-md-6">
              <div class="form-group text-dark{{ $errors->has('description') ? ' has-error' : '' }}">
                {!! Form::label('author',__('Author Name')) !!}
                {!! Form::text('author', null, ['placeholder' => __('EnterAuthorName'),'id' => 'textbox', 'class' => 'form-control']) !!}
                <small class="text-danger">{{ $errors->first('author') }}</small>
              </div>
            </div>
            <div class="col-md-6"></div>
            <div class="col-md-6">
              <div class="form-group text-dark{{ $errors->has('description') ? ' has-error' : '' }}">
                {!! Form::label('description', __('Metadata Description')) !!}
                {!! Form::textarea('description', null, ['id' => 'textbox', 'class' => 'form-control']) !!}
                <small class="text-danger">{{ $errors->first('description') }}</small>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group text-dark{{ $errors->has('keyword') ? ' has-error' : '' }}">
                {!! Form::label('keyword', __('Metadata Keyword')) !!}
                {!! Form::textarea('keyword', null, ['placeholder' => __('Keyword Placeholder'),'id' => 'textbox', 'class' => 'form-control']) !!}
                <small class="text-danger">{{ $errors->first('keyword') }}</small>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group text-dark{{ $errors->has('google') ? ' has-error' : '' }}">
                {!! Form::label('google',__('Google Analytics')) !!}
                {!! Form::text('google', null, ['class' => 'form-control']) !!}
                <small class="text-danger">{{ $errors->first('google') }}</small>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group text-dark{{ $errors->has('fb') ? ' has-error' : '' }}">
                {!! Form::label('fb', __('Facebook Pixcal')) !!}
                {!! Form::text('fb', null, ['id' => 'textbox1', 'class' => 'form-control']) !!}
                <small class="text-danger">{{ $errors->first('fb') }}</small>
              </div>
            </div>
              </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary-rgba" title="{{ __('Save') }}"><i class="fa fa-check-circle"></i> {{ __('Save') }}</button>
            </div>

          {!! Form::close() !!}
        @endif
        <div class="clear-both">
        </div>

      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-12">
    <div class="card m-b-30">
      <div class="card-body ml-2">
        <div class="card-body bg-success-rgba">
          <div class="row align-items-center">
            <div class="col-12">
              <h5 class="text-success process-fonts"><i class="fa fa-info-circle"></i> {{ __('Site Map Generate') }}</h5>
                
                <br>
                <a href="{{ url('/sitemap') }}" class="btn btn-primary-rgba" title="{{ __('Generate') }}">{{ __('Generate') }}</a>
                @if(@file_get_contents(public_path().'/sitemap.xml'))
                  <a href="{{ url('/sitemap/download') }}" class="btn btn-primary-rgba" data-toggle="tooltip" data-original-title="{{__('download sitemap.xml')}}" title="{{__('download sitemap.xml')}}"><i class="material-icons">download </i>{{__('sitemap.xml')}}</a>
                  |
                  <a href="{{ url('/sitemap.xml') }}" class="btn btn-primary-rgba" data-toggle="tooltip" data-original-title="{{__('view sitemap')}}"><i class="material-icons">visibility</i>{{__('Sitemap')}}</a>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

  

@endsection 
@section('script')
<script>
  $(function () {
    CKEDITOR.replace('editor1');
  });
</script>
@endsection