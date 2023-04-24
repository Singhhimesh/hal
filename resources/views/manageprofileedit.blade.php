@extends('layouts.theme')
@section('title',__('Manage Profile Name'))
@section('main-wrapper')

	<div class="manage-profile">
		<div class="container">
			<br>
			<div class="text-center">
				<h4>{{__('Hey')}} {{ Auth::user()->name }} {{__('Edit your Personal Profile Name')}} {{ config('app.name') }}:</h4>
			</div>
			@if(!isset($result))
			 	<p>{{__('no profile available')}}</p>
			@endif
			<div align="center"><p id="msg"></p></div>
				<form action="{{ route('mus.update') }}" method="POST">
					<div class="row">
						<div class="col-md-6 col-md-offset-3"> 
							<ul class="manage-profile-block text-center">
							{{ csrf_field() }}			
							@if(isset($result->screen1))
								<li>
									<div>
										<div class="manage-profile-image">
											<img class="imageprofile" src="{{ Avatar::create($result->screen1)->toBase64() }}" alt="">
										</div>
										<input class="screen2 form-control" name="screen1" type="text" value="{{ $result->screen1 }}" >
									</div>
								</li>
							@endif
							@if(isset($result->screen2))
								<li>
									<div>
										<div class="manage-profile-image">
											<img class="imageprofile" src="{{ Avatar::create($result->screen2)->toBase64() }}" alt="">
										</div>
										<input class="screen2 form-control" name="screen2" type="text" value="{{ $result->screen2 }}" >
									</div>
								</li>
							@endif
							@if(isset($result->screen3))
								<li>
									<div>
										<div class="manage-profile-image">
											<img class="imageprofile" src="{{ Avatar::create($result->screen3)->toBase64() }}" alt="">
										</div>
										<input class="screen2 form-control" name="screen3" type="text" value="{{ $result->screen3 }}" >
									</div>
								</li>
							@endif
							@if(isset($result->screen4))
								<li>
									<div>
										<div class="manage-profile-image">
											<img class="imageprofile" src="{{ Avatar::create($result->screen4)->toBase64() }}" alt="">
										</div>
										<input class="screen2 form-control" name="screen4" type="text" value="{{ $result->screen4 }}" >
									</div>
								</li>
							@endif		
						</div>
					</div>
                    <div class="manage-profile-btn text-center">
                        <input class="btn btn-success" type="submit" value="{{__('Update')}}">
					</div>
				</form>
				
			</div>
		</div>
	</div>

@endsection

@section('custom-script')
	<script>
		function changescreen(screen,count){

			$.ajax({
				type : 'GET',
				data : {screen : screen, count : count},
				url  : '{{ url('/changescreen/'.Auth::user()->id) }}',
				success : function(data){
					console.log(baseurl);
					$('#msg').html(data);
					setTimeout(function(){ 
						$(location).attr('href',baseurl)
					}, 700);


				}
			});
		}
	</script>
@endsection