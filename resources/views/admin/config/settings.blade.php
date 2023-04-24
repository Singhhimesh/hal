@extends('layouts.master')
@section('title', __('General Settings'))
@section('breadcum')
	 <div class="breadcrumbbar">
        <h4 class="page-title">{{ __('General Settings') }}</h4>
        <div class="breadcrumb-list">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{url('/admin')}}" title="{{ __('Dashboard') }}">{{ __('Dashboard') }}</a></li>
              <li class="breadcrumb-item active" aria-current="page">{{ __('General Settings') }}</li>
            </ol>
        </div>   
    </div>
@endsection
@section('maincontent')
<div class="contentbar">
    <div class="col-md-12 col-lg-12 col-xl-12">
        <div class="card m-b-30">
            <div class="card-body">
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-GenralSetting" role="tabpanel" aria-labelledby="pills-home-tab">
                      @if ($config)
{!! Form::model($config, ['method' => 'PATCH', 'action' => ['ConfigController@update', $config->id], 'files' => true]) !!}
<div class="row">
  <div class="col-md-2">
    <div class="form-group text-dark{{ $errors->has('title') ? ' has-error' : '' }}">
        {!! Form::label('title', __('Project Title')) !!} <sup class="text-danger">*</sup>
        {!! Form::text('title', null, ['id' => 'pr', 'onkeyup' => 'sync()', 'class' => 'form-control']) !!}
        <small class="text-danger">{{ $errors->first('title') }}</small>
    </div>
  </div>
<!-- ============ Project Title end =========================-->
<!-- ============ APP URL start =============================-->
  <div class="col-md-3">
    <div class="form-group text-dark {{ $errors->has('APP_URL') ? ' has-error' : '' }}">
        {!! Form::label('APP_URL',  __('Website URL')) !!} <sup class="text-danger">*</sup>
        <input type="text" name="APP_URL" value="{{ $env_files['APP_URL'] }}" class="form-control" placeholder="{{ __('https://yourdomain.com/public') }}" />
        <small class="text-danger">{{ $errors->first('w_name') }}</small>
    </div>
  </div>
<!-- ============ APP URL end =============================-->
<!-- ============ w_email start =============================-->
  <div class="col-md-3">
    <div class="form-group text-dark{{ $errors->has('w_email') ? ' has-error' : '' }}">
        {!! Form::label('w_email', __('Default Email')) !!} <sup class="text-danger">*</sup>
        {!! Form::email('w_email', null, ['class' => 'form-control', 'placeholder' => 'eg: mail@yourdomain.com']) !!}
        <small class="text-danger">{{ $errors->first('w_email') }}</small>
    </div>
  </div>
<!-- ============ w_email end =============================-->
<!-- ============ Currency Code start =============================-->
  <div class="col-md-2">
    <div class="form-group text-dark{{ $errors->has('currency_code') ? ' has-error' : '' }}">
        {!! Form::label('currency_code', __('Currency Code')) !!}  <sup class="text-danger">*</sup>
        {!! Form::text('currency_code', null, ['class' => 'form-control']) !!}
        <small class="text-danger">{{ $errors->first('currency_code') }}</small>
    </div>
  </div>
<!-- ============ Currency Code end =============================-->
<!-- ============ Currency Symbol Text start ==================-->
  <div class="col-md-2">
    <div class="form-group text-dark{{ $errors->has('currency_symbol') ? ' has-error' : '' }} currency-symbol-block">
      {!! Form::label('currency_symbol', __('Currency Symbol')) !!}
      <div class="input-group">
        {!! Form::text('currency_symbol', null, ['class' => 'form-control currency-icon-picker']) !!}
        <span class="input-group-addon simple-input"><i class="glyphicon glyphicon-user"></i></span>
      </div>
      <small class="text-danger">{{ $errors->first('currency_symbol') }}</small>
    </div>
  </div>
