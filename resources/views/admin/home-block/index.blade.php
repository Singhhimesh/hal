@extends('layouts.master')
@section('title',__('All Promotion Settings'))
@section('breadcum')
	  <div class="breadcrumbbar">
      <h4 class="page-title">{{ __('Promotion Settings') }}</h4>
      <div class="breadcrumb-list">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/admin')}}" title="{{ __('Dashboard') }}">{{ __('Dashboard') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('Promotion Settings') }}</li>
          </ol>
      </div> 
    </div>
    
@endsection
@section('maincontent')
<div class="contentbar">
<div class="row">
  
  <div class="col-lg-12">
      <div class="card m-b-50">
          <div class="card-header">
            <button type="button" class="float-right btn btn-danger-rgba mr-2 " data-toggle="modal"
            data-target="#bulk_delete" title="{{ __('Delete Selected') }}"><i class="feather icon-trash mr-2"></i> {{ __('Delete Selected') }} </button>
              <a href="{{route('home-block.create')}}" class="float-right btn btn-primary-rgba mr-2" title="{{ __('Add Promotion') }}"><i
                  class="feather icon-plus mr-2"></i>{{ __('Add Promotion') }}</a>
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
                              {!! Form::open(['method' => 'POST', 'action' => 'HomeBlockController@bulk_delete', 'id' => 'bulk_delete_form']) !!}
                                    @method('POST')
                                    <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">{{__('No')}}</button>
                                    <button type="submit" class="btn btn-danger">{{__('Yes')}}</button>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
                <h5 class="card-title"> {{__("Promotion Settings")}}</h5>
          </div>
          
          <div class="card-body">
           
              <div class="table-responsive">
                <table id="full_detail_table" class="table table-borderd responsive " style="width: 100%">

                    <thead>
                      <th>
                        <div class="inline">
                          <input id="checkboxAll" type="checkbox" class="filled-in" name="checked[]" value="all" id="checkboxAll">
                          <label for="checkboxAll" class="material-checkbox"></label>
                        </div>
                        #
                      </th>
                      <th>{{__('Movie')}}</th>
                      <th>{{__('TV Series')}}</th>
                      <th>{{__('Active')}}</th>
                      <th>{{__('Actions')}}</th>
                    </thead>
                    @if ($home_blocks)
          <tbody>
                  @foreach ($home_blocks as $key => $home_block)
                    <tr id="item-{{$home_block->id}}">
                      <td>
                        <div class="inline">
                          <input type="checkbox" form="bulk_delete_form" class="filled-in material-checkbox-input" name="checked[]" value="{{$home_block->id}}" id="checkbox{{$home_block->id}}">
                          <label for="checkbox{{$home_block->id}}" class="material-checkbox"></label>
                        </div>
                        <a class="handle"><i class="fa fa-unsorted" style="opacity: 0.3"></i></a>
                      {{--  {{$key+1}} --}}
                      </td>
                      <td>{{$home_block->movie ? $home_block->movie->title : '-'}}</td>
                      <td>{{$home_block->tvseries ? $home_block->tvseries->title : '-'}}</td>
                        <td>{{$home_block->active == 1 ? __('Active') : __('Deactive')}}</td>
                        <td>
                          <div class="admin-table-action-block">
                            <a href="{{route('appslider.edit', $home_block->id)}}" data-toggle="" data-original-title="{{__('Edit')}}" class="btn btn-round btn-outline-primary" title="{{ __('Edit') }}"> <i class="fa fa-edit"></i></a>
                            <button type="button" class="btn btn-round btn-outline-danger" data-toggle="modal" data-target="#delete{{$home_block->id}}" title="{{ __('Delete') }}"><i class="fa fa-trash"></i> </button>
                          </div>
                        </td>
                      </tr>
                      <!-- Delete Modal -->
                      <div id="delete{{$home_block->id}}" class="delete-modal modal fade" role="dialog">
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
                                  {!! Form::open(['method' => 'DELETE', 'action' => ['HomeBlockController@destroy', $home_block->id]]) !!}
                                        @method('POST')
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
              
                </table>
            </div>
        </div>
    </div>
</div>
</div>
@endsection 
@section('script')
<script>
 
  var sorturl = {!!json_encode(route('app_slide_reposition'))!!};

</script>
<script>
  $(function(){
    // jQuery.noConflict();
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