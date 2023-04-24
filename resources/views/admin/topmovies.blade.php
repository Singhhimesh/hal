@extends('layouts.master')
@section('title',__('Top 10 Movies'))
@section('breadcum')
	  <div class="breadcrumbbar">
      <h4 class="page-title">{{ __('Top 10 Movies') }}</h4>
      <div class="breadcrumb-list">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/admin')}}" title="{{ __('Dashboard') }}">{{ __('Dashboard') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('Top 10 Movies') }}</li>
          </ol>
      </div>
    </div>
@endsection
@section('maincontent')
<div class="contentbar"> 
  <div class="row">
    <div class="col-md-12">
      <div class="card-header movie-create-heading">
        <div class="row">
          <div class="col-lg-4 col-4">
            <h5 class="card-title">{{ __('Top 10 Movie') }}</h5>
          </div>
          <div class="col-lg-8 col-8">
           
           
          </div>
        </div>
                        
      </div> 
      <div class="card-body">
        <section id="movies" class="movies-main-block">
          <div class="row">
            @if(isset($movieslw) && count($movieslw) > 0)
            @foreach($movieslw as $item)
            @php
              if($item->thumbnail != NULL){
                $content = @file_get_contents(public_path() .'/images/movies/thumbnails/' . $item->thumbnail); 
                if($content){
                  $image = public_path() .'/images/movies/thumbnails/' . $item->thumbnail;
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
              <input class="form-check-card-input visibility-visible" form="bulk_delete_form" type="checkbox" value="{{$item->id}}" id="checkbox{{$item->id}}" name="checked[]">         
              <div class="card">
                @if($src != NULL)
                  <img src="{{$src}}" class="card-img-top" alt="...">
                @endif
                <div class="overlay-bg"></div>
                <div class="dropdown card-dropdown">
                  <a class="btn btn-round btn-outline-primary pull-right dropdown-toggle" type="button" id="dropdownMenuButton-{{$item->id}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-more-vertical-"></i></a>
                  <div class="dropdown-menu pull-right" aria-labelledby="dropdownMenuButton-{{$item->id}}">
                    @can('movies.view')
                      <a class="dropdown-item" href="{{url('movie/detail', $item->slug)}}" target="__blank"><i class="feather icon-monitor mr-2"></i> Page Preview</a>        
                    @endcan
                    @can('movies.edit')                                
                      <a class="dropdown-item" href="{{route('movies.edit', $item->id)}}"><i class="feather icon-edit mr-2"></i> Edit</a>     
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
                        <form method="POST" action="{{route("movies.destroy", $item->id)}}">
                          @method('DELETE')
                          @csrf
                          <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">{{__('No')}}</button>
                          <button type="submit" class="btn btn-danger">{{__('Yes')}}</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-body card-header">
                  <h5 class="card-title">{{$item->title}}</h5><br>
                </div>
                <div class="card-body">
                  <div class="card-block row">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                      <h6 class="card-body-sub-heading">{{__('Year')}}</h6>
                      <p>{{isset($item->publish_year) && $item->publish_year ? $item->publish_year : '-' }}</p>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6">
                      <h6 class="card-body-sub-heading">{{__('Length')}}</h6>
                      <p>{{isset($item->publish_year) && $item->publish_year ? $item->publish_year : '-' }}</p>
                    </div>                        
                  </div>
                  <div class="card-block card-block-ratings">
                    <h6 class="card-body-sub-heading">{{__('Ratings')}}</h6>
                    @php
                    $rating = ($item->rating)/2;
                    @endphp
                    
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
                  <div class="card-block row">
                    <div class="col-xs-6 col-sm-6 col-md-6 movie-create-heading">
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
           
            @else   
            <div class="col-md-12 text-center">
              <h5>{{__("Let's start :)")}}</h5>
              <small>{{__('Get Started by creating a movie! All of your movies will be displayed on this page.')}}</small>
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

@endsection