<!-- ============ Currency Symbol Text end ==================-->
  <div class="col-md-4">
    <div class="form-group text-dark{{ $errors->has('invoice_add') ? ' has-error' : '' }}">
        {!! Form::label('invoice_add', __('Invoice Address')) !!}
        {!! Form::text('invoice_add', null, ['class' => 'form-control']) !!}
        <small class="text-danger">{{ $errors->first('invoice_add') }}</small>
    </div>
  </div>

  <div class="col-md-4">
    <div class="row">
        <div class="col-md-8">
          <div class="form-group text-dark{{ $errors->has('logo') ? ' has-error' : '' }} input-file-block">
            {!! Form::label('logo', __('Logo')) !!}
            <small class="badge badge-pill badge-secondary" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{__('Use .png or .jpg format file. Size')}}: 200 x 63PX">
              <i class="fa fa-info"></i>
            </small>
              <div class="input-group">
                <input type="text" class="form-control" id="logo" name="logo">
                <span class="input-group-addon midia-toggle" data-input="logo">{{__('Choose A File')}}</span>
              </div>
          </div>
        </div>
        <div class="col-md-4 m-t-60">
          <img src="{{asset('images/logo/' . $config->logo)}}" class="img-fluid bg-primary-rgba px-2 py-1" />
        </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="row mb-4">
        <div class="col-md-9">
            <div class="form-group text-dark{{ $errors->has('favicon') ? ' has-error' : '' }} input-file-block">
                {!! Form::label('favicon',__('Favicon Icon')) !!}  
                <small class="badge badge-pill badge-secondary" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{__('Use .png or .jpg format file. Size')}}: 64 x 64PX">
              <i class="fa fa-info"></i>
            </small>
                <div class="input-group">
                  <input type="text" class="form-control" id="favicon" name="favicon">
                  <span class="input-group-addon midia-toggle-favicon" data-input="favicon">{{__('Choose A File')}}</span>
                </div>
              </div>
          </div>
          <div class="col-md-3 m-t-30">
            @if($image = @file_get_contents(public_path().'/images/favicon/'.$setting->favicon))
            <img src="{{asset('images/favicon/' . $config->favicon)}}" class="logo_img img-fluid bg-primary-rgba py-1 px-2" />
            @endif
          </div>
      </div>
  </div>

<!-- ============ Preloader logo start =========================== -->
  <div class="form-group col-md-4">
    <div class="row">
      <div class="col-md-9">
        <div class="form-group text-dark{{ $errors->has('preloader_img') ? ' has-error' : '' }} input-file-block">
          {!! Form::label('preloader_img',__('Proloader Logo')) !!}
            <small class="badge badge-pill badge-secondary" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{__('Use .png or .jpg format file. Size')}}: 200 x 63PX">
              <i class="fa fa-info"></i>
            </small>
          <div class="input-group">
            <input type="text" class="form-control" id="preloder" name="preloader_img">
            <span class="input-group-addon midia-toggle-preloder" data-input="preloder">{{__('Choose A File')}}</span>
          </div>
        </div>
      </div>
      <div class="col-md-3 m-t-40">
        <img src="{{url('images/' . $config->preloader_img)}}" class="img-fluid bg-primary-rgba py-1 px-2" />
      </div>
    </div>
  </div>

  <div class="form-group col-md-4">
    <div class="row">
      <div class="col-md-9">
        <div class="form-group text-dark{{ $errors->has('livetvicon') ? ' has-error' : '' }} input-file-block">
          {!! Form::label('livetvicon', __('Live TV Icon')) !!}
            <small class="badge badge-pill badge-secondary" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{__('Use .png or .jpg format file. Size')}}: 101 x 42PX">
              <i class="fa fa-info"></i>
            </small>
            <div class="input-group">
              <input type="text" class="form-control" id="livetvicon" name="livetvicon" >
              <span class="input-group-addon midia-toggle-livetv" data-input="livetvicon">{{__('Choose A File')}}</span>
            </div>
          </div>
        </div>
        <div class="col-md-3 m-t-40">
          <img src="{{asset('images/livetvicon/' . $config->livetvicon)}}" class="logo_img img-fluid bg-primary-rgba py-2 px-3" width="100px" height="100px" />
        </div>
    </div>
  </div>

