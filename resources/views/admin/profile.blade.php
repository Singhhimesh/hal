@extends('layouts.master')
@section('title', __('Profile'))
@section('breadcum')
<div class="breadcrumbbar">
          <h4 class="page-title">{{ __('Profile') }}</h4>
          <div class="breadcrumb-list">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/admin')}}" title="{{ __('Dashboard') }}">{{ __('Dashboard') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('Profile') }}</li>
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
          			<h5 class="box-title">{{Auth::user()->name}} {{__(' Profile')}}</h5>
        		</div>
        		<div class="card-body ml-2">
					<div class="row">
			
						
      				</div>
    			</div>
				<div class="row mx-2">
					<!-- ======= Facebook Login start ========== -->
					<div class="col-md-6 col-lg-6 col-xl-6 mb-4">
						<div class="bg-info-rgba ml-6 mr-6 mb-6">
							<div class="card-header text-dark"><h5 class="mb-0"> {{__('Change Email Address')}} : {{Auth::user()->email}}</h5>
              
                
              </div>
							<div class="payment-gateway-block">
                {!! Form::open(['method' => 'POST', 'action' => 'UserAccountController@update_profile']) !!}
									<div class="row mx-1 mt-3">
										<div class="col-md-12">
											<div class="form-group text-dark{{ $errors->has('new_email') ? ' has-error' : '' }}">
                        {!! Form::label('new_email', __('New Email')) !!} <sup class="text-danger">*</sup>
                        {!! Form::text('new_email', null, ['class' => 'form-control']) !!}
                        <small class="text-danger">{{ $errors->first('new_email') }}</small>
                      </div>
                      <div class="form-group text-dark{{ $errors->has('current_password') ? ' has-error' : '' }}">
                        {!! Form::label('current_password',__('Current Password')) !!} <sup class="text-danger">*</sup>
                        {!! Form::password('current_password', ['class' => 'form-control']) !!}
                        <small class="text-danger">{{ $errors->first('current_password') }}</small>
                      </div>
										<div class="col-md-6 col-lg-6 col-xl-12 form-group">
											<button type="submit" class="btn btn-primary-rgba" title="{{ __('Update') }}"><i class="fa fa-check-circle"></i>
												{{ __('Update') }}</button>
										</div>
									</div>
                  {!! Form::close() !!}
							</div>
						</div>
					</div>
          </div>
						<!-- ======= Facebook Login end ========== -->

						<!-- ======= Google Login start ========== -->
						<div class="col-md-6 col-lg-6 col-xl-6 mb-4">
							<div class="bg-info-rgba ml-6 mr-6 mb-6">
								<div class="card-header text-dark"><h5 class="mb-0">{{__('Change Password ')}}</h5></div>
								<div class="payment-gateway-block">
                  {!! Form::open(['method' => 'POST', 'action' => 'UserAccountController@update_profile']) !!}
										<div class="row mx-1 mt-3">
											<div class="col-md-12">
												<div class="form-group text-dark{{ $errors->has('current_password') ? ' has-error' : '' }}">
                          {!! Form::label('current_password', __('Current Password')) !!} <sup class="text-danger">*</sup>
                          {!! Form::password('current_password', ['class' => 'form-control']) !!}
                          <small class="text-danger">{{ $errors->first('current_password') }}</small>
                        </div>
                        <div class="form-group text-dark{{ $errors->has('new_password') ? ' has-error' : '' }}">
                          {!! Form::label('new_password', __('New Password')) !!} <sup class="text-danger">*</sup>
                          {!! Form::password('new_password', ['class' => 'form-control']) !!}
                          <small class="text-danger">{{ $errors->first('new_password') }}</small>
                        </div>
											<div class="col-md-6 col-lg-6 col-xl-12 form-group">
												<button type="submit" class="btn btn-primary-rgba" title="{{ __('Update') }}"><i class="fa fa-check-circle"></i>
													{{ __('Update') }}</button>
											</div>
										</div>
                    {!! Form::close() !!}
								</div>
							</div>
						</div>
            </div>
						<!-- ======= Google Login end ========== -->

						<!-- ======= GITLAB Login start ========== -->
						<div class="col-md-6 col-lg-6 col-xl-6 mb-4">
							<div class="bg-info-rgba ml-6 mr-6 mb-6">
								<div class="card-header text-dark"><h5 class="mb-0">{{__('Change Name')}}</h5>
                </div>
								<div class="payment-gateway-block">
									{!! Form::open(['method' => 'POST', 'action' => 'UserAccountController@update_profile']) !!}
										<div class="row mx-1 mt-3">
											<div class="col-md-12">
												<div class="form-group text-dark{{ $errors->has('current_name') ? ' has-error' : '' }}">
                          {!! Form::label('current_name', __('Current Name')) !!} 
                          {!! Form::text('current_name',Auth::user()->name, ['class' => 'form-control','readonly']) !!}
                          <small class="text-danger">{{ $errors->first('current_name') }}</small>
                        </div>
                        <div class="form-group text-dark{{ $errors->has('new_name') ? ' has-error' : '' }}">
                          {!! Form::label('new_name', __('New Name')) !!} <sup class="text-danger">*</sup>
                          {!! Form::text('new_name',null, ['class' => 'form-control']) !!}
                          <small class="text-danger">{{ $errors->first('new_name') }}</small>
                        </div>
                        <div class="form-group text-dark{{ $errors->has('current_password') ? ' has-error' : '' }}">
                          {!! Form::label('current_password',__('Current Password')) !!} <sup class="text-danger">*</sup>
                          {!! Form::password('current_password', ['class' => 'form-control']) !!}
                          <small class="text-danger">{{ $errors->first('current_password') }}</small>
                        </div>
											<div class="col-md-6 col-lg-6 col-xl-12 form-group">
												<button type="submit" class="btn btn-primary-rgba" title="{{ __('Update') }}"><i class="fa fa-check-circle"></i>
													{{ __('Update') }}</button>
											</div>
										</div>
                    {!! Form::close() !!}
								</div>
							</div>
						</div>
            </div>
						<!-- ======= GITLAB Login end ========== -->

						<!-- ======= Amazon Login start ========== -->
						<div class="col-md-6 col-lg-6 col-xl-6 mb-4">
							<div class="bg-info-rgba ml-6 mr-6 mb-6">
								<div class="card-header text-dark"><h5 class="mb-0">{{__('Change Profile Image ')}}</h5></div>
								<div class="payment-gateway-block">
									{!! Form::open(['method' => 'POST', 'action' => 'UserAccountController@update_profile','files' => true]) !!}
										<div class="row mx-1 mt-3">
											<div class="col-md-12">
												<div class="form-group text-dark{{ $errors->has('image') ? ' has-error' : '' }} input-file-block">
                          {!! Form::label('image', __('Profile Image')) !!}
                          {!! Form::file('image', ['class' => 'input-file', 'id'=>'image']) !!}
                          <small class="text-danger">{{ $errors->first('image') }}</small>
                        </div>
                      </div>
                      @if(Auth::user()->image != NULL)
                        <div class="col-xs-6">
                          <img src="{{asset('images/users/' . Auth::user()->image)}}" class="img-responsive img-thumbnail" width="130" height="100" alt="">
                        </div>
                      @endif
											<div class="col-md-6 col-lg-6 col-xl-12 form-group">
												<button type="submit" class="btn btn-primary-rgba" title="{{ __('Update') }}"><i class="fa fa-check-circle"></i>
													{{ __('Update') }}</button>
											</div>
										</div>
                    {!! Form::close() !!}
								</div>
							</div>
						</div>
            </div>
						<!-- ======= Amazon Login end ========== -->
				</div>
            </div></div>
  			</div>
		</div>
	</div>

  

@endsection 
@section('script')
@endsection