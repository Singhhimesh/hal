@extends('layouts.master')
@section('title',__('Create User'))
@section('breadcum')
	<div class="breadcrumbbar">
    <h4 class="page-title">{{ __('Create User') }}</h4>
    <div class="breadcrumb-list">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('/admin')}}" title="{{ __('Dashboard') }}">{{ __('Dashboard') }}</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ __('Create User') }}</li>
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
          <p>{{ $error}}<button type="button" class="close" data-dismiss="alert" aria-label="Close" title="{{ __('Clsoe') }}">
          <span aria-hidden="true" style="color:red;">&times;</span></button></p>
        @endforeach  
      </div>
    @endif
    <div class="col-lg-12">
      <div class="card m-b-50">
        <div class="card-header">
          <a href="{{ route('users.index') }}" class="float-right btn btn-primary-rgba mr-2" title="{{ __('Back') }}"><i
            class="feather icon-arrow-left mr-2"></i>{{ __('Back') }}</a>
          <h5 class="box-title">{{__('Create User')}}</h5>
        </div>
        <div class="card-body ml-2">
          {!! Form::open(['method' => 'POST', 'action' => 'UsersController@store', 'files' => true]) !!}
          <div class="bg-info-rgba p-4 mb-4">
            <h4 class="pb-4">{{__('Personal Details')}}</h4>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="name">
                    {{ __('Enter Full Name') }}:
                    <sup class="text-danger">*</sup>
                  </label>
                  <input value="{{ old('name') }}" autofocus required name="name" type="text" class="form-control"
                    placeholder="{{ __('Please Enter Your Full Name') }}" />
                </div>
              </div> 

              <div class="col-md-4">
                <div class="form-group">
                  <label for="email">{{ __('Email Address') }}:<sup class="text-danger">*</sup></label>
                  <input value="{{ old('email') }}" required type="email" name="email"
                    placeholder="{{ __('eg: name@yourdomain.com') }}"
                    class="form-control">
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="mobile"> {{ __('Mobile Number') }}:</label>
                  <input value="{{ old('mobile') }}" type="number" name="mobile"
                    placeholder="{{ __('Please Enter Your Mobile No') }} "
                    class="form-control">
                </div>
              </div>

              <div class="col-md-2">
                <div class="form-group">
                  <label for="age"> {{ __('Age') }}:</label>
                  <input value="{{ old('age') }}" type="number" name="age"
                    placeholder="{{ __('Your Age') }} "
                    class="form-control">
                </div>
              </div>

              <div class="col-md-2">
                <div class="form-group">
                  <label for="role">{{ __('Select Role') }}:<sup class="text-danger">*</sup></label>
                  <select class="form-control select2" name="role">
                    @foreach($roles as $role)
                    <option vlaue="{{$role->name}}">{{ucfirst($role->name)}}</option>
                  @endforeach
                  </select>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label>{{ __('Password') }}<sup class="text-danger">* </sup>
                    <small class="badge badge-pill badge-secondary" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{__('At least 8 characters long but 14 or more is better. A combination of uppercase letters, lowercase letters, numbers, and symbols is better.')}}">
                      <i class="fa fa-info"></i>
                    </small>
                  </label>
                  <input type="password" name="password" class="form-control"
                    placeholder="{{ __('Please Enter Your Password') }}">
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group" >
                  <label>{{ __('Confirm Password') }}<sup class="text-danger">*</sup></label>
                  <input type="password" name="confirm_password" class="form-control"
                    placeholder="{{ __('Please Enter Your Password Again') }}">
                </div>
              </div>              
            </div>
          </div>

          <div class="bg-info-rgba p-4 mb-4">
            <h4 class="pb-4">Address</h4>
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label for="address">{{ __('Address') }}: </label>
                  <textarea name="address" class="form-control" rows="1"
                    placeholder="{{ __('Please Enter Your Address') }}" value="{{ old('address') }}"></textarea>
                </div>
              </div>

              <div class="col-md-3">
                <div class="form-group">
                  <label for="country">{{__('Country')}}</label>
                  <select id="country-dropdown" class="form-control select2" name="country">
                    <option value="">{{__('Select Your Country')}}</option>
                    @foreach ($country as $country) 
                    <option value="{{$country->id}}">
                    {{$country->name}}
                    </option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="col-md-3">
                <div class="form-group">                  
                  <label for="state">{{__('State')}}:</label>
                  <select class="form-control select2"  name="state" id="state-dropdown"  >
                  </select>
                </div>
              </div>

              <div class="col-md-3">
                <div class="form-group">
                  <label for="city">{{__('City')}}</label>
                  <select class="form-control select2"  name="city" id="city-dropdown" >
                  </select>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-12">
              <div class="form-group">
                <button type="reset" class="btn btn-success-rgba" title="{{__('Reset')}}">{{__('Reset')}}</button>
                <button type="submit" class="btn btn-primary-rgba" title="{{ __('Create') }}"><i class="fa fa-check-circle"></i>
                  {{ __('Create') }}</button>
              </div>
            </div>
          </div>

          {!! Form::close() !!}
          <div class="clear-both"></div>

        </div>
      </div>
    </div>
  </div>
</div>
</div>
@endsection 
@section('script')
<script>
  (function($){
    $.noConflict();
    $('form').on('submit', function(event){
      $('.loading-block').addClass('active');
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
  })(jQuery);    
</script>
<script>
      (function($) {
        jQuery.noConflict();
      $('#country-dropdown').on('change', function() {
      var country_id = this.value;
      $("#state-dropdown").html('');
      $.ajax({
      url:"{{url('get-states-by-country')}}",
      type: "POST",
      data: {
      country_id: country_id,
      _token: '{{csrf_token()}}' 
      },
      dataType : 'json',
      success: function(result){
        console.log("Result is ", result);
        $('#state-dropdown').html('<option value="">Select State</option>'); 
        $.each(result.states,function(key,value){
        $("#state-dropdown").append('<option value="'+value.id+'">'+value.name+'</option>');
        });
        $('#city-dropdown').html('<option value="">Select State First</option>'); 
        }
        });
      });    
      $('#state-dropdown').on('change', function() {
        $.noConflict();
      var state_id = this.value;
      $("#city-dropdown").html('');
      $.ajax({
        url:"{{url('get-cities-by-state')}}",
        type: "POST",
        data: {
        state_id: state_id,
        _token: '{{csrf_token()}}' 
      },
      dataType : 'json',
      success: function(result){
        $('#city-dropdown').html('<option value="">Select City</option>'); 
        $.each(result.cities,function(key,value){
        $("#city-dropdown").append('<option value="'+value.id+'">'+value.name+'</option>');
      });
      }
      });
      });
      })(jQuery);
</script>
    
@endsection