<!-- ============ App link Start =========================== -->
  <div class="col-md-6 col-lg-6 col-xl-12 mb-4">
    <div class="bg-info-rgba ml-6 mr-6 mb-6">
      <div class="card-header text-dark"><h4><i class="feather icon-smartphone" aria-hidden="true"></i> {{__('Mobile App Download')}}</h4></div>
      <div class="row mx-2 my-4">
        <div class="col-md-2">
          <div class="form-group">
            <label class="text-dark" for="status">{{ __('iOS Store') }}</label>
            <br>
            {!! Form::checkbox('is_appstore', 1, ($config->is_appstore == '1' ? 1 : 0), ['class' => 'custom_toggle appstore', 'onChange' =>'isappstore()']) !!}
          </div>
        </div>

        <div class="col-md-4">
          <div id="appstore_link" style="{{ $config->is_appstore=='1' ? "" : "display: none" }}" class="custom_toggle-checkbox form-group{{ $errors->has('appstore') ? ' has-error' : '' }}">
            <label class="text-dark">{{ __('URL') }} <sup class="text-danger">*</sup></label>
            {!! Form::text('appstore', null, ['class' => 'form-control', 'placeholder' => __('Please Enter iOS URL')]) !!} 
            <div class="invalid-feedback">
                {{ __('Please Enter Link !') }}.
            </div>
          </div>
        </div>

        <div class="col-md-2">
          <div class="form-group">
            <label class="text-dark">{{ __('Play Store') }}</label><br>
            {!! Form::checkbox('is_playstore', 1, ($config->is_playstore == '1' ? 1 : 0), ['class' => 'custom_toggle playstore', 'onChange' =>'isplaystore()']) !!}
          </div>
        </div>

        <div class="col-md-4">
          <div id="playstore_link" style="{{ $config->is_playstore=='1' ? "" : "display: none" }}"class="custom_toggle-checkbox form-group{{ $errors->has('playstore') ? ' has-error' : '' }}">
            <label class="text-dark">{{ __('URL') }} <sup class="text-danger">*</sup></label>
            {!! Form::text('playstore', null, ['class' => 'form-control', 'placeholder' => __('Please Enter Playstore URL')]) !!} 
            <div class="invalid-feedback">
                {{ __('Please Enter Link !') }}.
            </div>
          </div>
        </div>

        <div class="col-md-2">
          <div class="form-group">
            <label class="text-dark">{{ __('IP Block') }}</label><br>
            {!! Form::checkbox('ip_block', 1, ($button->ip_block == '1' ? 1 : 0), ['class' => 'custom_toggle ip_block', 'onChange' =>'isipblock()']) !!}
          </div>
        </div>

        <div class="col-md-4">
          <div id="ip_block_link" style="{{ $button->ip_block=='1' ? "" : "display: none" }}"class="custom_toggle-checkbox form-group{{ $errors->has('ipblock_ip') ? ' has-error' : '' }}">
            <label class="text-dark">{{ __('Blocked IPS:') }} <sup class="text-danger">*</sup></label>
            <select class="form-control select2" name="block_ips[]" multiple="multiple">
              @if(isset($button->block_ips))
                @foreach($button->block_ips as $block_ip)
                <option value="{{$block_ip}}" @if(isset($block_ip))selected="" @endif>{{$block_ip}}</option>
                @endforeach
              @endif
            </select>
          </div>
        </div>

        <div class="col-md-2">
          <div class="custom_toggle-checkbox form-group{{ $errors->has('donation') ? ' has-error' : '' }}">
            <label class="text-dark">{{ __('Donation') }}: </label><br>
            {!! Form::checkbox('donation', 1, ($config->donation == '1' ? 1 : 0), ['class' => 'custom_toggle donate', 'onChange' =>'isdonation()']) !!}
          </div>
        </div>

        <div class="col-md-4">
          <div id="donation_link"  style="{{ $config->donation=='1' ? "" : "display: none" }}" class="custom_toggle-checkbox form-group{{ $errors->has('donation_link') ? ' has-error' : '' }}">
            <label class="text-dark">{{ __('Donation URL') }} <sup class="text-danger">*</sup></label>
            {!! Form::text('donation_link', null, ['class' => 'form-control', 'placeholder' => __('Please Enter Donation URL')]) !!}
            <small>{{ __('Get Donation link by register on ') }}<a target="__blank" href="https://www.paypal.com/in/webapps/mpp/paypal-me" title="PayPal.me"> PayPal.me</a></small>
            <div class="invalid-feedback">
                {{ __('Please Enter Doanation URL !') }}.
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
<!-- ============ App link end =========================== -->
  <div class="col-md-6 col-lg-6 col-xl-12 mb-4">
    <div class="bg-info-rgba ml-6 mr-6 mb-6">
      <div class="card-header text-dark"><h4><i class="feather icon-server" aria-hidden="true"></i> {{__('General Settings')}}</h4></div>
      <div class="row mx-2 my-4">
        <div class="col-md-6">
          <div class="bootstrap-checkbox form-group{{ $errors->has('comming_soon') ? ' has-error' : '' }}">
            <label class="text-dark" for="promo_enable">{{ __('Comming Soon') }}</label><br>
            {!! Form::checkbox('comming_soon', 1, ($button->comming_soon == '1' ? 1 : 0), ['class' => 'custom_toggle comming_soon', 'onChange' =>'iscommingsoon()']) !!}
          </div>
        

          <div class="row custom_toggle-checkbox form-group{{ $errors->has('commingsoon_enabled_ip') ? ' has-error' : '' }}" id="comming_soon_link" style="{{ $config->comming_soon=='1' ? "" : "display: none" }}">
            <div class="col-md-6">
              <label for="promo_text">{{ __('Coming Soon Enabled IPs') }}:</label>
              <select class="form-control select2" name="commingsoon_enabled_ip[]" multiple="multiple">
                @if(isset($button->commingsoon_enabled_ip) &&  $button->commingsoon_enabled_ip != NULL)
                @foreach($button->commingsoon_enabled_ip as $enable_ip)
                <option value="{{$enable_ip}}" @if(isset($enable_ip))selected="" @endif>{{$enable_ip}}</option>
                @endforeach
                @endif
              </select>
            </div>
            <div class="col-md-6">
              <small class="text-danger">{{ $errors->first('comming_soon_text') }}</small>
                <label for="promo_link">{{ __('Coming Soon Text') }}: <sup class="text-danger">*</sup></label>
                <input class ="form-control" type="text" name="comming_soon_text" value="">
            </div>
          </div>
        </div>    
    
        <div class="col-md-2">
          <div class="custom_toggle-checkbox form-group{{ $errors->has('is_toprated') ? ' has-error' : '' }}">
            <label class="text-dark" for="status">{{ __('Top Rated Section') }}</label>
            <br>
            {!! Form::checkbox('is_toprated', 1, ($button->is_toprated == '1' ? 1 : 0), ['class' => 'custom_toggle is_toprated', 'onChange' =>'isToprated()']) !!}
          </div>
          <div id="toprated_box"  style="{{ $button->is_toprated =='1' ? "" : "display: none" }}" class="custom_toggle-checkbox form-group{{ $errors->has('toprated_count') ? ' has-error' : '' }}">
            <label class="text-dark">{{ __('TopRated Count') }}</label>
            {!! Form::text('toprated_count', isset($button->toprated_count) ? $button->toprated_count : NULL , ['class' => 'form-control']) !!}
            <div class="col-md-12">
              <small class="text-danger">{{ $errors->first('toprated_count') }}</small>
            </div>
          </div>
        </div>

        <div class="col-md-2">
          <div class="custom_toggle-checkbox form-group{{ $errors->has('free_sub') ? ' has-error' : '' }}">
            <label class="text-dark">{{ __('Free Trial Days') }}</label><br>
            {!! Form::checkbox('free_sub', 1, ($config->free_sub == '1' ? 1 : 0), ['class' => 'custom_toggle free_sub', 'onChange' =>'isfree()']) !!}
          </div>
          <div id="free_days" style="{{ $config->free_sub=='1' ? "" : "display: none" }}"class="custom_toggle-checkbox  free_days form-group{{ $errors->has('free_days') ? ' has-error' : '' }}">
            <label class="text-dark">{{ __('Enter Days') }}</label>
            {!! Form::text('free_days', null, ['class' => 'form-control']) !!}
            <div class="col-md-12">
              <small class="text-danger">{{ $errors->first('free_days') }}</small>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-6 col-lg-6 col-xl-12">
    <div class="bg-info-rgba ml-6 mr-6 mb-6">
      <div class="card-header text-dark"><h4><i class="feather icon-Settings" aria-hidden="true"></i> {{__('Miscellaneous Settings')}}</h4></div>
      <!-- ======= Donation link end ========== -->
    <!-- ======= section 1 start ========== -->
    <div class="row mx-2 my-4">
      <div class="col-md-3">
        <div class="custom_toggle-checkbox form-group{{ $errors->has('goto') ? ' has-error' : '' }}">
          <label class="text-dark">{{ __('Go To Top') }} :</label><br>
          {!! Form::checkbox('goto', 1, ($button->goto == 1 ? 1 : 0), ['class' => 'custom_toggle']) !!}
        </div>
        <div class="col-md-3">
          <small class="text-danger">{{ $errors->first('goto') }}</small>
        </div>
      </div>
  
      <div class="col-md-3">
        <div class="custom_toggle-checkbox form-group{{ $errors->has('wel_eml') ? ' has-error' : '' }}">
          @if(env('MAIL_DRIVER') != NULL && env('MAIL_HOST') != NULL && env('MAIL_PORT'))
            <label class="text-dark">{{ __('Welcome Email') }} :
              <small class="badge badge-pill badge-secondary" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{ __('Welcome Email For New Users. Before Enable please fill mail settings otherwise get error message on sigunp or registration. Make sure you updated your mail setting in Site Setting -> Mail Settings before enable it.')}}">
              <i class="fa fa-info"></i>
            </small></label><br>
            <input type="checkbox" name="wel_eml" {{ $config->wel_eml == 1 ? "checked" : "" }} class='custom_toggle' >
          </div>
          @endif
        </div>
        <div class="col-md-3">
          <div class="custom_toggle-checkbox form-group{{ $errors->has('verify_email') ? ' has-error' : '' }}">
            <label class="text-dark">{{ __('Verify Email') }} :
              <small class="badge badge-pill badge-secondary" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{ __('Verify Email Address For New Signup or Registration. Before Enable please fill mail settings otherwise get error message on sigunp or registration. Make sure you updated your mail setting in Site Setting -> Mail Settings before enable it.')}}">
              <i class="fa fa-info"></i>
            </small></label><br>
            <input type="checkbox" name="verify_email" {{ $config->verify_email == 1 ? "checked" : "" }} class='custom_toggle' >
            <div>
              
            </div>
          </div>
        </div>
  
        <div class="col-md-3">
          <div class="custom_toggle-checkbox form-group{{ $errors->has('two_factor') ? ' has-error' : '' }}">
            <label class="text-dark">{{ __('Two Factor') }} :</label><br>
              {!! Form::checkbox('two_factor', null, ($button->two_factor == 1 ? 1 : 0), ['class' => 'custom_toggle']) !!}
          </div>
          <div class="col-md-12">
            <small class="text-danger">{{ $errors->first('two_factor') }}</small>
          </div>
        </div>
    </div>
  <!-- ======= section 1 end ========== -->

  <!-- ======= section 2 start ========== -->
  <div class="row mx-2 my-4">
  <div class="col-md-3">
    <div class="custom_toggle-checkbox form-group{{ $errors->has('blog') ? ' has-error' : '' }}">
          <label class="text-dark">{{ __('Blog') }} : </label><br>
          {!! Form::checkbox('blog', null, ($config->blog == 1 ? 1 : 0), ['class' => 'custom_toggle']) !!}
          <div class="col-md-12">
            <small class="text-danger">{{ $errors->first('blog') }}</small>
          </div>
      </div>
  </div>

  <div class="col-md-3">
    <div class="custom_toggle-checkbox form-group{{ $errors->has('age_restriction') ? ' has-error' : '' }}">
          <label class="text-dark">{{ __('Age Restriction') }} : 
            <small class="badge badge-pill badge-secondary" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{ __('Age Restriction will be taken from Maturity Rating in Movies and TV Series.')}}">
              <i class="fa fa-info"></i>
            </small> </label><br>
          {!! Form::checkbox('age_restriction', 1, ($config->age_restriction == '1' ? 1 : 0), ['class' => 'custom_toggle']) !!}
          <div>          
          </div>
      </div>
  </div>

  <div class="col-md-3">
    <div class="custom_toggle-checkbox form-group{{ $errors->has('user_rating') ? ' has-error' : '' }}">
          <label class="text-dark">{{ __('Ratings') }}: </label><br>
          {!! Form::checkbox('user_rating', 1, ($config->user_rating == '1' ? 1 : 0), ['class' => 'custom_toggle ']) !!}
      </div>
  </div>

  <div class="col-md-3">
    <div class="custom_toggle-checkbox form-group{{ $errors->has('protip') ? ' has-error' : '' }}">
          <label class="text-dark">{{ __('Protip') }} :</label><br>
          {!! Form::checkbox('protip', 1, ($button->protip == 1 ? 1 : 0), ['class' => 'custom_toggle']) !!}
      </div>
      <div class="col-md-12">
        <small class="text-danger">{{ $errors->first('protip') }}</small>
      </div>
  </div>

