@extends('layouts.master')
@section('title', __('Payment Gateway Settings'))
@section('breadcum')
<div class="breadcrumbbar">
    <h4 class="page-title">{{ __('Payment Gateway Settings') }}</h4>
    <div class="breadcrumb-list">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('/admin')}}" title="{{ __('Dashboard') }}">{{ __('Dashboard') }}</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ __('Payment Gateway Settings') }}</li>
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
          <h5 class="box-title">{{__('Payment Gateway Settings')}}</h5>
        </div>
        <div class="card-body ml-2">
          {!! Form::model($env_files, ['method' => 'POST', 'action' => 'ConfigController@changeEnvKeys']) !!}
<div class="row">
  <div class="col-md-6 col-lg-6 col-xl-12">
    <div class="bg-primary ml-6 mr-6 mb-6">
      <div class="card-header text-white"><h4 class="text-white"><i class="feather icon-Settings" aria-hidden="true"></i> {{__('PAYEMNT GATEWAYS')}}</h4></div>
  </div>
</div>

<!-- ======= STRIPE PAYMENT start ========== -->
<div class="col-md-6 col-lg-6 col-xl-12">
    <div class="bg-info-rgba ml-6 mr-6 mb-6">
        <div class="card-header text-dark"><h4><i class="feather icon-Settings" aria-hidden="true"></i> {{__('Stripe Payment Gateway')}}</h4></div>
            <div class="payment-gateway-block">
                <div class="form-group">
                    <div class="row mx-2 my-4">
                        <div class="col-md-10">
                            {!! Form::label('stripe_payment', __('Stripe Payment Gateway')) !!}
                            <small class="badge badge-pill badge-secondary" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{ __('All plans and coupons create from the Admin Panel. Dont create from strip account. All your test is complete then make a stripe to live mode, Stripe Test Mode user and packages not support to live mode.')}}">
                              <i class="fa fa-info"></i>
                            </small>

                        </div>
                        <div class="col-md-2">
                            <label class="switch">
                                {!! Form::checkbox('stripe_payment', 1, $config->stripe_payment, ['class' => 'custom_toggle']) !!}
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row mx-2 my-4" style="{{ $config->stripe_payment==1 ? "" : "display: none" }}" id="stripe_box">
                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('STRIPE_KEY') ? ' has-error' : '' }}">
                            <label class="text-dark">{{ __('STRIPE KEY') }} <sup class="text-danger">*</sup></label>
                            {!! Form::text('STRIPE_KEY', null, ['class' => 'form-control']) !!}
                            <small class="text-danger">{{ $errors->first('STRIPE_KEY') }}</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="search form-group{{ $errors->has('STRIPE_SECRET') ? ' has-error' : '' }}">
                            <label class="text-dark">{{ __('STRIPE SECRET KEY') }} <sup class="text-danger">*</sup></label>
                            <input class ="form-control" type="text" name="STRIPE_SECRET" id="captcha-password-field" value= "{{ $env_files['STRIPE_SECRET'] }}">
                            <small class="text-danger">{{ $errors->first('STRIPE_SECRET') }}</small>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
<!-- ======= STRIPE PAYMENT end ========== -->

<!-- ======= PAYPAL PAYMENT start ========== -->
<div class="col-md-6 col-lg-6 col-xl-12">
  <div class="bg-info-rgba ml-6 mr-6 mb-6">
      <div class="card-header text-dark"><h4><i class="feather icon-Settings" aria-hidden="true"></i> {{__('PayPal Payment Gateway')}}</h4></div>
          <div class="payment-gateway-block">
              <div class="form-group">
                  <div class="row mx-2 my-4">
                      <div class="col-md-10">
                        {!! Form::label('paypal_payment', __('PayPal Payment Gateway')) !!}
                        <small class="badge badge-pill badge-secondary" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{ __('For Paypal payment gateway You Need Paypal Key. Go To: https://developer.paypal.com/. All your test complete then make Payment Gateway to live mode,  Payment Gateway Sandbox Mode user and price not support to live mode.')}}">
                          <i class="fa fa-info"></i>
                        </small>
                      </div>
                      <div class="col-md-2">
                          <label class="switch">
                            {!! Form::checkbox('paypal_payment', 1, $config->paypal_payment, ['class' => 'custom_toggle']) !!}
                          </label>
                      </div>
                  </div>
              </div>
              <div class="row mx-2 my-4" style="{{ $config->paypal_payment==1 ? "" : "display: none" }}" id="paypal_box">
                  <div class="col-md-3">
                      <div class="form-group{{ $errors->has('PAYPAL_CLIENT_ID') ? ' has-error' : '' }}">
                          <label class="text-dark">{{ __('PayPal Client ID') }} <sup class="text-danger">*</sup></label>
                          <input type="text" name="PAYPAL_CLIENT_ID" value="{{ $env_files['PAYPAL_CLIENT_ID'] }}" id="pclientid" class="form-control">
                          <small class="text-danger">{{ $errors->first('PAYPAL_CLIENT_ID') }}</small>
                      </div>
                  </div>

                  <div class="col-md-6">
                      <div class="search form-group{{ $errors->has('PAYPAL_SECRET_ID') ? ' has-error' : '' }}">
                          <label class="text-dark">{{ __('PayPal Secret ID') }} <sup class="text-danger">*</sup></label>
                          <input type="text" name="PAYPAL_SECRET_ID" value="{{ $env_files['PAYPAL_SECRET_ID'] }}" id="paypal_secret" class="form-control">
                          <small class="text-danger">{{ $errors->first('PAYPAL_SECRET_ID') }}</small>
                      </div>
                  </div>

                  <div class="col-md-3">
                    <div class="search form-group{{ $errors->has('PAYPAL_MODE') ? ' has-error' : '' }}">
                        <label class="text-dark">{{ __('PayPal Mode') }} <sup class="text-danger">*</sup>
                          <small class="badge badge-pill badge-secondary" data-toggle="tooltip" data-placement="right" title="" data-original-title="{{ __('PayPal offers two modes for processing payments: Sandbox and Live mode.
