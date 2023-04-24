@extends('layouts.master')
@section('title',__('All Audio Languages'))
@section('breadcum')
	<div class="breadcrumbbar">
    <h4 class="page-title">{{ __('All Audio Languages') }}</h4>
    <div class="breadcrumb-list">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('/admin')}}" title="{{ __('Dashboard') }}">{{ __('Dashboard') }}</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ __('All Audio Languages') }}</li>
        </ol>
    </div>  
  </div>
@endsection
@section('maincontent')
<div class="contentbar"> 
  <div class="row">
    <div class="col-md-12">
      <div class="card-header movie-create-heading mb-4 pb-4">
        <div class="row">
          <div class="col-lg-4 col-md-4 col-12">
            <form class="navbar-form" role="search">
            <div class="input-group ">
                <form method="get" action="">
                <input value="{{ app('request')->input('name') ?? '' }}" type="text" name="search" class="form-control float-left text-center" placeholder="{{__('Search Audio Language')}}">
                <button type="submit" class="search-button"><i class="fa fa-search"></i></button>
                </form>
            </div>
            </form>
          </div>
          <div class="col-lg-8 col-md-8 col-12">
                
            @can('audiolanguage.delete')
              <button type="button" class="float-right btn btn-danger-rgba mr-2 " data-toggle="modal"
              data-target="#bulk_delete"><i class="feather icon-trash mr-2"></i> {{ __('Delete Selected') }} </button>
            @endcan
            @can('audiolanguage.create')
            <a href="{{route('audio_language.create')}}" class="float-right btn btn-primary-rgba mr-2" title="{{ __('Create Audio Language') }}"><i
                class="feather icon-plus mr-2"></i>{{ __('Create Audio Language') }} </a>
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
                            {!! Form::open(['method' => 'POST', 'action' => 'AudioLanguageController@bulk_delete', 'id' => 'bulk_delete_form']) !!}
                                @method('POST')
                                <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">{{__('No')}}</button>
                                <button type="submit" class="btn btn-danger">{{__('Yes')}}</button>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
            {{-- Bulk Delete Model End --}}
          </div>
        </div>
      </div>
            
        <div class="row">
            <!-- Start col -->
        @if($audio_languages != NULL && count($audio_languages) > 0)
          @foreach($audio_languages as $item)
          @php
            if($item->image != NULL){
              $content = @file_get_contents(public_path() .'/images/audiolanguage/' . $item->image); 
              if($content){
                $image = public_path() .'/images/audiolanguage/' . $item->image;
              }else{
                $image = Avatar::create($item->name)->toBase64();
              }
            }else{
              $image = Avatar::create($item->name)->toBase64();
            }

            $imageData = base64_encode(@file_get_contents($image));
            if($imageData){
                $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
            } 
          @endphp
            <div class="col-md-6 col-lg-6 col-xl-2">
                <div class="card m-b-30 audio-lang-page">
                    @if($src != NULL)
                        <img class="card-img-top" src="{{$src}}" alt="{{$item->language}}">
                    @endif
                    <div class="card-img-overlay">
                        <h5 class="card-title text-white font-18 text-center">{{$item->language}}</h5>                 
                    </div>     
                    <div class="card-body">
                        <div class="row mt-1 mb-1 justify-content-center">
                        @can('genre.edit')
                        <div class="col-2 mr-2">
                            <a href="{{route('audio_language.edit', $item->id)}}">
                            <i title="Edit" class="feather icon-edit mr-5"></i></a>
                            </div>
                        @endcan
                        @can('genre.delete')
                        <div class="col-2">
                            <a href="" data-toggle="modal" data-target="#delete{{$item->id }}">
                              <i title="Delete" class="text-primary feather icon-trash"></i></a>
          
                            <div class="modal fade bd-example-modal-sm" id="delete{{$item->id }}" tabindex="-1" role="dialog"
                              aria-hidden="true">
                              <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleSmallModalLabel">{{ __('Delete') }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <h4>{{ __('Are You Sure ?')}}</h4>
                                    <p>{{ __('Do you really want to delete')}} ? {{ __('This process cannot be undone.')}}</p>
                                  </div>
                                  <div class="modal-footer">
                                    <form method="post" action="{{route("audio_language.destroy", $item->id)}}" class="pull-right">
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
          {!! $audio_languages->appends(request()->query())->links() !!}
         </div> 
        </div>
    </div></div>
</div>
</div>
</div>
@endsection 
@section('script')
   

@endsection