</div>

<!-- ======= section 2 end ========== -->
<!-- ======= section 3 start ========== -->
<div class="row mx-2 my-4">
  <div class="col-md-3">
    <div class="custom_toggle-checkbox form-group{{ $errors->has('download') ? ' has-error' : '' }}">
          <label class="text-dark">{{ __('Download Video') }} :  
            <small class="badge badge-pill badge-secondary" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{ __('This option is Available only if you Upload Video at your hosting.')}}">
              <i class="fa fa-info"></i>
            </small></label><br>
          {!! Form::checkbox('download', 1, ($config->download == '1' ? 1 : 0), ['class' => 'custom_toggle download']) !!}
          <div>
          </div>
      </div>
  </div>

  <div class="col-md-3">
    <div class="custom_toggle-checkbox form-group{{ $errors->has('multiplescreen') ? ' has-error' : '' }}">
          <label class="text-dark">{{ __('Multiple Screen') }} :</label><br>
          {!! Form::checkbox('multiplescreen', 1, ($button->multiplescreen == '1' ? 1 : 0), ['class' => 'custom_toggle download']) !!}
      </div>
  </div>

  <div class="col-md-3">
    <div class="custom_toggle-checkbox form-group{{ $errors->has('aws') ? ' has-error' : '' }}">
          <label class="text-dark">{{ __('AWS') }} :</label><br>
          {!! Form::checkbox('aws', null, ($config->aws == 1 ? 1 : 0), ['class' => 'custom_toggle']) !!}
      </div>
      <div class="col-md-12">
        <small class="text-danger">{{ $errors->first('aws') }}</small>
      </div>
  </div>
  <div class="col-md-3">
    <div class="bootstrap-checkbox form-group{{ $errors->has('countviews') ? ' has-error' : '' }}">
          <label class="text-dark">{{ __('Count Views On') }} :</label><br>
          {!! Form::checkbox('countviews', 1, ($button->countviews == 1 ? 1 : 0), ['class' => 'custom_toggle']) !!}
      </div>
      <div class="col-md-12">
        <small class="text-danger">{{ $errors->first('countviews') }}</small>
      </div>
  </div>

