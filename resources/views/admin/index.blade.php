@extends('layouts.master')
@section('title',__('Dashboard'))
@section('maincontent')
@section('breadcum')
<div class="breadcrumbbar">
  <h4 class="page-title">{{ __('Dashboard') }}</h4>
  <div class="breadcrumb-list">
      <ol class="breadcrumb">          
          <li class="breadcrumb-item active">{{ __('Dashboard') }}</li>
      </ol>
  </div>
</div>
@endsection
<div class="contentbar">
  @can('dashboard.states')
      <!-- Start row -->
      <div class="row">       
          <!-- Start col -->
          <div class="col-lg-12">
              <!-- Start row -->
              <div class="row">
                  <!-- Start col -->
                  <div class="col-lg-3 col-md-6 col-12">
                      <div class="card m-b-30 shadow-sm">
                          <div class="card-body">
                              <div class="row align-items-center">
                                  <div class="col-6">
                                      <h4 id="number1">{{$users_count}}</h4>
                                      <p class="font-14 mb-0">{{ __('Users') }}</p>
                                  </div> 
                              <div class="col-6 text-right">
                                  <a href="{{url('admin/users')}}">
                                    <i class="text-info feather icon-users icondashboard" title="{{ __('Users') }}"></i>
                                  </a>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <!-- End col -->
                  <!-- Start col -->
                  <div class="col-lg-3 col-md-6 col-12">
                      <div class="card m-b-30 shadow-sm">
                          <div class="card-body">
                              <div class="row align-items-center">
                                  <div class="col-6">
                                      <h4 id="number2">{{ $activeusers }}</h4>
                                      <p class="font-14 mb-0">{{ __('Total Active Users') }}</p>
                                  </div>
                                  <div class="col-6 text-right">
                                      <a href="{{url('admin/users')}}">
                                        <i class="text-warning feather icon-user icondashboard" title="{{ __('Total Active Users') }}"></i>
                                      </a>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <!-- End col -->
                  <!-- Start col -->
                  <div class="col-lg-3 col-md-6 col-12">
                      <div class="card m-b-30 shadow-sm">
                          <div class="card-body">
                              <div class="row align-items-center">
                                  <div class="col-6">
                                      <h4 id="number3">{{$movies_count}}</h4>
                                      <p class="font-14 mb-0">{{ __('Total Movies') }}</p>
                                  </div>
                                  <div class="col-6 text-right">
                                      <a href="{{url('admin/movies')}}">
                                        <i class="text-success feather icon-video icondashboard" title="{{ __('Total Movies') }}"></i>
                                      </a>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <!-- End col -->
                  <!-- Start col -->
                  <div class="col-lg-3 col-md-6 col-12">
                      <div class="card m-b-30 shadow-sm">
                          <div class="card-body">
                              <div class="row align-items-center">
                                  <div class="col-6">
                                      <h4 id="number4">{{$tvseries_count}}</h4>
                                      <p class="font-14 mb-0">{{__('Total TV Series')}}</p>
                                  </div>
                                  <div class="col-6 text-right">
                                      <a href="{{url('admin/tvseries')}}">
                                        <i class="ttext-primary feather icon-camera icondashboard" title="{{__('Total TV Series')}}"></i>
                                      </a>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <!-- End col -->
                  <!-- Start col -->
                  <div class="col-lg-3 col-md-6 col-12 mt-md-3">
                      <div class="card m-b-30 shadow-sm">
                          <div class="card-body">
                              <div class="row align-items-center">
                                  <div class="col-7">
                                      <h4 id="number5">{{$livetv_count}}</h4>
                                      <p class="font-14 mb-0">{{__('Total TV Chanels')}}</p>
                                  </div>
                                  <div class="col-5 text-right">
                                      <a href="{{url('admin/livetv')}}">
                                        <i class="text-success feather icon-video icondashboard" title="{{__('Total TV Chanels')}}"></i>
                                      </a>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <!-- End col -->
                  <!-- Start col -->
                  <div class="col-lg-3 col-md-6 col-12 mt-md-3">
                      <div class="card m-b-30 shadow-sm">
                          <div class="card-body">
                              <div class="row align-items-center">
                                  <div class="col-6">
                                      <h4 id="number6">{{$package_count}}</h4>
                                      <p class="font-14 mb-0">{{__('Total Packages')}}</p>
                                  </div>
                                  <div class="col-6 text-right">
                                      <a href="{{url('admin/packages')}}">
                                        <i class="text-success feather icon-shopping-bag icondashboard" title="{{__('Total Packages')}}"></i>
                                      </a>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <!-- End col -->
                  <!-- Start col -->
                  <div class="col-lg-3 col-md-6 col-12 mt-md-3">
                      <div class="card m-b-30 shadow-sm">
                          <div class="card-body">
                              <div class="row align-items-center">
                                  <div class="col-6">
                                      <h4 id="number7">{{$coupon_count}}</h4>
                                      <p class="font-14 mb-0">{{__('Total Coupons')}}</p>
                                  </div>
                                  <div class="col-6 text-right">
                                      <a href="{{url('admin/coupons')}}">
                                        <i class="text-success feather icon-percent icondashboard" title="{{__('Total Coupons')}}"></i>
                                      </a>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <!-- End col -->
                  <!-- Start col -->
                  <div class="col-lg-3 col-md-6 col-12 mt-md-3">
                      <div class="card m-b-30 shadow-sm">
                          <div class="card-body">
                              <div class="row align-items-center">
                                  <div class="col-6">
                                      <h4 id="number8">{{$genres_count}}</h4>
                                      <p class="font-14 mb-0">{{__('Total Genres')}}</p>
                                  </div>
                                  <div class="col-6 text-right">
                                      <a href="{{url('admin/genres')}}">
                                        <i class="text-warning feather icon-radio icondashboard" title="{{__('Total Genres')}}"></i>
                                      </a>
                                  </div>
                                  
                              </div>
                          </div>
                      </div>
                  </div>
                  <!-- End col -->
                  <!-- Start col -->
                  <div class="col-lg-3 col-md-6 col-12">
                    <div class="card m-b-30 shadow-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <h4 id="number9">{{$movieslw}}</h4>
                                    <p class="font-14 mb-0">{{ __('Top 10 Movies') }}</p>
                                </div>
                                <div class="col-6 text-right">
                                    <a href="{{url('admin/topmovies')}}">
                                      <i class="text-success feather icon-video icondashboard" title="{{ __('Top 10 Movies') }}"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End col -->
                <!-- Start col -->
                {{-- <div class="col-lg-3 col-md-6 col-12">
                    <div class="card m-b-30 shadow-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <h4 id="number10">{{$seasonlw}}</h4>
                                    <p class="font-14 mb-0">{{ __('Top 10 Seasons') }}</p>
                                </div>
                                <div class="col-6 text-right">
                                    <a href="{{url('admin/topseasons')}}">
                                      <i class="text-success feather icon-video icondashboard" title="{{ __('Top 10 Seasons') }}"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
              </div>
              <!-- End col -->                  
              <!-- Start row -->
            <div class="row">
                <!-- Start Active Subscribed User-->
                <div class="col-lg-12 col-xl-7">
                    <div class="card m-b-30">
                        <div class="card-header">                                
                            <div class="row align-items-center">
                                <div class="col-9">
                                    <h5 class="card-title mb-0">{{__('Active Subscribed Users in ' . date('Y'))}}</h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            {!! $activesubsriber->container() !!}
                        </div>
                    </div>
                </div>
                <!-- End Active Subscribed User -->
                <!-- Start User Distribution -->
                <div class="col-lg-12 col-xl-5">
                    <div class="card m-b-30">
                        <div class="card-header">                                
                            <div class="row align-items-center">
                                <div class="col-9">
                                    <h5 class="card-title mb-0">{{__('User Distribution')}}</h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            {!! $piechart->container() !!}
                        </div>
                    </div>
                </div>
                <!-- End User Distribution -->
            </div>
            <!-- End row -->
            <!-- Start Revenue Report -->
            <div class="row">
                <div class="col-md-12">
                  <div class="card">
                    <div class="card-header">                                
                        <div class="row align-items-center">
                            <div class="col-9">
                                <h5 class="card-title mb-0">{{__('Revenue Reports')}}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                      <div class="table-responsive">
                        <table id="devicetable" class="table table-borderd">
                          <thead>
                            <th> {{ __('#') }}</th>
                            <th>{{__('Payment ID')}}</th>
                            <th>{{__('User Name')}}</th>
                            <th>{{__('Payment Method')}}</th>
                            <th>{{__('Paid Amount')}}</th>
                            <th>{{__('Subscription From')}}</th>
                            <th>{{__('Subscription To')}}</th>
                          </thead>
                            @if ($revenue_report)
                                <tbody>
                                    @foreach ($revenue_report as $key => $report)
                                        <tr id="item-{{$report->id}}">
                                        <td>{{$key+1}}</td>
                                        <td>{{$report->payment_id}}</td>
                                        <td>{{ucfirst($report->user_name)}}</td>
                                        <td>{{$report->method}}</td>
                                        <td><i class="{{ $currency_symbol }}" aria-hidden="true"></i>{{$report->price}}</td>
                                        <td>{{$report->subscription_from}}</td>
                                        <td>{{$report->subscription_to}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            @endif
                        </table>                  
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <br>
              <!-- End Revenue Report -->
              <!-- Start row -->
              <div class="row">
                <!-- Start Video Distributions -->
                <div class="col-lg-12 col-xl-5">
                    <div class="card m-b-30">
                        <div class="card-header">                                
                            <div class="row align-items-center">
                                <div class="col-9">
                                    <h5 class="card-title mb-0">{{__('Video Distributions')}}</h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            {!! $doughnutchart->container() !!}
                        </div>
                    </div>
                </div>
                <!-- End Video Distributions -->
                <!-- Start Monthly Registered Users -->
                <div class="col-lg-12 col-xl-7">
                    <div class="card m-b-30">
                        <div class="card-header">                                
                            <div class="row align-items-center">
                                <div class="col-9">
                                    <h5 class="card-title mb-0">{{__('Monthly Registered Users in ' . date('Y'))}}</h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            {!! $userchart->container() !!}
                        </div>
                    </div>
                </div>
                <!-- End Monthly Registered Users -->
            </div>
            <!-- End row -->
            <!-- Start row -->
            <div class="row">
                <!-- Start Paypal Subscription -->
                <div class="col-lg-12 col-xl-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            {!! $revenue_chart->container() !!}
                        </div>
                    </div>
                </div>
                <!-- End Paypal Subscription -->                
            </div>

@endcan
  </div>
@endsection
@section('script')
<script>
    
	$.fn.jQuerySimpleCounter = function( options ) {
	    var settings = $.extend({
	        start:  0,
	        end:    100,
	        easing: 'swing',
	        duration: 400,
	        complete: ''
	    }, options );

	    var thisElement = $(this);

	    $({count: settings.start}).animate({count: settings.end}, {
			duration: settings.duration,
			easing: settings.easing,
			step: function() {
				var mathCount = Math.ceil(this.count);
				thisElement.text(mathCount);
			},
			complete: settings.complete
		});
	};

    $('#number1').jQuerySimpleCounter({end: {{$users_count}},duration: 3000});
    $('#number2').jQuerySimpleCounter({end: {{$activeusers }},duration: 3000});
    $('#number3').jQuerySimpleCounter({end: {{$movies_count }},duration: 3000});
    $('#number4').jQuerySimpleCounter({end: {{$tvseries_count }},duration: 3000});
    $('#number5').jQuerySimpleCounter({end: {{$livetv_count }},duration: 3000});
    $('#number6').jQuerySimpleCounter({end: {{$package_count }},duration: 3000});
    $('#number7').jQuerySimpleCounter({end: {{$coupon_count }},duration: 3000});
    $('#number8').jQuerySimpleCounter({end: {{$genres_count }},duration: 3000});
    $('#number9').jQuerySimpleCounter({end: {{$movieslw }},duration: 3000});
    $('#number10').jQuerySimpleCounter({end: {{$seasonlw }},duration: 3000});

</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/6.0.6/highcharts.js" charset="utf-8"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
{!! $userchart->script() !!}
{!! $activesubsriber->script() !!}
{!! $piechart->script() !!}
{!! $doughnutchart->script() !!}
{!! $revenue_chart->script() !!}
<script>
    console.clear();
</script>
@endsection
