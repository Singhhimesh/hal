@extends('layouts.master')
@section('title',__('All Multiple Links'))
@section('breadcum')
	<div class="breadcrumbbar">
                <h4 class="page-title">{{ __('Multiple Links') }}</h4>
                <div class="breadcrumb-list">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{url('/admin')}}" title="{{ __('Dashboard') }}">{{ __('Dashboard') }}</a></li>
                      <li class="breadcrumb-item active" aria-current="page">{{ __('Multiple Links') }}</li>
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
           <a href="{{url('admin/movies')}}" class="float-right btn btn-primary-rgba mr-2" title="{{ __('Back') }}"><i
            class="feather icon-arrow-left mr-2"></i>{{ __('Back') }}</a>
            <button type="button" class="float-right btn btn-success-rgba mr-2 " data-toggle="modal"
            data-target=".bd-example-modal-lg" title="{{ __('Create Multiple Links') }}"><i class="feather icon-plus mr-2"></i> {{ __('Create Multiple Links') }} </button>
              {{-- Impport Model Start --}}
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleLargeModalLabel">{{__("Add Multiple Links")}}</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close" title="{{ __('Close') }}">
              <span aria-hidden="true">&times;</span>
              </button>
          </div>
              
              
          <div class="modal-body">
                {!! Form::open(['method' => 'POST', 'action' => ['MovieController@storelink',$id]]) !!}
                  <div class="box-body table-responsive">
                    <div class="form-group text-dark{{ $errors->has('download') ? ' has-error' : '' }} switch-main-block">
                      <div class="row">
                        <div class="col-md-4">
                          {!! Form::label('download', __('Do Yo Want To Download Link?')) !!}
                        </div>
                        <div class="col-md-2 pad-0">
                          <label class="switch">                
                            {!! Form::checkbox('download', 1, 1, ['class' => 'custom_toggle']) !!}
                            <span class="slider round"></span>
                          </label>
                        </div>
                      </div>
                      <div class="col-xs-12">
                        <small class="text-danger">{{ $errors->first('download') }}</small>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group text-dark{{ $errors->has('quality') ? ' has-error' : '' }}">
                              {!! Form::label('quality', __('Quality')) !!}
                              {!! Form::text('quality', null, ['class' => 'form-control', 'autofocus', 'autocomplete'=>'off','required', 'placeholder'=> __('Enter Quality')]) !!}
                              <small class="text-danger">{{ $errors->first('quality') }}</small>
                        </div>
                      </div>
                      <div class="col-md-4">
                         <div class="form-group text-dark{{ $errors->has('size') ? ' has-error' : '' }}">
                              {!! Form::label('size', __('Size')) !!}
                              {!! Form::text('size', null, ['class' => 'form-control', 'autofocus', 'autocomplete'=>'off','required', 'placeholder'=> __('Enter Size of Link')]) !!}
                              <small class="text-danger">{{ $errors->first('size') }}</small>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group text-dark{{ $errors->has('language') ? ' has-error' : '' }}">
                            {!! Form::label('language', __('Languages')) !!}
                            <div class="input-group cd-md-12" style="width:100%">
                              
                              <select name="language[]" id="" class="select2" multiple="multiple">
                                @foreach($language as $lang)
                                    <option value="{{ $lang->id }}">{{ $lang->language }}</option>
                                @endforeach
                              </select>                             
                            </div>
                            <small class="text-danger">{{ $errors->first('language') }}</small>
                          </div>
                        </div>
                      <div class="col-md-8">
                        <div class="form-group text-dark{{ $errors->has('url') ? ' has-error' : '' }}">
                              {!! Form::label('url', __('URL and Link')) !!}
                              {!! Form::url('url', null, ['class' => 'form-control', 'autofocus', 'autocomplete'=>'off','required', 'placeholder'=> __('Please Enter Your Downlod Link')]) !!}
                              <small class="text-danger">{{ $errors->first('url') }}</small>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="reset" class="btn btn-danger-rgba" data-dismiss="modal" title="{{__('Reset')}}">{{__('Reset')}}</button>
                    <button type="submit" class="btn btn-primary-rgba" title="{{__('Create')}}">{{__('Create')}}</button>
                 </div>
            {!! Form::close() !!}
                </div>
      </div>
  </div>
