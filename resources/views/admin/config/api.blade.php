@extends('layouts.master')
@section('title', __('API Settings'))
@section('breadcum')
<div class="breadcrumbbar">
    <h4 class="page-title">{{ __('API Settings') }}</h4>
    <div class="breadcrumb-list">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('/admin')}}" title="{{ __('Dashboard') }}">{{ __('Dashboard') }}</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ __('API Settings') }}</li>
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
          <h5 class="box-title">{{__('API Settings')}}</h5>
        </div>
        <div class="card-body ml-2">
          {!! Form::model($env_files, ['method' => 'POST', 'action' => 'ConfigController@changeEnvKeys']) !!}
<div class="row">

<!-- ======= Video Fetch API start ========== -->
<div class="col-md-6 col-lg-6 col-xl-12">
  <div class="bg-info-rgba ml-6 mr-6 mb-6">
    <div class="card-header text-dark"><h4><i class="feather icon-Settings" aria-hidden="true"></i> {{__('Video Fetch API Settings')}}</h4></div>
        <div class="row mx-2 my-4">
            <div class="col-md-6">
                <div class="form-group{{ $errors->has('YOUTUBE_API_KEY') ? ' has-error' : '' }}">
                    {!! Form::label('YOUTUBE_API_KEY', __('YouTube API KEY')) !!}
                    <small class="badge badge-pill badge-secondary" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="{{ __('YouTube API key is required if you want to fetch and interact with YouTube videos.')}}">
                              <i class="fa fa-info"></i>
                    </small>
                    {!! Form::text('YOUTUBE_API_KEY',null, ['class' => 'form-control', 'placeholder' => __('Please Enter YouTube API KEY')]) !!}
                    <small class="text-danger">{{ $errors->first('YOUTUBE_API_KEY') }}</small>
                </div>                
            </div>
            <div class="col-md-6">
              <div class="form-group{{ $errors->has('VIMEO_ACCESS') ? ' has-error' : '' }}">
                  {!! Form::label('VIMEO_ACCESS', __('Vimeo API KEY')) !!}
                  <small class="badge badge-pill badge-secondary" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="{{ __('Vimeo API key is required if you want to fetch and interact with Vimeo videos.')}}">
                              <i class="fa fa-info"></i>
                    </small>
                  {!! Form::text('VIMEO_ACCESS',null, ['class' => 'form-control', 'placeholder' => __('Please Enter Vimeo API KEY')]) !!}
                  <small class="text-danger">{{ $errors->first('VIMEO_ACCESS') }}</small>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ======= Video Fetch API end ========== -->
