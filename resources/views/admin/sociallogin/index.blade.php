@extends('layouts.master')
@section('title', __('Social Logins Settings'))
@section('breadcum')
<div class="breadcrumbbar">
  <h4 class="page-title">{{ __('Social Login Settings') }}</h4>
  <div class="breadcrumb-list">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/admin')}}" title="{{ __('Dashboard') }}">{{ __('Dashboard') }}</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ __('Social Login Settings') }}</li>
      </ol>
  </div> 
</div>
@endsection
@section('maincontent')
<div class="contentbar">
  	<div class="row">
    	<div class="col-lg-12">
      		<div class="card m-b-50">
        		<div class="card-header">
          			<h5 class="box-title">{{__('Social Logins Settings')}}</h5>
        		</div>
        		<div class="card-body ml-2">
					@if ($errors->any())
						<div class="alert alert-danger">
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif
					<div class="row">
			
						@php
							$fb_login_status = App\Config::select('fb_login')->where('id','=',1)->first();
							$google_login_status = App\Config::select('google_login')->where('id','=',1)->first();
							$gitlab_login_status = App\Config::select('gitlab_login')->where('id','=',1)->first();
							$amazon_login_status = App\Config::select('amazon_login')->where('id','=',1)->first();
						@endphp
      				</div>
    			</div>
				<div class="row mx-2">
					<!-- ======= Facebook Login start ========== -->
					<div class="col-md-6 col-lg-6 col-xl-6 mb-4">
						<div class="bg-info-rgba ml-6 mr-6 mb-6">
							<div class="card-header text-dark"><h5 class="mb-0"><i class="fa fa-facebook mr-2" aria-hidden="true"></i> {{__('Facebook Login Setting ')}}</h5></div>
							<div class="payment-gateway-block">
								<form action="{{ route('key.facebook') }}" method="POST">
									{{ csrf_field() }}
									<div class="row mx-1 mt-3">
										<div class="col-md-12">
											<div class="form-group">
												<label for="">{{__('Enable Facebook Login')}} </label>
												<input {{ $fb_login_status->fb_login == 1 ? 'checked' : "" }} type="checkbox" class="custom_toggle" name="fb_check" id="fb_check">
												<label for="fb_check"></label>
											</div>
										</div>
									</div>
									<div class="row mx-2 my-3" id="fb_box_dtl" style="{{ $fb_login_status->fb_login == 1 ? '' : "display: none" }}">
										<div class="col-md-12 mb-3">
											<label for="">{{__('Facebook Client ID')}}</label>
											<input type="text" value="{{ $env_files['FACEBOOK_CLIENT_ID'] }}" name="FACEBOOK_CLIENT_ID" class="form-control">
										</div>
										
										<div class="col-md-12 mail-password-input mb-3">
											<label for="">{{__('Facebook Secret ID')}}</label>	
											<input type="password" value="{{ $env_files['FACEBOOK_CLIENT_SECRET'] }}" name="FACEBOOK_CLIENT_SECRET" class="form-control" id="password-field" >
											<span  toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
										</div>
				
										<div class="col-md-12 mb-4">
											<label for="">{{__('Facebook Redirect URL')}}</label>
											<input type="text" placeholder="https://yoursite.com/login/facebook/callback" value="{{ $env_files['FACEBOOK_CALLBACK'] }}" name="FACEBOOK_CALLBACK" class="form-control">
										</div>
										<div class="col-md-6 col-lg-6 col-xl-12 form-group">
											<button type="submit" class="btn btn-primary-rgba" title="{{ __('Save') }}"><i class="fa fa-check-circle"></i>
												{{ __('Save') }}</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
						<!-- ======= Facebook Login end ========== -->

						<!-- ======= Google Login start ========== -->
						<div class="col-md-6 col-lg-6 col-xl-6 mb-4">
							<div class="bg-info-rgba ml-6 mr-6 mb-6">
								<div class="card-header text-dark"><h5 class="mb-0"><i class="fa fa-google" aria-hidden="true"></i> {{__('Google Login Setting ')}}</h5></div>
								<div class="payment-gateway-block">
									<form action="{{  route('key.google') }}" method="POST">
										{{ csrf_field() }}
										<div class="row mx-1 mt-3">
											<div class="col-md-12">
												<div class="form-group">
													<label for="">{{__('Enable Google Login')}} </label>
													<input {{ $google_login_status->google_login == 1 ? 'checked' : "" }} type="checkbox" class="custom_toggle" name="google_login" id="google_login" >
													<label for="google_login"></label>
												</div>
											</div>
										</div>
										<div class="row mx-2 my-3" id="g_box_detail" style="{{ $google_login_status->google_login == 1 ? '' : "display: none" }}">
											<div class="col-md-12 mb-3">
												<label for="">{{__('Google Client ID')}}</label>
												<input type="text" value="{{ $env_files['GOOGLE_CLIENT_ID'] }}" name="GOOGLE_CLIENT_ID" class="form-control" >
											</div>
											
											<div class="col-md-12 mail-password-input mb-3">
												<label for="">{{__('Google Secret ID')}}</label>
												<input type="text" value="{{ $env_files['GOOGLE_CLIENT_SECRET'] }}" name="GOOGLE_CLIENT_SECRET" class="form-control" id="password-field2" >
												<span toggle="#password-field2" class="fa fa-fw fa-eye field-icon toggle-password">
											</div>
					
											<div class="col-md-12 mb-4">
												<label for="">{{__('GoogleRedirectURL')}}</label>
												<input type="text" placeholder="https://yoursite.com/login/google/callback" value="{{ $env_files['GOOGLE_CALLBACK'] }}" name="GOOGLE_CALLBACK" class="form-control"  >
											</div>
											<div class="col-md-6 col-lg-6 col-xl-12 form-group">
												<button type="submit" class="btn btn-primary-rgba" title="{{ __('Save') }}"><i class="fa fa-check-circle"></i>
													{{ __('Save') }}</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
						<!-- ======= Google Login end ========== -->

						<!-- ======= GITLAB Login start ========== -->
						<div class="col-md-6 col-lg-6 col-xl-6 mb-4">
							<div class="bg-info-rgba ml-6 mr-6 mb-6">
								<div class="card-header text-dark"><h5 class="mb-0"><i class="fa fa-gitlab" aria-hidden="true"></i> {{__('GitLab Login Setting ')}}</h5></div>
								<div class="payment-gateway-block">
									<form action="{{  route('key.gitlab') }}" method="POST">
										{{ csrf_field() }}
										<div class="row mx-1 mt-3">
											<div class="col-md-12">
												<div class="form-group">
													<label for="">{{__('Enable GitLab Login')}} </label>
													<input {{ $gitlab_login_status->gitlab_login == 1 ? 'checked' : "" }} type="checkbox" class="custom_toggle" name="git_lab_check" id="git_lab_check" >
													<label for="git_lab_check"></label>
												</div>
											</div>
										</div>
										<div class="row mx-2 my-3" id="git_lab_box" style="{{ $gitlab_login_status->gitlab_login == 1 ? '' : "display: none" }}">
											<div class="col-md-12 mb-3">
												<label for="">{{__('GITLAB Client ID')}}</label>
												<input type="text" value="{{ $env_files['GITLAB_CLIENT_ID'] }}" name="GITLAB_CLIENT_ID" class="form-control" >
											</div>
											
											<div class="col-md-12 mail-password-input mb-3">
												<label for="">{{__('GITLAB Secret ID')}}</label>
												<input type="password" value="{{ $env_files['GITLAB_CLIENT_SECRET'] }}" name="GITLAB_CLIENT_SECRET" class="form-control" id="password-field3" >
												<span toggle="#password-field3" class="fa fa-fw fa-eye field-icon toggle-password">
											</div>
					
											<div class="col-md-12 mb-4">
												<label for="">{{__('GITLAB Redirect URL')}}</label>
												<input type="text" placeholder="https://yoursite.com/login/google/callback" value="{{ $env_files['GITLAB_CALLBACK'] }}" name="GITLAB_CALLBACK" class="form-control">
											</div>
											<div class="col-md-6 col-lg-6 col-xl-12 form-group">
												<button type="submit" class="btn btn-primary-rgba" title="{{ __('Save') }}"><i class="fa fa-check-circle"></i>
													{{ __('Save') }}</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
						<!-- ======= GITLAB Login end ========== -->

						<!-- ======= Amazon Login start ========== -->
						<div class="col-md-6 col-lg-6 col-xl-6 mb-4">
							<div class="bg-info-rgba ml-6 mr-6 mb-6">
								<div class="card-header text-dark"><h5 class="mb-0"><i class="fa fa-amazon" aria-hidden="true"></i> {{__('Amazon Login Setting ')}}</h5></div>
								<div class="payment-gateway-block">
									<form action="{{  route('key.amazon') }}" method="POST">
										{{ csrf_field() }}
										<div class="row mx-1 mt-3">
											<div class="col-md-12">
												<div class="form-group">
													<label for="">{{__('Enable Amazon Login')}} </label>
													<input {{ $amazon_login_status->amazon_login == 1 ? 'checked' : "" }} type="checkbox" class="custom_toggle" name="amazon_lab_check" id="amazon_lab_check">
													<label for="amazon_lab_check"></label>
												</div>
											</div>
										</div>
										<div class="row mx-2 my-3" id="amazon_lab_box" style="{{ $amazon_login_status->amazon_login == 1 ? '' : "display: none" }}">
											<div class="col-md-12 mb-3">
												<label for="">{{__('AMAZON LOGIN ID')}}</label>
												<input type="text" @if(isset($env_files['AMAZON_LOGIN_ID']))value="{{ $env_files['AMAZON_LOGIN_ID'] }}" @endif name="AMAZON_LOGIN_ID" class="form-control" >
											</div>
											
											<div class="col-md-12 mail-password-input mb-3">
												<label for="">{{__('AMAZON Login Secret')}}</label>
												<input type="password" @if(isset($env_files['AMAZON_LOGIN_SECRET']))value="{{ $env_files['AMAZON_LOGIN_SECRET'] }}" @endif name="AMAZON_LOGIN_SECRET" class="form-control" id="amazon-password-field3" >
												<span toggle="#amazon-password-field3" class="fa fa-fw fa-eye field-icon toggle-password">
											</div>
					
											<div class="col-md-12 mb-4">
												<label for="">{{__('AMAZON Redirect URL')}}</label>
												<input type="text" placeholder="https://yoursite.com/auth/amazon/callback" @if(isset($env_files['AMAZON_LOGIN_REDIRECT'])) value="{{ $env_files['AMAZON_LOGIN_REDIRECT'] }}" @endif name="AMAZON_LOGIN_REDIRECT" class="form-control">
											</div>
											<div class="col-md-6 col-lg-6 col-xl-12 form-group">
												<button type="submit" class="btn btn-primary-rgba" title="{{ __('Save') }}"><i class="fa fa-check-circle"></i>
													{{ __('Save') }}</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
						<!-- ======= Amazon Login end ========== -->
				</div>

  			</div>
		</div>
	</div>

  

@endsection 
@section('script')
<script type="text/javascript">
  
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
  
  
   $('#fb_check').on('change',function(){
	   if ($('#fb_check').is(':checked')){
			 $('#fb_box_dtl').show('fast');
	  }else{
		  $('#fb_box_dtl').hide('fast');
	  }
   });
  
   $('#google_login').on('change',function(){
	   if ($('#google_login').is(':checked')){
			 $('#g_box_detail').show('fast');
	  }else{
		  $('#g_box_detail').hide('fast');
	  }
   });
  
  
   $('#git_lab_check').on('change',function(){
	   if ($('#git_lab_check').is(':checked')){
			 $('#git_lab_box').show('fast');
	  }else{
		  $('#git_lab_box').hide('fast');
	  }
   });
   $('#amazon_lab_check').on('change',function(){
	   if ($('#amazon_lab_check').is(':checked')){
			 $('#amazon_lab_box').show('fast');
	  }else{
		  $('#amazon_lab_box').hide('fast');
	  }
   });
  
  </script>
  <script>
  (function($){
    $.noConflict();    
  })(jQuery);    
</script>  
@endsection