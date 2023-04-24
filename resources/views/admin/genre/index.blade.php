@extends('layouts.master')
@section('title',__('All Genres'))
@section('breadcum')
	<div class="breadcrumbbar">
      <h4 class="page-title">{{ __('All Genres') }}</h4>
      <div class="breadcrumb-list">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/admin')}}" title="{{ __('Dashboard') }}">{{ __('Dashboard') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('Genres') }}</li>
          </ol>
      </div>   
  </div>
@endsection
@section('maincontent')
<div class="contentbar permissionTable"> 
  <div class="row">
    <div class="col-md-12">
      <div class="card-header movie-create-heading mb-4 pb-4">
          <div class="row">
          <div class="col-lg-2 col-3">
            <h5 class="card-title">{{ __('Genre') }} 
                 <input class="grand_selectallm ml-2" type="checkbox">
                 {{__('Select All') }}
              </h5>
          </div>

            <div class="col-lg-2 col-md-12 col-12">
              <form class="navbar-form" role="search">
              <div class="input-group ">
                  <form method="get" action="">
                  <input value="{{ app('request')->input('name') ?? '' }}" type="text" name="search" class="form-control float-left text-center" placeholder="{{__('Search Genre')}}">
                  <button type="submit" class="search-button"><i class="fa fa-search"></i></button>
                  </form>
              </div>
              </form>
            </div>

            <div class="col-lg-8 col-md-8 col-12">
              @can('genre.delete')
                <button type="button" class="float-right btn btn-danger-rgba mr-2 " data-toggle="modal"
                data-target="#bulk_delete" title="{{ __('Delete Selected') }}"><i class="feather icon-trash mr-2"></i> {{ __('Delete Selected') }} </button>
              @endcan
             

              @if (Session::has('changed_language'))
              <a href="{{ route('tmdb_movie_translate') }}" class="float-right btn btn-warning-rgba mr-2" title="{{ __('Translate All To') }}"><i
                  class="fa fa-language"></i>{{ __('Translate All To') }} {{Session::get('changed_language')}} </a>
              @endif
              @can('genre.create')
              
              <button type="button" class="float-right btn btn-success-rgba mr-2 " data-toggle="modal"
              data-target=".bd-example-modal-lg" title="{{ __('Import Genres') }}"><i class="fa fa-file-excel-o mr-2"></i> {{ __('Import Genres') }} </button>
              <a href="{{route('genres.create')}}" class="float-right btn btn-primary-rgba mr-2" title="{{ __('Create Genre') }}"><i
                  class="feather icon-plus mr-2"></i>{{ __('Create Genre') }} </a>

              @endcan
              
              {{-- Bulk Delete Model Start --}}
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
                              {!! Form::open(['method' => 'POST', 'action' => 'GenreController@bulk_delete', 'id' => 'bulk_delete_form']) !!}
                              @csrf
                                  @method('POST')
                                  <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">{{__('No')}}</button>
                                  <button type="submit" class="btn btn-danger">{{__('Yes')}}</button>
                              {!! Form::close() !!}
                          </div>
                      </div>
                  </div>
              </div>
              {{-- Bulk Delete Model End --}}

              {{-- Import Model Start --}}
              <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h5 class="modal-title" id="exampleLargeModalLabel">{{__("Bulk Import Actors")}}</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close" title="{{ __('Close') }}">
                              <span aria-hidden="true">&times;</span>
                              </button>
                          </div>
                              <div class="col-md-12">
                                  <div class="card-header">
                                      <a href="{{ url('files/Genres.xlsx') }}" class="float-right btn btn-success-rgba mr-2" title="{{ __('Download Example xls/csv File') }}"><i
                                          class="fa fa-file-excel-o mr-2"></i>{{ __('Download Example xls/csv File') }}</a>
                                  </div>
                              </div>

                              <div class="card-header">
                                  <h6 class="card-title">{{ __('Choose your xls/csv File :') }}</h6>
                                  <form action="{{ url('/admin/import/genres') }}" method="POST" enctype="multipart/form-data">
                                      @csrf
                                      <input type ="file" class="btn btn-primary"/>
                                      <button type="submit" class="float-right btn btn-danger-rgba mr-2" title="{{__('Import')}}"><i class="feather icon-plus mr-2"></i> {{__('Import')}} </button>
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
                                          <th>{{__('Column No.')}}</th>
                                          <th>{{__('Column Name')}}</th>
                                          <th>{{__('Required')}}</th>
                                          <th>{{__('Description')}}</th>
                                        </tr>
                                      </thead>
                    
                                      <tbody>
                                        <tr>
                                          <td>1</td>
                                          <td><b>{{__('Name')}}</b></td>
                                          <td><b>{{__('Yes')}}</b></td>
                                          <td>{{__('Enter genre name')}}</td>
                                        </tr>
                    
                                        <tr>
                                          <td>2</td>
                                          <td> <b>{{__('Image')}}</b> </td>
                                          <td><b>{{__('No')}}</b></td>
                                          <td>{{__('Name your image eg: example.jpg')}} <b>{{__('(Image can be uploaded using Media Manager / Genre Tab.)')}}</b></td>
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

            <div class="card-body">
            </div>
          </div>
        </div>
      </div>
        <div class="row">
            <!-- Start col -->
          @if(isset($genres) && $genres->count() > 0)
            @foreach($genres as $genre)
              @php
                if($genre->image != NULL){
                  $content = @file_get_contents(public_path() .'/images/genre/' . $genre->image); 
                  if($content){
                    $image = public_path() .'/images/genre/' . $genre->image;
                  }else{
                    $image = Avatar::create($genre->name)->toBase64();
                  }
                }else{
                  $image = Avatar::create($genre->name)->toBase64();
                }

                $imageData = base64_encode(@file_get_contents($image));
                if($imageData){
                    $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                } 
              @endphp
              <div class="col-md-6 col-lg-6 col-xl-2">
                <div class="card m-b-30 genre-page">
                  <div class="checkbox-overlay movies-main-block">
                    <input class="permissioncheckbox form-check-card-input visibility-visible" form="bulk_delete_form" type="checkbox" value="{{$genre->id}}" id="checkbox{{$genre->id}}" name="checked[]">  
                  </div>
                  @if($src != NULL)
                  <a href="{{url('show/all/genres', $genre->id)}}" target="__blank"><img class="card-img-top" src="{{$src}}" alt="{{$genre->name}}"></a>
                  @endif
                  <div class="overlay-bg"></div>
                  <div class="card-img-overlay">
                      <h5 class="card-title text-white text-center font-18"><a href="{{url('show/all/genres', $genre->id)}}" target="__blank">{{$genre->name}}</a></h5>                 
                  </div>     
                  <div class="card-body p-2">
                    <div class="row mt-1 mb-1">
                    <div class="col-1"></div>
                    @can('genre.edit')
                    <div class="col-2 mr-2">
                        <a href="{{route('genres.edit', $genre->id)}}">
                        <i title="Edit" class="feather icon-edit mr-5"></i></a>
                    </div>
                    @endcan
                    @can('genre.delete')
                    <div class="col-2">
                      <a href="" data-toggle="modal" data-target="#delete{{$genre->id }}">
                      <i title="Delete" class="text-primary feather icon-trash"></i></a>
      
                      <div class="modal fade bd-example-modal-sm" id="delete{{$genre->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleSmallModalLabel">{{ __('Delete') }}</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close" title="{{ __('Close') }}">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <h4>{{ __('Are You Sure ?')}}</h4>
                              <p>{{ __('Do you really want to delete')}} ? {{ __('This process cannot be undone.')}}</p>
                            </div>
                            <div class="modal-footer">
                              <form method="post" action="{{route("genres.destroy", $genre->id)}}" class="pull-right">
                                {{csrf_field()}}
                                {{method_field("DELETE")}}
                                <button type="reset" class="btn btn-secondary" data-dismiss="modal">{{ __('No') }}</button>
                                <button type="submit" class="btn btn-primary">{{ __('Yes') }}</button>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    @endcan
                  </div>
                </div>
              </div>
            </div> 
            @endforeach
          @endif
          <div class="col-md-12 pagination-block">
            {!! $genres->appends(request()->query())->links() !!}
          </div> 
        </div>
    </div></div>
</div>
</div>
</div>
@endsection 
@section('script')
   

@endsection