Sandbox mode is a testing environment that allows you to test PayPal integration in a simulated environment, using fake PayPal accounts and transactions. This is a great way to test and debug your PayPal integration without risking any real money or transactions.
Live mode is the actual production environment where real transactions take place, using real PayPal accounts and actual funds. To accept payments in Live mode, you will need to have a verified PayPal Business account and have completed the necessary setup steps to receive payments.')}}">
                            <i class="fa fa-info"></i>
                          </small>
                        </label>
                        {!! Form::text('PAYPAL_MODE', null, ['class' => 'form-control']) !!}
                        <small class="text-danger">{{ $errors->first('PAYPAL_SECRET_ID') }}</small>
                    </div>
                </div>
                  
              </div>
          </div>
      </div>
  </div>
<!-- ======= STRIPE PAYMENT end ========== -->

<!-- ======= RAZORPAY PAYMENT start ========== -->
<div class="col-md-6 col-lg-6 col-xl-12">
  <div class="bg-info-rgba ml-6 mr-6 mb-6">
      <div class="card-header text-dark"><h4><i class="feather icon-Settings" aria-hidden="true"></i> {{__('Razorpay Payment Gateway')}}</h4></div>
          <div class="payment-gateway-block">
              <div class="form-group">
                  <div class="row mx-2 my-4">
                      <div class="col-md-10">
                          {!! Form::label('razorpay_payment', __('Razorpay Payment Gateway')) !!}
                      </div>
                      <div class="col-md-2">
                          <label class="switch">
                              {!! Form::checkbox('razorpay_payment', 1, $config->razorpay_payment, ['class' => 'custom_toggle']) !!}
                          </label>
                      </div>
                  </div>
              </div>
              <div class="row mx-2 my-4" style="{{ $config->razorpay_payment==1 ? "" : "display: none" }}" id="razorpay_box">
                  <div class="col-md-6">
                      <div class="form-group{{ $errors->has('STRIPE_KEY') ? ' has-error' : '' }}">
                          <label class="text-dark">{{ __('Razorpay Key') }} <sup class="text-danger">*</sup></label>
                          {!! Form::text('RAZOR_PAY_KEY', null , ['class' => 'form-control']) !!}
                          <small class="text-danger">{{ $errors->first('RAZOR_PAY_KEY') }}</small>
                      </div>
                  </div>

                  <div class="col-md-6">
                      <div class="search form-group{{ $errors->has('RAZOR_PAY_SECRET') ? ' has-error' : '' }}">
                          <label class="text-dark">{{ __('Razorpay Secret Key') }} <sup class="text-danger">*</sup></label>
                          <input type="text" id="razorpay_secret" name="RAZOR_PAY_SECRET" value="{{ $env_files['RAZOR_PAY_SECRET'] }}" class="form-control" >
                          <small class="text-danger">{{ $errors->first('RAZOR_PAY_SECRET') }}</small>
                      </div>
                  </div>
                  
              </div>
          </div>
      </div>
  </div>
<!-- ======= RAZORPAY PAYMENT end ========== -->

<!-- ======= PAYU PAYMENT start ========== -->
<div class="col-md-6 col-lg-6 col-xl-12">
  <div class="bg-info-rgba ml-6 mr-6 mb-6">
      <div class="card-header text-dark"><h4><i class="feather icon-Settings" aria-hidden="true"></i> {{__('PayU Payment Gateway')}}</h4></div>
          <div class="payment-gateway-block">
              <div class="form-group">
                  <div class="row mx-2 my-4">
                      <div class="col-md-10">
                          {!! Form::label('payu_payment', __('PayU Payment Gateway')) !!}
                      </div>
                      <div class="col-md-2">
                          <label class="switch">
                              {!! Form::checkbox('payu_payment', 1, $config->payu_payment, ['class' => 'custom_toggle']) !!}
                          </label>
                      </div>
                  </div>
              </div>
              <div class="row mx-2 my-4" style="{{ $config->payu_payment==1 ? "" : "display: none" }}" id="payu_box">
                  <div class="col-md-3">
                      <div class="form-group{{ $errors->has('PAYU_METHOD') ? ' has-error' : '' }}">
                          <label class="text-dark">{{ __('PayU Method') }} <sup class="text-danger">*</sup></label>
                          {!! Form::text('PAYU_METHOD', null, ['class' => 'form-control']) !!}
                          <small class="text-danger">{{ $errors->first('PAYU_METHOD') }}</small>
                      </div>
                  </div>

                  <div class="col-md-3">
                    <div class="form-group{{ $errors->has('PAYU_DEFAULT') ? ' has-error' : '' }}">
                        <label class="text-dark">{{ __('PayU Default Option') }} <sup class="text-danger">*</sup></label>
                        {!! Form::text('PAYU_DEFAULT', null, ['class' => 'form-control']) !!}
                        <small class="text-danger">{{ $errors->first('PAYU_DEFAULT') }}</small>
                    </div>
                </div>

                  <div class="col-md-3">
                      <div class="search form-group{{ $errors->has('PAYU_MERCHANT_KEY') ? ' has-error' : '' }}">
                          <label class="text-dark">{{ __('PayU Merchant Key') }} <sup class="text-danger">*</sup></label>
                          <input class ="form-control" type="text" name="PAYU_MERCHANT_KEY"  value= "{{ $env_files['PAYU_MERCHANT_KEY'] }}">
                          <small class="text-danger">{{ $errors->first('PAYU_MERCHANT_KEY') }}</small>
                      </div>
                  </div>

                  <div class="col-md-3">
                    <div class="search form-group{{ $errors->has('PAYU_MERCHANT_SALT') ? ' has-error' : '' }}">
                        <label class="text-dark">{{ __('PayU Merchant Salt') }} <sup class="text-danger">*</sup></label>
                        <input class ="form-control" type="text" name="PAYU_MERCHANT_SALT"  value= "{{ $env_files['PAYU_MERCHANT_SALT'] }}">
                        <small class="text-danger">{{ $errors->first('PAYU_MERCHANT_SALT') }}</small>
                    </div>
                </div>
                  
              </div>
          </div>
      </div>
  </div>
<!-- ======= PAYU PAYMENT end ========== -->

