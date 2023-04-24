@extends('layouts.master')
@section('title',__('Remove Public'))
@section('breadcum')
	<div class="breadcrumbbar">
        <h4 class="page-title">{{ __('Remove Public') }}</h4>
        <div class="breadcrumb-list">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{url('/admin')}}" title="{{ __('Dashboard') }}">{{ __('Dashboard') }}</a></li>
              <li class="breadcrumb-item active" aria-current="page">{{ __('Remove Public') }}</li>
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
							<h5 class="card-box">{{ __('Remove Public From URL') }}</h5>
						</div> 					   
						<div class="card-body">
						<div class="card bg-primary-rgba m-b-30">
							<div class="card-body">
								<div class="row align-items-center">
									<div class="col-12">
										<div class="text-primary process-fonts"><i class="fa fa-info-circle"></i> {{ __('Important Note') }}
											<ul class="process-font">
												<li>
													{{__(('Removing public from URL is only works when you have installed script in main domain.'))}}
												</li>			
												<li>
													{{__("Do not remove public when you have Installed script in subdomin or subfolders.")}}
												</li>
												<li>
													{{__(('Removing public from URL not work for Localhost'))}}
												</li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
						 
							<div class="col-12">
								<form action="{{route('remove.public')}}" class="form" method="POST">
									@csrf
									<div class="row">
										<div class="col-md-12">
											<div class="card">
												<div class="card-body">
													<div class="row">
														<div class="col-md-12">
															<div class="row">       
																	<div class="col-md-4">
																		<label class="text-dark">{{ __('Remove public from URL') }}</label>
																			<button type="submit" class="btn btn-primary" title="Click to Remove public">
																				{{__("Click to Remove public")}}
																			</button>
																	</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</form>
							</div>
						   
						</div>


					<div class="card-body">
						<div class="card bg-info-rgba m-b-30">
							<div class="card-body">
								<div class="row align-items-center">
									<div class="col-12">
										<div class="text-info process-fonts"><i class="fa fa-info-circle"></i> {{ __('Remove Public From URL Manually') }}
											
															
												<p>
													{{__("To remove the public from the URL create a .htaccess file in  the root folder and write following code.")}}
												</p>
												<p>
													<pre>	
&lt;IfModule mod_rewrite.c&gt;
	RewriteEngine On 
	RewriteRule ^(.*)$ public/$1 [L]
&lt;/IfModule&gt;			
</pre>											
													</p>
													<p>
													{{__("To remove the public from URL and Force HTTPS redirection create a .htaccess file in the root folder and write the following code.")}}
													</p>
													<p>
																											<pre>	
&lt;IfModule mod_rewrite.c&gt;	
	RewriteEngine On
	RewriteCond %{HTTPS} !=on
	RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301,NE] 
	RewriteRule ^(.*)$ public/$1 [L]
&lt;/IfModule&gt;				
</pre>		
													</p>
												
										</div>
									</div>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
</div>
@endsection 
@section('script')
   

@endsection