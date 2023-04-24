@extends('layouts.master')
@section('title',__('All Revenue Reports'))
@section('breadcum')
	<div class="breadcrumbbar">
    <h4 class="page-title">{{ __('Revenue Reports') }}</h4>
    <div class="breadcrumb-list">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('/admin')}}" title="{{ __('Dashboard') }}">{{ __('Dashboard') }}</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ __('All Revenue Reports') }}</li>
        </ol>
    </div>   
  </div>
@endsection
@section('maincontent')
<div class="contentbar"> 
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          {!! $revenue_chart->container() !!}
        </div>
      </div>
    </div>
  </div>
</div>
<div class="contentbar"> 
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <div class="table-responsive">
            <table id="full_detail_table" class="table table-borderd">
              <thead>
                <th> {{ __('#') }}</th>
                <th>{{__('User Name')}}</th>
                <th>{{__('Payment Method')}}</th>
                <th>{{__('Paid Amount')}}</th>
                <th>{{__('Subscription From')}}</th>
                <th>{{__('Subscription To')}}</th>
                <th>{{__('Date')}}</th>
              </thead>

              @if ($revenue_report)
                <tbody>
                  @foreach ($revenue_report as $key => $report)
                    <tr id="item-{{$report->id}}">
                      <td>
                        {{$key+1}}
                      </td>
                      <td>{{$report->user_name}}</td>
                      <td>{{$report->method}}</td>
                      <td><i class="{{ $currency_symbol }}" aria-hidden="true"></i>{{$report->price}}</td>
                      <td>{{$report->subscription_from}}</td>
                      <td>{{$report->subscription_to}}</td>
                      <td>{{$report->created_at}}</td>
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
</div>
<br>
@endsection   
@section('script')


<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>

 {!! $revenue_chart->script() !!}
 <script>
  @php
    $y = date('Y');
  @endphp
  var startDate = '{{ date('m/d/Y',strtotime($y.'-01-01')) }}';
  var endDate = '{{ date('m/d/Y',strtotime($y.'-12-31')) }}';
  console.log(startDate);
   $(function(){
    jQuery.noConflict();
      $('#mydate').daterangepicker({
        startDate : startDate,
        endDate : endDate
      });

      $('#mydate').on('change',function(){
      var k = $(this).val();
      var startDate = k.split('-')[0];
       //alert(startDate);  // return 2018-10-21
      var endDate = k.split('-')[1]; 
      //alert(endDate);
      $.ajax({
          type : 'GET',
          data : {startDate : startDate,
                endDate : endDate
                },
          url  : '{{ route("ajaxdatefilter") }}',
          dataType : 'html',
          success : function(data){
             $('#maindata').html('');
             $('#maindata').append(data);
          }
      });

    });
   });
 </script>
 
  <script type="text/javascript">
    
  </script>

@endsection