<!-- ======= BRAIN TREE PAYMENT start ========== -->
<div class="col-md-6 col-lg-6 col-xl-12">
  <div class="bg-info-rgba ml-6 mr-6 mb-6">
      <div class="card-header text-dark"><h4><i class="feather icon-Settings" aria-hidden="true"></i> {{__('Braintree Payment Gateway')}}</h4></div>
          <div class="payment-gateway-block">
              <div class="form-group">
                  <div class="row mx-2 my-4">
                      <div class="col-md-10">
                        {!! Form::label('braintree', __('Braintree Payment Gateway')) !!}
                      </div>
                      <div class="col-md-2">
                          <label class="switch">
                            {!! Form::checkbox('braintree', 1, $config->braintree, ['class' => 'custom_toggle','id' => 'braintree_check']) !!}
                          </label>
                      </div>
                  </div>
              </div>
              <div class="row mx-2 my-4" style="{{ $config->braintree == 1 ? "" : "display: none" }}" id="braintree_box">
                  <div class="col-md-4">
                      <div class="form-group{{ $errors->has('BTREE_ENVIRONMENT') ? ' has-error' : '' }}">
                          <label class="text-dark">{{ __('Braintree Environment') }} <sup class="text-danger">*</sup></label>
                          <input type="text" name="BTREE_ENVIRONMENT" value="{{ $env_files['BTREE_ENVIRONMENT'] }}"  class="form-control">
                          <small class="text-danger">{{ $errors->first('BTREE_ENVIRONMENT') }}</small>
                      </div>
                  </div>

                  <div class="col-md-4">
                      <div class="search form-group{{ $errors->has('BTREE_MERCHANT_ID') ? ' has-error' : '' }}">
                          <label class="text-dark">{{ __('Braintree Merchant ID') }} <sup class="text-danger">*</sup></label>
                          <input type="text" name="BTREE_MERCHANT_ID" value="{{ $env_files['BTREE_MERCHANT_ID'] }}" class="form-control">
                          <small class="text-danger">{{ $errors->first('BTREE_MERCHANT_ID') }}</small>
                      </div>
                  </div>

                  <div class="col-md-4">
                    <div class="search form-group{{ $errors->has('BTREE_MERCHANT_ACCOUNT_ID') ? ' has-error' : '' }}">
                        <label class="text-dark">{{ __('Merchant Merchant Account ID') }} <sup class="text-danger">*</sup></label>
                        <input type="text" name="BTREE_MERCHANT_ACCOUNT_ID" value="{{ $env_files['BTREE_MERCHANT_ACCOUNT_ID'] }}" class="form-control">
                        <small class="text-danger">{{ $errors->first('BTREE_MERCHANT_ACCOUNT_ID') }}</small>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="search form-group{{ $errors->has('BTREE_PUBLIC_KEY') ? ' has-error' : '' }}">
                        <label class="text-dark">{{ __('Merchant Public Key') }} <sup class="text-danger">*</sup></label>
                        <input type="text" name="BTREE_PUBLIC_KEY" value="{{ $env_files['BTREE_PUBLIC_KEY'] }}" class="form-control">
                        <small class="text-danger">{{ $errors->first('BTREE_PUBLIC_KEY') }}</small>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="search form-group{{ $errors->has('BTREE_PRIVATE_KEY') ? ' has-error' : '' }}">
                        <label class="text-dark">{{ __('Merchant Private Key') }} <sup class="text-danger">*</sup></label>
                        <input type="text" name="BTREE_PRIVATE_KEY" value="{{ $env_files['BTREE_PRIVATE_KEY'] }}" class="form-control">
                        <small class="text-danger">{{ $errors->first('BTREE_PRIVATE_KEY') }}</small>
                    </div>
                </div>
                  
              </div>
          </div>
      </div>
  </div>
<!-- ======= BRAIN TREE PAYMENT end ========== -->

<!-- ======= coinpay PAYMENT start ========== -->
<div class="col-md-6 col-lg-6 col-xl-12">
  <div class="bg-info-rgba ml-6 mr-6 mb-6">
      <div class="card-header text-dark"><h4><i class="feather icon-Settings" aria-hidden="true"></i> {{__('Coinpay Payment Gateway')}}</h4><a href="https://www.coinpayments.net/" target="__blank" title="({{__('Coin Payment Site')}})">  ({{__('Coinpay Payment Site')}})</a></div>
          <div class="payment-gateway-block">
              <div class="form-group">
                  <div class="row mx-2 my-4">
                      <div class="col-md-10">
                        {!! Form::label('coinpay', __('Coinpay Payment Gateway')) !!} 
                      </div>
                      <div class="col-md-2">
                          <label class="switch">
                            {!! Form::checkbox('coinpay', 1, $config->coinpay, ['class' => 'custom_toggle','id' => 'coinpay_check']) !!}
                          </label>
                      </div>
                  </div>
              </div>
              <div class="row mx-2 my-4" style="{{ $config->coinpay==1 ? "" : "display: none" }}" id="coinpay_box">
                  <div class="col-md-4">
                      <div class="form-group{{ $errors->has('COINPAYMENTS_MERCHANT_ID') ? ' has-error' : '' }}">
                          <label class="text-dark">{{ __('Coinpay Payment Merchant ID') }} <sup class="text-danger">*</sup></label>
                          <input type="text" name="COINPAYMENTS_MERCHANT_ID" value="{{ $env_files['COINPAYMENTS_MERCHANT_ID'] }}"  class="form-control">
                          <small class="text-danger">{{ $errors->first('COINPAYMENTS_MERCHANT_ID') }}</small>
                      </div>
                  </div>

                  <div class="col-md-4">
                      <div class="search form-group{{ $errors->has('COINPAYMENTS_PUBLIC_KEY') ? ' has-error' : '' }}">
                          <label class="text-dark">{{ __('Coinpay Payment Public Key') }} <sup class="text-danger">*</sup></label>
                          <input type="text" name="COINPAYMENTS_PUBLIC_KEY" value="{{ $env_files['COINPAYMENTS_PUBLIC_KEY'] }}"  class="form-control">
                          <small class="text-danger">{{ $errors->first('COINPAYMENTS_PUBLIC_KEY') }}</small>
                      </div>
                  </div>

                  <div class="col-md-4">
                    <div class="search form-group{{ $errors->has('COINPAYMENTS_PRIVATE_KEY') ? ' has-error' : '' }}">
                        <label class="text-dark">{{ __('Coinpay Payment Private Key') }} <sup class="text-danger">*</sup></label>
                        <input type="text" name="COINPAYMENTS_PRIVATE_KEY" value="{{ $env_files['COINPAYMENTS_PRIVATE_KEY'] }}"  class="form-control">
                        <small class="text-danger">{{ $errors->first('COINPAYMENTS_PRIVATE_KEY') }}</small>
                    </div>
                  </div>
                  
              </div>
          </div>
      </div>
  </div>
