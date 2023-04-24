@extends('layouts.master')
@section('title',__('View Track'))
@section('breadcum')
	<div class="breadcrumbbar">
        <h4 class="page-title">{{ __('View Track') }}</h4>
        <div class="breadcrumb-list">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{url('/admin')}}" title="{{ __('Dashboard') }}">{{ __('Dashboard') }}</a></li>
              <li class="breadcrumb-item active" aria-current="page">{{ __('View Track') }}</li>
            </ol>
        </div> 
    </div>
@endsection
@section('maincontent')
<div class="contentbar">
    <div class="col-md-12 col-lg-12 col-xl-12">
        <div class="card m-b-30">
            <div class="card-body">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    @if(Auth::user()->is_admin ==1)
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-movie" role="tab" aria-controls="pills-movie" aria-selected="true" title="{{ __('Movies') }}">{{__('Movies')}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-tv" role="tab" aria-controls="pills-tv" aria-selected="false" title="{{ __('TV Series') }}">{{__('TV Series')}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-home-tab" data-toggle="pill" href="#pills-weeklym" role="tab" aria-controls="pills-weeklym" aria-selected="false" title="{{ __('Weekly Top 10 Movies') }}">{{__('Weekly Top 10 Movies')}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-weeklys" role="tab" aria-controls="pills-weeklys" aria-selected="false" title="{{ __('Weekly Top 10 TV Series') }}">{{__('Weekly Top 10 TV Series')}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-home-tab" data-toggle="pill" href="#pills-monthlym" role="tab" aria-controls="pills-monthlym" aria-selected="false" title="{{ __('Monthly Top 10 Movies') }}">{{__('Monthly Top 10 Movies')}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-monthlys" role="tab" aria-controls="pills-monthlys" aria-selected="false" title="{{ __('Monthly Top 10 TV Series') }}">{{__('Monthly Top 10 TV Series')}}</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-movie" role="tab" aria-controls="pills-movie" aria-selected="true" title="{{ __('Movies') }}">{{__('Movies')}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-tv" role="tab" aria-controls="pills-tv" aria-selected="false" title="{{ __('TV Series') }}">{{__('TV Series')}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " id="pills-home-tab" data-toggle="pill" href="#pills-ltv" role="tab" aria-controls="pills-ltv" aria-selected="false" title="{{ __('Live TV') }}">{{__('Live TV')}}</a>
                        </li>
                    @endif

                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-movie" role="tabpanel" aria-labelledby="pills-home-tab">
                        <div class="table-responsive">
                            <table id="roletable" class="table table-borderd responsive " style="width: 100%">
                                <thead>
                                    <th>#</th>
                                    <th>{{__('Movie Name')}}</th>
                                    <th>{{__('Views')}}</th>
                                </thead>
                                <tbody>
                                    @foreach ($movies as $key => $movie)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $movie->title }}</td>
                                            <td> {{ views($movie)->unique()->count()}}</td>
                                        </tr>
                                     @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="pills-tv" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <div class="tab-pane fade show active" id="pills-tv" role="tabpanel" aria-labelledby="pills-home-tab">
                            <div class="table-responsive">
                                <table id="roletable" class="table table-borderd responsive " style="width: 100%">
                                    <thead>
                                        <th>#</th>
                                        <th>{{__('TV Series Name')}}</th>
                                        <th>{{__('Views')}}</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($season as $key => $s)
                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td>{{ $s->tvseries['title'] }} [Season: {{ $s->season_no }}]</td>
                                                <td> {{ views($s)->unique()->count() }}</td>
                                            </tr>
                                         @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="pills-weeklym" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <div class="tab-pane fade show active" id="pills-weeklym" role="tabpanel" aria-labelledby="pills-home-tab">
                            <div class="table-responsive">
                                <table id="roletable" class="table table-borderd responsive " style="width: 100%">
                                    <thead>
                                        <th>#</th>
                                        <th>{{__('TV Series Name')}}</th>
                                        <th>{{__('Views')}}</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($movieslw as $key => $mw)
                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td>{{ $mw->title }}</td>
                                                <td> {{ views($mw)->unique()->count()}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="pills-weeklys" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <div class="tab-pane fade show active" id="pills-weeklys" role="tabpanel" aria-labelledby="pills-home-tab">
                            <div class="table-responsive">
                                <table id="roletable" class="table table-borderd responsive " style="width: 100%">
                                    <thead>
                                        <th>#</th>
                                        <th>{{__('TV Series Name')}}</th>
                                        <th>{{__('Views')}}</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($seasonlw as $key => $sw)
                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td>{{ $sw->tvseries['title'] }} [Season: {{ $sw->season_no }}]</td>
                                                <td> {{ views($sw)->unique()->count() }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="pills-monthlym" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <div class="tab-pane fade show active" id="pills-monthlym" role="tabpanel" aria-labelledby="pills-home-tab">
                            <div class="table-responsive">
                                <table id="roletable" class="table table-borderd responsive " style="width: 100%">
                                    <thead>
                                        <th>#</th>
                                        <th>{{__('TV Series Name')}}</th>
                                        <th>{{__('Views')}}</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($movieslm as $key => $mm)
                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td>{{ $mm->title }}</td>
                                                <td> {{ views($mm)->unique()->count()}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="pills-monthlys" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <div class="tab-pane fade show active" id="pills-monthlys" role="tabpanel" aria-labelledby="pills-home-tab">
                            <div class="table-responsive">
                                <table id="roletable" class="table table-borderd responsive " style="width: 100%">
                                    <thead>
                                        <th>#</th>
                                        <th>{{__('TV Series Name')}}</th>
                                        <th>{{__('Views')}}</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($seasonlm as $key => $sm)
                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td>{{ $sm->tvseries['title'] }} [Season: {{ $sm->season_no }}]</td>
                                                <td> {{ views($sm)->unique()->count() }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="pills-ltv" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <div class="tab-pane fade show active" id="pills-ltv" role="tabpanel" aria-labelledby="pills-home-tab">
                            <div class="table-responsive">
                                <table id="roletable" class="table table-borderd responsive " style="width: 100%">
                                    <thead>
                                        <th>#</th>
                                        <th>{{__('Live TV Name')}}</th>
                                        <th>{{__('Views')}}</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($livetv as $key => $lt)
                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td>{{ $lt->title }}</td>
                                                <td> {{ views($lt)->unique()->count()}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection 
@section('script')
    
@endsection