</div>

<!-- ======= section 3 end ========== -->
<!-- ======= section 4 start ========== -->
<div class="row mx-2 my-4">
<div class="col-md-3">
  <div class="custom_toggle-checkbox form-group{{ $errors->has('remove_thumbnail') ? ' has-error' : '' }}">
        <label class="text-dark">{{ __('Remove Thumbnail on Detail page') }} :</label><br>
        {!! Form::checkbox('remove_thumbnail', null, ($button->remove_thumbnail == 1 ? 1 : 0), ['class' => 'custom_toggle']) !!}
    </div>
    <div class="col-md-12">
      <small class="text-danger">{{ $errors->first('remove_thumbnail') }}</small>
    </div>
</div>

  <div class="col-md-3">
    <div class="custom_toggle-checkbox form-group{{ $errors->has('remove_subscription') ? ' has-error' : '' }}">
          <label class="text-dark">{{ __('Remove Packages On Landing Page') }} :</label><br>
          {!! Form::checkbox('remove_subscription', 1, ($button->remove_subscription == 1 ? 1 : 0), ['class' => 'custom_toggle']) !!}
      </div>
      <div class="col-md-12">
        <small class="text-danger">{{ $errors->first('remove_subscription') }}</small>
      </div>
  </div>

  <div class="col-md-3">
    <div class="custom_toggle-checkbox form-group{{ $errors->has('remove_landing_page') ? ' has-error' : '' }}">
      @php
      $mymenu=App\Menu::first();
      @endphp
      @if(isset($mymenu))
          <label class="text-dark">{{ __('Remove Landing Page') }} :</label><br>
          {!! Form::checkbox('remove_landing_page', 1, ($config->remove_landing_page == 1 ? 1 : 0), ['class' => 'custom_toggle']) !!}
    </div>
    @else
    <div class="row">
      <small>({{__('Remove Landing PageNote')}})</small>
    </div>
    @endif
    <div class="col-md-12">
      <small class="text-danger">{{ $errors->first('remove_landing_page') }}</small>
    </div>
  </div>

  <div class="col-md-3">
    <div class="custom_toggle-checkbox form-group{{ $errors->has('remove_ads') ? ' has-error' : '' }}">
          <label class="text-dark">{{ __('Remove Ads') }} :</label><br>
          {!! Form::checkbox('remove_ads', 1, ($button->remove_ads == 1 ? 1 : 0), ['class' => 'custom_toggle']) !!}
    </div>
    <div class="col-md-12">
      <small class="text-danger">{{ $errors->first('remove_ads') }}</small>
    </div>
  </div>
