@extends('layouts.master')
@section('title',__('All Languages'))
@section('breadcum')
	<div class="breadcrumbbar">
        <h4 class="page-title">{{ __('All Languages') }}</h4>
        <div class="breadcrumb-list">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{url('/admin')}}" title="{{ __('Dashboard') }}">{{ __('Dashboard') }}</a></li>
              <li class="breadcrumb-item active" aria-current="page">{{ __('All Languages') }}</li>
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
                    <button type="button" class="float-right btn btn-danger-rgba mr-2 " data-toggle="modal"
            data-target="#bulk_delete" title="{{ __('Delete Selected') }}"><i class="feather icon-trash mr-2"></i> {{ __('Delete Selected') }} </button>
            <a href="{{route('languages.create')}}" class="float-right btn btn-primary-rgba mr-2" title="{{ __('Add Language') }}"><i
                class="feather icon-plus mr-2"></i>{{ __('Add Language') }} </a>
                    <h5 class="card-title">{{ __('All Languages') }}</h5>
                    
                </div> 
                <h4 class="card-title">{{ __('Default Language is ') }}{{$dlangs[0]->name}}</h5>
                <div class="card-body">
                    <div class="table-responsive">
                         <table id="languagetable" class="table table-borderd">

                            <thead>
                                <th> {{ __('#') }}</th>
                                <th>{{__('Local')}}</th>
                                <th>{{__('Name')}}</th>
                                <th>{{__('Default')}}</th>
                                <th>{{__('Actions')}}</th>
                            </thead>

                            <tbody>
                                
                            </tbody>

                            <div id="bulk_delete" class="delete-modal modal fade" role="dialog">
                                <div class="modal-dialog modal-sm">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close"
                                                data-dismiss="modal">&times;</button>
                                            <div class="delete-icon"></div>
                                        </div>
                                        <div class="modal-body text-center">
                                            <h4 class="modal-heading">{{__('Are You Sure ?')}}</h4>
                                            <p>{{__('Do you really want to delete selected item names here? This
                                                process
                                                cannot be undone.')}}</p>
                                        </div>
                                        <div class="modal-footer">
                                          {!! Form::open(['method' => 'POST', 'action' => 'LanguageController@bulk_delete', 'id' => 'bulk_delete_form']) !!}
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
      if($.fn.dataTable.isDataTable('#languagetable')){
        table = $('#languagetable').DataTable();
      }else{
        table = $('#languagetable').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            autoWidth: false,
            scrollCollapse: true,
     
       
            ajax: "{{ route('languages.index') }}",
            columns: [
                {data: 'checkbox', name: 'checkbox',orderable: false, searchable: false},
                {data: 'local', name: 'local'},
                {data: 'name', name: 'name'},
                {data: 'def', name: 'def'},
                
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