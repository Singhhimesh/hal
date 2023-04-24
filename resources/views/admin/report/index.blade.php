@extends('layouts.master')
@section('title',__('Reports'))
@section('breadcum')
	<div class="breadcrumbbar">
    <h4 class="page-title">{{ __('All Reports') }}</h4>
    <div class="breadcrumb-list">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('/admin')}}" title="{{ __('Dashboard') }}">{{ __('Dashboard') }}</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ __('Reports') }}</li>
        </ol>
    </div>   
  </div>
@endsection
@section('maincontent')
<div class="contentbar"> 
    <div class="row">
        <div class="col-md-12">
          @if (isset($all_reports) && count($all_reports->data) > 0)
            <div class="card">
                <div class="card-header">
            
                    <h5 class="card-title">{{ __('Stripe Report') }}</h5>
                    
                </div> 

                <div class="card-body">
                    <div class="table-responsive">
                         <table  class="table table-borderd">

                            <thead>
                                <th> {{ __('#') }}</th>
                                <th>{{__('Date')}}</th>
                                <th>{{__('Subscribed Package')}}</th>
                                <th>{{__('Paid Amount')}}</th>
                                <th>{{__('Method')}}</th>
                                <th>{{__('User')}}</th>
                            </thead>

                            <tbody>
                              @php
                              $sell = null;
                            @endphp
                            @foreach ($all_reports->data as $key => $report)
                              @php
                                \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
                               
                                $customer_id = \Stripe\Customer::retrieve($report->customer);
                                $user = Illuminate\Support\Facades\DB::table('users')->where('email', '=', $customer_id->email)->first();
                                $sell = $sell + (($report->plan->amount/100));
                              @endphp
                              <tr>
                                <td>
                                  {{$key+1}}
                                </td>
                                <td>
                                  {{date('d/m/Y',$report->items->data[0]->created)}}
                                </td>
                                <td>
                                  {{$report->items->data[0]->plan->id}}
                                </td>
                                <td>
                                  <i class="{{$currency_symbol}}"></i> {{$report->plan->amount/100}}
                                </td>
                                <td>
                                  Stripe
                                </td>
                                <td>
                                  @if (isset($user))
                                    {{$user->name ? $user->name : ''}}
                                  @else
                                   {{__('User Removed')}}
                                  @endif
                                </td>
                              </tr>
                            @endforeach 
                            </tbody>

                        </table>  
                                     
                    </div>
                </div>
            </div>
        </div>
        <div class="total-sell" style="margin-top: 20px">
          <h5>{{__('Total Sells')}} <i class="{{$currency_symbol}}"></i>{{isset($sell) ? $sell : ''}}</h5>
        </div>
         </div>
            @endif  

            @if (isset($paypal_subscriptions) && count($paypal_subscriptions) > 0)
        <div class="card">
          <div class="card-header">
      
              <h5 class="card-title">{{ __('Paypal Report') }}</h5>
              
          </div> 

          <div class="card-body">
              <div class="table-responsive">
                   <table  class="table table-borderd">

                      <thead>
                          <th> {{ __('#') }}</th>
                          <th>{{__('Date')}}</th>
                          <th>{{__('Subscribed Package')}}</th>
                          <th>{{__('Paid Amount')}}</th>
                          <th>{{__('Method')}}</th>
                          <th>{{__('User')}}</th>
                      </thead>

                      <tbody>
                        @foreach ($paypal_subscriptions as $key => $item)
                        @php
                          $sell = 0;
                          $date = $item->created_at->toDateString();
                          $sell = $sell + $item->price; 
          
                        @endphp
                        <tr>
                          <td>
                            {{$key+1}}
                          </td>
                          <td>
                            {{$date}}
                          </td>
                          <td>
                            {{$item->plan ? $item->plan->name : 'N/A'}}
                          </td>
                          <td>
                            <i class="{{$currency_symbol}}"></i> {{$item->price}}
                          </td>
                          <td>
                            Paypal
                          </td>
                          <td>
                            {{$item->user ? $item->user->name : 'N/A'}}
                          </td>
                        </tr>
                      @endforeach
                      </tbody>

                  </table>                  
              </div>
          </div>
      </div>
  </div>
  <div class="total-sell" style="margin-top: 20px">
    <h5>{{__('Total Sells')}} <i class="{{$currency_symbol}}"></i>{{isset($sell) ? $sell : ''}}</h5>
  </div>
   </div>
      @endif

    </div>
</div>
@endsection 
@section('script')
  
@endsection