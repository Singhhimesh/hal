@extends('layouts.master')
@section('title',__('All Slider'))
@section('breadcum')
  <div class="breadcrumbbar">
    <h4 class="page-title">{{ __('All Slider') }}</h4>
    <div class="breadcrumb-list">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('/admin')}}" title="{{ __('Dashboard') }}">{{ __('Dashboard') }}</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ __('All Slider') }}</li>
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
              <a href="{{ route('home_slider.create') }}" class="float-right btn btn-primary-rgba mr-2" title="{{ __('Add Slide') }}"><i
                  class="feather icon-plus mr-2"></i>{{ __('Add Slide') }}</a>
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
                              {!! Form::open(['method' => 'POST', 'action' => 'HomeSliderController@bulk_delete', 'id' => 'bulk_delete_form']) !!}
                                    @method('POST')
                                    <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">{{__('No')}}</button>
                                    <button type="submit" class="btn btn-danger">{{__('Yes')}}</button>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
                <h5 class="card-title"> {{__("All Slider")}}</h5>
          </div>
          
          <div class="card-body">
           
              <div class="table-responsive">
                <table id="full_detail_table" class="table table-borderd responsive " style="width: 100%">
                  <thead>
                    <tr class="table-heading-row">
                    <th>
                      <div class="inline">
                        <input id="checkboxAll" type="checkbox" class="filled-in" name="checked[]" value="all" id="checkboxAll">
                        <label for="checkboxAll" class="material-checkbox"></label>
                      </div>
                      #
                    </th>
                    <th>{{__('Movie')}}</th>
                    <th>{{__('TV Series')}}</th>
                    <th>{{__('Slide Image')}}</th>
                    <th>{{__('Active')}}</th>
                    <th>{{__('Actions')}}</th>
                  </tr>
                  </thead>
                  @if ($home_slides)
                    <tbody id="sortable">
                    @foreach ($home_slides as $key => $home_slide)
                      <tr class="sortable row1" data-id="{{ $home_slide->id }}">
                        <td>
                          <div class="inline">
                            <input type="checkbox" form="bulk_delete_form" class="filled-in material-checkbox-input" name="checked[]" value="{{$home_slide->id}}" id="checkbox{{$home_slide->id}}">
                            <label for="checkbox{{$home_slide->id}}" class="material-checkbox"></label>
                          </div>
                          <a class="handle"><i class="fa fa-unsorted" style="opacity: 0.3"></i></a>
                          {{$key+1}}
                        </td>
                        <td>{{$home_slide->movie ? $home_slide->movie->title : '-'}}</td>
                        <td>{{$home_slide->tvseries ? $home_slide->tvseries->title : '-'}}</td>
                        <td class="app-slider-image">
                          @if(isset($home_slide->slide_image))
                            @if(isset($home_slide->movie) && $home_slide->movie_id != NULL)
                              @if ($home_slide->movie != null && $home_slide->movie_id != NULL)
                                <img src="{{asset('images/home_slider/movies/'. $home_slide->slide_image)}}" class="img-responsive" alt="slide-image">
                              @elseif ($home_slide->movie->poster != null)
                                <img src="{{asset('images/movies/posters/'. $home_slide->movie->poster)}}" class="img-responsive" alt="slide-image">
                              @endif
                            @elseif(isset($home_slide->tvseries)&& $home_slide->tv_series_id != NULL)
                              @if ($home_slide->slide_image != null)
                                <img src="{{asset('images/home_slider/shows/'. $home_slide->slide_image)}}" class="img-responsive" alt="slide-image">
                              @elseif ($home_slide->tvseries['poster'] != null)
                                <img src="{{asset('images/tvseries/posters/'. $home_slide->tvseries['poster'])}}" class="img-responsive" alt="slide-image">
                              @endif
                            @else
                              @if($home_slide->slide_image != null)
                                <img src="{{asset('images/home_slider/'. $home_slide->slide_image)}}" class="img-responsive" alt="slide-image">
                              @endif
                            @endif
                          @endif
                        </td>
                        <td>{{$home_slide->active == 1 ? __('Active') : __('inactive')}}</td>
                        <td>
                          <div class="admin-table-action-block">
                            <a href="{{route('home_slider.edit', $home_slide->id)}}" data-toggle="" data-original-title="{{__('Edit')}}" class="btn btn-round btn-outline-primary" title="{{ __('Edit') }}"> <i class="fa fa-edit"></i></a>
                            <button type="button" class="btn btn-round btn-outline-danger" data-toggle="modal" data-target="#delete{{$home_slide->id}}" title="{{ __('Delete') }}"><i class="fa fa-trash"></i> </button>
                          </div>
                        </td>
                      </tr>
                      <!-- Delete Modal -->
                      <div id="delete{{$home_slide->id}}" class="delete-modal modal fade" role="dialog">
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
                                  {!! Form::open(['method' => 'DELETE', 'action' => ['HomeSliderController@destroy', $home_slide->id]]) !!}
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
  var sorturl = {!!json_encode(route('slide_reposition'))!!};
</script>
<script>  
  (function($){

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

  })(jQuery);  

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