</div>
<!-- ======= section 4 end ========== -->
<!-- ======= section 5 start ========== -->

<div class="row mx-2 my-4">
  <div class="col-md-3">
    <div class="custom_toggle-checkbox form-group{{ $errors->has('preloader') ? ' has-error' : '' }}">
          <label class="text-dark">{{ __('Preloader') }} :</label><br>
          {!! Form::checkbox('preloader', 1, ($config->preloader == 1 ? 1 : 0), ['class' => 'custom_toggle']) !!}
    </div>
    <div class="col-md-12">
      <small class="text-danger">{{ $errors->first('preloader') }}</small>
    </div>
  </div>

  <div class="col-md-3">
    <div class="custom_toggle-checkbox form-group{{ $errors->has('inspect') ? ' has-error' : '' }}">
          <label class="text-dark">{{ __('Inspect Element') }} :</label><br>
          {!! Form::checkbox('inspect', 1, ($button->inspect == 1 ? 1 : 0), ['class' => 'custom_toggle']) !!}
    </div>
    <div class="col-md-12">
      <small class="text-danger">{{ $errors->first('inspect') }}</small>
    </div>
  </div>

  <div class="col-md-3 d-none">
    <div class="custom_toggle-checkbox form-group{{ $errors->has('reminder_mail') ? ' has-error' : '' }}">
          <label class="text-dark">{{ __('Reminder Mail') }} : </label><br>
          {!! Form::checkbox('reminder_mail', null, ($button->reminder_mail == 1 ? 1 : 0), ['class' => 'custom_toggle']) !!}
    </div>
    <div class="col-md-12">
      <small class="text-danger">{{ $errors->first('reminder_mail') }}</small>
    </div>
  </div>

  <div class="col-md-3">
    <div class="custom_toggle-checkbox form-group{{ $errors->has('catlog') ? ' has-error' : '' }}">
          <label class="text-dark">{{ __('Catalog View') }} :</label><br>
          {!! Form::checkbox('catlog', 1, ($config->catlog == 1 ? 1 : 0), ['class' => 'custom_toggle checkk', 'onChange' =>'withoutlogin()']) !!}
          <div>
              <small>{{ __('(Allow user to Access website without Subscription, but can not Play Video. Login Required.)') }}</small>
          </div>
      </div>
      <div class="col-md-12">
        <small class="text-danger">{{ $errors->first('catlog') }}</small>
      </div>
  </div>

  <div class="col-md-3">
    <div id="withoutlogin" style="{{ $config->catlog=='1' ? "" : "display: none" }}" class="custom_toggle-checkbox form-group{{ $errors->has('withlogin') ? ' has-error' : '' }}">
          <label class="text-dark">{{ __('Without Login') }} :</label><br>
          {!! Form::checkbox('withlogin', 1, ($config->withlogin == 1 ? 1 : 0), ['class' => 'custom_toggle']) !!}
          <div>
              <small>{{ __('(Allow user to Access website without Subscription and Without Login, but can not Play Video)') }}</small>
          </div>
      </div>
      <div class="col-md-12">
        <small class="text-danger">{{ $errors->first('withlogin') }}</small>
      </div>
  </div>
