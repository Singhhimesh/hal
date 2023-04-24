@extends('layouts.theme')


@section('custom-meta')

@endsection

@section('title',"$audio->title")


@section('main-wrapper')
@php
$auth = Illuminate\Support\Facades\Auth::user();
$subscribed = null;
$withlogin= $configs->withlogin;
$catlog = $configs->catlog;


@endphp
<!-- main wrapper -->
<section class="main-wrapper main-wrapper-single-movie-prime">
  <div class="background-main-poster-overlay">

    <!-- Modal -->


    @if(isset($audio))
    @if($audio->poster != null)
    <div class="background-main-poster col-md-offset-4 col-md-6"
      style="background-image: url('{{asset('images/audio/posters/'.$audio->poster)}}');">
      @else
      <div class="background-main-poster col-md-offset-4 col-md-6"
        style="background-image: url('{{asset('images/default-poster.jpg')}}');">
        @endif
        @endif
      </div>
      <div class="overlay-bg gredient-overlay-right"></div>
      <div class="overlay-bg"></div>
    </div>
    <div id="full-movie-dtl-main-block" class="full-movie-dtl-main-block">
      <div class="container-fluid">
        @if(isset($audio))

        <div class="row">
          <div class="col-md-8 small-screen-block">
            <div class="full-movie-dtl-block">
              <h2 class="section-heading">{{$audio->title}}</h2></br>
              <div class="">

                <div id="wishlistelement" class="screen-play-btn-block">

                  @if(Auth::check() && getSubscription()->getData()->subscribed == true)


                  @if(Auth::check() && Auth::user()->is_admin == '1')
                  <a href="{{route('watchaudio',$audio->id)}}"
                    class="btn btn-play play-btn-icon{{ $audio['id'] }}"><span class="play-btn-icon"><i
                        class="fa fa-play"></i></span> <span class="play-text">{{__('Play Now')}}</span>
                  </a>
                  @else
                  <a href="{{url('/watch/audio/'.$audio->id)}}"
                    class=" btn btn-play play-btn-icon{{ $audio['id'] }}"><span class="play-btn-icon "><i
                        class="fa fa-play"><span class="play-text"> {{__('Play Now')}}</span></a>
                  @endif

                  @endif

                </div>

              </div>

              <p>
                {{$audio->detail}}
              </p>
            </div>
          </div>
          <div class="col-md-4 small-screen-block">
            <div class="poster-thumbnail-block">
              @if($audio->thumbnail != null || $audio->thumbnail != '')
              <img src="{{asset('images/audio/thumbnails/'.$audio->thumbnail)}}" class="img-responsive"
                alt="genre-image">
              @else
              <img src="{{asset('images/default-thumbnail.jpg')}}" class="img-responsive" alt="genre-image">
              @endif
            </div>
          </div>
        </div>
        @endif
      </div>
    </div>


    {{-- comments section start from here --}}