<!-- ======= reCAPTCHA Settings start ========== -->
<div class="col-md-6 col-lg-6 col-xl-12">
    <div class="bg-info-rgba ml-6 mr-6 mb-6">
        <div class="card-header text-dark"><h4><i class="feather icon-Settings" aria-hidden="true"></i> {{__('reCAPTCHA Credentials')}}<a target="__blank" title="{{__('Get Your reCAPTCHA v2 Keys From Here')}}" class="pull-right text-info" href="https://www.google.com/recaptcha/admin/create"><i class="fa fa-key"></i> {{__('Get Your reCAPTCHA v2 Keys From Here')}}</a></h4></div>
            <div class="payment-gateway-block">
                <div class="form-group">
                    <div class="row mx-2 my-4">
                        <div class="col-md-3">
                            {!! Form::label('captcha', __('Enable reCAPTCHA')) !!} 
                            <small class="badge badge-pill badge-secondary" data-toggle="tooltip" data-placement="right" title="" data-original-title="{{ __('reCAPTCHA is a security measure developed by Google that uses a combination of machine learning and advanced risk analysis algorithms to distinguish humans from bots. It is designed to protect websites from spam and abuse by requiring users to prove that they are not bots. reCAPTCHA can be implemented on web pages using a simple API, which displays a challenge to users, such as identifying objects in images or solving math problems, to verify their identity. reCAPTCHA is used to protect against spam, fraud, and other malicious activity. It is important to keep the secret key secure and not share it with others to prevent unauthorized use of the CAPTCHA.')}}">
                              <i class="fa fa-info"></i>
                            </small>
                        </div>
                        <div class="col-md-2">
                            <label class="switch">
                                {!! Form::checkbox('captcha', 1, $config->captcha, ['class' => 'custom_toggle']) !!}
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row mx-2 my-4" style="{{ $config->captcha==1 ? "" : "display: none" }}" id="captcha_box">
                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('NOCAPTCHA_SITEKEY') ? ' has-error' : '' }}">
                            <label class="text-dark">{{ __('CAPTCHA SITEKEY') }} <sup class="text-danger">*</sup>

                            </label>
                            {!! Form::text('NOCAPTCHA_SITEKEY', null, ['class' => 'form-control', 'placeholder' => __('Please Enter CAPTCHA SITEKEY')]) !!}
                            <small class="text-danger">{{ $errors->first('NOCAPTCHA_SITEKEY') }}</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="search form-group{{ $errors->has('NOCAPTCHA_SECRET') ? ' has-error' : '' }}">
                            <label class="text-dark">{{ __('CAPTCHA SECRET KEY') }} <sup class="text-danger">*</sup>

                            </label>
                            <input class ="form-control" type="text" placeholder="{{ __('Please Enter CAPTCHA SECRET KEY') }}" name="NOCAPTCHA_SECRET" id="captcha-password-field" @if(isset( $env_files['NOCAPTCHA_SECRET'])) value="{{ $env_files['NOCAPTCHA_SECRET'] }}" @endif>
                            <small class="text-danger">{{ $errors->first('NOCAPTCHA_SECRET') }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- ======= Vimeo Api end ========== -->

  <!-- ======= OTHER APIS  start ========== -->
<div class="col-md-6 col-lg-6 col-xl-12">
    <div class="bg-primary ml-6 mr-6 mb-6">
      <div class="card-header text-white"><h4 class="text-white"><i class="feather icon-Settings" aria-hidden="true"></i> {{__('OTHER APIS')}}</h4></div>
  </div>
</div>

<div class="col-md-6 col-lg-6 col-xl-12">
    <div class="bg-info-rgba ml-6 mr-6 mb-6">
            <div class="payment-gateway-block">
                </div>
                <div class="row mx-2 my-4" >
                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('MAILCHIMP_APIKEY') ? ' has-error' : '' }}">
                            <label class="text-dark">{{ __('MAILCHIMP API KEY') }}</label>
                             <small class="badge badge-pill badge-secondary" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{ __('Mailchimp is an email marketing platform that allows users to design, send, and track email campaigns. It provides a range of features and tools to help businesses and organizations grow their audience, engage their customers, and drive more sales.')}}">
                              <i class="fa fa-info"></i>
                            </small>
                            <input type="text" id="mailc" value="{{ $env_files['MAILCHIMP_APIKEY'] }}" name="MAILCHIMP_APIKEY" class="form-control" placeholder="{{ __('Please Enter Mailchimp Api Key')}}">
                            <small class="text-danger">{{ $errors->first('MAILCHIMP_APIKEY') }}</small>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="search form-group{{ $errors->has('MAILCHIMP_LIST_ID') ? ' has-error' : '' }}">
                            <label class="text-dark">{{ __('MAILCHIMP LIST ID') }}</label>
                            <small class="badge badge-pill badge-secondary" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="{{ __('The Mailchimp list ID is a unique identifier for a specific mailing list within a Mailchimp account. It is a combination of letters and numbers, usually in the format xxxxxxxxxx and can be found in the list settings section of your Mailchimp account.')}}">
                              <i class="fa fa-info"></i>
                            </small>
                            {!! Form::text('MAILCHIMP_LIST_ID', null, ['class' => 'form-control', 'placeholder' => __('Please Enter Mailchimp List ID')]) !!}
                            <small class="text-danger">{{ $errors->first('MAILCHIMP_LIST_ID') }}</small>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="search form-group{{ $errors->has('TMDB_API_KEY') ? ' has-error' : '' }}">
                            <label class="text-dark">{{ __('TMDB API KEY') }}</label> 
                            <small class="badge badge-pill badge-secondary" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{ __('TMDB (The Movie Database) is a popular online database for movies, TV shows, and other related content. It contains information about a wide range of movies, including details about their cast and crew, plot summaries, ratings, and reviews.  TMDB also provides APIs that allow developers to access its data and integrate it into their applications. This allows developers to build applications that provide movie recommendations, display movie information, and much more.')}}">
                              <i class="fa fa-info"></i>
                            </small>
                            <input type="text" id="tmdb_secret" name="TMDB_API_KEY" value="{{ $env_files['TMDB_API_KEY'] }}" id="tmdb_secret" class="form-control" placeholder="{{ __('Please Enter TMDB Api Key')}}">
                            <small class="text-danger">{{ $errors->first('TMDB_API_KEY') }}</small>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
