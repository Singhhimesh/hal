@extends('layouts.master')
@section('title','Edit role '.$role->name)
@section('breadcum')
	<div class="breadcrumbbar">
                <h4 class="page-title">{{ __('EDIT ROLE') }}</h4>
                <div class="breadcrumb-list">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{url('/admin')}}">{{ __('Dashboard') }}</a></li>
                      <li class="breadcrumb-item active" aria-current="page">{{ __('Edit Role') }}</li>
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
                    <a href="{{ route('roles.index') }}" class="float-right btn btn-primary-rgba mr-2"><i
                        class="feather icon-arrow-left mr-2"></i>{{ __('Back') }}</a>
                    <h5 class="card-title"> {{__("Edit role")}}</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('roles.update',$role->id) }}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name"  class="text-dark">{{__("Role name")}} <span class="text-red">*</span></label>
                            <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="{{ __('Enter role name') }}" value="{{ $role->name }}" required autofocus>
                    
                            <input type="hidden" name="guard" value="web">
                    
                            @error('name')
                                <span class="text-red" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    
                        <div class="form-group table-responsive">
                            
                    
                            <p class="text-dark"> <b>{{ __('Assign Permissions to role') }}</b> </p>
                        
                            <table class="permissionTable table table-bordered">
                                <th>
                                    {{__("Section")}}
                                </th>
                    
                                <th>
                                    <label>
                                        <input class="grand_selectall" type="checkbox">
                                        {{__('Select All') }}
                                    </label>
                                </th>
                    
                                <th>
                                    {{__("Available permissions")}}
                                </th>
                    
                            
                                <tbody>
                                    @foreach($custom_permission as $key => $group)
                                    <tr>
                                        <td>
                                            <b>{{ ucfirst($key) }}</b>
                                        </td>
                                        <td width="30%">
                                            <label>
                                                <input class="selectall" type="checkbox">
                                                {{__('Select All') }}
                                            </label>
                                        </td>
                                        <td>
                                            
                                            @forelse($group as $permission)
                    
                                                <label>
                                                    <input {{ $role->permissions->contains('id',$permission->id) ? "checked" : "" }} name="permissions[]" class="permissioncheckbox" type="checkbox" value="{{ $permission->id }}">
                                                    {{$permission->name}} &nbsp;&nbsp;
                                                </label>
                    
                                            @empty
                                                {{ __("No permission in this group !") }}
                                            @endforelse
                    
                                        </td>
                    
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                    
                        </div>
                    
                        <div class="form-group">
                            <button type="reset" class="btn btn-danger mr-1"><i class="fa fa-ban"></i> {{ __("Reset")}}</button>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-check-circle"></i>
                            {{ __("Update")}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 
@section('script')
<script src="{{ url('/js/checkbox.js') }}"></script>
    
@endsection