<!-- ======= Coinpay PAYMENT end ========== -->

<!-- ======= PAY STACK PAYMENT start ========== -->
<div class="col-md-6 col-lg-6 col-xl-12">
  <div class="bg-info-rgba ml-6 mr-6 mb-6">
      <div class="card-header text-dark"><h4><i class="feather icon-Settings" aria-hidden="true"></i> {{__('Pay Stack Payment Gateway')}}</h4><h5>{{__('(Only Works for NGN Currency)')}}</h5></div>
          <div class="payment-gateway-block">
              <div class="form-group">
                  <div class="row mx-2 my-4">
                      <div class="col-md-10">
                        {!! Form::label('paystack', __('Pay Stack Payment Gateway')) !!} 
                        <small class="badge badge-pill badge-secondary" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{ __('Only Works for NGN Currency.')}}">
                        <i class="fa fa-info"></i>
                      </small>
                      </div>
                      <div class="col-md-2">
                          <label class="switch">
                            {!! Form::checkbox('paystack', 1, $config->paystack, ['class' => 'custom_toggle','id' => 'paystack_check']) !!}
                          </label>
                      </div>
                  </div>
              </div>
              <div class="row mx-2 my-4" style="{{ $config->paystack==1 ? "" : "display: none" }}" id="paystack_box">
                  <div class="col-md-6">
                      <div class="form-group{{ $errors->has('PAYSTACK_PUBLIC_KEY') ? ' has-error' : '' }}">
                          <label class="text-dark">{{ __('Pay Stack Public Key') }} <sup class="text-danger">*</sup></label>
                          <input type="text" name="PAYSTACK_PUBLIC_KEY" value="{{ $env_files['PAYSTACK_PUBLIC_KEY'] }}"  class="form-control">
                          <small class="text-danger">{{ $errors->first('PAYSTACK_PUBLIC_KEY') }}</small>
                      </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group{{ $errors->has('PAYSTACK_SECRET_KEY') ? ' has-error' : '' }}">
                        <label class="text-dark">{{ __('Pay Stack Secret Key') }} <sup class="text-danger">*</sup></label>
                        <input type="text" name="PAYSTACK_SECRET_KEY" value="{{ $env_files['PAYSTACK_SECRET_KEY'] }}"  class="form-control">
                        <small class="text-danger">{{ $errors->first('PAYSTACK_SECRET_KEY') }}</small>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group{{ $errors->has('MERCHANT_EMAIL') ? ' has-error' : '' }}">
                        <label class="text-dark">{{ __('Merchant Email') }} <sup class="text-danger">*</sup></label>
                        <input type="text" name="MERCHANT_EMAIL" value="{{ $env_files['MERCHANT_EMAIL'] }}"  class="form-control">
                        <small class="text-danger">{{ $errors->first('MERCHANT_EMAIL') }}</small>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group{{ $errors->has('PAYSTACK_PAYMENT_URL') ? ' has-error' : '' }}">
                        <label class="text-dark">{{ __('Pay Stack Payment URL') }} <sup class="text-danger">*</sup></label>
                        <input type="text" name="PAYSTACK_PAYMENT_URL" value="{{ $env_files['PAYSTACK_PAYMENT_URL'] }}"  class="form-control">
                        <small class="text-danger">{{ $errors->first('PAYSTACK_PAYMENT_URL') }}</small>
                    </div>
                </div>
                  
              </div>
          </div>
      </div>
  </div>
<!-- ======= PAY STACK PAYMENT end ========== -->

