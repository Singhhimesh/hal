@extends('layouts.master')
@section('title','Manual Payment Gateway')
@section('breadcum')
	<div class="breadcrumbbar">
        <h4 class="page-title">{{ __('Manual Payment Gateway') }}</h4>
        <div class="breadcrumb-list">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{url('/admin')}}" title="{{ __('Dashboard') }}">{{ __('Dashboard') }}</a></li>
              <li class="breadcrumb-item active" aria-current="page">{{ __('Manual Payment Gateway') }}</li>
            </ol>
        </div>   
    </div>
    
@endsection
@section('maincontent')
<div class="contentbar"> 
    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    <button type="button" class="float-right btn btn-success-rgba mr-2 " data-toggle="modal"
                    data-target=".bd-example-modal-lg" title="{{ __('Add New') }}"><i class="feather icon-plus mr-2"></i> {{ __('Add New') }} </button>
            
            {{--New Manual Payment Gateway Model Start --}}
                <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-md">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleLargeModalLabel">{{__("Add New Manual Payment Gateway")}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" title="{{ __('Close') }}">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                                
                            <div class="modal-body">
                                <form action="{{ route('manual.payment.gateway.store') }}" method="POST" enctype="multipart/form-data">

                                    @csrf
        
                                    <div class="form-group">
                                        <label for="">
                                            {{__('Payment Method Name')}}: <span class="text-danger">*</span>
                                        </label>
                                        <input required type="text" value="{{ old('payment_name') }}" name="payment_name"
                                            class="form-control" placeholder="{{__('Please Enter Payment Method Name')}}" />
                                    </div>
        
                                    <div class="form-group">
                                        <label for="">
                                           {{__(' Payment Instructions')}} : <span class="text-danger">*</span>
                                        </label>
        
                                        <textarea name="description" id="" cols="30" rows="5"
                                            class="form-control editor" placeholder="{{__('Please Enter Payment Instructions')}}" >{!! old('description') !!}</textarea>
        
                                    </div>
        
                                    <div class="form-group">
                                        <label for="">
                                            {{__('Image')}} :
                                        </label>
                                        <input type="file" class="form-control" name="thumbnail">
                                    </div>
        
                                    <div class="form-group">
                                        <label class="col-md-5 bootstrap-switch-label">{{__('Status')}} :</label>
                                        <label class="make-switch col-md-7 pad-0">
                                            <input class="custom_toggle" id="status" type="checkbox" name="status" {{ old('status') ? "checked" : "" }}>
                                            
                                        </label>
                                    </div>
        
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary" title="{{ __('Update') }}">
                                            <i class="fa fa-save"></i> {{__('Create')}}
                                        </button>
                                    </div>
        
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            {{--New Manual Payment Gateway Model End --}}

                    <h5 class="card-title">{{ __('Manual Payment Gateway') }}</h5>
                    
                </div> 

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="modules" class="table table-bordered">
                            <thead>
                                <th>#</th>
                                <th>{{__('Payment Gateway Name')}}</th>
                                <th>{{__('Actions')}}</th>
                            </thead>
                    
                            <tbody>
                                @foreach($methods as $key=> $m)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{  ucfirst($m->payment_name) }}</td>
                                        <td>
                                        @can('manual-payment.edit')
                                            <button type="button" data-toggle="modal" data-target="bd-example-modal-lg{{ $m->id }}" class="btn btn-round btn-outline-primary" title="{{__('Edit')}}">
                                                <i class="fa fa-pencil-square-o"></i>
                                            </button>
                                        @endcan
                                        @can('manual-payment.delete')
                                            <button type="button" data-toggle="modal" data-target="#delete{{ $m->id }}" class="btn btn-round btn-outline-danger" title="{{__('Delete')}}">
                                            <i class="fa fa-trash"></i>
                                          </button>
                                        @endcan
                                            
                                        </td>
                                    </tr>

                                    {{--New Manual Payment Gateway Model Start --}}
                                        <div class="modal fade bd-example-modal-lg{{ $m->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-md">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleLargeModalLabel">{{__("Add New Manual Payment Gateway")}}</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" title="{{__('Close')}}">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                        
                                                    <div class="modal-body">
                                                        <form action="{{ route('manual.payment.gateway.update',$m->id) }}" method="POST" enctype="multipart/form-data">

                                                            @csrf
                        
                                                            <div class="form-group">
                                                                <label for="">
                                                                    {{__('Payment Method Name')}}: <span class="text-red">*</span>
                                                                </label>
                                                                <input required type="text" value="{{ $m['payment_name'] }}" name="payment_name" class="form-control"  placeholder="{{__('Please Enter Payment Method Name')}}"/>
                                                            </div>
                        
                                                            <div class="form-group">
                                                                <label for="">
                                                                    {{__('Payment Instructions')}} : <span class="text-red">*</span>
                                                                </label>
                        
                                                                <textarea name="description" id="" cols="30" rows="5" class="form-control editor" placeholder="{{__('Please Enter Payment Instructions')}}">{!! $m['description'] !!}</textarea>
                        
                                                            </div>
                        
                                                            <div class="form-group">
                                                                <label for="">
                                                                    {{__('Image')}} :
                                                                </label>
                                                                <input type="file" class="form-control" name="thumbnail">
                                                            </div>
                        
                                                           
                                                                <div class="bootstrap-checkbox form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                                                                  <div class="row">
                                                                    <div class="col-md-7">
                                                                      <h5 class="bootstrap-switch-label">{{__('Status')}}</h5>
                                                                    </div>
                                                                    <div class="col-md-5 pad-0">
                                                                      <div class="make-switch">
                                                                        {!! Form::checkbox('status', 1, ($m->status == 1 ? 1 : 0), ['class' => 'bootswitch', "data-on-text"=>__('On'), "data-off-text"=>__('OFF'), "data-size"=>"small"]) !!}
                                                                        
                                                                      </div>
                                                                    </div>
                                                                  </div>
                                                                
                                                                </div>
                                                           
                                                            <div class="form-group">
                                                                <button type="submit" class="btn btn-outline-primary" title="{{__('Update')}}">
                                                                    <i class="fa fa-save"></i> Instructions
                                                                </button>
                                                            </div>
                        
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    {{--New Manual Payment Gateway Model End --}}


                                {{--Delete Model Start --}}
                                    <div id="delete{{ $m->id }}" class="delete-modal modal fade" role="dialog">
                                        <div class="modal-dialog modal-sm">
                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="{{__('Close')}}"
                                                        data-dismiss="modal" title="">&times;</button>
                                                    <div class="delete-icon"></div>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <h4 class="modal-heading">{{__('Are You Sure ?')}}</h4>
                                                    <p>{{__('Do you really want to delete selected item names here? This
                                                        process
                                                        cannot be undone.')}}</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <form method="post" action="{{ route('manual.payment.gateway.delete',$m->id) }}">
                                                    @csrf
                                                    <input type="hidden" name="modulename" value="{{ $name }}">
                                                    <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">{{__('No')}}</button>
                                                        <button type="submit" class="btn btn-danger">{{__('Yes')}}</button>
                                                  </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                {{--Delete Model End --}}
                                @endforeach
                            </tbody>
                        </table>           
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 
@section('script')

@endsection