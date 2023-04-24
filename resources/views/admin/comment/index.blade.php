@extends('layouts.master')
@section('title',__('All Comments'))
@section('breadcum')
	<div class="breadcrumbbar">
        <h4 class="page-title">{{ __('Comments') }}</h4>
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

            <div class="card">
                <div class="card-header">
                    <button type="button" class="float-right btn btn-danger-rgba mr-2 " data-toggle="modal"
            data-target="#bulk_delete" title="{{ __('Delete Selected') }}"><i class="feather icon-trash mr-2"></i> {{ __('Delete Selected') }} </button>      
                    <h5 class="card-title">{{ __('All Comments') }}</h5>                    
                </div> 

                <div class="card-body">
                    <div class="table-responsive">
                         <table id="commentTable" class="table table-borderd">

                            <thead>
                                <th> {{ __('#') }}</th>
                                <th> {{ __('Username') }}</th>
                                <th> {{ __('Movie/TV Series') }}</th>
                                <th> {{ __('Comments') }}</th>
                                <th> {{ __('Submited ON') }}</th>
                                <th> {{ __('Status') }}</th>
                                <th> {{ __('Action') }}</th>
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
                                            {!! Form::open(['method' => 'POST', 'action' => 'AdminCommentController@bulk_delete', 'id' => 'bulk_delete_form']) !!}
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
  $(function(){
    $('#checkboxAll').on('change', function(){
      if($(this).prop("checked") == true){
        $('.material-checkbox-input').attr('checked', true);
      }
      else if($(this).prop("checked") == false){
        $('.material-checkbox-input').attr('checked', false);
      }
    });
  });
</script>
 <script>
  $(function () {
    "use strict";
    jQuery.noConflict();
    var table;
    if($.fn.dataTable.isDataTable( '#commentTable')){
        table = $('#commentTable').DataTable();
    }else{
        table = $('#commentTable').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        autoWidth: false,
        scrollCollapse: true,
        ajax: "{{ route('admin.comment.index') }}",
        columns: [
            {data: 'checkbox', name: 'checkbox',orderable: false, searchable: false},
            {data: 'username', name: 'username'},
            {data: 'name', name: 'name'},
            {data: 'comment', name: 'comment'},
            {data: 'created_at', name: 'created_at'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action',searchable: false}
           
        ],
        dom : 'lBfrtip',
        buttons : [
          'csv','excel','pdf','print'
        ]
    });
    }
    
  });
</script>
@endsection