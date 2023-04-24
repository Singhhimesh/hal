@extends('layouts.master')
@section('title','Wallet Setting')
@section('breadcum')
<div class="breadcrumbbar">
    <h4 class="page-title">{{ __('Wallet') }}</h4>
    <div class="breadcrumb-list">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('/admin')}}" title="{{ __('Dashboard') }}">{{ __('Dashboard') }}</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ __('Wallet Settings') }}</li>
        </ol>
    </div> 
</div>
@endsection
@section('maincontent')
<div class="contentbar">
  	<div class="row">
    	<div class="col-lg-12">
      		<div class="card m-b-30">
        		<div class="card-header">
          			<h5 class="box-title">{{__('Wallet Settings')}}</h5>
        		</div>

        <!-- ======= Facebook Login start ========== -->
					<div class="col-md-6 col-lg-6 col-xl-12">
						<div class="bg-info-rgba ml-6 mr-6 mb-6">
							<div class="card-header text-dark"><h4>{{__('Edit Wallet Setting ')}}</h4></div>
								<div class="payment-gateway-block">
									<form action="{{ route('admin.update.wallet.settings') }}" method="POST">
										{{ csrf_field() }}
										<div class="form-group">
											<div class="row mx-2 my-4">
												<div class="col-md-12">
													<label for="">{{__('Enable Wallet')}} </label>
                          {!! Form::checkbox('enable_wallet', 1, (isset($wallet) && $wallet->enable_wallet == 1 ? 1 : 0), ['class' => 'custom_toggle']) !!}
													<label for="fb_check"></label>
												</div>
											</div>
										</div>

                    <div class="col-md-6 col-lg-6 col-xl-12">
                      <div class="bg-primary ml-6 mr-6 mb-6">
                        <div class="card-header text-dark"><h4 class="text-white"><i class="feather icon-Settings" aria-hidden="true"></i> {{__('ENABLE PAYMENT OPTIONS ON WALLET')}}</h4></div>
                    </div>
                  </div>

										<div class="row mx-2 my-4">
											<div class="col-md-4">
                        <div class="form-group text-dark{{ $errors->has('stripe_enable') ? ' has-error' : '' }}">
                          <h6 class="bootstrap-switch-label">{{__('Enable Stripe Payment Gateway')}}</h6>
                          {!! Form::checkbox('stripe_enable', 1, (isset($wallet) && $wallet->stripe_enable == 1 ? 1 : 0), ['class' => 'custom_toggle']) !!}
                        </div>
                        <small class="text-danger">{{ $errors->first('stripe_enable') }}</small>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group text-dark{{ $errors->has('paytm_enable') ? ' has-error' : '' }}">
                          <h6 class="bootstrap-switch-label">{{__('Enable Paytm')}}</h6>
                          {!! Form::checkbox('paytm_enable', 1, (isset($wallet) && $wallet->paytm_enable == 1 ? 1 : 0), ['class' => 'custom_toggle']) !!}
                        </div>
                        <small class="text-danger">{{ $errors->first('paytm_enable') }}</small>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group text-dark{{ $errors->has('paypal_enable') ? ' has-error' : '' }}">
                          <h6 class="bootstrap-switch-label">{{__('Enable PayPal')}}</h6>
                          {!! Form::checkbox('paypal_enable', 1, (isset($wallet) && $wallet->paypal_enable == 1 ? 1 : 0), ['class' => 'custom_toggle']) !!}
                        </div>
                        <small class="text-danger">{{ $errors->first('paypal_enable') }}</small>
                      </div>

											<div class="col-md-6 col-lg-6 col-xl-12 form-group">
												<button type="submit" class="btn btn-primary-rgba" title=" {{ __('Save') }}"><i class="fa fa-check-circle"></i>
												  {{ __('Save') }}</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
  			</div>
		  </div>
	  </div>

    @can('wallet.history')
      <div class="row">
          <div class="col-md-12">
  
              <div class="card m-b-50">
                  <div class="card-header">
                      <h5 class="card-title">{{ __('Wallet Transactions') }}</h5>
                  </div>   
                  <div class="card-body wallet-transaction-page">
                      <div class="table-responsive">
                           <table id="wallet_logs_table" class="table table-borderd">  
                              <thead>
                                  <th> {{ __('#') }}</th>
                                  <th>{{__('User')}}</th>
                                  <th>{{__('Type')}}</th>
                                  <th>{{__('Amount')}}</th>
                                  <th>{{__('Note')}}</th>
                              </thead>  
                              <tbody>                                  
                              </tbody>  
                          </table>                  
                      </div>
                  </div>
              </div>
          </div>
      </div>
@endcan
@endsection 
@section('script')
<script>
$(function () {
  "use strict";
  jQuery.noConflict();
  var table;
  if($.fn.dataTable.isDataTable('#wallet_logs_table')){
    table = $('#wallet_logs_table').DataTable();  
  }else{
    table = $('#wallet_logs_table').DataTable({
      processing: true,
      serverSide: true,
      ajax: '{{ route("admin.wallet.settings") }}',
      columns: [
          {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable : false},
          {data : 'user', name : 'user'},
          {data : 'type', name : 'type'},
          {data : 'amount', name : 'amount'},
          {data : 'log', name : 'log'},
      ],
      dom : 'lBfrtip',
      buttons : [
        'csv','excel','pdf','print'
      ],
      order : [[0,'DESC']]
    });
  }
    
  
});

</script>
@endsection