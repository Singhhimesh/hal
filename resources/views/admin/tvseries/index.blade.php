@extends('layouts.master')
@section('title',__('All Tv Series'))
@section('breadcum')
	<div class="breadcrumbbar">
                <h4 class="page-title">{{ __('All Tv Series') }}</h4>
                <div class="breadcrumb-list">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{url('/admin')}}">{{ __('Dashboard') }}</a></li>
                      <li class="breadcrumb-item active" aria-current="page">{{ __('Tv Series') }}</li>
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
          <div class="col-lg-4 col-4 col-md-3">
            <h5 class="card-title">{{ __('All Tv Series') }}
                 <input class="grand_selectallm ml-3" type="checkbox">
                                        {{__('Select All') }}</h5></h5>
          </div>
          <div class="col-lg-8 col-8 col-md-9">
            @can('tvseries.delete')
              <button type="button" class="float-right btn btn-danger-rgba mr-2 " data-toggle="modal"
              data-target="#bulk_delete"><i class="feather icon-trash mr-2"></i> {{ __('Delete Selected') }} </button>
            @endcan

            @if (Session::has('changed_language'))
            <a href="{{ route('tmdb_tv_translate') }}" class="float-right btn btn-warning-rgba mr-2"><i
                class="fa fa-language"></i>{{ __('Translate All To') }} {{Session::get('changed_language')}} </a>
            @endif
            <button type="button" class="float-right btn btn-success-rgba mr-2 mb-2" data-toggle="modal"
            data-target=".bd-example-modal-lg"><i class="fa fa-file-excel-o mr-2"></i> {{ __('Import Tv Series') }} </button>
            @can('tvseries.create')
            <a href="{{route('tvseries.create')}}" class="float-right btn btn-primary-rgba mr-2 mb-2"><i
                class="feather icon-plus mr-2"></i>{{ __('Add Tv Series') }} </a>
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
                        {!! Form::open(['method' => 'POST', 'action' => 'TvSeriesController@bulk_delete', 'id' => 'bulk_delete_form']) !!}
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
                          <h5 class="modal-title" id="exampleLargeModalLabel">{{__("Bulk Import Tv Series")}}</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                          <div class="col-md-12">
                              <div class="card-header">
                                  <a href="{{ url('files/Tvseries.xlsx') }}" class="float-right btn btn-success-rgba mr-2"><i
                                      class="fa fa-file-excel-o mr-2"></i>{{ __('Download Example xls/csv File') }}</a>
                              </div>
                          </div>
            
                          <div class="card-header">
                              <h6 class="card-title">{{ __('Choose your xls/csv File :') }}</h6>
                              <form action="{{ url('/admin/import/tv-series') }}" method="POST" enctype="multipart/form-data">
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
                                      <td>{{__('Enter tvseries title / name')}}</td>
                                    </tr>
                                    <tr>
                                      <td>2</td>
                                      <td> <b>{{__('keyword')}}</b> </td>
                                      <td><b>{{__('No')}}</b></td>
                                      <td>{{__("Enter tvseries meta keywords")}}</td>
                                    </tr>
                                    <tr>
                                      <td>3</td>
                                      <td> <b>{{__('description')}}</b> </td>
                                      <td><b>{{__('No')}}</b></td>
                                      <td>{{__("Enter tvseries meta description")}}</td>
                                    </tr>
                                    <tr>
                                      <td>4</td>
                                      <td> <b>{{__('thumbnail')}}</b> </td>
                                      <td><b>{{__('No')}}</b></td>
                                      <td>{{__('Name your image eg: example.jpg')}} <b>{{__('(Image can be uploaded using Media Manager / tvseries / thumbnail Tab.)')}}</b></td>
                                    </tr>
                                    <tr>
                                      <td>5</td>
                                      <td> <b>{{__('poster')}}</b> </td>
                                      <td><b>{{__('No')}}</b></td>
                                      <td>{{__('Name your image eg: example.jpg')}} <b>{{__('(Image can be uploaded using Media Manager / tvseries / poster Tab.)')}}</b></td>
                                    </tr>
                                    <tr>
                                      <td>6</td>
                                      <td> <b>{{__('genre_id')}}</b> </td>
                                      <td><b>{{__('Yes')}}</b></td>
                                      <td>{{__("Multiple genre id can be pass here seprate by comma .")}}</td>
                                    </tr>
                                    <tr>
                                      <td>7</td>
                                      <td> <b>{{__('detail')}}</b> </td>
                                      <td><b>{{__('No')}}</b></td>
                                      <td>{{__("Enter tvseries detail")}}</td>
                                    </tr>
                                    <tr>
                                      <td>8</td>
                                      <td> <b>{{__('rating')}}</b> </td>
                                      <td><b>{{__('No')}}</b></td>
                                      <td>{{__("Enter tvseries rating")}}</td>
                                    </tr>
                
                                  
                                    <tr>
                                      <td>9</td>
                                      <td> <b>{{__('maturity_rating')}}</b> </td>
                                      <td><b>{{__('No')}}</b></td>
                                      <td>{{__("Enter tvseries maturity ratings (please wirte one of these :-  all age , 13+, 16+ or 18+)")}}</b></td>
                                    </tr>
                                  
                                  
                                    <tr>
                                      <td>10</td>
                                      <td> <b>{{__('featured')}}</b> </td>
                                      <td><b>{{__('No')}}</b></td>
                                      <td>{{__("tvseries featured (1 = enabled, 0 = disabled)")}}</b></td>
                                    </tr>
                                  
                                    
                                    <tr>
                                      <td>11</td>
                                      <td> <b>{{__('menu')}}</b> </td>
                                      <td><b>{{__('Yes')}}</b></td>
                                      <td>{{__("Multiple menu id can be pass here seprate by comma .")}}</td>
                                    </tr>
              
                                    <tr>
                                      <td>12</td>
                                      <td> <b>{{__('is_upcoming')}}</b> </td>
                                      <td><b>{{__('No')}}</b></td>
                                      <td>{{__('upcoming tvseries (1 = enabled, 0 = disabled)')}}</td>
                                    </tr>
                                    <tr>
                                      <td>13</td>
                                      <td> <b>{{__('upcoming_date')}}</b> </td>
                                      <td><b>{{__('No')}}</b></td>
                                      <td>{{__('If is_upcoming = 1 , then the pass upcoming date here')}}</b></td>
                                    </tr>
                
                                    <tr>
                                      <td>14</td>
                                      <td> <b>{{__('is_custom_label')}}</b> </td>
                                      <td><b>{{__('No')}}</b></td>
                                      <td>{{__("custom label (1 = enabled, 0 = disabled)")}}</b></td>
                                    </tr>
                
                                    <tr>
                                      <td>15</td>
                                      <td> <b>{{__('label_id')}}</b> </td>
                                      <td><b>{{__('No')}}</b></td>
                                      <td>{{__("If is_custom_label = 1 , then the pass label id here")}}</b></td>
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
        <section id="movies" class="movies-main-block tv-series-main-block">
            <div class="row">
              @if(isset($tv_serieses) && count($tv_serieses) > 0)
              @foreach($tv_serieses as $item)
              @php
                if($item->thumbnail != NULL){
                  $content = @file_get_contents(public_path() .'/images/tvseries/thumbnails/' . $item->thumbnail); 
                  if($content){
                    $image = public_path() .'/images/tvseries/thumbnails/' . $item->thumbnail;
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
                        <img src="{{$src}}" class="card-img-top" alt="...">
                      @endif
                        <div class="overlay-bg"></div>
                        <div class="dropdown card-dropdown">
                            <a class="btn btn-round btn-outline-primary pull-right dropdown-toggle" type="button" id="dropdownMenuButton-{{$item->id}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-more-vertical-"></i></a>
                            <div class="dropdown-menu pull-right" aria-labelledby="dropdownMenuButton-{{$item->id}}">
                              @can('tvseries.view')
                              @php 
                              $ifseason = App\Season::where('tv_series_id', '=', $item->id)->first(); 
                              @endphp
                              @if (isset($ifseason) && $item->status == 1)
                                <a class="dropdown-item" href="{{ url('show/detail', $ifseason->season_slug)}}" target="__blank"><i class="feather icon-monitor mr-2"></i> {{__('Page Preview')}}</a>      
                              @else
                                <a style="cursor: not-allowed" data-toggle="tooltip" data-original-title="Create a season first or tvseries is not active yet" class="dropdown-item"><i class="feather icon-monitor mr-2"></i>  {{__('Page Preview')}}</a>
                              @endif  
                              @endcan
                              @can('tvseries.create')                                
                              <a class="dropdown-item" href="{{ route('tvseries.show', $item->id)}}"><i class="fa fa-gear mr-2"></i> {{__('Manage Seasons')}}</a>     
                              @endcan
                              @can('tvseries.edit')                                
                                <a class="dropdown-item" href="{{ route('tvseries.edit', $item->id)}}"><i class="feather icon-edit mr-2"></i> {{__('Edit')}}</a>     
                              @endcan
                              @can('tvseries.delete')                                 
                                <a type="button" class="dropdown-item" data-toggle="modal" data-target="#deleteModal{{$item->id}}"><i class="feather icon-trash mr-2"></i>  {{__('Delete')}}</a>
                              @endcan
                            </div>
                        </div>
                        <div id="deleteModal{{$item->id}}" class="delete-modal modal fade card-dropdown-modal" role="dialog">
                          <div class="modal-dialog modal-sm">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal">×</button>
                                      <div class="delete-icon"></div>
                                  </div>
                                  <div class="modal-body text-center">
                                      <h4 class="modal-heading">Are You Sure ?</h4>
                                      <p>Do you really want to delete these records? This process cannot be undone.</p>
                                  </div>
                                  <div class="modal-footer">
                                    <form method="POST" action="{{route("tvseries.destroy", $item->id)}}">
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
                          <h5 class="card-title">{{$item->title}}</h5>
                        </div>
                        <div class="card-body">
                          <div class="card-block">
                            <h6 class="card-body-sub-heading">{{__('Genre')}}</h6>
                            @php
                              $genres = collect();
                                if (isset($item->genre_id)){
                                  $genre_list = explode(',', $item->genre_id);
                                  for ($i = 0; $i < count($genre_list); $i++) {
                                    try {
                                      $genre = App\Genre::find($genre_list[$i])->name;
                                      $genres->push($genre);
                                    } catch (Exception $e) {

                                    }
                                  }
                                }
                              @endphp
                          <p>
                            @if (count($genres) > 0)
                              @for($i = 0; $i < count($genres); $i++)
                                @if($i == count($genres)-1)
                                  {{$genres[$i]}}
                                @else
                                  {{$genres[$i]}},
                                @endif
                                @endfor
                            @endif
                          </p>
                        </div>
                            <div class="card-block card-block-ratings">
                                <h6 class="card-body-sub-heading">{{__('Ratings')}}</h6>
                                @php
                                $rating = ($item->rating)/2;
                                @endphp
                                <!-- <div class="stars stars-example-css">
                                    <div class="br-wrapper br-theme-css-stars">
                                        <select id="rating-css"  name="rating" autocomplete="off" style="display: none;">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                </div> -->
                                <div class="stars stars-example-css">
                                      @for($rating = 1; $rating <= 5; $rating++) @if($rating<=$item->rating/2)
                                          <i class='fa fa-star' style='color:#506fe4'></i>
                                          @else
                                          <i class='fa fa-star' style='color:#ccc'></i>
                                          @endif
                                      @endfor
                                  </div>
                                <p>{{$item->rating}}/10</p>
                            </div>
                            
                            <div class="card-block row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <h6 class="card-body-sub-heading">{{__('Created By')}}</h6>
                                    @php 
                                    $username = App\User::find($item->created_by);
                                    @endphp
                                    <p>{{isset($username) && $username != NULL ? $username->name :'user deleted'}}</p>
                                </div>
                                <div class="col-xs-6 col-md-6 col-md-6">
                                    <h6 class="card-body-sub-heading">{{__('Status')}}</h6>
                                    <p class="status-btn">
                                      @auth
                                      @if(Auth::user()->is_assistant == 1)
                                      @if($item->status == 1)
                                            <a href="javascript:void();" class='badge badge-pill badge-success'>{{__('Active')}}</a>
                                        @else
                                            <a href="javascript:void();" class='badge badge-pill badge-danger'>{{__('De Active')}}</a>
                                      @endif
                                      @else
                                      @if($item->status == 1)
                                            <a href="{{route('quick.movie.status', $item->id) }}" class='badge badge-pill badge-success'>{{__('Active')}}</a>
                                        @else
                                            <a href="{{route('quick.movie.status', $item->id) }}" class='badge badge-pill badge-danger'>{{__('De Active')}}</a>
                                      @endif
                                      @endif
                                      @endauth
                                    </p>
                                </div>
                            </div>              
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="col-md-12 pagination-block text-center">
                  {!! $tv_serieses->appends(request()->query())->links() !!}
                </div>
              @else
                <div class="col-md-12 text-center">
                  <h5>{{__("Let's start :)")}}</h5>
                  <small>{{__('Get Started by creating a tvseries! All of your tvseries will be displayed on this page.')}}</small>
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
   
<script src="{{ url('assets/js/custom/custom-barrating.js') }}"></script>
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
    var table = $('#tvTable').DataTable({
        processing: true,
        serverSide: true,
       responsive: true,
       autoWidth: false,
       scrollCollapse: true,
     
       
        ajax: "{{ route('tvseries.index') }}",
        columns: [
            
            {data: 'checkbox', name: 'checkbox',orderable: false, searchable: false},
            {data: 'thumbnail', name: 'thumbnail'},
            {data: 'title', name: 'title'},
            {data: 'rating', name: 'rating',searchable: false},
            {data: 'tmdb', name: 'tmdb',searchable: false},
            {data: 'featured', name: 'featured',searchable: false},
            {data: 'status', name: 'status',searchable: false},
            {data: 'addedby', name: 'addedby',searchable: false},
            {data: 'action', name: 'action',searchable: false}
           
        ],
        dom : 'lBfrtip',
        buttons : [
          'csv','excel','pdf','print'
        ],
        order : [[0,'desc']]
    });
    
  });
</script>
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
@endsection