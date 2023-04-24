@extends('layouts.master')
@section('title',__('All Users'))
@section('breadcum')
<div class="breadcrumbbar">
    <h4 class="page-title">{{ __('USERS') }}</h4>
    <div class="breadcrumb-list">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/admin')}}" title="{{ __('Dashboard') }}">{{ __('Dashboard') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('Users') }}</li>
        </ol>
    </div>
</div>
@endsection
@section('maincontent')
<div class="contentbar"> 
    <div class="row">
        <div class="col-md-12">
            <div class="card m-b-50">
                <div class="card-header">
                    <button type="button" class="float-right btn btn-danger-rgba mr-2 " data-toggle="modal" data-target="#bulk_delete" title="{{ __('Delete Selected') }}"><i class="feather icon-trash mr-2"></i> {{ __('Delete Selected') }} </button>
                    <a href="{{route('users.create')}}" class="float-right btn btn-primary-rgba mr-2" title="{{ __('Add User') }}"><i class="feather icon-plus mr-2"></i>{{ __('Add User') }} </a>
                    <h5 class="card-title">{{ __('All Users') }}</h5>                    
                </div> 
                <div class="card-body device-history-page">
                    <div class="table-responsive">
                        <table id="TABLE-USER" class="table table-borderd">
                            <thead>
                                <th> {{ __('#') }}</th>
                                <th> {{ __('ID') }}</th>
                                <th>{{ __('USER DETAILS') }}</th>
								<th> {{ __('PROFILE PIC') }}</th>
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
   
    <script>
      $(function () {
        jQuery.noConflict();
        var table;
        if($.fn.dataTable.isDataTable('#TABLE-USER')){
            table = $('#TABLE-USER').DataTable();
        }else{
            table = $('#TABLE-USER').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            autoWidth: false,
            scrollCollapse: true,         
           
            ajax: "{{ route('users.index') }}",
            columns: [
                
                {data: 'checkbox', name: 'checkbox',orderable: false, searchable: false},
                {data: 'DT_RowIndex', name: 'DT_RowIndex',searchable: false},
                {data: 'name', name: 'name'},
				{data: 'image', name: 'image' , orderable: false, searchable: false},
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
        }
        
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