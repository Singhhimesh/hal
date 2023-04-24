@foreach($audiolanguages as $lang)
           
@php
$audiogenreitems = NULL;
$audiogenreitems = array();


 foreach ($menu_data as $key => $item) 
 {
   
  $gmovie =  App\Movie::join('videolinks','videolinks.movie_id','=','movies.id')
             ->select('movies.id as id','movies.title as title','movies.type as type','movies.status as status','movies.genre_id as genre_id', 'movies.a_language as a_language','movies.thumbnail as thumbnail','movies.rating as rating','movies.duration as duration','movies.publish_year as publish_year','movies.maturity_rating as maturity_rating','movies.detail as detail','movies.trailer_url as trailer_url','videolinks.iframeurl as iframeurl','movies.slug as slug','movies.tmdb as tmdb','movies.is_custom_label as is_custom_label','movies.label_id as label_id')
               ->where('movies.is_upcoming','!=' ,1)
             ->where('movies.id',$item->movie_id)->first();
      if(isset($gmovie->a_language)) {   
        foreach (explode(',',$gmovie->a_language) as $key => $aid) {
          if($aid==$lang->id){
            if(isset($gmovie) && $gmovie != NULL){
        
              $audiogenreitems[] = $gmovie;
                      
            }
          }           
        }
      }
      


     if($section->order == 1){
         arsort($audiogenreitems);
       }

     if(count($audiogenreitems) == $section->item_limit){
         break;
         exit(1);
     }

 }       
 $audiogenreitems = array_values(array_filter($audiogenreitems));
 foreach ($menu_data as $key => $item) 
 {

   $gtvs = App\Tvseries::
               join('seasons','seasons.tv_series_id','=','tv_series.id')
               ->join('episodes','episodes.seasons_id','=','seasons.id')
               ->join('videolinks','videolinks.episode_id','=','episodes.id')
               ->select('seasons.id as seasonid','tv_series.genre_id as genre_id','tv_series.id as id','tv_series.type as type','seasons.a_language as a_language', 'tv_series.status as status','tv_series.thumbnail as thumbnail','tv_series.title as title','tv_series.rating as rating','seasons.publish_year as publish_year','tv_series.maturity_rating as age_req','tv_series.detail as detail','seasons.season_no as season_no','videolinks.iframeurl as iframeurl','seasons.trailer_url as trailer_url','seasons.tmdb as tmdb','tv_series.is_custom_label as is_custom_label','tv_series.label_id as label_id')
              
         ->where('tv_series.id',$item->tv_series_id)->first();
         

         if(isset($gtvs->a_language)) {   
        foreach (explode(',',$gtvs->a_language) as $key => $atid) {
          if($atid==$lang->id){
            if(isset($gtvs) && $gtvs != NULL){
        
              $audiogenreitems[] = $gtvs;
                      
            }
          }           
        }
      }
 
   if($section->order == 1){
     arsort($audiogenreitems);
   }

   if(count($audiogenreitems) == $section->item_limit*2){
       break;
       exit(1);
   }

 }
 $audiogenreitems = array_values(array_filter($audiogenreitems));

