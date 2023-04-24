@extends('layouts.master')
@section('title',__('All Live Events'))
@section('breadcum')
	<div class="breadcrumbbar">
            <h4 class="page-title">{{ __('All Live Events') }}</h4>
            <div class="breadcrumb-list">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{url('/admin')}}" title="{{ __('Dashboard') }}">{{ __('Dashboard') }}</a></li>
                  <li class="breadcrumb-item active" aria-current="page">{{ __('Live Events') }}</li>
                </ol>
            </div>   
    </div>
@endsection
@section('maincontent')
<div class="contentbar permissionTable"> 
  <div class="row">
    <div class="col-md-12">
      <div class="card-header movie-create-heading">
        <div class="row">
          <div class="col-lg-4 col-4">
            <h5 class="card-title">{{ __('All Live Events') }}
                 <input class="grand_selectallm ml-3" type="checkbox">
                                        {{__('Select All') }}</h5>
          </div>
          <div class="col-lg-8 col-8">
            @can('liveevent.delete')
              <button type="button" class="float-right btn btn-danger-rgba mr-2 " data-toggle="modal"
              data-target="#bulk_delete" title="{{ __('Delete Selected') }}"><i class="feather icon-trash mr-2"></i> {{ __('Delete Selected') }} </button>
            @endcan
            
            <button type="button" class="float-right btn btn-success-rgba mr-2 " data-toggle="modal"
            data-target=".bd-example-modal-lg" title="{{ __('Import Live Events') }}"><i class="fa fa-file-excel-o mr-2"></i> {{ __('Import Live Events') }} </button>
            @can('liveevent.create')
            <a href="{{route('liveevent.create')}}" class="float-right btn btn-primary-rgba mb-2 mr-2" title="{{ __('Add Live Event') }}"><i
                class="feather icon-plus mr-2"></i>{{ __('Add Live Event') }} </a>
            @endcan
            {{-- Bulk Delete Model Start --}}
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
                        {!! Form::open(['method' => 'POST', 'action' => 'LiveEventController@bulk_delete', 'id' => 'bulk_delete_form']) !!}
                              <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">{{__('No')}}</button>
                              <button type="submit" class="btn btn-danger">{{__('Yes')}}</button>
                          {!! Form::close() !!}
                      </div>
                  </div>
              </div>
            </div>
            {{-- Bulk Delete Model End --}}

            {{-- Impport Model Start --}}
            <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="exampleLargeModalLabel">{{__("Bulk Import Live Events")}}</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close" title="{{ __('Bulk Import Live Events') }}">
                          <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                          <div class="col-md-12">
                              <div class="card-header">
                                  <a href="{{ url('files/Liveevents.xlsx') }}" class="float-right btn btn-success-rgba mr-2" title="{{ __('Download Example xls/csv File') }}"><i
                                      class="fa fa-file-excel-o mr-2"></i>{{ __('Download Example xls/csv File') }}</a>
                              </div>
                          </div>
            
                          <div class="card-header">
                              <h6 class="card-title">{{ __('Choose your xls/csv File :') }}</h6>
                              <form action="{{ url('/admin/import/live-event') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group{{ $errors->has('file') ? ' has-error' : '' }} input-file-block col-md-12">
                                  {!! Form::file('file', ['class' => 'input-file', 'id'=>'file']) !!}
                                  <label for="file" class="btn btn-danger js-labelFile" data-toggle="tooltip" data-original-title="{{__('Choose your xls/csv File')}}">
                                    <i class="icon fa fa-check"></i>
                                    <span class="js-fileName">{{__('Choose A File')}}</span>
                                  </label>
                                  <small class="text-danger">{{ $errors->first('file') }}</small>
              
                                  <button type="submit" class="float-right btn btn-danger-rgba mr-2 "><i class="feather icon-plus mr-2"></i> {{__('Import')}} </button>
                                </div>
                                  
                              </form>
                          </div> 
                          
                      <div class="modal-body">
                          <div class="box box-danger">
                              <div class="box-header">
                                <div class="box-title">{{__('Instructions')}}</div>
                              </div>
                              <div class="box-body table-responsive">
                                <h6><b>{{__('Follow the instructions carefully before importing the file.')}}</b></h6>
                                <small>{{__('The columns of the file should be in the following order.')}}</small>
                                <table class="table table-striped table-bordered">
                                  <thead>
                                    <tr>
                                      <th>{{__('Column No')}}</th>
                                      <th>{{__('Column Name')}}</th>
                                      <th>{{__('Required')}}</th>
                                      <th>{{__('Description')}}</th>
                                    </tr>
                                  </thead>
                
                                  <tbody>
                                    <tr>
                                      <td>1</td>
                                      <td><b>{{__('title')}}</b></td>
                                      <td><b>{{__('Yes')}}</b></td>
                                      <td>{{__('Enter live event title / name')}}</td>
                                    </tr>
                                  
                                    <tr>
                                      <td>3</td>
                                      <td> <b>{{__('description')}}</b> </td>
                                      <td><b>{{__('No')}}</b></td>
                                      <td>{{__("Enter live event meta description")}}</td>
                                    </tr>
                                    <tr>
                                      <td>4</td>
                                      <td> <b>{{__('thumbnail')}}</b> </td>
                                      <td><b>{{__('No')}}</b></td>
                                      <td>{{__('Name your image eg: example.jpg')}} <b>{{__('(Image can be uploaded using Media Manager / live event / thumbnail Tab.)')}}</b></td>
                                    </tr>
                                    <tr>
                                      <td>5</td>
                                      <td> <b>{{__('poster')}}</b> </td>
                                      <td><b>{{__('No')}}</b></td>
                                      <td>{{__('Name your image eg: example.jpg')}} <b>{{__('(Image can be uploaded using Media Manager / live event / poster Tab.)')}}</b></td>
                                    </tr>
                                    
                                    <tr>
                                      <td>11</td>
                                      <td> <b>{{__('menu')}}</b> </td>
                                      <td><b>{{__('Yes')}}</b></td>
                                      <td>{{__("Multiple menu id can be pass here seprate by comma .")}}</td>
                                    </tr>
                                    <tr>
                                      <td>11</td>
                                      <td> <b>{{__('start_time')}}</b> </td>
                                      <td><b>{{__('Yes')}}</b></td>
                                      <td>{{__("enter the event start time here .")}}</td>
                                    </tr>
                                    <tr>
                                      <td>11</td>
                                      <td> <b>{{__('end_time')}}</b> </td>
                                      <td><b>{{__('Yes')}}</b></td>
                                      <td>{{__("enter the event end time here .")}}</td>
                                    </tr>
                                    <tr>
                                      <td>11</td>
                                      <td> <b>{{__('organized_by')}}</b> </td>
                                      <td><b>{{__('Yes')}}</b></td>
                                      <td>{{__("enter a organization name .")}}</td>
                                    </tr>
              
                                  
                                  </tbody>
                                </table>
                              </div>
                            </div>
                      </div>
                  </div>
              </div>
            </div>
            {{-- Import Model End --}}
          </div> 
        </div>
      </div>
      <div class="card-body">
        <section id="movies" class="movies-main-block">
            <div class="row">
              @if(isset($liveevent) && count($liveevent) > 0)
              @foreach($liveevent as $item)
                @php
                  if($item->thumbnail != NULL){
                    $content = @file_get_contents(public_path() .'/images/events/thumbnails/' . $item->thumbnail); 
                    if($content){
                      $image = public_path() .'/images/events/thumbnails/' . $item->thumbnail;
                    }else{
                      $image = Avatar::create($item->title)->toBase64();
                    }
                  }else{
                    $image = Avatar::create($item->title)->toBase64();
                  }
    
                  $imageData = base64_encode(@file_get_contents($image));
                  if($imageData){
                      $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                  } 
                @endphp
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <input class="permissioncheckbox form-check-card-input visibility-visible" form="bulk_delete_form" type="checkbox" value="{{$item->id}}" id="checkbox{{$item->id}}" name="checked[]">         
                    <div class="card">
                      @if($src != NULL)
                       <a href="{{url('event/detail', $item->slug)}}" target="__blank" title="{{$item->title}}"> <img src="{{$src}}" class="card-img-top" alt="{{$item->title}}"></a>
                      @endif
                        <div class="overlay-bg"></div>
                        <div class="dropdown card-dropdown">
                            <a class="btn btn-round btn-outline-primary pull-right dropdown-toggle" type="button" id="dropdownMenuButton-{{$item->id}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="{{ __('Settings') }}"><i class="feather icon-more-vertical-"></i></a>
                            <div class="dropdown-menu pull-right" aria-labelledby="dropdownMenuButton-{{$item->id}}">
                              @can('liveevent.view')
                                <a class="dropdown-item" href="{{url('event/detail', $item->slug)}}" target="__blank" title="{{ __('Preview') }}"><i class="feather icon-monitor mr-2"></i>{{__('Preview')}}</a>        
                              @endcan
                              @can('liveevent.edit')                                
                                <a class="dropdown-item" href="{{ route('liveevent.edit', $item->id)}}" title="{{ __('Edit') }}"><i class="feather icon-edit mr-2"></i> {{__('Edit')}}</a>     
                              @endcan
                              @can('liveevent.delete')                                 
                                <a type="button" class="dropdown-item" data-toggle="modal" data-target="#deleteModal{{$item->id}}" title="{{ __('Delete') }}"><i class="feather icon-trash mr-2"></i> {{__('Delete')}}</a>
                              @endcan
                            </div>
                        </div>
                        <div id="deleteModal{{$item->id}}" class="delete-modal modal fade card-dropdown-modal" role="dialog">
                          <div class="modal-dialog modal-sm">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal" title="{{__('Close')}}">×</button>
                                      <div class="delete-icon"></div>
                                  </div>
                                  <div class="modal-body text-center">
                                      <h4 class="modal-heading">{{__('Are You Sure ?')}}</h4>
                                      <p>{{__('Do you really want to delete these records? This process cannot be undone.')}}</p>
                                  </div>
                                  <div class="modal-footer">
                                    <form method="POST" action="{{route("liveevent.destroy", $item->id)}}">
                                      @method('DELETE')
                                      @csrf
                                    <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">{{__('No')}}</button>
                                    <button type="submit" class="btn btn-danger">{{__('Yes')}}</button>
                                    </form>
                                  </div>
                              </div>
                          </div>
                      </div>
                        <div class="card-header">
                          <a href="{{url('event/detail', $item->slug)}}" target="__blank" title="{{$item->title}}"><h5 class="card-title">{{$item->title}}</h5></a>
                        </div>
                        <div class="card-body">
                          <div class="card-block">
                            <h6 class="card-body-sub-heading">{{__('Start Time')}}</h6>
                            <p>{{isset($item->start_time) && $item->start_time != NULL ? date('Y/m/d, h:i:s a',strtotime($item->start_time)) : '-' }}</p>
                          </div>
                          <div class="card-block">
                            <h6 class="card-body-sub-heading">{{__('End Time')}}</h6>
                            <p>{{isset($item->end_time) && $item->end_time != NULL ? date('Y/m/d, h:i:s a',strtotime($item->end_time)) : '-' }}</p>
                          </div>
                          
                          <div class="card-block">
                            <h6 class="card-body-sub-heading">{{__('Organized By')}}</h6>
                            <p>{{isset($item->organized_by) && $item->organized_by ? $item->organized_by : '-' }}</p>
                          </div>
                          <div class="card-block">
                            <h6 class="card-body-sub-heading">{{__('Description')}}</h6>
                            <p>{{isset($item->description) && $item->description ? str_limit($item->description,50) : '-' }}</p>
                          </div>             
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="col-md-12 pagination-block">
                  {!! $liveevent->appends(request()->query())->links() !!}
                </div>
              @else
                <div class="col-md-12 text-center">
                  <h5>{{__("Let's start :)")}}</h5>
                  <small>{{__('Get Started by creating a liveevent ! All of your live events will be displayed on this page.')}}</small>
                </div>
              @endif
            </div>
        </section>
      </div>
    </div>
  </div>
</div>
</div>
@endsection 
@section('script')

@endsection