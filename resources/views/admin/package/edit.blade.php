@extends('layouts.master')
@section('title',__('Edit Package'))
@section('breadcum')
	<div class="breadcrumbbar">
                <h4 class="page-title">{{ __('Edit Package') }}</h4>
                <div class="breadcrumb-list">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{url('/admin')}}" title="{{ __('Dashboard') }}">{{ __('Dashboard') }}</a></li>
                      <li class="breadcrumb-item active" aria-current="page">{{ __('Edit Package') }}</li>
                    </ol>
                </div>  
    </div>
@endsection
@section('maincontent')
<div class="contentbar">
  <div class="row">
    @if ($errors->any())  
  <div class="alert alert-danger" role="alert">
  @foreach($errors->all() as $error)     
  <p>{{ $error}}<button type="button" class="close" data-dismiss="alert" aria-label="Close" title="{{ __('Close') }}">
  <span aria-hidden="true" style="color:red;">&times;</span></button></p>
      @endforeach  
  </div>
  @endif
    <div class="col-lg-6">
      <div class="card m-b-50">
        <div class="card-header">
          <a href="{{url('admin/packages')}}" class="float-right btn btn-primary-rgba mr-2" title="{{ __('Back') }}"><i
            class="feather icon-arrow-left mr-2"></i>{{ __('Back') }}</a>
          <h5 class="box-title">{{__('Edit Package')}}</h5>
        </div>
        <div class="card-body ml-2">
          {!! Form::model($package, ['method' => 'PATCH', 'action' => ['PackageController@update', $package->id]]) !!}
            <div class="row">
              <div class="col-md-12">
                <div class="form-group text-dark{{ $errors->has('plan_id') ? ' has-error' : '' }}">
                  {!! Form::label('plan_id',  __('PlanID')) !!}<span class="text-danger">*</span>
                  {!! Form::text('plan_id', null, ['class' => 'form-control', 'required' => 'required', 'data-toggle' => 'popover','data-content' => 'Create Your Unique Plan ID ex. basic10', 'data-placement' => 'bottom']) !!}
                  <small class="text-danger">{{ $errors->first('plan_id') }}</small>
              </div>
              <div class="form-group text-dark{{ $errors->has('name') ? ' has-error' : '' }}">
                  {!! Form::label('name', __('Plan Name')) !!}<span class="text-danger">*</span>
                  {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
                  <small class="text-danger">{{ $errors->first('name') }}</small>
              </div>
              {!! Form::hidden('currency', $currency_code) !!}
  
               <div class="form-group text-dark{{ $errors->has('free') ? ' has-error' : '' }}">
                <div class="row">
                  <div class="col-md-6">
                    {!! Form::label('free', __('Free')) !!}
                  </div>
                  <div class="col-md-5 pad-0">
                    <label class="switch">
                      {!! Form::checkbox('free', 1, $package->free, ['class' => 'custom_toggle seriescheck','id'=>'free']) !!}
                      <span class="slider round"></span>
                    </label>
                  </div>
                </div>
                <small class="text-danger">{{ $errors->first('free') }}</small>
              </div>
      
              <div class="form-group text-dark{{ $errors->has('amount') ? ' has-error' : '' }}"  style="{{$package->free == 1 ? 'display: none' : ''}}" id="planAmount">
                  {!! Form::label('amount', __('Your Plan Amount')) !!}<span class="text-danger">*</span>
                  <div class="input-group">
                    <span class="input-group-addon simple-input"><i class="{{$currency_symbol}}"></i></span>
                    {!! Form::number('amount', null, ['class' => 'form-control', 'step'=>'0.01']) !!}  
                  </div>
                  @if($package->currency_symbol=='')
                   <input type="text" name="currency_symbol" id="currency_symbol" value="{{$currency_symbol}}" hidden="true">
                   @else
                     <input type="text" name="currency_symbol" id="currency_symbol" value="{{$package->currency_symbol}}" hidden="true">
                   @endif
                  <small class="text-danger">{{ $errors->first('amount') }}</small>
              </div>
  
              <div class="form-group text-dark{{ $errors->has('feature') ? ' has-error' : '' }}">
                  {!! Form::label('feature', __('Package Feature')) !!}<span class="text-danger">*</span>
                   <select name="feature[]" class="select2 form-control" multiple>
                       @foreach($p_feature as $pf)
                        <option @isset($package['feature']) @foreach($package['feature'] as $opf) {{ $opf == $pf['id'] ? "selected" : "" }}  @endforeach @endisset value="{{$pf->id}}">{{$pf->name}} </option>
                      @endforeach
                      
                    </select>
                  <small class="text-danger">{{ $errors->first('feature') }}</small>
              </div>
               
              <div class="menu-block">
                <h6 class="menu-block-heading">{{__('Please Select Menu')}}</h6>

                @if (isset($menus) && count($menus) > 0)
                  <div class="row">
                    <div class="col-md-4">
                      {{__('All Menus')}}
                    </div>
                    <div class="col-md-5 pad-0">
                      <div class="inline">
                        <input type="checkbox" class=" filled-in material-checkbox-input all " name="menu[]" value="100" id="checkbox{{100}}" >
                        <label for="checkbox{{100}}" class="custom_toggle"></label>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    @foreach ($menus as $menu)
                    <div class="col-md-4">
                      {{$menu->name}}
                    </div>
                    <div class="col-md-5 pad-0">
                      <div class="inline">
                        <input @foreach($menu->getpackage as $pkg) {{ $pkg->menu_id == $menu->id && $package->id == $pkg->pkg_id? "checked" : "" }} @endforeach type="checkbox" class="filled-in material-checkbox-input one " name="menu[]" value="{{$menu->id}}" id="checkbox{{$menu->id}}" >
                        <label for="checkbox{{$menu->id}}" class="custom_toggle"></label>
                      </div>
                    </div>
                    @endforeach
                  </div>
                  @endif
              
              </div>
              <div class="form-group text-dark{{ $errors->has('screens') ? ' has-error' : '' }}">
                  {!! Form::label('screens', __('Screens')) !!}
                  {!! Form::number('screens', null, ['class' => 'form-control', 'min' => '1', 'max' => '4']) !!}
                  <small class="text-danger">{{ $errors->first('screens') }}</small>
              </div>
  
              <!-----------  for download limit ------------------>
  
              <div class="form-group text-dark{{ $errors->has('download') ? ' has-error' : '' }}">
                <div class="row">
                  <div class="col-md-6">
                    {!! Form::label('download', __('Do You Want Download Limit')) !!}
                  </div>
                  <div class="col-md-5 pad-0">
                    <label class="switch">
                      {!! Form::checkbox('download', 1, $package->download, ['class' => 'custom_toggle seriescheck','id'=>'download_enable']) !!}
                      <span class="slider round"></span>
                    </label>
                  </div>
                </div>
                <div class="col-xs-12">
                  <small class="text-danger">{{ $errors->first('download') }}</small>
                </div>
              </div>
              <small class="text-danger">{{ $errors->first('downloadlimit') }}</small>
              <div id="downloadlimit" class="form-group{{ $errors->has('downloadlimit') ? ' has-error' : '' }}" style="{{ $package->download != '' ? ""  : "display:none" }}">
                  {!! Form::label('downloadlimit', __('DownloadLimit')) !!}
                  {!! Form::number('download limit', null, ['class' => 'form-control']) !!}
                  <small class="text-danger">{{__('Note')}} :- <br/>
                    1. {{__('Given download limit will apply for each screens')}}.<br/>
                    2. {{__('If you enter 0 it means user can unlimited download')}}
                  </small>
                  
              </div>
  
              <!--------------- end download limit ------------------->
  
              @php
                  $webconfig = App\Button::first();
              @endphp
              @if($webconfig->remove_ads == 1)
                <div class="form-group text-dark{{ $errors->has('ads_in_web') ? ' has-error' : '' }}">
                  <div class="row">
                    <div class="col-md-6">
                      {!! Form::label('ads_in_web', __('Do you want Remove Ads in Web')) !!}
                    </div>
                    <div class="col-md-5 pad-0">
                      <label class="switch">
                        {!! Form::checkbox('ads_in_web', 1, $package->ads_in_web, ['class' => 'custom_toggle seriescheck','id'=>'download_enable']) !!}
                        <span class="slider round"></span>
                      </label>
                    </div>
                  </div>
                  <div class="col-xs-12">
                    <small class="text-danger">{{ $errors->first('ads_in_web') }}</small>
                  </div>
                </div>
              @endif
              @php
                  $appconfig = App\AppConfig::first();
              @endphp
              @if($appconfig->remove_ads == 1)
              <div class="form-group text-dark{{ $errors->has('ads_in_app') ? ' has-error' : '' }}">
                <div class="row">
                  <div class="col-md-6">
                    {!! Form::label('ads_in_app', __('Do you want Remove Ads in App')) !!}
                  </div>
                  <div class="col-md-5 pad-0">
                    <label class="switch">
                      {!! Form::checkbox('ads_in_app', 1, $package->ads_in_app, ['class' => 'custom_toggle seriescheck']) !!}
                      <span class="slider round"></span>
                    </label>
                  </div>
                </div>
                <div class="col-xs-12">
                  <small class="text-danger">{{ $errors->first('ads_in_app') }}</small>
                </div>
              </div>
              @endif
              
              <div class="form-group text-dark{{ $errors->has('status') ? ' has-error' : '' }}">
                  {!! Form::label('status',__('Status')) !!}<span class="text-danger">*</span>
                   <select name="status" class="select2 form-control">
                      <option value="active" {{$package->status == 'active' ? 'selected' :''}}>{{__('Active')}}</option>
                      <option value="upcoming" {{$package->status == 'upcoming' ? 'selected' :''}}>{{__('Upcoming')}}</option>
                      <option value="inactive" {{$package->status == 'inactive' ? 'selected' :''}}>{{__('In Active')}}</option>
                    </select>
                  <small class="text-danger">{{ $errors->first('status') }}</small>
              </div>


              </div>
              
              
                <div class="form-group">
                  <button type="submit" class="btn btn-primary-rgba" title="{{ __('Update') }}"><i class="fa fa-check-circle"></i>
                    {{ __('Update') }}</button>
                </div>
                {!! Form::close() !!}
                <div class="clear-both"></div>
            

      </div>
    </div>
  </div>
</div>
</div>
@endsection 
@section('script')
<script type="text/javascript">
  $(document).ready(function(){
    var check = [];
  
  $('.one').each(function(index){

    if($(this).is(':checked')){
      check.push(1);
    }else{
      check.push(0);
    }

  });
 console.log(check);
  var flag = 1;

  if (jQuery.inArray(0, check) == -1) {
          flag = 1;

      } else {
          flag = 0;
      }

   if(flag == 0){
    $('.all').prop('checked',false);
   }else{
     $('.all').prop('checked',true);
   }

});

  // if one checkbox is unchecked remove checked on all menu option

  $(".one").click(function(){
    if($(this).is(':checked'))
    {
     
      var checked = [];
     $('.one').each(function(){
      if($(this).is(':checked')){
        checked.push(1);
      }else{
        checked.push(0);
      }
     })
     
     var flag = 1;

  if (jQuery.inArray(0, checked) == -1) {
          flag = 1;

      } else {
          flag = 0;
      }

     if(flag == 0){
      $('.all').prop('checked',false);
     }else{
       $('.all').prop('checked',true);
     }
    }
    else{
      
      $('.all').prop('checked',false);
    }
  });

// when click all menu  option all checkbox are checked

  $(".all").click(function(){
    if($(this).is(':checked')){
      $('.one').prop('checked',true);
    }
    else{
      $('.one').prop('checked',false);
    }
  })

</script>
<script>
  $('#download_enable').on('change',function(){
    if($('#download_enable').is(':checked')){
      //show
      $('#downloadlimit').show();
    }else{
      //hide
       $('#downloadlimit').hide();
    }
  });
  $('#free').on('change',function(){
    if($('#free').is(':checked')){
      //show
      $('#planAmount').hide();
    }else{
      //hide
       $('#planAmount').show();
    }
  });
</script>
@endsection