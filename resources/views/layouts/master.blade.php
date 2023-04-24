<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>@yield('title') - {{__('Admin')}} - {{$w_title}}</title>
    @include('layouts.head')
</head>
<body class="vertical-layout"> 
<div id="containerbar">
   @include('layouts.sidebar')
   

<div class="rightbar">
     @include('layouts.topbar')
     <!-- Start Contentbar -->             
        
    
        @yield('maincontent')

         <!-- Start Footerbar -->
    <div class="footerbar">
        <footer class="footer">
            <p class="mb-0"> &copy; {{ date('Y') }} | {{ config('app.name') }} | {{__('All Rights Reserved.')}}</strong>
                <span class="pull-right"><b>{{ __("Version") }} {{ config('app.version') }}</p>
        </footer>
    </div>
       
  
  
    
    <!-- End Footerbar -->
</div>

</div>
 @include('layouts.scripts')
 @yield('script')
</body>
</html>