</div>
<!-- ======= section 5 end ========== -->
<!-- ======= section 6 start ========== -->
<div class="row mx-2 my-4">
  <div class="col-md-3">
    <div class="custom_toggle-checkbox form-group{{ $errors->has('uc_browser') ? ' has-error' : '' }}">
          <label class="text-dark">{{ __('UC Browser Block') }} : </label><br>
          {!! Form::checkbox('uc_browser', 1, ($button->uc_browser == 1 ? 1 : 0), ['class' => 'custom_toggle']) !!}
          <div class="col-md-12">
            <small class="text-danger">{{ $errors->first('uc_browser') }}</small>
          </div>
      </div>
  </div>

  <div class="col-md-3">
    <div class="custom_toggle-checkbox form-group{{ $errors->has('APP_DEBUG') ? ' has-error' : '' }}">
          <label class="text-dark">{{ __('Debug Mode') }} : </label><br>
          <input type="checkbox" {{env('APP_DEBUG') == true ? "checked" : ""}} name="APP_DEBUG" class="custom_toggle" >
      </div>
      <div class="col-md-12">
        <small class="text-danger">{{ $errors->first('APP_DEBUG') }}</small>
      </div>
  </div>

  <div class="col-md-3">
    <div class="custom_toggle-checkbox form-group{{ $errors->has('comments') ? ' has-error' : '' }}">
          <label class="text-dark">{{ __('Video Comments') }}: </label><br>
          {!! Form::checkbox('comments', 1, ($config->comments == '1' ? 1 : 0), ['class' => 'custom_toggle iscomment','onChange' =>'isComment()']) !!}
      </div>
  </div>

  <div class="col-md-3">
    <div class="bootstrap-checkbox comment_box form-group{{ $errors->has('comments_approval') ? ' has-error' : '' }}" style="{{$config->comments == '1' ? '' : 'display: none'}}">
          <label class="text-dark">{{ __('Comment Approval') }} :</label><br>
          {!! Form::checkbox('comments_approval', 1, ($config->comments_approval == '1' ? 1 : 0), ['class' => 'custom_toggle ']) !!}
      </div>
  </div>

</div>

<!-- ======= section 6 end ========== -->
<!-- ======= section 7 start ========== -->
<div class="row mx-2 my-4">
  <div class="col-md-3">
    <div class="custom_toggle-checkbox form-group{{ $errors->has('rightclick') ? ' has-error' : '' }}">
          <label class="text-dark">{{ __('Right Click') }} : </label><br>
          {!! Form::checkbox('rightclick', 1, ($button->rightclick == 1 ? 1 : 0), ['class' => 'custom_toggle']) !!}
      </div>
      <div class="col-md-12">
        <small class="text-danger">{{ $errors->first('rightclick') }}</small>
      </div>
  </div>

  <div class="col-md-3">
    <div class="custom_toggle-checkbox form-group{{ $errors->has('kids_mode') ? ' has-error' : '' }}">
          <label class="text-dark">{{ __('Kids Mode') }} : </label><br>
          {!! Form::checkbox('kids_mode', null, ($button->kids_mode == 1 ? 1 : 0), ['class' => 'custom_toggle']) !!}
      </div>
      <div class="col-md-12">
        <small class="text-danger">{{ $errors->first('kids_mode') }}</small>
      </div>
  </div>

  <div class="col-md-3">
    <div class="custom_toggle-checkbox form-group{{ $errors->has('movie_request') ? ' has-error' : '' }}">
          <label class="text-dark">{{ __('Movie Request') }} : </label><br>
          {!! Form::checkbox('movie_request', null, ($button->movie_request == 1 ? 1 : 0), ['class' => 'custom_toggle']) !!}
      </div>
      <div class="col-md-12">
        <small class="text-danger">{{ $errors->first('movie_request') }}</small>
      </div>
  </div>

</div>

<!-- ======= section 7 end ========== -->
  </div>
</div>

