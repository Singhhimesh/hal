@extends('layouts.master')
@section('title',__('Create Coupon'))
@section('breadcum')
	<div class="breadcrumbbar">
    <h4 class="page-title">{{ __('Create Coupon') }}</h4>
    <div class="breadcrumb-list">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('/admin')}}" title="{{ __('Dashboard') }}">{{ __('Dashboard') }}</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ __('Create Coupon') }}</li>
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
          <a href="{{url('admin/coupons')}}" class="float-right btn btn-primary-rgba mr-2" title="{{ __('Back') }}"><i
            class="feather icon-arrow-left mr-2"></i>{{ __('Back') }}</a>
          <h5 class="box-title">{{__('Create Coupon')}}</h5>
        </div>
        <div class="card-body ml-2">
          {!! Form::open(['method' => 'POST', 'action' => 'CouponController@store']) !!}
            <div class="row">
              <div class="col-md-3">
                <div class="form-group{{ $errors->has('coupon_code') ? ' has-error' : '' }}">
                  {!! Form::label('coupon_code', __('Coupon Code')) !!}
                   <small class="badge badge-pill badge-secondary" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{__('Please Enter Unique Coupon Code. In Capital Letters and Numbers')}} eg: SALE50">
                      <i class="fa fa-info"></i>
                  </small>                 
                  {!! Form::text('coupon_code', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => __('Please Enter Unique Coupon Code') ,'pattern'=>'[A-Za-z0-9]+','title'=>__('Please Do Not Use')]) !!}
                  <small class="text-danger">{{ $errors->first('coupon_code') }}</small>
                </div>

                @if(isset($config->stripe_payment) && $config->stripe_payment == '1')
                  @if(env('STRIPE_KEY') != NULL && env('STRIPE_SECRET') != NULL)
                    <div class="bootstrap-checkbox {{ $errors->has('in_stripe') ? ' has-error' : '' }}">
                      <div class="row">
                        <div class="col-md-7">
                          <h6>{{__('Use For Stripe')}} ?</h6>
                        </div>
                        <div class="col-md-5 pad-0">
                          <div class="make-switch">
                            <label class="switch">
                              <input type="checkbox" name="in_stripe" checked="" class="checkbox-switch">
                              <span class="slider round"></span>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <small class="text-danger">{{ $errors->first('in_stripe') }}</small>
                      </div>
                    </div><br/>
                  @endif
                @endif
                </div>
                <div class="col-md-3">
                  <div class="form-group{{ $errors->has('redeem_by') ? ' has-error' : '' }}">
                  {!! Form::label('redeem_by',__('Valid Upto')) !!}
                  <small class="badge badge-pill badge-secondary" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{__('Please Enter Coupon Validate Upto Or Expiry Date.')}}">
                      <i class="fa fa-info"></i>
                  </small>
                  
                  {!! Form::date('redeem_by', null, ['class' => 'form-control', 'placeholder' => '']) !!}
                  <small class="text-danger">{{ $errors->first('redeem_by') }}</small>
                  </div>
                </div>
                <div class="col-md-2"></div>
                <div class="col-md-4">
                  {!! Form::hidden('currency', $currency_code) !!}
                  <div class="form-group{{ $errors->has('duration') ? ' has-error' : '' }}">
                    {!! Form::label('duration',__('Duration')) !!}
                    <small class="badge badge-pill badge-secondary" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{__('Please Select Coupon Duration.')}}">
                        <i class="fa fa-info"></i>
                    </small>                 
                    
                    {!! Form::select('duration', ['once'=>__('Once'), 'repeating' =>__('Repeating'), 'forever' => __('Forever')], null, ['class' => 'form-control select2', 'required' => 'required']) !!}
                    <small class="text-danger">{{ $errors->first('duration') }}</small>
                  </div>  
                </div>
             
              <div class="col-md-6">
                <div class="bootstrap-checkbox {{ $errors->has('percent_check') ? ' has-error' : '' }}">
                  <div class="row">
                    <div class="col-md-7">
                      <h6>{{__('Discount in : Amount/Percent')}} (%)</h6>
                    </div>
                    <div class="col-md-5 pad-0">
                      <div class="make-switch">
                        {!! Form::checkbox('percent_check', 1, 1, ['class' => 'bootswitch', "data-on-text"=>__('Percent Off'), "data-off-text"=>__('Amount Off'), "data-size"=>"small"]) !!}
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <small class="text-danger">{{ $errors->first('percent_check') }}</small>
                  </div>
                </div>
                <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
  						    {!! Form::number('amount', 1, ['class' => 'form-control selection-input', 'min' => 0]) !!}
  						    <small class="text-danger">{{ $errors->first('amount') }}</small>
                </div>     
              </div>     
              <div class="col-md-2"></div>
              <div class="col-md-4">
                <div id="coupon_month_duration" class="form-group{{ $errors->has('duration_in_months') ? ' has-error' : '' }}">
                  {!! Form::label('duration_in_months', __('Duration In Months')) !!}
                  <small class="badge badge-pill badge-secondary" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{__('Please Enter Coupon Duration For Number of Months.')}}">
                      <i class="fa fa-info"></i>
                  </small>
                 
                  {!! Form::number('duration_in_months', 1, ['class' => 'form-control', 'min' => 0]) !!}
                  <small class="text-danger">{{ $errors->first('duration_in_months') }}</small>
                </div>

                <div class="form-group{{ $errors->has('max_redemptions') ? ' has-error' : '' }}">
                  {!! Form::label('max_redemptions', __('Max Redemptions')) !!}
                  <small class="badge badge-pill badge-secondary" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{__('Please Enter Total Coupon Use Count.')}}">
                      <i class="fa fa-info"></i>
                  </small>
                
                  {!! Form::number('max_redemptions', 1, ['class' => 'form-control', 'min' => 0, 'required' => 'required']) !!}
                  <small class="text-danger">{{ $errors->first('max_redemptions') }}</small>
                </div>

                
              
              </div>
                <div class="form-group">
                  <button type="reset" class="btn btn-success-rgba" title="{{__('Reset')}}">{{__('Reset')}}</button>
                  <button type="submit" class="btn btn-primary-rgba" title=" {{ __('Create') }}"><i class="fa fa-check-circle"></i>
                    {{ __('Create') }}</button>
                </div>
                {!! Form::close() !!}
           </div>
      </div>
    </div>
  </div>
</div>
@endsection 
@section('script')
<script>
  // Duration In Repeating (Show Duration In Months)  
  $("input[name='duration_in_months']").parent().hide();
  $("select[name='duration']").on('change',function(){
    if(this.value === 'repeating'){
      $("input[name='duration_in_months']").parent().fadeIn();
    }
    else {
      $("input[name='duration_in_months']").parent().fadeOut();
    }
  });
</script>
<script>
  (function($){
    $.noConflict();    
  })(jQuery);    
</script>  
@endsection