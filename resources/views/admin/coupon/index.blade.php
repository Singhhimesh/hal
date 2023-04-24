@extends('layouts.master')
@section('title',__('All Coupons'))
@section('breadcum')
	<div class="breadcrumbbar">
    <h4 class="page-title">{{ __('All Coupons') }}</h4>
    <div class="breadcrumb-list">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('/admin')}}" title="{{ __('Dashboard') }}">{{ __('Dashboard') }}</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ __('All Coupons') }}</li>
        </ol>
    </div>  
  </div>
@endsection
@section('maincontent')
<div class="contentbar">
<div class="row">
  
  <div class="col-lg-12">
      <div class="card m-b-30">
          <div class="card-header">
            <button type="button" class="float-right btn btn-danger-rgba mr-2 " data-toggle="modal"
            data-target="#bulk_delete" title="{{ __('Delete Selected') }}"><i class="feather icon-trash mr-2"></i> {{ __('Delete Selected') }} </button>
              <a href="{{ route('coupons.create') }}" class="float-right btn btn-primary-rgba mr-2" title="{{ __('Create Coupon') }}"><i
                  class="feather icon-plus mr-2"></i>{{ __('Create Coupon') }}</a>
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
                                {!! Form::open(['method' => 'POST', 'action' => 'CouponController@bulk_delete', 'id' => 'bulk_delete_form']) !!}
                                    @method('POST')
                                    <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">{{__('No')}}</button>
                                    <button type="submit" class="btn btn-danger">{{__('Yes')}}</button>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
                <h5 class="card-title"> {{__("All Coupons")}}</h5>
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
                      <th>{{__('Coupon Code')}}</th>
                      <th>{{__('Percent Off')}}</th>
                      <th>{{__('Amount Off')}}</th>
                      <th>{{__('Duration')}}</th>
                      <th>{{__('Duration in Months')}}</th>
                      <th>{{__('Max Redemption')}}</th>
                      <th>{{__('Valid Upto')}}</th>
                      <th>{{__('Actions')}}</th>
                    </thead>
                
                    <tbody>
              @if ($coupons)
                <tbody>
                  @foreach ($coupons as $key => $coupon)
                    <tr>
                      <td>
                        <div class="inline">
                          <input type="checkbox" form="bulk_delete_form" class="filled-in material-checkbox-input" name="checked[]" value="{{$coupon->id}}" id="checkbox{{$coupon->id}}">
                          <label for="checkbox{{$coupon->id}}" class="material-checkbox">{{$key+1}}</label>
                        </div>
                      </td>
                      <td>{{$coupon->coupon_code}}</td>
                      <td>{{$coupon->percent_off ? $coupon->percent_off.'%' : '-'}}</td>
                      <td>
                        @if($coupon->amount_off)
                          <i class="{{$currency_symbol}} main-curr"></i>{{$coupon->amount_off}}
                        @endif
                      </td>
                      <td>{{$coupon->duration}}</td>
                      <td>{{$coupon->duration_in_months}}</td>
                      <td>{{$coupon->max_redemptions}}</td>
                      <td>{{date('F d, Y',strtotime($coupon->redeem_by))}}</td>
                      @can('coupon.delete')
                      <td>
                        @if($coupon->in_stripe != 1)
                        <div class="admin-table-action-block">
                          <a href="{{route('coupons.edit', $coupon->id)}}"  title="{{__('Edit')}}" data-toggle="" data-original-title="{{__('Edit')}}" class="btn btn-round btn-outline-primary"> <i class="fa fa-edit"></i></a>
                        </div>
                        @endif
                        <div class="admin-table-action-block">
                          <button type="button" class="btn btn-round btn-outline-danger" data-toggle="modal" data-target="#delete{{$coupon->id}}" title="{{__('Delete')}}"><i class="fa fa-trash"></i> </button>
                        </div>
                      </td>
                      @endcan
                    </tr>

                    <div id="delete{{$coupon->id}}" class="delete-modal modal fade" role="dialog">
                      <div class="modal-dialog modal-sm">
                          <!-- Modal content-->
                          <div class="modal-content">
                              <div class="modal-header">
                                  <button type="button" class="close"
                                      data-dismiss="modal" title="{{__('Close')}}">&times;</button>
                                  <div class="delete-icon"></div>
                              </div>
                              <div class="modal-body text-center">
                                  <h4 class="modal-heading">{{__('Are You Sure ?')}}</h4>
                                  <p>{{__('Do you really want to delete selected item names here? This
                                      process
                                      cannot be undone.')}}</p>
                              </div>
                              <div class="modal-footer">
                                {!! Form::open(['method' => 'DELETE', 'action' => ['CouponController@destroy', $coupon->id]]) !!}
                                      @method('DELETE')
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