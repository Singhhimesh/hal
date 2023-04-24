@extends('layouts.master')
@section('title',__('Change Subscription'))
@section('breadcum')
	<div class="breadcrumbbar">
      <h4 class="page-title">{{ __('Change Subscription') }}</h4>
      <div class="breadcrumb-list">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/admin')}}" title="{{ __('Dashboard') }}">{{ __('Dashboard') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('Change Subscription') }}</li>
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
          <a href="{{url('admin/plan')}}" class="float-right btn btn-primary-rgba mr-2" title="{{ __('Back') }}"><i
              class="feather icon-arrow-left mr-2"></i>{{ __('Back') }}</a>
          <h5 class="box-title">{{__('Change Subscription')}}</h5>
        </div>
        <div class="card-body ml-2">
          {!! Form::open(['method' => 'POST', 'action' => 'UsersController@change_subscription', 'files' => true]) !!}
          <h5 class="box-title">{{__('User Name')}}: {{$user->name}}</h5>
            @php
              if (isset($plans)) {
                $planname='not exist';
                  if (isset($last_payment->plan->name) && !is_null($last_payment)){
                    $planname=$last_payment->plan->name;
                  }else{
                    if (isset($user_stripe_plan) && !is_null($user_stripe_plan)) {
                    $planname=$user_stripe_plan->name;
                    }
                  }
              
              }else{
                  $planname='not exist';
              }
            @endphp
            <h5 class="box-title">{{__('Last Subscription Plan')}}: {{$planname}}</h5>
              <div class="col-md-12">
                <input type="hidden" name="user_stripe_plan_id" value="{{$user_stripe_plan != null ? $user_stripe_plan->id : null}}">
                <input type="hidden" name="last_payment_id" value="{{$last_payment != null ? $last_payment->id : null}}">
                <input type="hidden" name="user_id" value="{{$user->id}}">
                <div class="form-group{{ $errors->has('plan') ? ' has-error' : '' }}">
                  {!! Form::label('plan',__('Select A Plan')) !!} 
                  <p class="inline info"> - {{__('Please Select Plan ForUser')}}</p>
                  {!! Form::select('plan_id', $plan_list, null, ['class' => 'form-control select2', 'required' => 'required', 'autofocus']) !!}
                  <small class="text-danger">{{ $errors->first('plan') }}</small>
                </div>
              </div>
              
              <div class="form-group">
                <button type="submit" class="btn btn-primary-rgba" title="{{ __('Change Subscription') }}"><i class="fa fa-check-circle"></i>{{ __('Change Subscription') }}</button>
              </div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection 
@section('script')

@endsection