@if(isset($audio))
@if($configs->comments == 1 || $configs->user_rating == 1)
  
  <div class="container-fluid movie-series-section comment-nav-tabs">
     <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist" >
      @if($configs->comments == 1)
        <li role="presentation" class="active"><a href="#showcomment" aria-controls="showcomment" role="tab" data-toggle="tab" style="z-index:999;">{{__('Comment')}}</a></li>
      

        @if(getSubscription()->getData()->subscribed == true)
        <li role="presentation" style="z-index:999;"><a href="#postcomment" aria-controls="postcomment" role="tab" data-toggle="tab">{{__('Post Comment')}}</a></li>
        @endif
      @endif
    </ul>
    <br/>
    <!-- Tab panes -->
    <div class="tab-content">
      @if($configs->comments == 1)
        <div role="tabpanel" class="tab-pane fade in active" id="showcomment">
          @if(isset($audio->comments) && $audio->comments->isEmpty())
          <div class="row text-center" style="color:#B1B1B1;">
            <h4 class="text-center"><i class="fa fa-comment-o"></i> &nbsp;{{__('No comments yet!')}}</h4>&nbsp;
              <small class="text-center">{{__('Be the first to share what you think !')}}</small>
          </div>
            
          @else
            
            <h4 class="title" style="color:#B1B1B1;"><span class="glyphicon glyphicon-comment"></span> {{$audio->comments->where('status',1)->count()}} {{__('Comment')}} </h4> <br/>
            
              @foreach ($audio->comments->where('status','1') as $comment)

                  <div class="comment">
                    <div class="author-info">
                      <img src="{{ Avatar::create($comment->name )->toBase64() }}" class="author-image">
                      <div class="author-name">
                        <h4 class="author-heading">{{$comment->name}}</h4>
                        <p class="author-time">{{date('F jS, Y - g:i a',strtotime($comment->created_at))}}</p>
                      </div>
                      @if(Auth::check() && (Auth::user()->is_admin == 1 || $comment->user_id == Auth::user()->id))  
                      <button type="button" class="btn btn-danger btn-floating pull-right" data-toggle="modal" data-target="#deleteModal{{$comment->id}}" style="left:10px;position:relative;"><i class="fa fa-trash-o"></i></button>
                      @endif
                      @if(getSubscription()->getData()->subscribed == true)
                      <button type="button" class="btn btn-danger comment-btn btn-floating pull-right" data-toggle="modal" data-target="#{{$comment->id}}deleteModal"><i class="fa fa-reply"></i></button>
                      @endif
                    </div>

                    <div class="comment-content">
                    {{$comment->comment}}
                    </div>
                  </div>
                  <!-- ---------------- comment delete ------------>
                      <div id="deleteModal{{$comment->id}}" class="delete-modal  modal fade" role="dialog">
                        <div class="modal-dialog modal-sm">
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <div class="delete-icon"></div>
                            </div>
                            <div class="modal-body text-center">
                              <h4 class="modal-heading comment-delete-heading">{{__('Are You Sure')}}</h4>
                              <p class="comment-delete-detail">{{__('Model Message')}}</p>
                            </div>
                            <div class="modal-footer">
                              {!! Form::open(['method' => 'DELETE', 'action' => ['AudioCommentController@deletecomment', $comment->id]]) !!}
                                  <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">{{__('No')}}</button>
                                  <button type="submit" class="btn btn-danger">{{__('Yes')}}</button>
                              {!! Form::close() !!}
                            </div>
                          </div>
                        </div>
                      </div>
                    <!-------------------- end comment delete ------------------->
                
                      
                  <!-- Modal -->
                  @foreach($comment->subcomments->where('status',1) as $subcomment)

                    <div class="comment" style="margin-left:50px;">
                      <div class="author-info">
                        @php
                            $name=App\user::where('id',$subcomment->user_id)->first();
                          @endphp
                        <img src="{{ Avatar::create($name->name )->toBase64() }}" class="author-image">
                        <div class="author-name">
                        
                          <h5 class="author-heading">{{$name->name}}</h5>
                          <p class="author-time">{{date('F jS, Y - g:i a',strtotime($subcomment->created_at))}}</p>
                        </div>
                        @if(Auth::check() && (Auth::user()->is_admin == 1 || $subcomment->user_id == Auth::user()->id))
                      
                          <button type="button" class="btn btn-danger btn-floating comment-btn pull-right" data-toggle="modal" data-target="#subdeleteModal{{$subcomment->id}}"><i class="fa fa-trash-o"></i></button>
                        <div id="subdeleteModal{{$subcomment->id}}" class="delete-modal modal fade" role="dialog">
                        <div class="modal-dialog modal-sm">
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <div class="delete-icon"></div>
                            </div>
                            <div class="modal-body text-center">
                              <h4 class="modal-heading comment-delete-heading ">{{__('Are You Sure')}}</h4>
                              <p class="comment-delete-detail">{{__('Model Message')}}</p>
                            </div>
                            <div class="modal-footer">
                              {!! Form::open(['method' => 'DELETE', 'action' => ['AudioCommentController@deletesubcomment', $subcomment->id]]) !!}
                                  <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">{{__('No')}}</button>
                                  <button type="submit" class="btn btn-danger">{{__('Yes')}}</button>
                              {!! Form::close() !!}
                            </div>
                          </div>
                        </div>
                      </div>

                      
                      @endif
                      </div>

                      <div class="comment-content">
                      {{$subcomment->reply}}
                      </div>
                    
                    </div>
                  
                  @endforeach
                  <div id="{{$comment->id}}deleteModal" class="comment-modal modal fade" role="dialog"  style="margin-top: 20px;">
                          <div class="modal-dialog modal-md" style="margin-top:70px;">
                            <!-- Modal content-->
                            <div class="modal-content">
                              <div class="modal-header">
                                
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <div class="delete-icon"></div>
                              <h4 style="color:#FFF;"> {{__('Reply For')}} {{$comment->name}}</h4>
                              </div>
                              <div class="modal-body text-center">
                                
                                  <form action="{{route('audio.comment.reply', ['cid' =>$comment->id])}}" method ="POST">
                                    {{ csrf_field() }}
                                  {{Form::label('reply',__('Your Reply'))}}
                                  {{Form::textarea('reply', null, ['class' => 'form-control', 'rows'=> '5','cols' => '10'])}} 
                                  <br/>
                                    <button type="submit" class="btn btn-danger">{{__('Submit')}}</button>
                              </form>
                              </div>
                              <div class="modal-footer">
                              
                              </div>
                            </div>
                          </div>
                  </div>
              @endforeach
          @endif
        </div>

        @auth
        <div role="tabpanel" class="tab-pane fade" id="postcomment">
            <div style="width: 90%;color:#B1B1B1;" class=" " >
                <h3 class="author-heading">{{__('Post Comment')}}:</h3><br/>
                      {{Form::open( ['route' => ['audio.comment.store', $audio->id], 'method' => 'POST'])}}
                    <br/>
                    {{Form::label('comment',__('Comment'))}}
                    {{Form::textarea('comment', null, ['class' => 'form-control', 'rows'=> '5','cols' => '9'])}}
                    <br/>
                    {{Form::submit(__('Add Comment'), ['class' => 'btn btn-md btn-default'])}}
            </div>

        </div>
        @endauth
      @endif
      @endif
      @endif

    @endsection


    @section('custom-script')


    <script>
      $(document).ready(function () {

        $(".group1").colorbox({
          rel: 'group1'
        });
        $(".group2").colorbox({
          rel: 'group2',
          transition: "fade"
        });
        $(".group3").colorbox({
          rel: 'group3',
          transition: "none",
          width: "75%",
          height: "75%"
        });
        $(".group4").colorbox({
          rel: 'group4',
          slideshow: true
        });
        $(".ajax").colorbox();
        $(".youtube").colorbox({
          iframe: true,
          innerWidth: 640,
          innerHeight: 390
        });
        $(".vimeo").colorbox({
          iframe: true,
          innerWidth: 500,
          innerHeight: 409
        });
        $(".iframe").colorbox({
          iframe: true,
          width: "100%",
          height: "100%"
        });
        $(".inline").colorbox({
          inline: true,
          width: "50%"
        });
        $(".callbacks").colorbox({
          onOpen: function () {
            alert('onOpen: colorbox is about to open');
          },
          onLoad: function () {
            alert('onLoad: colorbox has started to load the targeted content');
          },
          onComplete: function () {
            alert('onComplete: colorbox has displayed the loaded content');
          },
          onCleanup: function () {
            alert('onCleanup: colorbox has begun the close process');
          },
          onClosed: function () {
            alert('onClosed: colorbox has completely closed');
          }
        });

        $('.non-retina').colorbox({
          rel: 'group5',
          transition: 'none'
        })
        $('.retina').colorbox({
          rel: 'group5',
          transition: 'none',
          retinaImage: true,
          retinaUrl: true
        });


        $("#click").click(function () {
          $('#click').css({
            "background-color": "#f00",
            "color": "#fff",
            "cursor": "inherit"
          }).text("Open this window again and this message will still be here.");
          return false;
        });
      });
    </script>

    @endsection