</div>
{{-- Import Model End --}}
                <h5 class="card-title"> {{__("Multiple Links")}}</h5>
              
              
          </div>
          
          <div class="card-body">
           
              <div class="table-responsive">
                <table id="roletable" class="table table-borderd responsive " style="width: 100%">

                    <thead>
                      <th>
                        <div class="inline">
                          <input id="checkboxAll" type="checkbox" class="filled-in" name="checked[]" value="all" id="checkboxAll">
                          <label for="checkboxAll" class="material-checkbox"></label>
                        </div>
                      </th>
                      <th>{{__('Movie')}}</th>
                      <th>{{__('URL and Links')}}</th>
                      <th>{{__('Quality')}}</th>
                      <th>{{__('Size')}}</th>
                      <th>{{__('Language')}}</th>
                      <th>{{__('Visits')}}</th>
                      <th>{{__('Downlodable')}}</th>
                      <th>{{__('User')}}</th>
                      <th>{{__('Actions')}}</th>
            
                    </thead>
                
                    @if(isset($links))
          <tbody>
            @foreach($links as $key=> $link)
            @php
             
              $lang = App\AudioLanguage::where('id',$link->language)->first();
            @endphp
            <tr>
              <td>{{$key+1}}</td>
              <td>{{$link->movie['title']}}</td>
              <td>{{$link->url}}</td>
              <td>{{$link->quality}}</td>
              <td>{{$link->size}}</td>
              <td>@if(isset($lang)){{$lang->language}} @else - @endif</td>
              <td>{{$link->clicks}}</td>
              <td>{{ $link->download == 1 ? "YES" : "NO" }}</td>
              <td>{{$link->movie->user->name}}</td>
              <td>{{$link->created_at}}</td>
              <td>  
                <a data-original-title="Edit" class="btn btn-round btn-outline-primary" data-toggle="modal" data-target=".bd-example-modal-lg1"><i class="fa fa-pencil"></i></a>
                <button type="button" class="btn-danger btn-floating" data-toggle="modal" data-target="#deleteModal{{$link->id}}"><i class="material-icons">delete</i> </button>
              </td>

              <div id="deleteModal{{$link->id}}"  class="delete-modal modal fade" role="dialog">
                <div class="modal-dialog modal-sm">
                <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <div class="delete-icon"></div>
                    </div>
                    <div class="modal-body text-center">
                      <h4 class="modal-heading">{{__('Are You Sure')}}</h4>
                      <p>{{__('Delete Warrnig')}}</p>
                      </div> 
                      <div class="modal-footer">
                      <form method="POST" action={{route("movies.deletelink", $link->id) }}>
                        {{csrf_field()}}
                        {{ method_field('DELETE') }}
                      <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">{{__('No')}}</button>
                      <button type="submit" class="btn btn-danger">{{__('Yes')}}</button>
                      </form>
                      </div>
                    </div>
                  </div>
              </div>

            </tr>
            @endforeach
          </tbody>
        @endif
                </table>
            </div>
        </div>
    </div>
</div>
</div>
@foreach($links as $key=> $link)
{{-- Impport Model Start --}}
<div class="modal fade bd-example-modal-lg1" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleLargeModalLabel">{{__("Add Multiple Links")}}</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
          </div>
              
              
          <div class="modal-body">
            {!! Form::model($link,['method' => 'PATCH', 'action' => ['MovieController@editlink',$link->id]]) !!}
            <div class="form-group text-dark{{ $errors->has('download') ? ' has-error' : '' }} switch-main-block">
              <div class="row">
                <div class="col-md-4">
                  {!! Form::label('download', __('Do You Want To Download Link')) !!}
                </div>
                <div class="col-md-5 pad-0">
                  <label class="switch">                
                    {!! Form::checkbox('download', 0,1, ['class' => 'custom_toggle']) !!}
                    <span class="slider round"></span>
                  </label>
                </div>
              </div>
              <div class="col-xs-12">
                <small class="text-danger">{{ $errors->first('download') }}</small>
              </div>
            </div>
            <div class="form-group text-dark{{ $errors->has('quality') ? ' has-error' : '' }}">
                  {!! Form::label('quality',__('Quality')) !!}
                  {!! Form::text('quality',null, ['class' => 'form-control', 'autofocus', 'autocomplete'=>'off','required', 'placeholder'=> __('Enter Quality')]) !!}
                  <small class="text-danger">{{ $errors->first('quality') }}</small>
            </div>
             <div class="form-group text-dark{{ $errors->has('size') ? ' has-error' : '' }}">
                  {!! Form::label('size', __('Size')) !!}
                  {!! Form::text('size', null,['class' => 'form-control', 'autofocus', 'autocomplete'=>'off','required', 'placeholder'=> __('Enter Size Of Link ')]) !!}
                  <small class="text-danger">{{ $errors->first('size') }}</small>
            </div>
            <div class="form-group text-dark{{ $errors->has('language') ? ' has-error' : '' }}">
                {!! Form::label('language', __('Languages')) !!}
                <div class="input-group cd-md-12" style="width:100%">
                  
                  <select name="language[]" id="" class="select2" multiple="multiple">
                    @foreach($language as $lang)
                    
                        <option @if(!empty($link->language)) @foreach($link->language as $a) {{ $a == $lang->id ? "selected" : "" }} @endforeach @endif value="{{ $lang->id }}">{{ $lang->language }}</option>
                    @endforeach
                  </select>
                 
                </div>
                <small class="text-danger">{{ $errors->first('language') }}</small>
              </div>
            <div class="form-group text-dark{{ $errors->has('url') ? ' has-error' : '' }}">
                  {!! Form::label('url', __('UrlAndLinks')) !!}
                  {!! Form::url('url',null, ['class' => 'form-control', 'autofocus', 'autocomplete'=>'off','required']) !!}
                  <small class="text-danger">{{ $errors->first('url') }}</small>
            </div>
                  <div class="modal-footer">
                    <button type="reset" class="btn btn-danger-rgba" data-dismiss="modal">{{__('Reset')}}</button>
                    <button type="submit" class="btn btn-primary-rgba">{{__('Create')}}</button>
                 </div>
            {!! Form::close() !!}
                </div>
      </div>
  </div>
</div>
{{-- Import Model End --}}
@endforeach
@endsection 
@section('script')
    
@endsection