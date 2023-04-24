<p><b>{{ __('Name') }}</b>: {{ $name }}</p>
<p><b>{{ __('Email') }}</b>: {{ $email }}</p>
<p><b>{{ __('Mobile') }}</b>: @if(isset($mobile))
    {{ $mobile }}
    @endif</p>