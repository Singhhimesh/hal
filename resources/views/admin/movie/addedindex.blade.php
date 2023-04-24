@extends('layouts.master')
@section('title',__('Added Movies'))
@section('breadcum')
	<div class="breadcrumbbar">
                <h4 class="page-title">{{ __('Added Movies') }}</h4>
                <div class="breadcrumb-list">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{url('/admin')}}" title="{{ __('Dashboard') }}">{{ __('Dashboard') }}</a></li>
                      <li class="breadcrumb-item active" aria-current="page">{{ __('Added Movies') }}</li>
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
                    <button type="button" class="float-right btn btn-danger-rgba mr-2 " data-toggle="modal"
            data-target="#bulk_delete" title="{{ __('Delete Selected') }}"><i class="feather icon-trash mr-2"></i> {{ __('Delete Selected') }} </button>
            
                @if (Session::has('changed_language'))
                <a href="{{ route('tmdb_movie_translate') }}" class="float-right btn btn-warning-rgba mr-2" title="{{ __('Translate All To') }}"><i
                    class="fa fa-language"></i>{{ __('Translate All To') }} {{Session::get('changed_language')}} </a>
                    <a href="{{route('movies.create')}}" class="float-right btn btn-primary-rgba mr-2" title="{{ __('Add Movie') }}"><i
                class="feather icon-plus mr-2"></i>{{ __('Add Movie') }} </a>
                @endif
                    <h5 class="card-title">{{ __('Added Movies') }}</h5>
                    
                </div> 

                <div class="card-body device-history-page">
                    <div class="table-responsive">
                         <table id="moviesTable" class="table table-borderd">

                            <thead>
                              <th>
                                <div class="inline">
                                  <input id="checkboxAll" type="checkbox" class="filled-in" name="checked[]" value="all" id="checkboxAll">
                                  <label for="checkboxAll" class="material-checkbox"></label>
                                </div>
                                #
                              </th>
                              <th>{{__('Thumbnail')}}</th>
                              <th>{{__('Movie Title')}}</th>
                              <th>{{__('Rating')}}</th>
                              <th>{{__('By TMDB')}}</th>
                              <th>{{__('Featured')}}</th>
                              <th>{{__('Added By')}}</th>
                              <th>{{__('Status')}}</th>
                              <th>{{__('Actions')}}</th>
                            </thead>

                            @if ($movies)
                              <tbody>
                              
                              </tbody>
                            @endif  

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
                                          {!! Form::open(['method' => 'POST', 'action' => 'MovieController@bulk_delete', 'id' => 'bulk_delete_form']) !!}
                                                @method('POST')
                                                <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">{{__('No')}}</button>
                                                <button type="submit" class="btn btn-danger">{{__('Yes')}}</button>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        

                        </table>                  
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 
@section('script')
<script>
  (function($){
    $('#checkboxAll').on('change', function(){
      if($(this).prop("checked") == true){
        $('.material-checkbox-input').attr('checked', true);
      }
      else if($(this).prop("checked") == false){
        $('.material-checkbox-input').attr('checked', false);
      }
    });
  })(jQuery);
</script>
 
<script>
   $(document).ready(function() {
var SITEURL = '{{URL::to('')}}';


      $.ajax({
          type: "GET",
          url: SITEURL + "/admin/movie/upload_video/converting",
          success: function (data) {
         console.log('Success:',data);
          },
          error: function (data) {
              console.log('Error:', data);
          }
      });
   });
</script>
<script>

  $(function () {
    jQuery.noConflict();
    var table;
    if( $.fn.dataTable.isDataTable( '#moviesTable' )){
      table = $('#moviesTable').DataTable();
    }else{
      
      table = $('#moviesTable').DataTable({
        
        processing: true,
        serverSide: true,
        responsive: true,
        autoWidth: false,
        scrollCollapse: true,
     
       
        ajax: "{{ route('addedmovies') }}",
        columns: [
            
            {data: 'checkbox', name: 'checkbox',orderable: false, searchable: false},
          
            {data: 'thumbnail', name: 'thumbnail'},
            {data: 'title', name: 'title'},
            {data: 'rating', name: 'rating',searchable: false},
            {data: 'tmdb', name: 'tmdb',searchable: false},
            {data: 'featured', name: 'featured',searchable: false},
            {data: 'addedby', name: 'addedby',searchable: true},
            {data: 'status', name: 'status',searchable: false},
            {data: 'action', name: 'action',searchable: false}
           
        ],
        dom : 'lBfrtip',
        buttons : [
          'csv','excel','pdf','print'
        ],
        order : [[0,'desc']]
    });
    }
    
    
  });
</script>


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