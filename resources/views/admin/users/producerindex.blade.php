@extends('layouts.master')
@section('title',__('All Producers'))
@section('breadcum')
	<div class="breadcrumbbar">
    <h4 class="page-title">{{ __('USERS') }}</h4>
    <div class="breadcrumb-list">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('/admin')}}" title="{{ __('Dashboard') }}">{{ __('Dashboard') }}</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ __('Producers') }}</li>
        </ol>
    </div>
  </div>
@endsection
@section('maincontent')
<div class="contentbar">
    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    <button type="button" class="float-right btn btn-danger-rgba mr-2 " data-toggle="modal"
            data-target="#bulk_delete" title="{{ __('Delete Selected') }}"><i class="feather icon-trash mr-2"></i> {{ __('Delete Selected') }} </button>
            
                    <h5 class="card-title">{{ __('All Producers') }}</h5>
                    
                </div> 

                <div class="card-body">
                    <div class="table-responsive">
                         <table id="usersTable" class="table table-borderd">

                            <thead>
                                <th> {{ __('#') }}</th>
                                <th> {{ __('ID') }}</th>
                                <th> {{ __('NAME') }}</th>
                                <th> {{ __('EMAIL') }}</th>
                                <th> {{ __('CREATED AT') }}</th>
                                <th> {{ __('UPDATED AT') }}</th>
                                <th> {{ __('STATUS') }}</th>
                                <th> {{ __('ACTION') }}</th>
                            </thead>

                            <tbody>
                                
                            </tbody>

                            <div id="bulk_delete" class="delete-modal modal fade" role="dialog">
                                <div class="modal-dialog modal-sm">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close"
                                                data-dismiss="modal" title="{{ __('Close') }}">&times;</button>
                                            <div class="delete-icon"></div>
                                        </div>
                                        <div class="modal-body text-center">
                                            <h4 class="modal-heading">{{__('Are You Sure ?')}}</h4>
                                            <p>{{__('Do you really want to delete selected item names here? This
                                                process
                                                cannot be undone.')}}</p>
                                        </div>
                                        <div class="modal-footer">
                                            {!! Form::open(['method' => 'POST', 'action' => 'UsersController@bulk_delete', 'id' => 'bulk_delete_form']) !!}
                                                @method('POST')
                                                <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">{{__('No')}}</button>
                                                <button type="submit" class="btn btn-danger">{{__('Yes')}}</button>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        

                        </table>                  
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 
@section('script')
    <script src="{{ url('assets/plugins/tabledit/jquery.tabledit.js') }}"></script>     
    <script src="{{ url('assets/js/custom/custom-table-editable.js') }}"></script>
    <script>
      $(function () {
        $.noConflict();
        var table = $('#usersTable').DataTable({
            processing: true,
            serverSide: true,
           responsive: true,
           autoWidth: false,
           scrollCollapse: true,
         
           
            ajax: "{{ url('admin/producers') }}",
            columns: [
                
                {data: 'checkbox', name: 'checkbox',orderable: false, searchable: false},
                {data: 'DT_RowIndex', name: 'DT_RowIndex',searchable: false},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'created_at', name: 'created_at',searchable: false},
                {data: 'updated_at', name: 'updated_at',searchable: false},
                  {data: 'status', name: 'status'},
                {data: 'action', name: 'action',searchable: false}
               
            ],
            dom : 'lBfrtip',
            buttons : [
              'csv','excel','pdf','print'
            ],
            order : [[0,'desc']],
             "oLanguage": {
                "sEmptyTable":     "<b>Let's start :)</b><br><small>Get Started by creating a user! All of your users will be displayed on this page.</small><br/> "
            }
            
        });
        console.log("Table is ", table);
        
      });
  var SITEURL = '{{URL::to('')}}';
       /* When click Status Button */
      $('body').on('click', '.status', function () {
        var pid = $(this).data('id');
      
         $.ajax({
              type: "get",
              url: SITEURL + "/admin/user/status/"+pid,
              success: function (data) {
              var oTable = $('#usersTable').dataTable(); 
              oTable.fnDraw(false);
              },
              error: function (data) {
                  console.log('Error:', data);
              }
          });
       
     });
  
 
    </script>
@endsection