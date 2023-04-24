@extends('layouts.master')
@section('title',__('Google Advertise'))
@section('stylesheet')
<style>
  .fl::first-letter {text-transform:uppercase}
</style>
@endsection
@section('breadcum')
	<div class="breadcrumbbar">
                <h4 class="page-title">{{ __('Google Advertise') }}</h4>
                <div class="breadcrumb-list">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{url('/admin')}}">{{ __('Dashboard') }}</a></li>
                      <li class="breadcrumb-item active" aria-current="page">{{ __('Google Advertise') }}</li>
                    </ol>
                </div>
    </div>
@endsection
@section('maincontent')
<div class="contentbar">
<div class="row">
  
  <div class="col-lg-12">
      <div class="card m-b-30">
          <div class="card-header"><button type="button" class="float-right btn btn-danger-rgba mr-2 " data-toggle="modal"
            data-target="#bulk_delete"><i class="feather icon-trash mr-2"></i> {{ __('Delete Selected') }} </button>
              <a href="{{ route('google.ads.create') }}" class="float-right btn btn-primary-rgba mr-2"><i
                  class="feather icon-plus mr-2"></i>{{ __('Create AD') }}</a>
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
                        {!! Form::open(['method' => 'POST', 'action' => 'GoogleAdsController@bulk_delete', 'id' => 'bulk_delete_form']) !!}
                              @method('POST')
                              <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">{{__('No')}}</button>
                              <button type="submit" class="btn btn-danger">{{__('Yes')}}</button>
                          {!! Form::close() !!}
                      </div>
                  </div>
              </div>
                <h5 class="card-title"> {{__("Create AD")}}</h5>
          </div>
          
          <div class="card-body">
           
              <div class="table-responsive">
                <table id="roletable" class="table table-borderd responsive " style="width: 100%">

                    <thead>
                      <th>
                        <div class="inline">
                          <input id="checkboxAll" type="checkbox" class="filled-in" name="checked[]" value="all" id="checkboxAll">
                          <label for="checkboxAll" class="material-checkbox">#</label>
                        </div>
                      </th>
                      <th>{{__('Google Ad Client')}}</th>
                      <th>{{__('Google Ad Slot')}}</th>
                      <th>{{__('Edit')}}</th>
                      <th>{{__('Actions')}}</th>
                    </thead>
                
                    <tbody>
                      <tr>
                        @php $i=0; @endphp
                        @foreach($googleads as $ad)
                        @php $i++ @endphp
        
                        <td>
                          <div class="inline">
                            <input type="checkbox" form="bulk_delete_form" class="filled-in material-checkbox-input" name="checked[]" value="{{$ad->id}}" id="checkbox{{$ad->id}}">
                            <label for="checkbox{{$ad->id}}" class="material-checkbox"></label>
                          </div>
                        </td>
        
                         <td>{{ $i }}</td>
                         <td class="fl">{{ $ad->google_ad_client }}</td>
                         <td class="fl">{{ $ad->google_ad_slot }}</td>
                         <td><a href="{{ route('google.ads.edit',$ad->id) }}" data-toggle="tooltip" data-original-title="{{__('Edit')}}" class="btn btn-round btn-outline-primary"> <i class="fa fa-edit"></i></a></td>
                         <td>
                             <form action="{{ route('google.ads.delete',$ad->id) }}" method="POST">
                                {{ csrf_field() }} 
                                {{ method_field('DELETE')}}
                                <button type="submit" value="{{__('Delete')}}" onclick="return confirm('Are you sure?')" class="btn btn-round btn-outline-danger" ><i class="fa fa-trash"></i> </button>
                                
                             </form>
                         </td>
                         </tr>
                        @endforeach
             
                </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
@endsection 
@section('script')
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