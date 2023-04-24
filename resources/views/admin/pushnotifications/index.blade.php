@extends('layouts.master')
@section('title', __('Push Notification'))
@section('breadcum')
	<div class="breadcrumbbar">
        <h4 class="page-title">{{ __('Push Notification') }}</h4>
        <div class="breadcrumb-list">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{url('/admin')}}" title="{{ __('Dashboard') }}">{{ __('Dashboard') }}</a></li>
              <li class="breadcrumb-item active" aria-current="page">{{ __('Push Notification') }}</li>
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
    <div class="col-lg-7 col-xl-8">
      <div class="card m-b-30">
        <div class="card-header">
          <h5 class="box-title">{{__('Push Notification')}}</h5>
        </div>
        <div class="card-body ml-2">
            <form action="{{ route('admin.push.notif') }}" method="POST">
                @csrf
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group text-dark">
                        <label for="">{{__('Select User Group')}}: <span class="text-danger">*</span> </label>
                        <select required data-placeholder="{{__('Please Select User Group')}}" name="user_group" id="" class="select2 form-control">
                            <option value="">{{__('Please Select User Group')}}</option>
                            <option {{ old('user_group') == 'all' ? "selected" : "" }} value="all">{{__('All')}}</option>
                            <option {{ old('user_group') == 'all_admins' ? "selected" : "" }} value="all_admins">{{__('All Admins')}}</option>
                            <option {{ old('user_group') == 'all_customers' ? "selected" : "" }} value="all_customers">{{__('All Users')}}</option>
                            <option {{ old('user_group') == 'all_sellers' ? "selected" : "" }} value="all_sellers">{{__('All Producers')}}</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group text-dark">
                        <label for="">{{__('Target URL')}}: </label>
                        <input value="{{ old('target_url') }}" class="form-control" name="target_url" type="url" placeholder="{{ url('/') }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group text-dark">
                        <label for="">{{__('Subject')}}: <span class="text-danger">*</span></label>
                        <input placeholder="{{__('Subject')}}" type="text" class="form-control" required name="subject" value="{{ old('subject') }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group text-dark">
                        <label for="">{{__('Notification Body')}}: <span class="text-danger">*</span> </label>
                        <textarea required placeholder="{{__('Notification Body Note')}}" class="form-control" name="message" id="" cols="3" rows="5">{{ old('message') }}</textarea>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group text-dark">
                        <label for="">{{__('Notification Icon URL')}}: </label>
                        <input value="{{ old('icon') }}" name="icon" class="form-control" type="url" placeholder="https://someurl/icon.png">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group text-dark">
                        <label for="">{{__('Image URL')}}: </label>
                        <input value="{{ old('image') }}" class="form-control" name="image" type="url" placeholder="https://someurl/image.png">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="from-group text-dark">
                        <label for="">{{__('Show Button')}}: </label>
                        <br>
                        <label class="make-switch">
                            <input  class="custom_toggle" type="checkbox" name="show_button" onChange ='isshow()'>
                        </label>
                    </div>
                    <div id="buttonBox">
                        <div class="form-group text-dark">
                            <label for="">{{__('Button Text')}}:  <span class="text-danger">*</span></label>
                            <input value="{{ old('btn_text') }}" class="form-control" name="btn_text" type="text" placeholder="{{__('Grab Now')}}">
                        </div>
                        <div class="form-group text-dark">
                            <label for="">{{__('Button Target URL')}}: </label>
                            <input value="{{ old('btn_url') }}" class="form-control" name="btn_url" type="url" placeholder="https://someurl/image.png">
                        </div>
                    </div>
                </div>         
            </div>
      
            <div class="form-group">
              <button type="submit" class="btn btn-primary-rgba" title=" {{ __('Send') }}"><i class="fa fa-location-arrow"></i>
                {{ __('Send') }}</button>
            </div>
            {!! Form::close() !!}
            <div class="clear-both"></div>            

        </div>
   
  </div>
</div>
<div class="col-lg-5 col-xl-4">
    <div class="card m-b-30">
        <div class="card-header">
            <h5 class="card-title"> {{__('One signal Keys')}}</h5>
            <a title="Get one signal keys" href="https://onesignal.com/" target="__blank" title="{{__('Get Your Keys From Here')}}">
                <i class="fa fa-key"></i> {{__('Get Your Keys From Here')}}
            </a>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.onesignal.keys') }}" method="POST">
                @csrf

            <div class="form-group text-dark">
                        <div class="eyeCy">

                            <label for="ONESIGNAL_APP_ID"> {{__('ONE SIGNAL APP ID')}}: <span class="text-danger">*</span></label>
                            <input type="test" value="{{ env('ONESIGNAL_APP_ID') }}"
                                name="ONESIGNAL_APP_ID" placeholder="{{__('Enter ONE SIGNAL APP ID')}} " id="ONESIGNAL_APP_ID" type="password"
                                class="form-control">

                        </div>
                    </div>

                    <div class="form-group text-dark">
                        <div class="eyeCy">

                            <label for="ONESIGNAL_REST_API_KEY"> {{__('ONE SIGNAL REST API KEY')}}: <span class="text-danger">*</span></label>
                            <input type="text" value="{{ env('ONESIGNAL_REST_API_KEY') }}"
                                name="ONESIGNAL_REST_API_KEY" placeholder="{{__('Enter ONE SIGNAL REST API KEY')}} " id="ONESIGNAL_REST_API_KEY" type="password"
                                class="form-control">

                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success-rgba" title=" {{ __('Save') }}"><i class="fa fa-save"></i>
                          {{ __('Save') }}</button>
                      </div>
            </form>
        </div>
    </div>
</div>
</div>
@endsection 
@section('script')
<script>
  
    function isshow(){
        if($('.show_button').is(":checked")){
            $('input[name=btn_text]').attr('required','required');
            $('#buttonBox').show();
        }else{
            $('input[name=btn_text]').removeAttr('required');
            $('#buttonBox').hide();
        }
    }
   
</script>    
@endsection