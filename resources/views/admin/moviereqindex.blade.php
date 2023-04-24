@extends('layouts.master')
@section('title',__('All Movies Request'))
@section('breadcum')
	<div class="breadcrumbbar">
      <h4 class="page-title">{{ __('All Movies Request') }}</h4>
      <div class="breadcrumb-list">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/admin')}}" title="{{ __('Dashboard') }}">{{ __('Dashboard') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('All Movies Request') }}</li>
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
                <h5 class="card-title"> {{__("All Movies Request")}}</h5>
          </div>          
          <div class="card-body">           
              <div class="table-responsive">
                <table id="roletable" class="table table-borderd responsive" style="width: 100%">
                    <thead>
                      <th>#</th>
                      <th>{{__('Name')}}</th>
                      <th>{{__('Email')}}</th>
                      <th>{{__('Movie / TV Series Name')}}</th>
                      <th>{{__('Reply')}}</th>
                    </thead>
                
                    <tbody>
              @if ($req)
                <tbody>
                  @foreach ($req as $key => $r)
                    <tr>
                      <td>
                        {{$key+1}}
                      </td>
                      <td>{{$r->name}}</td>
                      <td>{{$r->email}}</td>
                      <td>{{$r->mr_name}}</td>
                      <td><button data-toggle="modal" data-target="#replyModal{{$r->id}}" class="btn btn-round btn-outline-danger"><i class="fa fa-reply"></i></button></td>
                    </tr>
                     <!-- Delete Modal -->
                    <div id="replyModal{{$r->id }}" class="delete-modal modal fade" role="dialog">
                      <div class="modal-dialog modal-sm">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" title="{{__('Close')}}">&times;</button>
                            <div class="delete-icon"></div>
                          </div>
                          <div class="modal-body text-center">
                            <h6 class="modal-heading">{{__('Reply to ')}}{{$r->name}} , {{$r->email}}</h6>
                            <textarea  name="w3review" rows="4" cols="30">
                          </textarea>
                        </div>
                          <div class="modal-footer">                    
                              <button type="submit" class="btn btn-danger" title="{{__('Reply')}}">{{__('Reply')}}</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  @endforeach
                </tbody>
              @endif
                </table>
                <div class="col-md-12 pagination-block text-center">
                    {!! $req->appends(request()->query())->links() !!}
                  </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection 
@section('script')
@endsection