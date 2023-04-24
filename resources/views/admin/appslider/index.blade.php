@extends('layouts.master')
@section('title',__('App Slider'))
@section('breadcum')
	<div class="breadcrumbbar">
      <h4 class="page-title">{{ __('Mobile App Slider') }}</h4>
      <div class="breadcrumb-list">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/admin')}}" title="{{ __('Dashboard') }}">{{ __('Dashboard') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('Mobile App Slider') }}</li>
          </ol>
      </div>
    </div>
@endsection
@section('maincontent')
<div class="contentbar">
<div class="row">
  
  <div class="col-lg-12">
      <div class="card m-b-30">
          <div class="card-header">
              <button type="button" class="float-right btn btn-danger-rgba mr-2" data-toggle="modal"
            data-target="#bulk_delete" title="{{ __('Delete Selected') }}"
><i class="feather icon-trash mr-2"></i> {{ __('Delete Selected') }} </button>
              <a href="{{ route('appslider.create') }}" class="float-right btn btn-primary-rgba mr-2" title="{{ __('Add Mobile App Slide') }}"
><i
                  class="feather icon-plus mr-2"></i>{{ __('Add Mobile App Slide') }}</a>
           

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
                        {!! Form::open(['method' => 'POST', 'action' => 'AppSliderController@bulk_delete', 'id' => 'bulk_delete_form']) !!}
                              @method('POST')
                              <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">{{__('No')}}</button>
                              <button type="submit" class="btn btn-danger">{{__('Yes')}}</button>
                          {!! Form::close() !!}
                      </div>
                  </div>
              </div>
                <h5 class="card-title"> {{__("App Slider")}}</h5>
          </div>
          
          <div class="card-body">
           
              <div class="table-responsive">
                <table id="full_detail_table" class="table table-borderd responsive" style="width: 100%">
                    <thead>
                      <th>
                        <div class="inline">
                          <input id="checkboxAll" type="checkbox" class="filled-in" name="checked[]" value="all" id="checkboxAll">
                          <label for="checkboxAll" class="material-checkbox"></label>
                        </div>
                      </th>
                      <th>{{__('Movie')}}</th>
                      <th>{{__('Tv-Series')}}</th>
                      <th>{{__('App Slider Image')}}</th>
                      <th>{{__('Status')}}</th>
                      <th>{{__('Actions')}}</th>
                    </thead>
                    @if ($app_slides)
                    <tbody id="sortable">
                    @foreach ($app_slides as $key => $app_slide)
                      <tr class="row1 sortable" data-id="{{$app_slide->id}}">
                        <td>
                          <div class="inline">
                            <input type="checkbox" form="bulk_delete_form" class="filled-in material-checkbox-input" name="checked[]" value="{{$app_slide->id}}" id="checkbox{{$app_slide->id}}">
                            <label for="checkbox{{$app_slide->id}}" class="material-checkbox"></label>
                          </div>
                          <a class="handle"><i class="fa fa-unsorted" style="opacity: 0.3"></i></a>
                          {{$key+1}}
                        </td>
                        <td>{{$app_slide->movie ? $app_slide->movie->title : '-'}}</td>
                        <td>{{$app_slide->tvseries ? $app_slide->tvseries->title : '-'}}</td>
                        <td class="app-slider-image">
                          @if(isset($app_slide->slide_image))
                            @if($app_slide->movie && $app_slide->movie_id != NULL )
                              @if ($app_slide->slide_image != null)
                                <img src="{{asset('images/app_slider/movies/'. $app_slide->slide_image)}}" class="img-responsive" alt="slider-image">
                              @elseif ($app_slide->movie->poster != null)
                                <img src="{{asset('images/movies/posters/'. $app_slide->movie->poster)}}" class="img-responsive" alt="slider-image">
                              @endif
                            @elseif(isset($app_slide->tvseries) && $app_slide->tv_series_id != NULL)
                              @if ($app_slide->slide_image != null)
                                <img src="{{asset('images/app_slider/shows/'. $app_slide->slide_image)}}" class="img-responsive" alt="slider-image">
                              @elseif ($app_slide->tvseries['poster'] != null)
                                <img src="{{asset('images/tvseries/posters/'. $app_slide->tvseries['poster'])}}" class="img-responsive" alt="slider-image">
                              @endif
                            @else
                                @if ($app_slide->slide_image != null)
                                  <img src="{{asset('images/app_slider/'. $app_slide->slide_image)}}" class="img-responsive" alt="slider-image">
                                @endif
                            
                            @endif
                          
                          @endif
                        </td>
                        <td>{{$app_slide->active == 1 ? __('Active') : __('Deactive')}}</td>
                        <td>
                          <div class="admin-table-action-block">
                            <a href="{{route('appslider.edit', $app_slide->id)}}" data-toggle="tooltip" data-original-title="{{__('Edit')}}" class="btn btn-round btn-outline-primary" title="{{ __('Edit') }}"> <i class="fa fa-edit"></i></a>
                            <button type="button" class="btn btn-round btn-outline-danger" data-toggle="modal" data-target="#delete{{$app_slide->id}}" title="{{ __('Delete') }}"><i class="fa fa-trash"></i> </button>
                          </div>
                        </td>
                      </tr>
                      <!-- Delete Modal -->
                      <div id="delete{{$app_slide->id}}" class="delete-modal modal fade" role="dialog">
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
                                  {!! Form::open(['method' => 'DELETE', 'action' => ['AppSliderController@destroy', $app_slide->id]]) !!}
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