<!-- ======= OTHER APIS end ========== -->
  <div class="col-md-6 col-lg-6 col-xl-12 form-group">
    <button type="submit" class="btn btn-primary-rgba" title="{{ __('Save') }}"><i class="fa fa-check-circle"></i>
      {{ __('Save') }}</button>
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
  $(".toggle-password").click(function() {

    $(this).toggleClass("fa-eye fa-eye-slash");
    var input = $($(this).attr("toggle"));
    if (input.attr("type") == "password") {
      input.attr("type", "text");
    } else {
      input.attr("type", "password");
    }
  }); 

  $(".toggle-password2").click(function() {
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
  $('#stripe_payment').on('change',function(){
    if ($('#stripe_payment').is(':checked')){
         $('#stripe_box').show('fast');
      }else{
        $('#stripe_box').hide('fast');
      }
  });  

  $('#razorpay_payment').on('change',function(){
    if ($('#razorpay_payment').is(':checked')){
         $('#razorpay_box').show('fast');
      }else{
        $('#razorpay_box').hide('fast');
      }
  });   

  $('#paypal_payment').on('change',function(){
    if ($('#paypal_payment').is(':checked')){
         $('#paypal_box').show('fast');
      }else{
        $('#paypal_box').hide('fast');
      }
  });   

  $('#payu_payment').on('change',function(){
    if ($('#payu_payment').is(':checked')){
         $('#payu_box').show('fast');
      }else{
        $('#payu_box').hide('fast');
      }
  }); 

  $('#bankdetails').on('change',function(){
    if ($('#bankdetails').is(':checked')){
         $('#bank_box').show('fast');
      }else{
        $('#bank_box').hide('fast');
      }
  }); 
    

  $('#paytm_check').on('change',function(){
    if ($('#paytm_check').is(':checked')){
         $('#paytm_box').show('fast');
      }else{
        $('#paytm_box').hide('fast');
      }
  }); 

  $('#braintree_check').on('change',function(){
    if ($('#braintree_check').is(':checked')){
         $('#braintree_box').show('fast');
      }else{
        $('#braintree_box').hide('fast');
      }
  }); 
   $('#paystack_check').on('change',function(){
    if ($('#paystack_check').is(':checked')){
         $('#paystack_box').show('fast');
      }else{
        $('#paystack_box').hide('fast');
      }
  }); 

  $('#payhere_check').on('change',function(){
    if ($('#payhere_check').is(':checked')){
         $('#payhere_box').show('fast');
      }else{
        $('#payhere_box').hide('fast');
      }
  }); 

  $('#instamojo_check').on('change',function(){
    if ($('#instamojo_check').is(':checked')){
         $('#instamojo_box').show('fast');
      }else{
        $('#instamojo_box').hide('fast');
      }
  });

  $('#mollie_check').on('change',function(){
    if ($('#mollie_check').is(':checked')){
         $('#mollie_box').show('fast');
      }else{
        $('#mollie_box').hide('fast');
      }
  });

  $('#cashfree_check').on('change',function(){
    if ($('#cashfree_check').is(':checked')){
         $('#cashfree_box').show('fast');
      }else{
        $('#cashfree_box').hide('fast');
      }
  });

  $('#omise_check').on('change',function(){
    if ($('#omise_check').is(':checked')){
         $('#omise_box').show('fast');
      }else{
        $('#omise_box').hide('fast');
      }
  }); 

  $('#flutter_check').on('change',function(){
    if ($('#flutter_check').is(':checked')){
         $('#flutterave_box').show('fast');
      }else{
        $('#flutterave_box').hide('fast');
      }
  });     

  $('#coinpay_check').on('change',function(){
    if ($('#coinpay_check').is(':checked')){
         $('#coinpay_box').show('fast');
      }else{
        $('#coinpay_box').hide('fast');
      }
  });  

  $('#aws').on('change',function(){
    if ($('#aws').is(':checked')){
         $('#aws_box').show('fast');
      }else{
        $('#aws_box').hide('fast');
      }
  });  
  $('#captcha').on('change',function(){
    if ($('#captcha').is(':checked')){
         $('#captcha_box').show('fast');
      }else{
        $('#captcha_box').hide('fast');
      }
  });   
</script>
<script>
  (function($){
    $.noConflict();    
  })(jQuery);    
</script>  


@endsection