<!-- ======= PAYTM PAYMENT start ========== -->
<div class="col-md-6 col-lg-6 col-xl-12">
  <div class="bg-info-rgba ml-6 mr-6 mb-6">
      <div class="card-header text-dark"><h4><i class="feather icon-Settings" aria-hidden="true"></i> {{__('Paytm Payment Gateway
')}}</h4></div>
          <div class="payment-gateway-block">
              <div class="form-group">
                  <div class="row mx-2 my-4">
                      <div class="col-md-10">
                        {!! Form::label('paytm_payment', __('Paytm Payment Gateway')) !!}
                      </div>
                      <div class="col-md-2">
                          <label class="switch">
                            {!! Form::checkbox('paytm_payment', 1, $config->paytm_payment, ['class' => 'custom_toggle','id' => 'paytm_check']) !!}
                          </label>
                      </div>
                  </div>
              </div>
              <div class="row mx-2 my-4" style="{{ $config->paytm_payment==1 ? "" : "display: none" }}" id="paytm_box">
                  <div class="col-md-3">
                      <div class="form-group{{ $errors->has('PAYTM_MID') ? ' has-error' : '' }}">
                          <label class="text-dark">{{ __('Merchant ID') }} <sup class="text-danger">*</sup></label>
                          <input type="text" name="PAYTM_MID" value="{{ $env_files['PAYTM_MID'] }}"  class="form-control">
                          <small class="text-danger">{{ $errors->first('PAYTM_MID') }}</small>
                      </div>
                  </div>

                  <div class="col-md-6">
                      <div class="search form-group{{ $errors->has('PAYTM_MERCHANT_KEY') ? ' has-error' : '' }}">
                          <label class="text-dark">{{ __('Merchant Key') }} <sup class="text-danger">*</sup></label>
                          <input type="text" name="PAYTM_MERCHANT_KEY" value="{{ $env_files['PAYTM_MERCHANT_KEY'] }}"  class="form-control">
                          <small class="text-danger">{{ $errors->first('PAYTM_MERCHANT_KEY') }}</small>
                      </div>
                  </div>

                  <div class="col-md-3">
                    <label class="text-dark">{{ __('Paytm LIVE/TEST') }}</label>
                  
                      <label class="switch">
                        {!! Form::checkbox('paytm_test', 1, ($config->paytm_test == 1 ? 1 : 0), ['class' => 'custom_toggle']) !!}
                      </label>
                  </div>
                  
              </div>
          </div>
      </div>
  </div>
<!-- ======= PAYTM PAYMENT end ========== -->

<!-- ======= INSTA MOJO PAYMENT start ========== -->
<div class="col-md-6 col-lg-6 col-xl-12">
  <div class="bg-info-rgba ml-6 mr-6 mb-6">
      <div class="card-header text-dark"><h4><i class="feather icon-Settings" aria-hidden="true"></i> {{__('INSTA MOJO Payment Gateway')}}</h4><h5>{{__('(Support Only INR Currency)')}}</h5></div>
          <div class="payment-gateway-block">
              <div class="form-group">
                  <div class="row mx-2 my-4">
                      <div class="col-md-10">
                        {!! Form::label('instamojo_payment', __('INSTA MOJO Payment Gateway')) !!}
                        <small class="badge badge-pill badge-secondary" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{ __('Support Only INR Currency')}}">
                          <i class="fa fa-info"></i>
                        </small>
                      </div>
                      <div class="col-md-2">
                          <label class="switch">
                            {!! Form::checkbox('instamojo_payment', 1, $config->instamojo_payment, ['class' => 'custom_toggle', 'id'=>'instamojo_check']) !!}
                          </label>
                      </div>
                  </div>
              </div>
              <div class="row mx-2 my-4" style="{{ $config->instamojo_payment==1 ? "" : "display: none" }}" id="instamojo_box">
                  <div class="col-md-6">
                      <div class="form-group{{ $errors->has('IM_API_KEY') ? ' has-error' : '' }}">
                          <label class="text-dark">{{ __('INSTA MOJO Api Key') }}</label>
                          <input type="text" name="IM_API_KEY" value="{{ $env_files['IM_API_KEY'] }}" class="form-control">
                          <small class="text-danger">{{ $errors->first('IM_API_KEY') }}</small>
                      </div>
                  </div>

                  <div class="col-md-6">
                      <div class="search form-group{{ $errors->has('IM_AUTH_TOKEN') ? ' has-error' : '' }}">
                          <label class="text-dark">{{ __('INSTA MOJO Api Token') }}</label>
                          <input type="text" name="IM_AUTH_TOKEN" value="{{ $env_files['IM_AUTH_TOKEN'] }}"  class="form-control">
                          <small class="text-danger">{{ $errors->first('IM_AUTH_TOKEN') }}</small>
                      </div>
                  </div>

                  <div class="col-md-4">
                    <div class="search form-group{{ $errors->has('IM_URL') ? ' has-error' : '' }}">
                        <label class="text-dark">{{ __('INSTA MOJO Payment URL') }}</label>
                        <input type="text" name="IM_URL" value="{{ $env_files['IM_URL'] }}"  class="form-control">
                        <small class="text-danger">{{ $errors->first('IM_URL') }}</small>
                    </div>
                </div>

                <div class="col-md-6">
                    <small class="text-danger">             
                    <br/>           
                        <ul>
                            <li>
                                <a target="__blank"  href="https://test.instamojo.com/api/1.1" title="{{__('For Testing Mode Payment URL')}}">{{__('For Testing Mode Payment URL')}} https://test.instamojo.com/api/1.1</a>
                            </li>
                            <li>
                                <a target="__blank"  href="https://www.instamojo.com/api/1.1/" title="{{__('For Live Mode Payment URL')}}">{{__('For Live Mode Payment URL')}} https://www.instamojo.com/api/1.1/</a>
                            </li>
                        </ul>
                    </small>
                </div>
                  
              </div>
          </div>
      </div>
  </div>
<!-- ======= INSTA MOJO PAYMENT end ========== -->

<!-- ======= MOLLIE PAYMENT start ========== -->
<div class="col-md-6 col-lg-6 col-xl-12">
  <div class="bg-info-rgba ml-6 mr-6 mb-6">
      <div class="card-header text-dark"><h4><i class="feather icon-Settings" aria-hidden="true"></i> {{__('MOLLIE Payment Gateway')}}</h4></div>
          <div class="payment-gateway-block">
              <div class="form-group">
                  <div class="row mx-2 my-4">
                      <div class="col-md-10">
                        {!! Form::label('mollie_payment', __('MOLLIE Payment Gateway')) !!}
                      </div>
                      <div class="col-md-2">
                          <label class="switch">
                            {!! Form::checkbox('mollie_payment', 1, $config->mollie_payment, ['class' => 'custom_toggle','id' => 'mollie_check']) !!}
                          </label>
                      </div>
                  </div>
              </div>
              <div class="row mx-2 my-4" style="{{ $config->mollie_payment==1 ? "" : "display: none" }}" id="mollie_box">
                  <div class="col-md-12">
                      <div class="form-group{{ $errors->has('MOLLIE_KEY') ? ' has-error' : '' }}">
                          <label class="text-dark">{{ __('MOLLIE Key') }} <sup class="text-danger">*</sup></label>
                          <input type="text" name="MOLLIE_KEY" value="{{ $env_files['MOLLIE_KEY'] }}" placeholder="{{__('Please Enter Mollie Key')}}" class="form-control">
                          <small class="text-danger">{{ $errors->first('MOLLIE_KEY') }}</small>
                      </div>
                  </div>
                  
              </div>
          </div>
      </div>
  </div>
<!-- ======= MOLLIE PAYMENT end ========== -->

<!-- ======= CASHFREE PAYMENT start ========== -->
<div class="col-md-6 col-lg-6 col-xl-12">
  <div class="bg-info-rgba ml-6 mr-6 mb-6">
      <div class="card-header text-dark"><h4><i class="feather icon-Settings" aria-hidden="true"></i> {{__('CASHFREE Payment Gateway')}}</h4></div>
          <div class="payment-gateway-block">
              <div class="form-group">
                  <div class="row mx-2 my-4">
                      <div class="col-md-10">
                        {!! Form::label('cashfree_payment', __('CASHFREE Payment Gateway')) !!}
                      </div>
                      <div class="col-md-2">
                          <label class="switch">
                            {!! Form::checkbox('cashfree_payment', 1, $config->cashfree_payment, ['class' => 'custom_toggle','id' => 'cashfree_check']) !!}
                          </label>
                      </div>
                  </div>
              </div>
              <div class="row mx-2 my-4" style="{{ $config->cashfree_payment==1 ? "" : "display: none" }}" id="cashfree_box">
                  <div class="col-md-4">
                      <div class="form-group{{ $errors->has('CASHFREE_APP_ID') ? ' has-error' : '' }}">
                          <label class="text-dark">{{ __('CASH FREE APP ID') }} <sup class="text-danger">*</sup></label>
                          {!! Form::text('CASHFREE_APP_ID', null, ['class' => 'form-control']) !!}
                          <small class="text-danger">{{ $errors->first('CASHFREE_APP_ID') }}</small>
                      </div>
                  </div>

                  <div class="col-md-4">
                      <div class="search form-group{{ $errors->has('CASHFREE_SECRET_ID') ? ' has-error' : '' }}">
                          <label class="text-dark">{{ __('CASHFREE Secret ID') }} <sup class="text-danger">*</sup></label>
                          <input type="password" name="CASHFREE_SECRET_ID" value="{{env('CASHFREE_SECRET_ID') ? env('CASHFREE_SECRET_ID') :''}}" id="cashfree_secret" class="form-control">
                          <small class="text-danger">{{ $errors->first('CASHFREE_SECRET_ID') }}</small>
                      </div>
                  </div>

                  <div class="col-md-4">
                    <div class="search form-group{{ $errors->has('CASHFREE_API_END_URL') ? ' has-error' : '' }}">
                        <label class="text-dark">{{ __('CASHFREE API and URL') }} <sup class="text-danger">*</sup></label>
                        <input type="text" name="CASHFREE_API_END_URL" value="{{env('CASHFREE_API_END_URL') ? env('CASHFREE_API_END_URL') : ''}}" placeholder="https://test.cashfree.com" class="form-control">
                        <small class="text-danger">{{ $errors->first('CASHFREE_API_END_URL') }}</small>
                    </div>
                </div>
                <div class="col-md-12">
                    <small class="text-danger">                      
                        <ul>
                            <li>
                                <a target="__blank"  href="https://test.cashfree.com" title="{{__('For Test Mode Use CASHFREE API END URL')}}">{{__('For Test Mode Use CASHFREE API END URL')}} https://test.cashfree.com</a>
                            </li>
                            <li>
                                <a target="__blank"  href="https://cashfree.com" title="{{__('For Live Mode Use CASHFREE API END URL')}}">{{__('For Live Mode Use CASHFREE API END URL')}} https://cashfree.com</a>
                            </li>
                        </ul>
                    </small>
                </div>
                  
              </div>
          </div>
      </div>
  </div>
<!-- ======= CASHFREE PAYMENT end ========== -->

<!-- ======= OMISE PAYMENT start ========== -->
<div class="col-md-6 col-lg-6 col-xl-12">
  <div class="bg-info-rgba ml-6 mr-6 mb-6">
      <div class="card-header text-dark"><h4><i class="feather icon-Settings" aria-hidden="true"></i> {{__('OMISE Payment Gateway')}}</h4></div>
          <div class="payment-gateway-block">
              <div class="form-group">
                  <div class="row mx-2 my-4">
                      <div class="col-md-10">
                          {!! Form::label('omise_payment', __('OMISE Payment Gateway')) !!}
                      </div>
                      <div class="col-md-2">
                          <label class="switch">
                              {!! Form::checkbox('omise_payment', 1, $config->omise_payment, ['class' => 'custom_toggle','id' => 'omise_check']) !!}
                          </label>
                      </div>
                  </div>
              </div>
              <div class="row mx-2 my-4" style="{{ $config->omise_payment==1 ? "" : "display: none" }}" id="omise_box">
                  <div class="col-md-4">
                      <div class="form-group{{ $errors->has('OMISE_PUBLIC_KEY') ? ' has-error' : '' }}">
                          <label class="text-dark">{{ __('OMISE Public Key') }} <sup class="text-danger">*</sup></label>
                          {!! Form::text('OMISE_PUBLIC_KEY', null, ['class' => 'form-control']) !!}
                          <small class="text-danger">{{ $errors->first('OMISE_PUBLIC_KEY') }}</small>
                      </div>
                  </div>

                  <div class="col-md-4">
                      <div class="search form-group{{ $errors->has('OMISE_SECRET_KEY') ? ' has-error' : '' }}">
                          <label class="text-dark">{{ __('OMISE Secret Key') }} <sup class="text-danger">*</sup></label>
                          <input class ="form-control" type="text" id="omise_secret" name="OMISE_SECRET_KEY" value="{{ $env_files['OMISE_SECRET_KEY'] ? $env_files['OMISE_SECRET_KEY'] : '' }}" >
                          <small class="text-danger">{{ $errors->first('OMISE_SECRET_KEY') }}</small>
                      </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group{{ $errors->has('OMISE_API_VERSION') ? ' has-error' : '' }}">
                        <label class="text-dark">{{ __('OMISE API Version') }} <sup class="text-danger">*</sup></label>
                        {!! Form::text('OMISE_API_VERSION', null, ['class' => 'form-control']) !!}
                        <small class="text-danger">{{ $errors->first('OMISE_API_VERSION') }}</small>
                    </div>
                </div>
                  
              </div>
          </div>
      </div>
  </div>
<!-- ======= OMISE PAYMENT end ========== -->

<!-- ======= Flutter Rave PAYMENT start ========== -->
<div class="col-md-6 col-lg-6 col-xl-12">
  <div class="bg-info-rgba ml-6 mr-6 mb-6">
    <div class="card-header text-dark"><h4><i class="feather icon-Settings" aria-hidden="true"></i> {{__('FLUTTER RAVE Payment Gateway')}}</h4><a href="https://dashboard.flutterwave.com/signup" title="({{__('Flutter Rave Site')}})" target="__blank">  ({{__('Flutter Rave Site')}})</a></div>
          <div class="payment-gateway-block">
              <div class="form-group">
                  <div class="row mx-2 my-4">
                      <div class="col-md-10">
                          {!! Form::label('flutterrave', __('FLUTTER RAVE Payment Gateway')) !!}
                      </div>
                      <div class="col-md-2">
                          <label class="switch">
                              {!! Form::checkbox('flutterrave_payment', 1, $config->flutterrave_payment, ['class' => 'custom_toggle','id' => 'flutter_check']) !!}
                          </label>
                      </div>
                  </div>
              </div>
              <div class="row mx-2 my-4" style="{{ $config->flutterrave_payment==1 ? "" : "display: none" }}" id="flutterave_box">
                  <div class="col-md-6">
                      <div class="form-group{{ $errors->has('RAVE_PUBLIC_KEY') ? ' has-error' : '' }}">
                          <label class="text-dark">{{ __('RAVE Public Key') }} <sup class="text-danger">*</sup></label>
                          <input type="text" name="RAVE_PUBLIC_KEY" value="{{ $env_files['RAVE_PUBLIC_KEY'] ? $env_files['RAVE_PUBLIC_KEY'] : '' }}" class="form-control">
                          <small class="text-danger">{{ $errors->first('RAVE_PUBLIC_KEY') }}</small>
                      </div>
                  </div>

                  <div class="col-md-6">
                      <div class="search form-group{{ $errors->has('RAVE_SECRET_KEY') ? ' has-error' : '' }}">
                          <label class="text-dark">{{ __('RAVE Secret Key') }} <sup class="text-danger">*</sup></label>
                          <input type="text" name="RAVE_SECRET_KEY" value="{{ $env_files['RAVE_SECRET_KEY'] ? $env_files['RAVE_SECRET_KEY'] :'' }}" class="form-control">
                          <small class="text-danger">{{ $errors->first('RAVE_SECRET_KEY') }}</small>
                      </div>
                  </div>

                  <div class="col-md-2">
                    <div class="search form-group{{ $errors->has('RAVE_COUNTRY') ? ' has-error' : '' }}">
                        <label class="text-dark">{{ __('Country Code') }} <sup class="text-danger">*</sup></label>
                        <input type="text" name="RAVE_COUNTRY" value="{{ $env_files['RAVE_COUNTRY'] ? $env_files['RAVE_COUNTRY'] : '' }}" class="form-control">
                        <small class="text-danger">{{ $errors->first('RAVE_COUNTRY') }}</small>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="search form-group{{ $errors->has('RAVE_LOGO') ? ' has-error' : '' }}">
                        <label class="text-dark">{{ __('RAVE Logo') }} <sup class="text-danger">*</sup>
                          <small class="badge badge-pill badge-secondary" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{ __('Enter Full URL to Logo')}}">
                            <i class="fa fa-info"></i>
                          </small>
                        </label>
                        <input type="text" name="RAVE_LOGO" value="{{ $env_files['RAVE_LOGO'] ? $env_files['RAVE_LOGO'] : '' }}" class="form-control">
                       
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="search form-group{{ $errors->has('RAVE_PREFIX') ? ' has-error' : '' }}">
                        <label class="text-dark">{{ __('RAVE Prefix') }} <sup class="text-danger">*</sup></label>
                        <input type="text" name="RAVE_PREFIX" value="{{ $env_files['RAVE_PREFIX'] ? $env_files['RAVE_PREFIX'] : '' }}" class="form-control">
                        <small class="text-danger">{{ $errors->first('RAVE_PREFIX') }}</small>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="search form-group{{ $errors->has('RAVE_SECRET_HASH') ? ' has-error' : '' }}">
                        <label class="text-dark">{{ __('RAVE Secret Hash') }} <sup class="text-danger">*</sup></label>
                        <input type="text" name="RAVE_SECRET_HASH" value="{{ $env_files['RAVE_SECRET_HASH'] ? $env_files['RAVE_SECRET_HASH'] : '' }}" class="form-control">
                        <small class="text-danger">{{ $errors->first('RAVE_SECRET_HASH') }}</small>
                    </div>
                </div>
                  
              </div>
          </div>
      </div>
  </div>
<!-- ======= Flutter Rave PAYMENT end ========== -->

<!-- ======= PAYHERE PAYMENT start ========== -->
<div class="col-md-6 col-lg-6 col-xl-12">
    <div class="bg-info-rgba ml-6 mr-6 mb-6">
        <div class="card-header text-dark"><h4><i class="feather icon-Settings" aria-hidden="true"></i> {{__('PAYHERE Payment Gateway')}}</h4></div>
            <div class="payment-gateway-block">
                <div class="form-group">
                    <div class="row mx-2 my-4">
                        <div class="col-md-10">
                          {!! Form::label('payhere', __('PAYHERE Payment Gateway')) !!}
                        </div>
                        <div class="col-md-2">
                            <label class="switch">
                              {!! Form::checkbox('payhere_payment', 1, $config->payhere_payment, ['class' => 'custom_toggle','id' => 'payhere_check']) !!}
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row mx-2 my-4" style="{{ $config->payhere_payment==1 ? "" : "display: none" }}" id="payhere_box">
                    <div class="col-md-3">
                        <div class="form-group{{ $errors->has('PAYHERE_BUISNESS_APP_CODE') ? ' has-error' : '' }}">
                            <label class="text-dark">{{ __('PAYHERE Business APP Code') }} <sup class="text-danger">*</sup>
</label>
                            <input type="text" name="PAYHERE_BUISNESS_APP_CODE" value="{{ $env_files['PAYHERE_BUISNESS_APP_CODE'] }}" class="form-control">
                            <small class="text-danger">{{ $errors->first('PAYHERE_BUISNESS_APP_CODE') }}</small>
                        </div>
                    </div>
  
                    <div class="col-md-6">
                        <div class="search form-group{{ $errors->has('PAYHERE_APP_SECRET') ? ' has-error' : '' }}">
                            <label class="text-dark">{{ __('PAYHERE APP Secret Key') }} <sup class="text-danger">*</sup>
</label>
                            <input type="text" name="PAYHERE_APP_SECRET" value="{{ $env_files['PAYHERE_APP_SECRET'] }}" class="form-control">
                            <small class="text-danger">{{ $errors->first('PAYHERE_APP_SECRET') }}</small>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="search form-group{{ $errors->has('PAYHERE_MERCHANT_ID') ? ' has-error' : '' }}">
                            <label class="text-dark">{{ __('PAYHERE Merchant ID') }} <sup class="text-danger">*</sup>
</label>
                            <input type="text" name="PAYHERE_MERCHANT_ID" value="{{ $env_files['PAYHERE_MERCHANT_ID'] }}" class="form-control">
                            <small class="text-danger">{{ $errors->first('PAYHERE_MERCHANT_ID') }}</small>
                        </div>
                    </div>
  
                    <div class="col-md-6">
                      <label class="text-dark">{{ __('PAYHERE Payment Environment LIVE/SANDBOX') }}</label>
                    
                      <label class="switch">
                          {!! Form::checkbox('PAYHERE_MODE', 1, ($env_files['PAYHERE_MODE'] == 'live' ? 1 : 0), ['class' => 'custom_toggle']) !!}
                      </label>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
  <!-- ======= PAYHERE PAYMENT end ========== -->

  <!-- ======= BANK DETAILS PAYMENT start ========== -->
<div class="col-md-6 col-lg-6 col-xl-12">
    <div class="bg-info-rgba ml-6 mr-6 mb-6">
        <div class="card-header text-dark"><h4><i class="feather icon-Settings" aria-hidden="true"></i> {{__('Bank Details')}}</h4></div>
            <div class="payment-gateway-block">
                <div class="form-group">
                    <div class="row mx-2 my-4">
                        <div class="col-md-10">
                            {!! Form::label('bankdetails', __('Bank Details')) !!}
                        </div>
                        <div class="col-md-2">
                            <label class="switch">
                                {!! Form::checkbox('bankdetails', 1, $config->bankdetails, ['class' => 'custom_toggle']) !!}
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row mx-2 my-4" style="{{ $config->bankdetails==1 ? "" : "display: none" }}" id="bank_box">
                    <div class="col-md-3">
                        <div class="form-group{{ $errors->has('account_no') ? ' has-error' : '' }}">
                            <label class="text-dark">{{ __('Account Number') }} <sup class="text-danger">*</sup>
</label>
                            <input id="payum" type="text" class="form-control" value="{{$config->account_no}}" name="account_no">
                            <small class="text-danger">{{ $errors->first('account_no') }}</small>
                        </div>
                    </div>
  
                    <div class="col-md-3">
                      <div class="form-group{{ $errors->has('account_name') ? ' has-error' : '' }}">
                          <label class="text-dark">{{ __('Account Owner Name') }} <sup class="text-danger">*</sup>
</label>
                          <input id="payum" type="text" class="form-control" value="{{$config->account_name}}" name="account_name">
                          <small class="text-danger">{{ $errors->first('account_name') }}</small>
                      </div>
                  </div>
  
                    <div class="col-md-3">
                        <div class="search form-group{{ $errors->has('ifsc_code') ? ' has-error' : '' }}">
                            <label class="text-dark">{{ __('IFSC Code') }} <sup class="text-danger">*</sup>
</label>
                            <input id="payum" type="text" class="form-control" value="{{$config->ifsc_code}}" name="ifsc_code">
                            <small class="text-danger">{{ $errors->first('ifsc_code') }}</small>
                        </div>
                    </div>
  
                    <div class="col-md-3">
                      <div class="search form-group{{ $errors->has('bank_name') ? ' has-error' : '' }}">
                          <label class="text-dark">{{ __('Bank Name') }} <sup class="text-danger">*</sup>
</label>
                          <input type="text" name="bank_name" value="{{$config->bank_name}}" id="payusalt" class="form-control">
                          <small class="text-danger">{{ $errors->first('bank_name') }}</small>
                      </div>
                  </div>
                    
                </div>
            </div>
        </div>
    </div>
  <!-- ======= BANK DETAILS PAYMENT end ========== -->

  <!-- ======= AWS STORAGE PAYMENT start ========== -->
<div class="col-md-6 col-lg-6 col-xl-12">
    <div class="bg-info-rgba ml-6 mr-6 mb-6">
        <div class="card-header text-dark"><h4><i class="feather icon-Settings" aria-hidden="true"></i> {{__('AWS Storage Details')}}</h4></div>
            <div class="payment-gateway-block">
                <div class="form-group">
                    <div class="row mx-2 my-4">
                        <div class="col-md-10">
                            {!! Form::label('aws', __('AWS Storage Details')) !!}
                        </div>
                        <div class="col-md-2">
                            <label class="switch">
                                {!! Form::checkbox('aws', 1, $config->aws, ['class' => 'custom_toggle']) !!}
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row mx-2 my-4" style="{{ $config->aws==1 ? "" : "display: none" }}" id="aws_box">
                    <div class="col-md-3">
                        <div class="form-group{{ $errors->has('key') ? ' has-error' : '' }}">
                            <label class="text-dark">{{ __('AWS Access Key') }} <sup class="text-danger">*</sup>
</label>
                            <input id="payum" type="text" class="form-control" value="{{isset($env_files['key']) ? $env_files['key'] : '' }}" name="key">
                            <small class="text-danger">{{ $errors->first('key') }}</small>
                        </div>
                    </div>
  
                    <div class="col-md-3">
                      <div class="form-group{{ $errors->has('secret') ? ' has-error' : '' }}">
                          <label class="text-dark">{{ __('AWS Secret Key') }} <sup class="text-danger">*</sup>
</label>
                          <input id="payum" type="text" class="form-control" value="{{isset($env_files['secret']) ? $env_files['secret'] :'' }}" name="secret">
                          <small class="text-danger">{{ $errors->first('secret') }}</small>
                      </div>
                  </div>
  
                    <div class="col-md-3">
                        <div class="search form-group{{ $errors->has('region') ? ' has-error' : '' }}">
                            <label class="text-dark">{{ __('AWS Bucket Region') }} <sup class="text-danger">*</sup>
</label>
                            <input id="payum" type="text" class="form-control" value="{{isset($env_files['region']) ? $env_files['region'] : '' }}" name="region">
                            <small class="text-danger">{{ $errors->first('region') }}</small>
                        </div>
                    </div>
  
                    <div class="col-md-3">
                        <div class="search form-group{{ $errors->has('bucket') ? ' has-error' : '' }}">
                            <label class="text-dark">{{ __('AWS Bucket Name') }} <sup class="text-danger">*</sup>
</label>
                            <input type="text" name="bucket" value="{{isset($env_files['bucket']) ? $env_files['bucket'] : '' }}" id="payusalt" class="form-control">
                            <small class="text-danger">{{ $errors->first('bucket') }}</small>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
  <!-- ======= AWS STORAGE PAYMENT end ========== -->



<div class="col-md-6 col-lg-6 col-xl-12 form-group">
  <button type="submit" class="btn btn-primary-rgba" title="{{ __('Save') }}"
><i class="fa fa-check-circle"></i>
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