<!-- ======= section layout start ========== -->
<div class="col-md-6 col-lg-6 col-xl-12">
  <div class="bg-info-rgba ml-6 mr-6 mb-6">
    <div class="card-header text-dark"><h4><i class="feather icon-Settings" aria-hidden="true"></i> {{__('Layout One/Two')}}</h4></div>
  <div class="row mx-2 my-4">
    <div class="col-md-4">
      <div class="custom_toggle-checkbox form-group{{ $errors->has('prime_genre_slider') ? ' has-error' : '' }}">
        <label class="text-dark">{{ __('Genre Slider Type') }} :</label><br>
        {!! Form::checkbox('prime_genre_slider', 1, ($config->prime_genre_slider == '1' ? 1 : 0), ['class' => 'custom_toggle']) !!}
      </div>
      <div class="col-md-4">
        <small class="text-danger">{{ $errors->first('prime_genre_slider') }}</small>
      </div>
    </div>

    <div class="col-md-4">
      <div class="custom_toggle-checkbox form-group{{ $errors->has('prime_movie_single') ? ' has-error' : '' }}">
        <label class="text-dark">{{ __('Movie Single Type') }} :</label><br>
        {!! Form::checkbox('prime_movie_single', 1, ($config->prime_movie_single == '1' ? 1 : 0), ['class' => 'custom_toggle']) !!}
      </div>
      <div class="col-md-4">
        <small class="text-danger">{{ $errors->first('prime_movie_single') }}</small>
      </div>
    </div>

    <div class="col-md-4">
      <div class="custom_toggle-checkbox form-group{{ $errors->has('prime_footer') ? ' has-error' : '' }}">
        <label class="text-dark">{{ __('Footer Type') }} :</label><br>
        {!! Form::checkbox('prime_footer', 1, ($config->prime_footer == '1' ? 1 : 0), ['class' => 'custom_toggle']) !!}
      </div>
      <div class="col-md-12">
        <small class="text-danger">{{ $errors->first('prime_footer') }}</small>
      </div>
    </div>
      
  </div>
  </div>
</div>
<!-- ======= section layout end ========== -->

<div class="col-md-6 col-lg-6 col-xl-12 form-group">
  <button type="submit" class="btn btn-primary-rgba"><i class="fa fa-check-circle"></i>
    {{ __('Update') }}</button>
</div>
</div>
{!! Form::close() !!}
@endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<script type="text/javascript">
  function sync()
  {
    var n1 = document.getElementById('pr');
    var n2 = document.getElementById('pr2');
    n2.value = n1.value;
  }


</script>

<script type="text/javascript">
  function withoutlogin()
  {
    if($('.checkk').is(":checked"))   
      $("#withoutlogin").show();
    else
      $("#withoutlogin").hide();
  }

</script>
<script type="text/javascript">
  function isdonation()
  {
    if($('.donate').is(":checked"))   
      $("#donation_link").show();
    else
      $("#donation_link").hide();
  }

</script>
<script type="text/javascript">
  function isplaystore()
  {
    if($('.playstore').is(":checked"))   
      $("#playstore_link").show();
    else
      $("#playstore_link").hide();
  }

</script>
<script type="text/javascript">
  function isappstore()
  {
    if($('.appstore').is(":checked"))   
      $("#appstore_link").show();
    else
      $("#appstore_link").hide();
  }

</script>
<script type="text/javascript">
  function isfree()
  {
    if($('.free_sub').is(":checked"))   
      $("#free_days").show();
    else
      $("#free_days").hide();
  }

</script>

<!---------- comming soon --------->
<script type="text/javascript">
  function iscommingsoon()
  {
    if($('.comming_soon').is(":checked"))   
      $("#comming_soon_link").show();
    else
      $("#comming_soon_link").hide();
  }

</script>
<!------------- end comming soon ----->

<!---------- Ip Block --------->
<script type="text/javascript">
  function isipblock()
  {
    if($('.ip_block').is(":checked"))   
      $("#ip_block_link").show();
    else
      $("#ip_block_link").hide();
  }

</script>
<!------------- end ip_block ----->

<!---------- maintenance --------->
<script type="text/javascript">
  function ismaintenance()
  {
    if($('.maintenance').is(":checked"))   
      $("#maintenance_link").show();
    else
      $("#maintenance_link").hide();
  }

</script>
<!------------- end maintenance ----->

<!---------- comment --------->
<script type="text/javascript">
  function isComment()
  {
    if($('.iscomment').is(":checked"))   
      $(".comment_box").show();
    else
      $(".comment_box").hide();
  }

</script>
<!------------- end comment ----->

<script type="text/javascript">
  function isToprated()
  {
    if($('.is_toprated').is(":checked")) 
      $("#toprated_box").show();
    else
      $("#toprated_box").hide();
  }

</script>

<script>
  (function($){
    jQuery.noConflict();
    $(".midia-toggle").midia({
      base_url: '{{url('')}}',
      dropzone : {
            acceptedFiles: '.jpg,.png,.jpeg,.webp,.bmp,.gif'
          },
      directory_name: 'logo',
	  });
    $(".midia-toggle-favicon").midia({
      base_url: '{{url('')}}',
      dropzone : {
            acceptedFiles: '.jpg,.png,.jpeg,.webp,.bmp,.gif'
          },
      directory_name: 'favicon'
    });
    $(".midia-toggle-livetv").midia({
      base_url: '{{url('')}}',
      dropzone : {
            acceptedFiles: '.jpg,.png,.jpeg,.webp,.bmp,.gif'
          },
      directory_name: 'livetvicon'
    });
    $(".midia-toggle-preloder").midia({
      base_url: '{{url('')}}',
      dropzone : {
            acceptedFiles: '.jpg,.png,.jpeg,.webp,.bmp,.gif'
          },
      directory_name: 'preloader'
    });
  })(jQuery);
  
</script> 

@endsection