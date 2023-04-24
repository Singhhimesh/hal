@extends('layouts.master')
@section('title',__('All Package Features'))
@section('breadcum')
	<div class="breadcrumbbar">
        <h4 class="page-title">{{ __('All Package Features') }}</h4>
        <div class="breadcrumb-list">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{url('/admin')}}" title="{{ __('Dashboard') }}">{{ __('Dashboard') }}</a></li>
              <li class="breadcrumb-item active" aria-current="page">{{ __('Package Features') }}</li>
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
            @can('package-feature.delete')
            <button type="button" class="float-right btn btn-danger-rgba mr-2 " data-toggle="modal"
            data-target="#bulk_delete" title="{{ __('Delete Selected') }}"><i class="feather icon-trash mr-2"></i> {{ __('Delete Selected') }} </button>
            @endcan
            @can('package-feature.create')
            <a href="{{route('package_feature.create')}}" class="float-right btn btn-primary-rgba mr-2" title="{{ __('Create Package Feature') }}"><i
                class="feather icon-plus mr-2"></i>{{ __('Create Package Feature') }} </a>
              @endcan
                    <h5 class="card-title">{{ __('All Package Features') }}</h5>
                    
                </div> 

                <div class="card-body">
                    <div class="table-responsive">
                         <table id="package_featureTable" class="table table-borderd">

                            <thead>
                                <th> {{ __('#') }}</th>
                                <th> {{ __('PACAKGE FEATURE') }}</th>
                                <th> {{ __('ACTION') }}</th>
                            </thead>

                            @if ($p_feature)
                            <tbody>
                         
                            </tbody>
                          @endif

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
                                            {!! Form::open(['method' => 'POST', 'action' => 'PackageFeatureController@bulk_delete', 'id' => 'bulk_delete_form']) !!}
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
    if ( $.fn.dataTable.isDataTable( '#package_featureTable' ) ) {
        table = $('#package_featureTable').DataTable()
    }else{
        var table = $('#package_featureTable').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            autoWidth: false,
            scrollCollapse: true,
     
       
            ajax: "{{ route('package_feature.index') }}",
            columns: [
                {data: 'checkbox', name: 'checkbox',orderable: false, searchable: false},
                {data: 'name', name: 'name'},
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