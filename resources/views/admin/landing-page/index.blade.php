@extends('layouts.master')
@section('title',__('Landing Pages'))
@section('breadcum')
	<div class="breadcrumbbar">
      <h4 class="page-title">{{ __('Landing Pages') }}</h4>
      <div class="breadcrumb-list">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/admin')}}" title="{{ __('Dashboard') }}">{{ __('Dashboard') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('Landing Pages') }}</li>
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
            <a href="{{route('landing-page.create')}}" class="float-right btn btn-primary-rgba mr-2" title="{{ __('Create Slide') }}"><i
                class="feather icon-plus mr-2"></i>{{ __('Create Slide') }}</a>
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
                            {!! Form::open(['method' => 'POST', 'action' => 'LandingPageController@bulk_delete', 'id' => 'bulk_delete_form']) !!}
                                  <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">{{__('No')}}</button>
                                  <button type="submit" class="btn btn-danger">{{__('Yes')}}</button>
                              {!! Form::close() !!}
                          </div>
                      </div>
                  </div>
              </div>
                <h5 class="card-title"> {{__("Landing Pages")}}</h5>
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
                      </th>
                      <th>{{__('Image')}}</th>
                      <th>{{__('Slide Heading')}}</th>
                      <th>{{__('Details')}}</th>
                      <th>{{__('Button For')}}</th>
                      <th>{{__('Image Position')}}</th>
                      <th>{{__('Actions')}}</th>
                    </thead>
                
                    <tbody>

                      @if ($landing_pages)
                      <tbody>
                        @foreach ($landing_pages as $key => $block)
                          <tr id="item-{{$block->id}}">
                            <td>
                              <div class="inline">
                                <input type="checkbox" form="bulk_delete_form" class="filled-in material-checkbox-input" name="checked[]" value="{{$block->id}}" id="checkbox{{$block->id}}">
                                <label for="checkbox{{$block->id}}" class="material-checkbox"></label>
                              </div>
                              {{$key+1}}
                            </td>
                            <td>
                              @if ($block->image != null) 
                                <img src="{{ asset('images/main-home/'.$block->image) }}" width="140px" height="50px" class="img-responsive">
                              @endif
                            </td>
                            <td>{{$block->heading}}</td>
                            <td title="{{$block->detail}}">{{str_limit($block->detail, 50)}}</td>
                            <td>
                              @if ($block->button == 1)
                                @if ($block->button_link == 'login')
                                  <a href="#" data-toggle="tooltip" data-original-title="Login Link" class="btn btn-prime">{{$block->button_text}}</a>
                                @elseif ($block->button_link == 'register')  
                                  <a href="#" data-toggle="tooltip" data-original-title="Register Link" class="btn btn-prime">{{$block->button_text}}</a>
                                @endif
                              @endif
                            </td>
                            <td>{{$block->left == 1 ? 'Left' : 'Right'}}</td>
                            <td>
                              <div class="admin-table-action-block">
                                <a href="{{route('landing-page.edit', $block->id)}}" data-toggle="" data-original-title="{{__('Edit')}}" class="btn btn-round btn-outline-primary" title="{{ __('Edit') }}"> <i class="fa fa-edit"></i></a>
                                <button type="button" class="btn btn-round btn-outline-danger" data-toggle="modal" data-target="#delete{{$block->id}}" title="{{ __('Delete') }}"><i class="fa fa-trash"></i> </button>
                              </div>
                            </td>
                          </tr>
                          <div id="delete{{$block->id}}" class="delete-modal modal fade" role="dialog">
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
                                      {!! Form::open(['method' => 'DELETE', 'action' => ['LandingPageController@destroy', $block->id]]) !!}
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
  (function($){
    $('#checkboxAll').on('change', function(){
      if($(this).prop("checked") == true){
        $('.material-checkbox-input').attr('checked', true);
      }
      else if($(this).prop("checked") == false){
        $('.material-checkbox-input').attr('checked', false);
      }
    });

    $('table.db tbody').sortable({
      cursor: "move",
      revert: true,
      placeholder: 'sort-highlight',
      connectWith: '.connectedSortable',
      forcePlaceholderSize: true,
      zIndex: 999999,
      axis: 'y',
      update: function(event, ui) {
        var data = $(this).sortable('serialize');
        app.$http.post('{{route('landing_page_reposition')}}', {item: data}).then((response) => {
          console.log(data);
          console.log('re');
          console.log(response);
        }).catch((e) => {
          console.log($(this).sortable('serialize'));
          console.log(e);
          console.log('err');
        });
      }
    });
  })(jQuery);
 
  $(window).resize(function() {
    $('table.db tr').css('min-width', $('table.db').width());
  });
</script>
@endsection