@extends('layouts.master')
@section('title',__('Addon Manager'))
@section('breadcum')
	<div class="breadcrumbbar">
        <h4 class="page-title">{{ __('Addon Manager') }}</h4>
        <div class="breadcrumb-list">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{url('/admin')}}" title="{{ __('Dashboard') }}">{{ __('Dashboard') }}</a></li>
              <li class="breadcrumb-item active" aria-current="page">{{ __('Addon Manager') }}</li>
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
                    <button type="button" class="float-right btn btn-primary-rgba mr-2 " data-toggle="modal"
                    data-target=".bd-example-modal-lg" title="{{ __('Install New Addon') }}"><i class="feather icon-plus mr-2"></i> {{ __('Install New Addon') }} </button>
            
            {{-- Install new Addon Model Start --}}
                <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-md">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleLargeModalLabel">{{__("Install New Addon")}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" title="{{ __('Close') }}">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                                
                            <div class="modal-body">
                                <form action="{{ route('addon.install') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label>{{__('Enter Purchase Code')}}: <span class="text-danger">*</span></label>
                                        <input type="text" placeholder="{{__('Enter Purchase Code of Your Addon')}}" class="form-control" name="purchase_code">
                                    </div>
            
                                    <div class="form-group">
                                        <label>{{__('Choose Addon Zip File')}}: <span class="text-danger">*</span></label>
                                        <input type="file" class="form-control" name="addon_file">
                                    </div>
            
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary" title="{{__('Install')}}"><i class="feather icon-plus"></i> {{__('Install')}}</button>
                                     
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            {{-- Install new Addon Model End --}}
                    <h5 class="card-title">{{ __('Addon Manager') }}</h5>                    
                </div> 

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="modules" class="table table-bordered">
                            <thead>
                                <th>#</th>
                                <th>{{__('Logo')}}</th>
                                <th>{{__('Addon Name')}}</th>
                                <th>{{__('Status')}}</th>
                                <th>{{__('Version')}}</th>
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
        "use strict";
        jQuery.noConflict();
        var table;
        if($.fn.dataTable.isDataTable( '#modules')){
            table = $('#modules').DataTable();
        }else{
            table = $('#modules').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ url("admin/addon-manger") }}',
                language: {
                    searchPlaceholder: "Search Addon..."
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        searchable: false,
                        orderable : false
                    },
                    {
                        data: 'image',
                        name: 'image',
                        searchable: false,
                        orderable : false
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'version',
                        name: 'version'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                ],
                dom: 'lBfrtip',
                buttons: [
                    'csv', 'excel', 'pdf', 'print'
                ],
                order: [
                    [0, 'DESC']
                ]
            });
        }
        

        $('#modules').on('change', '.toggle_addon', function (e) { 

            var modulename = $(this).data('addon');

            if($(this).is(':checked')){
                var status = 1;
            }else{
                var status = 0;
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url : '{{ url("admin/toggle/module") }}',
                method : 'POST',
                data : {status : status, modulename : modulename},
                success :function(data){
                    table.draw();

                    if(data.status == 'success'){
                        toastr.success(data.msg,{timeOut: 1500});
                    }else{
                        toastr.error(data.msg, 'Oops!',{timeOut: 1500});
                    }
                    
                },
                error : function(jqXHR,err){
                    console.log(err);
                }
            });

        });

    });
</script>
@endsection