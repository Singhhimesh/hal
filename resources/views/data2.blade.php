

              
      @foreach($genres as $genre)
      
                    
                @php
                    $moviegenreitems = NULL;
                    $moviegenreitems = array();

                    foreach ($menu_data as $key => $item) {
                       
                        $gmovie =  \DB::table('movies')
                                 ->select('movies.id as id','movies.title as title','movies.type as type','movies.status as status','movies.genre_id as genre_id','movies.thumbnail as thumbnail','movies.slug as slug','movies.is_custom_label as is_custom_label','movies.label_id as label_id')
                                 ->where('movies.is_upcoming','!=' ,1)
                                 ->where('movies.genre_id', 'LIKE', '%' . $genre->id . '%')->where('movies.id',$item->movie_id)->first();

                       
                        if(isset($gmovie)){
                          
                           $moviegenreitems[] = $gmovie;
                                  
                        }

                         if($section->order == 1){
                            arsort($moviegenreitems);
                          }

                        if(count($moviegenreitems) == $section->item_limit){
                            break;
                            exit(1);
                        }


                    }

                    $moviegenreitems = array_values(array_filter($moviegenreitems));

                   

                      foreach ($menu_data as $key => $item) {

                           $gtvs =  \DB::table('tv_series')
                                  ->join('seasons','seasons.tv_series_id','=','tv_series.id')
                                  ->select('seasons.id as seasonid','tv_series.genre_id as genre_id','tv_series.id as id','tv_series.type as type','tv_series.status as status','tv_series.title as title','tv_series.thumbnail as thumbnail','seasons.season_slug as season_slug','tv_series.is_custom_label as is_custom_label','tv_series.label_id as label_id')->where('tv_series.genre_id', 'LIKE', '%' . $genre->id . '%')
                                  ->where('tv_series.id',$item->tv_series_id)->first();
                                  
                         
                          
                          if(isset($gtvs)){
                            
                             array_push($moviegenreitems, $gtvs);
                                   
                          }
                            
                          if($section->order == 1){
                            arsort($moviegenreitems);
                          }

                          if(count($moviegenreitems) == $section->item_limit*2){
                              break;
                              exit(1);
                          }

                      }
                    
                    $moviegenreitems = array_values(array_filter($moviegenreitems));

                    
                @endphp
                @if($moviegenreitems != NULL && count($moviegenreitems)>0)
                  <div class="genre-main-block">
                  <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-3">
                          <div class="genre-dtl-block">
                         <h5 class="section-heading">{{  $genre->name }} in {{ $menu->name }}</h5>
                         <p class="section-dtl">{{__('at the big screen at home')}}</p>
                          
                          @if($auth && getSubscription()->getData()->subscribed == true)
                          
                            <a href="{{ route('show.in.genre',$genre->id) }}" class="see-more"> <b>{{__('View All')}}</b></a>
                         
                          @else
                          
                            <a href="{{ route('show.in.guest.genre',$genre->id) }}" class="see-more"> <b>{{__('View All')}}</b></a>
                           
                          @endif

                      </div>
                    </div>
                     @if($section->view == 1)
                      <!-- List view movies in genre -->
                        <div class="col-md-9">
                          <div class="genre-main-slider owl-carousel">
                            @foreach($moviegenreitems as $item)
                          
                           <!-- List view genre movies and tv shows -->
                               
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
                                                $src = url('images/default-thumbnail.jpg');
                                            }
                                        @endphp
                                          <div class="genre-slide ">
                                            <div class="genre-slide-image genre-image  home-prime-slider">
                                              @if($auth && getSubscription()->getData()->subscribed == true)
                                              <a href="{{url('movie/detail',$item->slug)}}">
                                                @if($src)
                                                  <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="genre-image">
                                                @else
                                                  <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="genre-image">
                                                @endif
                                              </a>
                                              @else
                                                <a href="{{url('movie/guest/detail',$item->slug)}}">
                                                @if($src)
                                                  <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="genre-image">
                                                @else
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

                                      @if($item->type == 'T')
                                        @php
                                             $image = 'images/tvseries/thumbnails/'.$item->thumbnail;
                                            // Read image path, convert to base64 encoding
                                            
                                            $imageData = base64_encode(@file_get_contents($image));
                                            if($imageData){
                                            // Format the image SRC:  data:{mime};base64,{data};
                                            $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                                            }else{
                                                $src = url('images/default-thumbnail.jpg');
                                            }
                                        @endphp
                                       <div class="genre-slide">
                                          <div class="genre-slide-image genre-image  home-prime-slider">
                                              @if($auth && getSubscription()->getData()->subscribed == true)
                                              <a @if(isset($gets1)) href="{{url('show/detail',$item->season_slug)}}" @endif>
                                                @if($item->thumbnail != null)
                                                  
                                                  <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="genre-image">
                                                
                                                @else
                                                  <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="genre-image">
                                                @endif
                                              </a>
                                              @else
                                               <a @if(isset($gets1)) href="{{url('show/guest/detail',$item->season_slug)}}" @endif>
                                                @if($item->thumbnail != null)
                                                  <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="genre-image">
                                              
                                                @else
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
                              
                              <!-- end -->

                            @endforeach
                          </div>
                        </div>
                     <!-- List view movies in genre END -->
                     @endif
                     

                
                      @if($section->view == 0)

                      <!-- Grid view genre movies -->
                          <div class="col-md-9">
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
                                                $src = url('images/default-thumbnail.jpg');
                                            }
                                          @endphp
                                          
                                          <div class="col-lg-4 col-md-9 col-xs-6 col-sm-6">
                                              <div class="genre-slide-image genre-grid  home-prime-slider">
                                                  @if($auth && getSubscription()->getData()->subscribed == true)
                                                    <a href="{{url('movie/detail',$item->slug)}}">
                                                    @if($src)
                                                      <img data-src="{{ $src }}" class="img-responsive lazy" alt="genre-image">
                                                    @else
                                                      <img data-src="{{ $src }}" class="img-responsive lazy" alt="genre-image">
                                                    @endif
                                                   </a>
                                                  @else
                                                     <a href="{{url('movie/guest/detail',$item->slug)}}">
                                                      @if($src)
                                                        <img data-src="{{$src}}" class="img-responsive lazy" alt="genre-image">
                                                      @else
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

                                        @if($item->type == 'T')
                                            @php
                                               $image = 'images/tvseries/thumbnails/'.$item->thumbnail;
                                              // Read image path, convert to base64 encoding
                                              
                                              $imageData = base64_encode(@file_get_contents($image));
                                              if($imageData){
                                              // Format the image SRC:  data:{mime};base64,{data};
                                              $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                                              }else{
                                                  $src = url('images/default-thumbnail.jpg');
                                              }
                                            @endphp
                                          <div class="col-lg-4 col-md-9 col-xs-6 col-sm-6">
                                            <div class="genre-slide-image genre-grid  home-prime-slider">
                                               @if($auth && getSubscription()->getData()->subscribed == true)
                                                <a @if(isset($gets1)) href="{{url('show/detail',$item->season_slug)}}" @endif>
                                                  @if($src)
                                                    
                                                    <img data-src="{{ $src }}" class="img-responsive lazy" alt="genre-image">
                                                  
                                                  @else
                                                    <img data-src="{{ $src }}" class="img-responsive lazy" alt="genre-image">
                                                  @endif
                                                </a>
                                                @else
                                                 <a @if(isset($gets1)) href="{{url('show/guest/detail',$item->season_slug)}}" @endif>
                                                  @if($src)
                                                    <img data-src="{{ $src }}" class="img-responsive lazy" alt="genre-image">
                                                  
                                                  @else
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
                                  @endforeach

                                  
                               </div>
                          </div>
                     
                    <!--end grid view for genre-->
                    @endif

                 
                           </div>
                  </div>    
                </div>
                <br/>
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
                   


