@extends('layouts.master')
@section('title',__('Affiliate Reports'))
@section('breadcum')
    <div class="breadcrumbbar">
        <h4 class="page-title">{{ __('Affiliate Reports') }}</h4>
        <div class="breadcrumb-list">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/admin')}}" title="{{ __('Dashboard') }}">{{ __('Dashboard') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('Affiliate Reports') }}</li>
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
                    <div class="table-responsive">
                         <table id="affiliate_report" class="table table-borderd">
                            <thead>
                                <th> {{ __('#') }}</th>
                                <th> {{ __('Referred User') }}</th>
                                <th> {{ __('Referred By') }}</th>
                                <th> {{ __('Amount') }}</th>
                                <th> {{ __('Date') }}</th>
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
        "use strict";
        jQuery.noConflict();
        var table;
        if($.fn.dataTable.isDataTable('#affiliate_report')){
            table = $('#affiliate_report').DataTable();
        }else{
            table = $('#affiliate_report').DataTable({
                processing: true,
                serverSide: true,
            
                responsive: true,
                autoWidth: false,
                scrollCollapse: true,
                ajax: '{{ route("admin.affilate.dashboard") }}',
                language: {
                    searchPlaceholder: "Search in reports..."
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'affilate_histories.id', searchable : false},
                    {data : 'refered_user', name : 'fromRefered.name'},
                    {data : 'user', name : 'user.name'},
                    {data : 'amount', name : 'affilate_histories.amount'},
                    {data : 'created_at', name : 'affilate_histories.created_at'},
                ],
                "footerCallback": function ( row, data, start, end, display ) {
                    var api = this.api(), data;
    
                // converting to interger to find total
                var intVal = function ( i ) {
                    return typeof i === 'string' ?
                        i.replace("{{ $currency_symbol }}", '')*1 :
                        typeof i === 'number' ?
                            i : 0;
                };

                var grandtotal = api
                        .column( 4 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
                    
                        
                    // Update footer by showing the total with the reference of the column index 
                $( api.column( 3).footer() ).html('Total');
                    $( api.column( 4 ).footer() ).html("{{ $currency_symbol }}"+'<p>'+grandtotal.toFixed(2)+'</p>');
                },
            
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