@endphp
  @if($moviegenreitems != NULL && count($moviegenreitems)>0)
  <div class="genre-main-block"> 
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-3 col-sm-5">
          <div class="genre-dtl-block">
              <h5 class="section-heading">{{  $lang->language }} in {{ $menu->name }}</h5>
              <p class="section-dtl">{{__('At The Big Screen At Home')}}</p>
          </div>
        </div>
        @if($section->view == 1)
          <!-- List view movies in genre -->
          <div class="col-md-9 col-sm-7">
            <div class="genre-main-slider owl-carousel">
            @foreach($moviegenreitems as $item)
            
              <!-- List view genre movies and tv shows -->
                  
              @if($item->status == 1)
                @if($item->type == 'M')
                  @php
                  if($item->thumbnail != NULL){
                    $image = 'images/movies/thumbnails/'.$item->thumbnail;
                  }  // Read image path, convert to base64 encoding
                      
                  $imageData = base64_encode(@file_get_contents($image));
                  if($imageData){
                  // Format the image SRC:  data:{mime};base64,{data};
                    $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                  }else{
                    $src = Avatar::create($item->title)->toBase64();
                  }
                    
                  
                  @endphp
                   @if(hidedata($item->id,$item->type) != 1)
                  <div class="genre-slide">
                      <div class="genre-slide-image genre-image  home-prime-slider progress-movie">
                        @if($auth && getSubscription()->getData()->subscribed == true)
                          <a href="{{url('movie/detail',$item->slug)}}">
                            @if($src)
                              <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="genre-image">
                            
                            @endif
                          </a>
                         
                          <div class="hide-icon">
                            <a onclick="hideforme('{{$item->id}}','{{$item->type}}')" title="{{__('Hide this Movie')}}" class=""><i class="fa fa-eye-slash"></i></a>
                          </div>
                          @if(timecalcuate($auth->id,$item->id,$item->type) != 0)
                          <div class="progress">
                            <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:{{timecalcuate($auth->id,$item->id,$item->type)}}%">
                            </div>
                          </div>
                          @endif
                        @else
                          <a href="{{url('movie/guest/detail',$item->slug)}}">
                            @if($src)
                              <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="genre-image">
                            
                            @endif
                          </a>
                        @endif
                        @if($item->is_custom_label == 1)
                          @if(isset($item->label_id) && isset($item->label))
                            <span class="badge bg-info">{{$item->label->name}}</span>
                          @endif
                        @endif
                      
                        
                      </div>
                      <div class="genre-slide-dtl">
                        <h5 class="genre-dtl-heading">
                        @if($auth && getSubscription()->getData()->subscribed == true)
                          <a href="{{url('movie/detail/'.$item->slug)}}">{{$item->title}}</a>
                        @else
                          <a href="{{url('movie/guest/detail/'.$item->slug)}}">{{$item->title}}</a>
                        @endif
                        </h5>
                      </div>
                  </div>
                  @endif
                @endif

                @if($item->type == 'T')
                  @php
                  if($item->thumbnail != NULL){
                    $image = '/images/tvseries/thumbnails/'.$item->thumbnail;
                  }
                        
                      // Read image path, convert to base64 encoding
                      
                  $imageData = base64_encode(@file_get_contents($image));
                  if($imageData){
                  // Format the image SRC:  data:{mime};base64,{data};
                    $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                  }else{
                    $src = Avatar::create($item->title)->toBase64();
                  }
                  @endphp
                  @if(hidedata($gets1->id,$gets1->type) != 1)
                  <div class="genre-slide">
                    <div class="genre-slide-image genre-image  home-prime-slider">
                      @if($auth && getSubscription()->getData()->subscribed == true)
                        <a @if(isset($gets1)) href="{{url('show/detail',$item->season_slug)}}" @endif>
                          @if($item->thumbnail != null)
                            
                            <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="genre-image">
                        
                          @endif
                        </a>
                        <div class="hide-icon">
                          <a onclick="hideforme('{{$gets1->id}}','{{$gets1->type}}')" title="{{__('Hide this Movie')}}" class=""><i class="fa fa-eye-slash"></i></a>
                        </div>
                        @if(timecalcuate($auth->id,$gets1->id,$gets1->type) != 0)
                        <div class="progress">
                          <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:{{timecalcuate($auth->id,$gets1->id,$gets1->type)}}%">
                          </div>
                        </div>
                        @endif
                      @else
                        <a @if(isset($gets1)) href="{{url('show/guest/detail',$item->season_slug)}}" @endif>
                        @if($item->thumbnail != null)
                          <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="genre-image">
                      
                        @endif
                        </a>
                      @endif
                      @if($item->is_custom_label == 1)
                        @if(isset($item->label_id))
                          <span class="badge bg-info">{{$item->label->name}}</span>
                        @endif
                      @endif
                      
                    </div>
                    
                    <div class="genre-slide-dtl">
                      @if($auth && getSubscription()->getData()->subscribed == true)
                        <h5 class="genre-dtl-heading"><a href="{{url('show/detail/'.$item->season_slug)}}">{{$item->title}}</a></h5>
                      @else
                        <h5 class="genre-dtl-heading"><a href="{{url('show/guest/detail/'.$item->season_slug)}}">{{$item->title}}</a></h5>
                      @endif
                    </div>  
                  </div>
                  @endif
                @endif
              @endif
        
              <!-- end -->

            @endforeach
            </div>
          </div>
          <!-- List view movies in genre END -->
        @endif
            

      
        @if($section->view == 0)

        <!-- Grid view genre movies -->
            <div class="col-md-9 col-sm-7">
                <div class="cus_img">
                  
                    @foreach($moviegenreitems as $item)
                        @php
                          if(isset($auth) && $auth != NULL){
                            if ($item->type == 'M') {
                              $wishlist_check = \Illuminate\Support\Facades\DB::table('wishlists')->where([
                                                                                ['user_id', '=', $auth->id],
                                                                                ['movie_id', '=', $item->id],
                                                                              ])->first();
                            }
                          }


                          $gets1 = App\Season::where('tv_series_id','=',$item->id)->first();

                          if (isset($gets1) && $auth != NULL) {


                            $wishlist_check = \Illuminate\Support\Facades\DB::table('wishlists')->where([
                                                                        ['user_id', '=', $auth->id],
                                                                        ['season_id', '=', $gets1->id],
                              ])->first();


                            }

              
    
                            
                        @endphp
                        @if($item->status == 1)
                          @if($item->type == 'M')
                          
                            @php
                                $image = 'images/movies/thumbnails/'.$item->thumbnail;
                              // Read image path, convert to base64 encoding
                              
                              $imageData = base64_encode(@file_get_contents($image));
                              if($imageData){
                              // Format the image SRC:  data:{mime};base64,{data};
                              $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                              }else{
                                  $src = Avatar::create($item->title)->toBase64();
                              }
                            @endphp
                             @if(hidedata($item->id,$item->type) != 1)
                            <div class="col-lg-4 col-md-9 col-xs-6 col-sm-6">
                                <div class="genre-slide-image genre-grid  home-prime-slider">
                                    @if($auth && getSubscription()->getData()->subscribed == true)
                                      <a href="{{url('movie/detail',$item->slug)}}">
                                      @if($src)
                                        <img data-src="{{ $src }}" class="img-responsive lazy" alt="genre-image">
                                      
                                      @endif
                                      </a>
                                      <div class="hide-icon hide-icon-two">
                                        <a onclick="hideforme('{{$item->id}}','{{$item->type}}')" title="{{__('Hide this Movie')}}" class=""><i class="fa fa-eye-slash"></i></a>
                                      </div>
                                      @if(timecalcuate($auth->id,$item->id,$item->type) != 0)
                                      <div class="progress">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:{{timecalcuate($auth->id,$item->id,$item->type)}}%">
                                        </div>
                                      </div>
                                      @endif
                                    @else
                                        <a href="{{url('movie/guest/detail',$item->slug)}}">
                                        @if($src)
                                          <img data-src="{{$src}}" class="img-responsive lazy" alt="genre-image">
                                        
                                        @endif
                                        </a>

                                    @endif
                                    @if($item->is_custom_label == 1 && isset($item->label))
                                      @if(isset($item->label_id))
                                        <span class="badge bg-info">{{$item->label->name}}</span>
                                      @endif
                                    
                                    @endif
                                  
                                
                                  </div>
                                  <div class="genre-slide-dtl">
                                    <h5 class="genre-dtl-heading">
                                      @if($auth && getSubscription()->getData()->subscribed == true)
                                      <a href="{{url('movie/detail/'.$item->slug)}}">{{$item->title}}</a>
                                      @else
                                      <a href="{{url('movie/guest/detail/'.$item->slug)}}">{{$item->title}}</a>

                                      @endif
                                    </h5>
                                  </div>
                            </div>
                            @endif
                          @endif

                          @if($item->type == 'T')
                              @php
                                  $image = 'images/tvseries/thumbnails/'.$item->thumbnail;
                                // Read image path, convert to base64 encoding
                                
                                $imageData = base64_encode(@file_get_contents($image));
                                if($imageData){
                                // Format the image SRC:  data:{mime};base64,{data};
                                $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                                }else{
                                    $src = Avatar::create($item->title)->toBase64();
                                }
                              @endphp
                               @if(hidedata($gets1->id,$gets1->type) != 1)
                                <div class="col-lg-4 col-md-9 col-xs-6 col-sm-6">
                                  <div class="genre-slide-image genre-grid  home-prime-slider">
                                      @if($auth && getSubscription()->getData()->subscribed == true)
                                      <a @if(isset($gets1)) href="{{url('show/detail',$item->season_slug)}}" @endif>
                                        @if($src)
                                          <img data-src="{{ $src }}" class="img-responsive lazy" alt="genre-image">
                                        
                                        @endif
                                      </a>
                                      <div class="hide-icon hide-icon-two">
                                        <a onclick="hideforme('{{$gets1->id}}','{{$gets1->type}}')" title="{{__('Hide this Movie')}}" class=""><i class="fa fa-eye-slash"></i></a>
                                      </div>
                                      @if(timecalcuate($auth->id,$gets1->id,$gets1->type) != 0)
                                      <div class="progress">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:{{timecalcuate($auth->id,$gets1->id,$gets1->type)}}%">
                                        </div>
                                      </div>
                                      @endif
                                      @else
                                        <a @if(isset($gets1)) href="{{url('show/guest/detail',$item->season_slug)}}" @endif>
                                        @if($src)
                                          <img data-src="{{ $src }}" class="img-responsive lazy" alt="genre-image">
                                        
                                        @endif
                                      </a>
                                      @endif
                                      @if($item->is_custom_label == 1)
                                        @if(isset($item->label_id))
                                          <span class="badge bg-info">{{$item->label->name}}</span>
                                        @endif
                                      @endif
          
                                  
                                  </div>
                                  <div class="genre-slide-dtl">
                                      @if($auth && getSubscription()->getData()->subscribed == true)
                                      <h5 class="genre-dtl-heading"><a href="{{url('show/detail/'.$item->season_slug)}}">{{$item->title}}</a></h5>
                                      @else
                                        <h5 class="genre-dtl-heading"><a href="{{url('show/guest/detail/'.$item->season_slug)}}">{{$item->title}}</a></h5>
                                      @endif
                                  </div>
                                </div>
                              @endif
                          @endif
                        @endif
                    @endforeach

                    
                  </div>
            </div>
        
        <!--end grid view for genre-->
        @endif
      </div>
    </div>
  </div>
@endif
                   

              
@endforeach

 @section('custom-script')
  <script type="text/javascript">

function addWish(id, type) {
    //   app.addToWishList(id, type);
    $.ajax({
        type: 'POST',
        url: '{{route('addtowishlist')}}',
        data: {"id": id, "type": type, "_token": "{{ csrf_token() }}"},
        success: function (data) {
            console.log(data);
        }
    });
    setTimeout(function() {
        $('.addwishlistbtn'+id+type).text(function(i, text){
          return text == "{{__('Add to Watchlist')}}" ? "{{ __('Remove from Watchlist') }}" : "{{__('Add to Watchlist')}}";
        });
      }, 100);
    }
  </script>
   <script>
 
      function myage(age){
        if (age==0) {
        $('#ageModal').modal('show'); 
      }else{
          $('#ageWarningModal').modal('show');
      }
    }

</script>
  @endsection