<script type="text/javascript" src="{{url('js/jquery.popover.js')}}"></script> <!-- bootstrap popover js -->
<script type="text/javascript" src="{{url('js/menumaker.js')}}"></script> <!-- menumaker js -->
<script type="text/javascript" src="{{url('js/jquery.curtail.min.js')}}"></script> <!-- menumaker js -->
<script type="text/javascript" src="{{url('js/owl.carousel.min.js')}}"></script> <!-- owl carousel js -->
@if(selected_lang()->rtl == 0)
  <script src="{{ url('js/slider.js') }}"></script>
@else
  <script src="{{ url('js/slider-rtl.js') }}"></script>
@endif
{{-- <script type="text/javascript" src="{{ url('js/slider.js') }}"></script> --}}
<script type="text/javascript" src="{{url('js/jquery.scrollSpeed.js')}}"></script> <!-- owl carousel js -->
<script type="text/javascript" src="{{url('js/TweenMax.min.js')}}"></script> <!-- animation gsap js -->
<script type="text/javascript" src="{{url('js/ScrollMagic.min.js')}}"></script> <!-- custom js -->
<script type="text/javascript" src="{{url('js/animation.gsap.min.js')}}"></script> <!-- animation gsap js -->
<script type="text/javascript" src="{{url('js/modernizr-custom.js')}}"></script> <!-- debug addIndicators js -->
<script type="text/javascript" src="{{url('js/theme.js')}}"></script> <!-- custom js -->
<script type="text/javascript" src="{{url('js/custom-js.js')}}"></script>
<script type="text/javascript" src="{{ url('js/colorbox.js') }}"></script>
<script type="text/javascript" src="{{ url('js/checkit.js') }}"></script>
{{-- start rating js --}}
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/js/star-rating.min.js"></script>
