@extends('layouts.master')
@section('title', __('App Settings'))
@section('breadcum')
<div class="breadcrumbbar">
    <h4 class="page-title">{{ __('Mobile App Settings') }}</h4>
    <div class="breadcrumb-list">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('/admin')}}" title="{{ __('Dashboard') }}">{{ __('Dashboard') }}</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ __('Mobile App Settings') }}</li>
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
          <h5 class="box-title">{{__('Mobile App Settings')}}</h5>
        </div>
        <div>
        <div class="card-body ml-2 app-settings-page">
          <form action="{{ route('apikey.create') }}" method="POST">
          @csrf
            <div class="col-md-6 col-lg-6 col-xl-12">
              <div class="bg-info-rgba ml-6 mr-6 mb-6">
                <div class="card-header text-dark"><h5 class="mb-0 "><i class="feather icon-settings"></i> {{__('GENERATE SECRET KEY FOR API')}}</h5></div>
                  <div class="payment-gateway-block">
                    <div class="row mx-2 my-4 pb-3">
                      <div class="col-md-6">
                        <div class="form-group text-dark{{ $errors->has('generate_apikey') ? ' has-error' : '' }}">
                          {!! Form::label('generate_apikey',__('Client Secret KEY')) !!}   
                          <small class="badge badge-pill badge-secondary" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{ __('A Client Secret KEY usefull for deploy mobile app or use api anywhere. A client secret key is a confidential string used by a client application to authenticate itself to an API service. It is important to keep the client secret key confidential, as it can be used to impersonate the client application and gain unauthorized access to user data. If you change key old key api will stop.')}}">
                            <i class="fa fa-info"></i>
                          </small>                  
                          {!! Form::text('generate_apikey', $appconfig->generate_apikey, ['class' => 'form-control']) !!}

                          <span toggle="#generate_apikey" class="fa fa-fw field-icon toggle-password fa-eye-slash"></span>
                          <small class="text-danger">{{ $errors->first('generate_apikey') }}</small>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="search form-group text-dark{{ $errors->has('purchase_code') ? ' has-error' : '' }}">
                          {!! Form::label('purchase_code', __('Purchase Code')) !!} <sup class="text-danger">*</sup> 
                          <small class="badge badge-pill badge-secondary" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{ __('Enter your purchase code to generat Client Secret KEY')}}">
                            <i class="fa fa-info"></i>
                          </small>                  
                          <input type="password" value="{{ old('purchase_code') }}" name="purchase_code" id="purchase_code-field" class="form-control" placeholder="Enter your purchase code">
                          <span toggle="#purchase_code-field" class="fa fa-fw field-icon toggle-password fa-eye-slash"></span>
                          <small class="text-danger">{{ $errors->first('purchase_code') }}</small>
                        </div>
                      </div>
                              
                      <div class="col-md-6 col-lg-6 col-xl-12 form-group"> 
                        <button type="reset" class="btn btn-danger-rgba mr-2" title="{{ __('Reset') }}"><i class="fa fa-ban mr-1"></i>{{__('Reset')}}</button>
                        <button type="submit" class="btn btn-primary-rgba" id="send_form" title="{{ __('RE-GENREATE KEY') }}"><i class="fa fa-check-circle"></i> {{$appconfig->generate_apikey != NULL ?  __('RE-GENREATE KEY') : __('GET YOUR KEY') }}</button>
                      </div>
                    </div>
                  </div>
              </div>
            </div>
          </form>

          @if ($appconfig)
          {!! Form::model($appconfig, ['method' => 'PATCH', 'action' => ['AppConfigController@update', $appconfig->id], 'files' => true]) !!}
          <div class="col-md-6 col-lg-6 col-xl-12">
            <div class="bg-info-rgba ml-6 mr-6 mb-6">
              <div class="card-header text-dark"><h5 class="mb-0"><i class="feather icon-smartphone"></i> {{__('MOBILE APP SETTINGS')}}</h5></div>
              <div class="payment-gateway-block">
                <div class="row mx-2 my-4 pb-3">
                  <div class="col-md-4">
                    <div class="form-group text-dark{{ $errors->has('title') ? ' has-error' : '' }}">
                      {!! Form::label('title',__('App Name')) !!} <sup class="text-danger">*</sup>
                      {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => __('Please Enter Mobile App Name')]) !!}
                      <small class="text-danger">{{ $errors->first('title') }}</small>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="row">
                      <div class="col-md-9">
                        <label class="text-dark">{{__('Logo')}} :</label> <sup class="text-danger">*</sup>
                        <small class="badge badge-pill badge-secondary" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{ __('Recommended Image Size : 300x90. Not using the recommended image size: This can result in images that are either too small and dont look good, or too large and slow down the loading time of your application.')}}">
                          <i class="fa fa-info"></i>
                        </small>
                        <small>{{__('(Recommended - Size : 300x90)')}}</small>
                        <div class="input-group mb-3">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" id="inputGroupFile01" name="contact_image"
                                aria-describedby="inputGroupFileAddon01">
                            <label class="custom-file-label" for="inputGroupFile01">{{ __('Choose file') }}</label>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-3 pt-4">
                        <div class="image-block card mt-2">
                          <img src="{{asset('images/app/logo/' . $appconfig->logo)}}" class="img-responsive" alt="{{__('Logo')}}">
                        </div>
                      </div>
                    </div>
                  </div>                    
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-6 col-xl-12">
            <div class="bg-info-rgba ml-6 mr-6 mb-6 ">
              <div class="card-header text-dark"><h5 class="mb-0 "><i class="feather icon-credit-card"></i> {{__('PAYMENT GATEWAY SETTINGS FOR MOBILE APP')}}</h5></div>
              <div class="payment-gateway-block">
                <div class="row my-4 pb-3">
                  <div class="col-lg-4">
                    <div class="form-group">
                      <div class="row mx-2 mt-2 mb-2">
                        <div class="col-md-5 text-dark">
                          {!! Form::label('stripe_payment',__('STRIPE PAYMENT')) !!}
                        </div>
                        <div class="col-md-7">
                          @if(env('STRIPE_KEY') != NULL && env('STRIPE_SECRET') != NULL)
                            <div class="col-xs-5 text-dark text-right">
                              <label class="switch">
                                {!! Form::checkbox('stripe_payment', 1, $appconfig->stripe_payment, ['class' => 'custom_toggle']) !!}
                                <span class="slider round"></span>
                              </label>
                            </div>
                          @else
                              <span class="text-danger">{{__('Please fill the details.')}}<a href="{{url('/admin/api-settings/')}}" title="{{ __('click here') }}"> {{__('click here')}}</a></span>
                          @endif
                        </div>
                      </div>
                    </div>  
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <div class="row mx-2 mt-2 mb-2">
                        <div class="col-md-5 text-dark">
                          {!! Form::label('razorpay_payment', __('RAZORPAY PAYMENT')) !!}
                        </div>
                        <div class="col-md-7">
                          @if(env('RAZOR_PAY_KEY') != NULL && env('RAZOR_PAY_SECRET') != NULL)
                          <div class="col-xs-5 text-right">
                            <label class="switch">
                              {!! Form::checkbox('razorpay_payment', 1, $appconfig->razorpay_payment, ['class' => 'custom_toggle']) !!}
                              <span class="slider round"></span>
                            </label>
                          </div>
                          @else
                          <span class="text-danger">{{__('Please fill the details.')}}<a href="{{url('/admin/api-settings/')}}" title="{{ __('click here') }}"> {{__('click here')}}</a></span>
                          @endif
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <div class="row mx-2 my-2">
                        <div class="col-md-5 text-dark">
                          {!! Form::label('paypal_payment',__('PAYPAL PAYMENT')) !!}
                        </div>
                        <div class="col-md-7">
                          @if(env('PAYPAL_CLIENT_ID') != NULL && env('PAYPAL_SECRET_ID') != NULL && env('PAYPAL_MODE') != NULL )
                          <div class="col-xs-5 text-dark text-right">
                            <label class="switch">
                              {!! Form::checkbox('paypal_payment', 1, $appconfig->paypal_payment, ['class' => 'custom_toggle']) !!}
                              <span class="slider round"></span>
                            </label>
                          </div>
                          @else
                            <span class="text-danger">{{__('Please fill the details.')}}<a href="{{url('/admin/api-settings/')}}" title="{{ __('click here') }}"> {{__('click here')}}</a></span>
                          @endif
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <div class="row mx-2 my-2">
                        <div class="col-md-5 text-dark">
                          {!! Form::label('inapp_payment',__('IN APP PAYMENT')) !!}
                        </div>
                        <div class="col-md-7">
                          <div class="col-xs-5 text-right">
                            <label class="switch">
                              {!! Form::checkbox('inapp_payment', 1, $appconfig->inapp_payment, ['class' => 'custom_toggle']) !!}
                              <span class="slider round"></span>
                            </label>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <div class="row mx-2 my-2">
                        <div class="col-md-5 text-dark">
                          {!! Form::label('instamojo_payment',__('INSTA MOJO PAYMENT')) !!}
                        </div>
                        <div class="col-md-7">
                          @if(env('IM_API_KEY') != NULL && env('IM_AUTH_TOKEN') != NULL && env('IM_URL') != NULL)
                            <div class="col-xs-5 text-dark text-right">
                              <label class="switch">
                                {!! Form::checkbox('instamojo_payment', 1, $appconfig->instamojo_payment, ['class' => 'custom_toggle']) !!}
                                <span class="slider round"></span>
                              </label>
                            </div>  
                          @else
                            <span class="text-danger">{{__('Please fill the details.')}}<a href="{{url('/admin/api-settings/')}}" title="{{ __('click here') }}"> {{__('click here')}}</a></span>
                          @endif
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <div class="row mx-2 my-2">
                        <div class="col-md-5 text-dark">
                          {!! Form::label('bankdetails',__('BANK DETAILS')) !!}
                        </div>
                        <div class="col-md-7">
                          <div class="col-xs-5 text-right">
                            <label class="switch">
                              {!! Form::checkbox('bankdetails', 1, $appconfig->bankdetails, ['class' => 'custom_toggle']) !!}
                              <span class="slider round"></span>
                            </label>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <div class="row mx-2 my-2">
                        <div class="col-md-5 text-dark">
                          {!! Form::label('brainetree_payment',__('BRAIN TREE PAYMENT')) !!}
                        </div>
                        <div class="col-md-7">
                          @if(env('BTREE_ENVIRONMENT') != NULL && env('BTREE_MERCHANT_ID') != NULL && env('BTREE_PUBLIC_KEY') != NULL && env('BTREE_PRIVATE_KEY') != NULL && env('BTREE_MERCHANT_ACCOUNT_ID') != NULL)
                            <div class="col-xs-5 text-dark text-right">
                              <label class="switch">
                                {!! Form::checkbox('brainetree_payment', 1, $appconfig->brainetree_payment, ['class' => 'custom_toggle']) !!}
                                <span class="slider round"></span>
                              </label>
                            </div>
                          @else
                            <span class="text-danger">{{__('Please fill the details.')}}<a href="{{url('/admin/api-settings/')}}" title="{{ __('click here') }}"> {{__('click here')}}</a></span>
                          @endif
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <div class="row mx-2 my-2">
                        <div class="col-md-5 text-dark">
                          {!! Form::label('paytm_payment',__('PAYTM PAYMENT')) !!}
                        </div>
                        <div class="col-md-7">
                          @if(env('PAYTM_MID') != NULL && env('PAYTM_MERCHANT_KEY') != NULL && env('PAYTM_ENVIRONMENT') != NULL && env('PAYTM_MERCHANT_WEBSITE') != NULL && env('PAYTM_CHANNEL') != NULL)
                            <div class="col-xs-5 text-right">
                              <label class="switch">
                                {!! Form::checkbox('paytm_payment', 1, $appconfig->paytm_payment, ['class' => 'custom_toggle']) !!}
                                <span class="slider round"></span>
                              </label>
                            </div>
                            @else
                            <span class="text-danger">{{__('Please fill the details.')}}<a href="{{url('/admin/api-settings/')}}" title="{{ __('click here') }}"> {{__('click here')}}</a></span>
                            @endif
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <div class="row mx-2 my-2">
                        <div class="col-md-5 text-dark">
                          {!! Form::label('paystack_payment',__('PAYSTACK PAYMENT')) !!}
                        </div>
                        <div class="col-md-7">
                          @if(env('PAYSTACK_PUBLIC_KEY') != NULL && env('PAYSTACK_SECRET_KEY') != NULL && env('PAYSTACK_PAYMENT_URL') != NULL)
                          <div class="col-xs-5 text-right">
                            <label class="switch">
                              {!! Form::checkbox('paystack_payment', 1, $appconfig->paystack_payment, ['class' => 'custom_toggle']) !!}
                              <span class="slider round"></span>
                            </label>
                          </div>
                          @else
                          <span class="text-danger">{{__('Please fill the details.')}}<a href="{{url('/admin/api-settings/')}}" title="{{ __('click here') }}"> {{__('click here')}}</a></span>
                          @endif
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-6 col-xl-12">
            <div class="bg-info-rgba ml-6 mr-6 mb-6">
              <div class="card-header text-dark"><h5 class="mb-0 "><i class="feather icon-facebook"></i> {{__('SOCIAL LOGIN SETTINGS FOR MOBILE APP')}}</h5></div>
              <div class="payment-gateway-block">
                <div class="row my-4 pb-3">
                  <div class="col-lg-4">
                    <div class="form-group">
                      <div class="row mx-2 mt-2 mb-2">
                        <div class="col-md-5 text-dark">
                          {!! Form::label('fb_check',__('Enable Facebook Login')) !!}
                        </div>
                        <div class="col-md-7">
                          @if(env('FACEBOOK_CLIENT_ID') != NULL && env('FACEBOOK_CLIENT_SECRET') != NULL && env('FACEBOOK_CALLBACK') != NULL)
                          <div class="col-xs-5 text-right">
                            <label class="switch">
                              {!! Form::checkbox('fb_check', 1, $appconfig->fb_login, ['class' => 'custom_toggle']) !!}
                              <span class="slider round"></span>
                            </label>
                          </div>
                          @else
                              <span class="text-danger">{{__('Please fill the details.')}}<a href="{{url('/admin/social-login/')}}" title="{{ __('click here') }}"> {{__('click here')}}</a></span>
                            @endif
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <div class="row mx-2 mt-2 mb-2">
                        <div class="col-md-5 text-dark">
                          {!! Form::label('google_login',__('Enable Google Login')) !!}
                        </div>
                        <div class="col-md-7">
                          @if(env('GOOGLE_CLIENT_ID') != NULL && env('GOOGLE_CLIENT_SECRET') != NULL && env('GOOGLE_CALLBACK') != NULL)
                          <div class="col-xs-5 text-right">
                            <label class="switch">
                              {!! Form::checkbox('google_login', 1, $appconfig->google_login, ['class' => 'custom_toggle']) !!}
                              <span class="slider round"></span>
                            </label>
                          </div>
                          @else
                            <span class="text-danger">{{__('Please fill the details.')}}<a href="{{url('/admin/social-login/')}}" title="{{ __('click here') }}"> {{__('click here')}}</a></span>
                          @endif
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <div class="row mx-2 my-2">
                        <div class="col-md-5 text-dark">
                          {!! Form::label('amazon_login',__('Enable AMAZON Login')) !!}
                        </div>
                        <div class="col-md-7">
                          @if(env('AMAZON_LOGIN_ID') != NULL && env('AMAZON_LOGIN_SECRET') != NULL && env('AMAZON_LOGIN_REDIRECT') != NULL)
                          <div class="col-xs-5 text-right">
                            <label class="switch">
                              {!! Form::checkbox('amazon_login', 1, $appconfig->amazon_login, ['class' => 'custom_toggle']) !!}
                              <span class="slider round"></span>
                            </label>
                          </div>
                          @else
                            <span class="text-danger">{{__('Please fill the details.')}}<a href="{{url('/admin/social-login/')}}" title="{{ __('click here') }}"> {{__('click here')}}</a></span>
                          @endif
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-6 col-lg-6 col-xl-12">
            <div class="bg-info-rgba ml-6 mr-6 mb-6">
              <div class="card-header text-dark"><h5 class="mb-0"><i class="feather icon-monitor"></i> {{__('ADMOB SETTINGS FOR MOBILE APP')}}</h5></div>
              <div class="payment-gateway-block">
                <div class="row my-4 pb-3">
                  <div class="col-lg-3">
                    <div class="form-group">
                      <div class="row mx-2 mt-2 mb-2">
                        <div class="col-md-5 text-dark">
                          {!! Form::label('google_login',__('Admob Setting')) !!}
                        </div>
                        <div class="col-md-7">
                          <div class="col-xs-5 text-right">
                            <label class="switch">
                              {!! Form::checkbox('is_admob', 1, $appconfig->is_admob, ['class' => 'custom_toggle']) !!}
                              <span class="slider round"></span>
                            </label>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <div class="row mx-2 mt-2 mb-2">
                        <div class="col-md-5 text-dark">
                          {!! Form::label('banner_admob', __('BANNER ADMOB')) !!}
                        </div>
                        <div class="col-md-4">
                          <div class="col-xs-5 text-right">
                            <label class="switch">
                              {!! Form::checkbox('banner_admob', 1, $appconfig->banner_admob, ['class' => 'custom_toggle']) !!}
                              <span class="slider round"></span>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="row mx-2 my-2" style="{{ $appconfig->banner_admob==1 ? "" : "display: none" }}" id="banner_box">
                        <div class="col-md-10">
                          <div class="form-group text-dark{{ $errors->has('Banner_id') ? ' has-error' : '' }}">
                          {!! Form::label('banner_id', __('BANNER ID')) !!} <sup class="text-danger">*</sup>
                          {!! Form::text('banner_id', null, ['class' => 'form-control', 'placeholder' => __('Please Enter Banner ID')]) !!}
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-5">
                    <div class="form-group">
                      <div class="row mx-2 mt-2 mb-2">
                        <div class="col-md-5 text-dark">
                          {!! Form::label('interstitial_admob', __('INTERSTITAL ADMOB')) !!}
                        </div>
                        <div class="col-md-7">
                          <div class="col-xs-5 text-right">
                            <label class="switch">
                              {!! Form::checkbox('interstitial_admob', 1, $appconfig->interstitial_admob, ['class' => 'custom_toggle']) !!}
                              <span class="slider round"></span>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="row mx-2 my-2" style="{{ $appconfig->interstitial_admob==1 ? "" : "display: none" }}" id="interstitial_box">
                        <div class="col-md-10">
                          <div class="form-group text-dark{{ $errors->has('interstitial_id') ? ' has-error' : '' }}">
                            {!! Form::label('interstitial_id', __('INTERSTITAL ID')) !!} <sup class="text-danger">*</sup>
                            {!! Form::text('interstitial_id', null, ['class' => 'form-control', 'placeholder' => __('Please Enter INTERSTITAL ID')]) !!}
                            <small class="text-danger">{{ $errors->first('interstitial_id') }}</small>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-6 col-xl-12">
            <div class="bg-info-rgba ml-6 mr-6 mb-6">
              <div class="card-header text-dark"><h5 class="mb-0"><i class="feather icon-bell"></i> {{__('PUSH NOTIFICATION SETTINGS FOR MOBILE APP')}}</h5></div>
              <div class="payment-gateway-block">
                <div class="row my-4 pb-3">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <div class="row mx-2 mt-2 mb-2">
                        <div class="col-md-5 text-dark">
                          {!! Form::label('push_key', __('Push Notification')) !!}
                        </div>
                        <div class="col-md-7">
                          <div class="col-xs-5 text-right">
                            <label class="switch">
                              {!! Form::checkbox('push_key', 1, $appconfig->push_key, ['class' => 'custom_toggle','id'=> 'push_id']) !!}
                              <span class="slider round"></span>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="row mx-2 my-4" style="{{ $appconfig->push_key == 1 ? "" : "display: none" }}" id="push_box">
                        <div class="col-md-12">
                          <div class="form-group text-dark{{ $errors->has('PUSH_AUTH_KEY') ? ' has-error' : '' }}">
                            {!! Form::label('PUSH_AUTH_KEY', __('PUSH AUTH KEY')) !!} <sup class="text-danger">*</sup>
                            <input type="text" name="PUSH_AUTH_KEY" class="form-control" placeholder="Please Enter Push Auth Key" value="{{env('PUSH_AUTH_KEY') ? env('PUSH_AUTH_KEY') : '' }}">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-6 col-xl-12">
            <div class="bg-info-rgba ml-6 mr-6 mb-6 ">
              <div class="card-header text-dark"><h5 class="mb-0"><i class="feather icon-tool"></i> {{__('OTHER SETTINGS')}}</h5></div>
              <div class="payment-gateway-block">
                <div class="row my-4 pb-3">
                  <div class="col-lg-4">
                    <div class="form-group">
                      <div class="row mx-2 mt-2 mb-2">
                        <div class="col-md-5 text-dark">
                          {!! Form::label('remove_ads',__('Remove Ads')) !!}
                          <small class="badge badge-pill badge-secondary" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{ __('Remove ADS')}}">
                            <i class="fa fa-info"></i>
                          </small>
                        </div>
                        <div class="col-md-7">
                          <div class="col-xs-5 text-right">
                            <label class="switch">
                              {!! Form::checkbox('remove_ads', 1, $appconfig->remove_ads, ['class' => 'custom_toggle']) !!}
                              <span class="slider round"></span>
                            </label>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>                  
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-6 col-xl-12 form-group">
            <button type="submit" class="btn btn-primary-rgba" title="{{ __('Save') }}"><i class="fa fa-check-circle"></i> {{ __('Save') }}</button>
          </div>
          {!! Form::close() !!}
          <div class="clear-both"></div>
          @endif
        </div>
      </div>
    </div>
  </div>
</div> 

@endsection 
@section('script')
<script type="text/javascript">
  $('#banner_admob').on('change',function(){
      if ($('#banner_admob').is(':checked')){
           $('#banner_box').show('fast');
        }else{
          $('#banner_box').hide('fast');
        }
    });  

  $('#interstitial_admob').on('change',function(){
    if ($('#interstitial_admob').is(':checked')){
         $('#interstitial_box').show('fast');
      }else{
        $('#interstitial_box').hide('fast');
      }
  });  

  $('#rewarded_admob').on('change',function(){
      if ($('#rewarded_admob').is(':checked')){
           $('#rewarded_box').show('fast');
        }else{
          $('#rewarded_box').hide('fast');
        }
    }); 
  $('#native_admob').on('change',function(){
      if ($('#native_admob').is(':checked')){
           $('#native_box').show('fast');
        }else{
          $('#native_box').hide('fast');
        }
    }); 
  $('#push_id').on('change',function(){
      if ($('#push_id').is(':checked')){
           $('#push_box').show('fast');
        }else{
          $('#push_box').hide('fast');
        }
    }); 

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
  (function($){
    $.noConflict();    
  })(jQuery);    
</script>  
@endsection