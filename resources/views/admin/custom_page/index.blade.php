@extends('layouts.master')
@section('title',__('All Custom Page'))
@section('breadcum')
  <div class="breadcrumbbar">
    <h4 class="page-title">{{ __('All Pages') }}</h4>
    <div class="breadcrumb-list">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('/admin')}}" title="{{ __('Dashboard') }}">{{ __('Dashboard') }}</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ __('All Pages') }}</li>
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
            @can('pages.delete')
            <button type="button" class="float-right btn btn-danger-rgba mr-2 " data-toggle="modal"
            data-target="#bulk_delete" title="{{ __('') }}"><i class="feather icon-trash mr-2"></i> {{ __('Delete Selected') }} </button>
            @endcan
            @can('pages.create')
            <a href="{{route('custom_page.create')}}" class="float-right btn btn-primary-rgba mr-2" title="{{ __('') }}"><i
                class="feather icon-plus mr-2"></i>{{ __('Create Page') }} </a>
            @endcan
                    <h5 class="card-title">{{ __('All Page') }}</h5>
                    
                </div> 

                <div class="card-body">
                    <div class="table-responsive">
                         <table id="custompageTable" class="table table-borderd">

                            <thead>
                              <th>
                                <div class="inline">
                                  <input id="checkboxAll" type="checkbox" class="filled-in" name="checked[]" value="all" id="checkboxAll">
                                  <label for="checkboxAll" class="material-checkbox"></label>
                                </div>
                               
                              </th>
                              <th>{{__('Page Title')}}</th>
                              <th>{{__('Description')}}</th>
                              <th>{{__('Status')}}</th>                              
                              <th>{{__('Actions')}}</th>
                            </thead>

                            @if (isset($customs))
                              <tbody>

                        
                              </tbody>
                            @endif  

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
                                          {!! Form::open(['method' => 'POST', 'action' => 'CustomPageController@bulk_delete', 'id' => 'bulk_delete_form']) !!}
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
    jQuery.noConflict();
    var table;
    if($.fn.dataTable.isDataTable('#custompageTable')){
      table = $('#custompageTable').DataTable();
    }else{
      table = $('#custompageTable').DataTable({
        processing: true,
        serverSide: true,
       responsive: true,
       autoWidth: false,
       scrollCollapse: true,
     
       
        ajax: "{{ route('custom_page.index') }}",
        columns: [
            
            {data: 'checkbox', name: 'checkbox',orderable: false, searchable: false},
           
            {data: 'title', name: 'title'},
            {data: 'detail', name: 'detail'},
             {data: 'status', name: 'status'},
            {data: 'created_at', name: 'created_at',searchable: false},
        
            {data: 'action', name: 'action',searchable: false}
           
        ],
        dom : 'lBfrtip',
        buttons : [
          'csv','excel','pdf','print'
        ],
        order : [[0,'desc']]
    });
    }
    
    
  });
</script>
@endsection