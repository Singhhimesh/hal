@extends('layouts.master')
@section('title', __('Chat Settings'))
@section('breadcum')
<div class="breadcrumbbar">
          <h4 class="page-title">{{ __('Chat Settings') }}</h4>
          <div class="breadcrumb-list">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/admin')}}">{{ __('Dashboard') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('Chat Settings') }}</li>
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
          			<h5 class="box-title">{{__('Chat Settings')}}</h5>
        		</div>

        		{!! Form::model($chat,['method'=>'POST','action'=>'ChatSettingController@update']) !!}
              @if (isset($chat) && count($chat) > 0)  
              @foreach ($chat as $element)
              <!-- ======= Facebook Login start ========== -->
              <div class="col-md-6 col-lg-6 col-xl-12">
                <div class="bg-info-rgba ml-6 mr-6 mb-6">
                  <div class="card-header text-dark"><h4> {{__('Chat Settings For ')}} {{ucfirst($element->key)}}</h4></div>
                    {!! Form::hidden('ids['.$element->id.']', $element->id) !!}
                    <input type='hidden' name="keyname[{{ $element->id }}]" value="{{ $element->key }}">
                    <div class="payment-gateway-block">
                        <div class="row mx-2 my-4" id="fb_box_dtl" >
                          @if($element->key != 'whatsapp')
                            <div class="col-md-2">
                              <div class="form-group text-dark{{ $errors->has('enable_messanger') ? ' has-error' : '' }}">
                                <label for="">{{__('Enable')}} </label>
                              </div>
                            </div>
                            <div class="col-md-2">
                              <input type="checkbox" name="enable_messanger[{{ $element->id }}]" {{ $element->enable_messanger == 1 ? 'checked' :'' }} class='custom_toggle' >
                            </div>
                          @endif
                          @if($element->key != 'whatsapp')
                            <div class="col-md-8">
                              <div class="form-group text-dark {{ $errors->has('script') ? ' has-error' : '' }}">
                                {!! Form::label('script',__('Script') )!!}
                                {!! Form::textarea('script['.$element->id.']', $element->script, ['class' => 'form-control','rows'=>'3']) !!}
                                <small class="text-danger">{{ $errors->first('script') }}</small>
                              </div>
                            </div>
                          @endif
                          

                          @if($element->key != 'messanger')
                            <div class="col-md-3">
                              <div class="form-group text-dark{{ $errors->has('mobile') ? ' has-error' : '' }}">
                                {!! Form::label('mobile', __('Whatsapp Mobile No')) !!}
                              
                                {!! Form::text('mobile['.$element->id.']', $element->mobile, [ 'class' => 'form-control', 'placeholder' => __('Whatsapp Mobile No')]) !!}
                                <small class="text-danger">{{ $errors->first('mobile') }}</small>
                              </div>
                            </div>
                          @endif

                          @if($element->key != 'messanger')
                            <div class="col-md-3">
                              <div class="form-group text-dark{{ $errors->has('text') ? ' has-error' : '' }}">
                                {!! Form::label('text',__('Welcome Text')) !!} 
                                {!! Form::text('text['.$element->id.']', $element->text, ['class' => 'form-control', 'placeholder' => __('Hello, Welcome')]) !!}
                                <small class="text-danger">{{ $errors->first('text') }}</small>
                              </div>
                            </div>
                          @endif

                          @if($element->key != 'messanger')
                            <div class="col-md-3">
                              <div class="form-group text-dark{{ $errors->has('header') ? ' has-error' : '' }}">
                                {!! Form::label('header',__('Chat Header')) !!} 
                                {!! Form::text('header['.$element->id.']', $element->header, ['class' => 'form-control', 'placeholder' => __('Connect with us')]) !!}
                                <small class="text-danger">{{ $errors->first('header') }}</small>
                              </div>
                            </div>
                          @endif

                          @if($element->key != 'messanger')
                            <div class="col-md-1">
                              <div class="form-group text-dark{{ $errors->has('size') ? ' has-error' : '' }}">
                                {!! Form::label('size',__('Icon Size')) !!} 
                                {!! Form::number('size['.$element->id.']', $element->size, ['class' => 'form-control','min'=>'30']) !!}
                                <small class="text-danger">{{ $errors->first('size') }}</small>
                              </div>
                            </div>
                          @endif

                          @if($element->key != 'messanger')
                            <div class="col-md-2">
                                <div class="form-group text-dark{{ $errors->has('color') ? ' has-error' : '' }}">
                                {!! Form::label('color',__('Header Color')) !!} 
                                {!! Form::color('color['.$element->id.']', $element->color, ['class' => 'form-control']) !!}
                                <small class="text-danger">{{ $errors->first('color') }}</small>
                              </div>
                            </div>
                          @endif

                          @if($element->key != 'messanger')
                            <div class="col-md-3">
                              <div class="form-group text-dark{{ $errors->has('enable_whatsapp') ? ' has-error' : '' }}">
                                <h6 class="bootstrap-switch-label">{{__('Enable')}}</h6>
                                <input type="checkbox" name="enable_whatsapp[{{ $element->id }}]" {{ $element->enable_whatsapp == 1 ? 'checked' :'' }} class='custom_toggle' >
                              </div>
                              <small class="text-danger">{{ $errors->first('enable_whatsapp') }}</small>
                            </div>
                          @endif  
                          
                          @if($element->key != 'messanger')
                            <div class="col-md-3">
                              <div class="form-group text-dark{{ $errors->has('position') ? ' has-error' : '' }}">
                                <h6 class="bootstrap-switch-label">{{__('Position')}} 
                                  <small class="badge badge-pill badge-secondary" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{ __('Position : Left/Right')}}">
                                    <i class="fa fa-info"></i>
                                  </small></h6>
                                <input type="checkbox" name="position[{{ $element->id }}]" {{ $element->position == 'left' ?'checked' :'' }} class='custom_toggle' >
                              </div>
                              <small class="text-danger">{{ $errors->first('position') }}</small>
                            </div>
                          @endif  

                        </div>
                    </div>
                  </div>
                </div>
                <!-- ======= Facebook Login end ========== -->
                @endforeach
                @endif
                <div class="col-md-6 col-lg-6 col-xl-12 form-group">
                  <button type="submit" class="btn btn-primary-rgba" title="{{ __('Save') }}"><i class="fa fa-check-circle"></i>
                    {{ __('Save') }}</button>
                </div>
              {!! Form::close() !!}

  			</div>
		</div>
	</div>

@endsection 
@section('script')
<script>
  (function($){
    $.noConflict();    
  })(jQuery);    
</script>  
@endsection