@extends('layouts.master')
@section('title',__('Change Subscription'))
@section('breadcum')
	<div class="breadcrumbbar">
      <h4 class="page-title">{{ __('User Subscription') }}</h4>
      <div class="breadcrumb-list">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/admin')}}" title="{{ __('Dashboard') }}">{{ __('Dashboard') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('User Subscription') }}</li>
          </ol>
      </div>    
  </div>
@endsection
@section('maincontent')
<div class="contentbar"> 
  <div class="row">
    <div class="col-md-12">
      <div class="card m-b-50">
        <div class="card-body">
          <div class="table-responsive">
            <table id="plan_table" class="table table-borderd">
              <thead>
                <th>{{__('ID')}}</th>
                <th>{{__('Name')}}</th>
                <th>{{__('Email')}}</th>
                <th>{{__('Plans')}}</th>
                <th>{{__('Subscribtion Expire')}}</th>
                <th>{{__('Actions')}}</th>
              </thead>
              <tbody>
              
              </tbody>
            </table>                  
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection  
@section('script')
   
<script>
  $(function () {
    jQuery.noConflict();
    var table;
    if($.fn.dataTable.isDataTable('#plan_table')){
      table = $('#plan_table').DataTable();
    }else{
      table = $('#plan_table').DataTable({
        processing: true,
        serverSide: true,
         responsive: true,
        autoWidth: false,
        scrollCollapse: true,
     
        ajax: "{{ route('plan.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'username', name: 'username'},
            {data : 'useremail', name: 'useremail'},
            {data : 'planname', name: 'planname'},
            {data : 'subscription_to', name : 'subscription_to'},
            {data : 'action', name: 'action'}
    
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