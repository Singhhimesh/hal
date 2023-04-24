@extends('layouts.master')
@section('title',__('All Packages'))
@section('breadcum')
	<div class="breadcrumbbar">
                <h4 class="page-title">{{ __('Package') }}</h4>
                <div class="breadcrumb-list">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{url('/admin')}}" title="{{ __('Dashboard') }}">{{ __('Dashboard') }}</a></li>
                      <li class="breadcrumb-item active" aria-current="page">{{ __('Package') }}</li>
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
            @can('package.delete')
              <button type="button" class="float-right btn btn-danger-rgba mr-2 " data-toggle="modal"
            data-target="#bulk_delete" title="{{ __('Delete Selected') }}"><i class="feather icon-trash mr-2"></i> {{ __('Delete Selected') }} </button>
            @endcan
            @can('package.create')
            <a href="{{route('packages.create')}}" class="float-right btn btn-primary-rgba mr-2" title="{{ __('Create Package') }}"><i
                class="feather icon-plus mr-2"></i>{{ __('Create Package') }} </a>
            @endcan
                    <h5 class="card-title">{{ __('All Packages') }}</h5>
                    
                </div> 

                <div class="card-body">
                    <div class="table-responsive">
                         <table id="full_detail_table" class="table table-borderd">

                            <thead>
                                <th> {{ __('#') }}</th>
                                <th> {{ __('ID') }}</th>
                                <th>{{__('PACKAGE NAME')}}</th>
                                <th>{{__('AMOUNT')}}</th>
                                <th>{{__('INTERVAL')}}</th>
                                <th>{{__('INTERVAL COUNT')}}</th>
                                <th>{{__('TRIAL PERIOD')}}</th>
                                <th>{{__('STATUS')}}</th>
                                <th>{{__('ACTIONS')}}</th>
                            </thead>

                            @if ($packages)
          <tbody id="sortable">
            @foreach ($packages as $key => $package)
           {{--  @if($package->delete_status == 1) --}}

              <tr  class="sortable row1" data-id="{{ $package->id }}">
                <td>
                  <div class="inline">
                    <input type="checkbox" form="bulk_delete_form" class="filled-in material-checkbox-input" name="checked[]" value="{{$package->id}}" id="checkbox{{$package->id}}">
                    <label for="checkbox{{$package->id}}" class="material-checkbox"></label>
                  </div>
                </td>
                <td>{{$key+1}}</td>
                <td>{{$package->name}}</td>
                <td>@if($package->amount != '0.00') <i class="{{$package->currency_symbol}}"></i>{{$package->amount}} @else Free @endif</td>
                <td>{{$package->interval}}</td>
                <td>{{$package->interval_count}}</td>
                <td>
                  @if($package->trial_period_days == NULL)
                  0
                  @else
                  {{$package->trial_period_days}}</td>
                  @endif
                <td>
                  <form action="{{ route('pkgstatus',$package->id) }}" method="POST">
                    {{ csrf_field() }}
                  @if($package->status == 'active' || $package->status == 'upcoming')
                  <input type="hidden" value="inactive" name="status">
                  <button type="submit" class="btn btn-rounded btn-danger" title="{{__('Deactivate')}}">{{__('Deactivate')}}</button>
                  @else
                  <input type="hidden" value="active" name="status">
                  <button type="submit" class="btn btn-rounded btn-success" title="{{__('Activate')}}">{{__('Activate')}}</button>
                  @endif
                  </form>
                </td>
                <td>
                  <div class="admin-table-action-block">
                    @if($package->delete_status != 1)
                    @can('package.edit')
                    <a class="btn btn-round btn-outline-primary" data-original-title="{{__('Restore Package')}}" ><i class="fa fa-pencil"></i></a>
                    @endcan
                    {{-- <a href="{{route('pricing.text', $package->id)}}" data-toggle="tooltip" data-original-title="{{__('adminstaticwords.PackageFeature')}}" class="btn-success btn-floating"><i class="material-icons">settings</i></a> --}}
                    @can('package.delete')
                    <button data-toggle="modal" data-target="#deleteModal{{$package->id}}" class="btn btn-round btn-outline-danger"><i class="fa fa-trash"></i></button>
                    @endcan
                  @else
                    @can('package.edit')
                    <a class="btn btn-round btn-outline-primary" href="{{route('packages.edit', $package->id)}}"> <i class="fa fa-pencil"></i></a>
                    @endcan
                  @endif
                   
                  </div>
                </td>
              </tr>
              {{-- @endif --}}
              <!-- Delete Modal -->
              <div id="deleteModal{{$package->id }}" class="delete-modal modal fade" role="dialog">
                <div class="modal-dialog modal-sm">
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <div class="delete-icon"></div>
                    </div>
                    <div class="modal-body text-center">
                      <h4 class="modal-heading">{{__('Are You Sure ?')}}</h4>
                      <p>{{__('Do you really want to delete selected item names here? This
                          process
                          cannot be undone.')}}</p>
                  </div>
                    <div class="modal-footer">
                      <form method="POST" action="{{route("packages.destroy", $package->id)}}">
                        @method("DELETE")
                        @csrf
                        <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">{{__('No')}}</button>
                        <button type="submit" class="btn btn-danger">{{__('Yes')}}</button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Soft Delete Modal -->
              <div id="{{$package->id}}deleteModal" class="delete-modal modal fade" role="dialog">
                <div class="modal-dialog modal-sm">
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <div class="delete-icon"></div>
                    </div>
                    <div class="modal-body text-center">
                      <h4 class="modal-heading">{{__('Are You Sure ?')}}</h4>
                      <p>{{__('Do you really want to delete selected item names here? This
                          process
                          cannot be undone.')}}</p>
                  </div>
                    <div class="modal-footer">
                      {!! Form::open(['method' => 'DELETE', 'action' => ['PackageController@softDelete', $package->id]]) !!}
                      <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">{{__('No')}}</button>
                      <button type="submit" class="btn btn-danger">{{__('Yes')}}</button>
                      {!! Form::close() !!}
                    </div>
                  </div>
                </div>
              </div>

            @endforeach
          </tbody>
        @endif
        <div id="bulk_delete" class="delete-modal modal fade" role="dialog">
          <div class="modal-dialog modal-sm">
              <!-- Modal content-->
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <div class="delete-icon"></div>
                  </div>
                  <div class="modal-body text-center">
                      <h4 class="modal-heading">{{__('Are You Sure ?')}}</h4>
                      <p>{{__('Do you really want to delete selected item names here? This
                          process
                          cannot be undone.')}}</p>
                  </div>
                  <div class="modal-footer">
                    {!! Form::open(['method' => 'POST', 'action' => 'PackageController@bulk_delete', 'id' => 'bulk_delete_form']) !!}
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
@endsection 
@section('script')
    <script src="{{ url('assets/plugins/tabledit/jquery.tabledit.js') }}"></script>     
    <script src="{{ url('assets/js/custom/custom-table-editable.js') }}"></script>
  
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
      $(function() {
        $('#cb3').change(function() {
          $('#status').val(+ $(this).prop('checked'))
        })
      })
    </script>
  
  <script>
      
      var sorturl = {!!json_encode(route('package_reposition'))!!};
  
      </script>
  
      <script>
        $(function(){
          jQuery.noConflict();
          $('#checkboxAll').on('change', function(){
              if($(this).prop("checked") == true){
              $('.material-checkbox-input').attr('checked', true);
              }
              else if($(this).prop("checked") == false){
              $('.material-checkbox-input').attr('checked', false);
              }
          });

          $( "#full_detail_table" ).sortable({
            items: "tr",
            cursor: 'move',
            opacity: 0.6,
            update: function() {
              sendOrderToServer();
            }
          });
        });
  
  
      
  
      function sendOrderToServer() {
      var order = [];
      var token = $('meta[name="csrf-token"]').attr('content');
      $('tr.row1').each(function(index,element) {
          order.push({
          id: $(this).attr('data-id'),
          position: index+1
          });
      });
      $.ajax({
          type: "POST", 
          dataType: "json", 
          url: sorturl,
          data: {
              order: order,
          _token: token
          },
          success: function(response) {
              if (response.status == "success") {
              console.log(response);
              } else {
              console.log(response);
              }
          }
      });
      }
          
      </script>
@endsection