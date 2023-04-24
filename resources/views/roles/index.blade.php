@extends('layouts.master')
@section('title','Roles')
@section('breadcum')
	<div class="breadcrumbbar">
        <h4 class="page-title">{{ __('ROLES') }}</h4>
            <div class="breadcrumb-list">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/admin')}}">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('Roles') }}</li>
                </ol>
            </div>    
    </div>
@endsection
@section('maincontent')
<div class="contentbar">
<div class="row">
  
  <div class="col-md-12">
      <div class="card m-b-50">
          <div class="card-header">
                <a href="{{ route('roles.create') }}" class="float-right btn btn-primary-rgba mr-2"><i
                    class="feather icon-plus mr-2"></i>{{ __('Create a new role') }}</a>
              
             
                <h5 class="card-title"> {{__("Roles")}}</h5>
              
              
          </div>
          
          <div class="card-body">
           
              <div class="table-responsive">
                <table id="roletable" class="table table-borderd responsive " style="width: 100%">

                    <thead>
                        <th class="text-center">
                            #
                        </th>
                        <th class="text-center">
                            {{__("Role Name")}}
                        </th>
                        <th class="text-center">
                            {{__('Action')}}
                        </th>
                    </thead>
                
                    <tbody>
                      @foreach($roles as $key => $role)
                      <tr>
                      <td class="text-center">{{$key+1}}</td>
                      <td class="text-center">{{$role->name}}</td>
                      <td class="text-center">
                        @if(($role->id == 1) || ($role->id == 2) || ($role->id == 3))
                          <h6 style="color:#a94442;"><b>System reserved role</b></h6>
                      @else
                        <a class="btn btn-round btn-outline-primary" href="{{url('/admin/roles/'.$role->id.'/edit')}}"> <i class="fa fa-pencil"></i></a>
                        <button type="button" data-toggle="modal" data-target="#delete" class="btn btn-round btn-outline-danger">
                            <i class="fa fa-trash"></i>
                        </button>
                            <div id="delete" class="delete-modal modal fade" role="dialog">
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
                                          <form method="post" action="{{url('admin/roles/'.$role->id.'/delete')}}" class="pull-right">
                                            @csrf
                                            <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">{{__('No')}}</button>
                                                <button type="submit" class="btn btn-danger">{{__('Yes')}}</button>
                                          </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                      @endif
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
    
@endsection