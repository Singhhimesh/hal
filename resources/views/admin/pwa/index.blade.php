@extends('layouts.master')
@section('title','Progressive Web App Setting')
@section('breadcum')
	<div class="breadcrumbbar">
        <h4 class="page-title">{{ __('Progressive Web APP Setting ') }}</h4>
        <div class="breadcrumb-list">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{url('/admin')}}" title="{{ __('Dashboard') }}">{{ __('Dashboard') }}</a></li>
              <li class="breadcrumb-item active" aria-current="page">{{ __('Progressive Web APP Setting ') }}</li>
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
							<h5 class="card-box">{{ __('Progressive Web APP Setting ') }}</h5>
						</div> 					   
						<div class="card-body">
							<div class="box-body admin-form-block z-depth-1">
								<!-- Nav tabs -->
							<ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">							  
							  <li role="presentation" class="nav-item">
								<a class="nav-link active" data-toggle="pill" href="#home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true" title="{{__('APP Setting')}}">{{__('APP Setting')}}</a>
							  </li>
							  <li role="presentation" class="nav-item">
								<a class="nav-link" data-toggle="pill" href="#profile" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true" title="{{__('Update Icons')}}">{{__('Update Icons')}}</a>
							  </li>							  
							</ul>					
							<!-- Tab panes -->
							<div class="tab-content" id="custom-tabs-four-tabContent">
							  <div role="tabpanel" class="tab-pane active" id="home">
									<br>
									<div class="card bg-danger-rgba m-b-30">
										<div class="card-body">
											<div class="row align-items-center">
												<div class="col-12">
													<div class="text-danger process-fonts"><i class="fa fa-info-circle"></i> {{ __('Progressive Web APP Requirements') }}
														<ul class="process-font">
															<li>
																{{__(('HTTPS must required in your domain (for enable contact your host provider for SSL configuration).'))}}
															</li>						
															<li>
																{{__("Icons and splash screens required and to be updated in Icon Settings.")}}
															</li>
															<li>
																{{__("PWA is lite app, When you open it in Mobile Browser its ask for add app in mobile. Its Not APK. You can not submit to Play Store.")}}
															</li>
															<li>
																{{__("Splash Screen works only on Apple Device.")}}
															</li>
														</ul>
													</div>
												</div>
											</div>
										</div>
									</div>					
								  <div class="row">
									  <div class="col-md-12">
										  <form action="{{ route('pwa.setting.update') }}" method="POST" enctype="multipart/form-data">
											  @csrf
											<div class="row">
												<div class="col-md-3">
												  <div class="form-group text-dark">										 
													  <div class="form-group make-switch">
														<h5 class="bootstrap-switch-label">{{__('Enable PWA')}}</h5>
														  
														<input class="custom_toggle col-md-6" {{ env("PWA_ENABLE") =='1' ? "checked" : "" }} type="checkbox"  name="PWA_ENABLE" >							
													  </div>
												  </div>
												</div>
												<div class="col-md-3">											  
												  <div class="form-group text-dark">
													  <label>{{__('APP Name')}}: </label>
													  <input  class="form-control" type="text" name="app_name" value="{{ env("PWA_NAME")}}"/>
												  </div>
												</div>
					
											  
												  <div class="col-md-3">
													  <div class="form-group text-dark">
														  <label>{{__('Theme Color For Header')}}: </label>
														  <input name="PWA_THEME_COLOR" class="form-control" type="color" value="{{env('PWA_THEME_COLOR') ?? '' }}"/>
													  </div>
												  </div>
												  <div class="col-md-3">
													  <div class="form-group text-dark">
														  <label for="">{{__('Background Color')}}:</label>
														  <input name="PWA_BG_COLOR" class="form-control" type="color" value="{{ env('PWA_BG_COLOR') ?? '' }}"/>
													  </div>
												  </div>
											  </div>
					
											  <div class="row">
												  <div class="col-md-6">
					
													  <div class="form-group text-dark">
														<label for="">{{__('Shortcut Icon For Home')}}: <span class="text-danger">*</span> </label>
														
														<div class="custom-file">
														  <input name="shorticon_1" type="file" class="custom-file-input @error('shorticon_1') is-invalid @enderror" id="shorticon_1">
														  <label class="custom-file-label" for="shorticon_1">{{ __("Select icon for login (96 x 96)") }}</label>
														</div>
													</div>
										  
														@error('shorticon_1')
														  <span class="invalid-feedback" role="alert">
															  <strong>{{ $message }}</strong>
														  </span>
														@enderror
													  </div>
												@if(env('SHORTCUT_ICON1') != NULL)
												  <div class="col-md-1 card text-center">
													  @if(env('SHORTCUT_ICON1') != NULL)
													<div class="card-body pt-4 pb-0">
														<img class="img-responsive" src="{{ url('images/icons/'.env('SHORTCUT_ICON1'))}}" alt="{{ 'shorticon_1' }}" width="60px" height="60px">
													</div>
													@endif
												  </div>
												@endif
												  <div class="col-md-6">
													  <div class="form-group text-dark">
														<label for="">{{__('Shortcut Icon For Login')}}: <span class="text-danger">*</span> </label>	
														<div class="custom-file">
														  <input name="shorticon_2" type="file" class="custom-file-input @error('shorticon_2') is-invalid @enderror" id="shorticon_2">
														  <label class="custom-file-label" for="shorticon_2">{{ __("Select icon for home (96 x 96)") }}</label>
														</div>										  
														@error('shorticon_2')
														  <span class="invalid-feedback" role="alert">
															  <strong>{{ $message }}</strong>
														  </span>
														@enderror
													  </div>
												  </div>
												 @if(env('SHORTCUT_ICON2') != NULL)
												  <div class="col-md-1 card text-center">	
													  <div class="card-body pt-4 pb-0">
														<img class="img-responsive" src="{{ url('images/icons/'.env('SHORTCUT_ICON2'))}}" alt="{{ 'shorticon_2' }}" width="60px" height="60px">
													  </div>													
												  </div>
												@endif												  
					
											  </div>	
											  <button  data-loading-text="<i class='fa fa-spinner fa-spin'></i> Saving..." type="submit" class="btn btn-primary-rgba" title="{{ __('Save') }}"><i class="fa fa-check-circle mr-1"></i> 
												 {{__('Save')}}
											</button>
										  </form>
									  </div>
					
								  </div>
								  
							  </div>
							  <div role="tabpanel" class="tab-pane" id="profile">
									<br>
								  <h4>{{__('PWA Icons')}}:</h4>					
								  <hr>					
								  <form action="{{ route('pwa.icons.update') }}" method="POST" enctype="multipart/form-data">
									  @csrf
									  <div class="row">
										
										  <div class="col-md-6">
											  <div class="form-group text-dark">
											
												
												<label>{{__('PWA Icon')}} (512x512): <span class="text-danger">*</span> </label>
												
												<div class="custom-file">
												  <input name="icon_512" type="file" class="custom-file-input @error('icon_512') 'is-invalid' @enderror" id="icon_512" width="60px" height="60px">
												  <label class="custom-file-label" for="icon_512">{{ __("Select icon (512 x 512)") }}</label>
												</div>
								  
												@error('icon_512')
												  <span class="invalid-feedback" role="alert">
													  <strong>{{ $message }}</strong>
												  </span>
												@enderror
											  </div>
										  </div>
					
										  <div class="offset-md-1 col-md-2 card">
											  <div class="card-body pt-4 pb-0">
												<img class="img-responsive" src="{{ url('images/icons/icon-512x512.png') }}" alt="icon_512x512.png" width="60px" height="60px">
											  </div>
										  </div>					
										  <div class="col-md-12">
											  <button  data-loading-text="<i class='fa fa-spinner fa-spin'></i> Updating..." type="submit" class="btn btn-primary-rgba" title="{{__('Update')}}"> <i class="fa fa-check-circle mr-1"></i>
												{{__('Update')}}
											  </button>
										  </div>
					
									  </div>
					
									  <br>
					
									  <h4>{{__('Splash Screens')}}:</h4>
									  <hr>
					
									  <div class="row">
					
										  <div class="col-md-6">
											  
											  <div class="form-group text-dark">
											
												
												<label>{{__('PWA Splash Screen')}} (2048x2732): <span class="text-danger">*</span> </label>
												
												<div class="custom-file">
												  <input name="splash_2048" type="file" class="custom-file-input @error('splash_2048') 'is-invalid' @enderror" id="splash_2048">
												  <label class="custom-file-label" for="splash_2048">{{ __("Select splash screen (2048 x 2732)") }}</label>
												</div>
								  
												@error('splash_2048')
												  <span class="invalid-feedback" role="alert">
													  <strong>{{ $message }}</strong>
												  </span>
												@enderror
											  </div>
										  </div>					
										  <div class="offset-md-1 col-md-2 card">
											 <div class="card-body pt-4 pb-0">
												<img class="img-responsive" src="{{ url('images/icons/splash-2048x2732.png') }}" alt="splash-2048x2732.png" width="60px" height="60px">
											 </div>
										  </div>					
										  <div class="col-md-12">
											<button  data-loading-text="<i class='fa fa-spinner fa-spin'></i> Updating..." type="submit" class="btn btn-primary-rgba" title="{{__('Save')}}"> <i class="fa fa-check-circle mr-1"></i>
												{{__('Save')}}
											</button>
										  </div>	
									  </div>			
					
					
								  </form>
							  </div>
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
		// $.noConflict();
		$("input[data-bootstrap-switch]").each(function(){
			$(this).bootstrapSwitch();
		})(jQuery);
	});
	
</script>