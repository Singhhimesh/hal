@extends('layouts.master')
@section('title',__('Fake View'))
@section('breadcum')
	<div class="breadcrumbbar">
        <h4 class="page-title">{{ __('Fake Views') }}</h4>
        <div class="breadcrumb-list">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{url('/admin')}}" title="{{ __('Dashboard') }}">{{ __('Dashboard') }}</a></li>
              <li class="breadcrumb-item active" aria-current="page">{{ __('Fake Views') }}</li>
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
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-movie" role="tab" aria-controls="pills-home" aria-selected="true" title="{{ __('Movies') }}">{{__('Movies')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-tv" role="tab" aria-controls="pills-profile" aria-selected="false" title="{{ __('TV Series') }}">{{__('TV Series')}}</a>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-movie" role="tabpanel" aria-labelledby="pills-home-tab">
                        <div class="table-responsive">
                            <table id="roletable" class="table table-borderd responsive " style="width: 100%">
                                <thead>
                                    <th>#</th>
                                    <th>{{__('Movie Name')}}</th>
                                    <th>{{__('Views')}}</th>
                                    <th>{{__('Fake Views')}}</th>
                                    <th>{{__('Total Views')}}</th>
                                    <th>{{__('Add Fake Views')}}</th>
                                </thead>
                                <tbody>
                                    @foreach ($movies as $key => $movie)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $movie->title }}</td>
                                            <td> {{ views($movie)->unique()->count()}}</td>
                                            <td> {{ $movie->views }}</td>   
                                            <td> {{ views($movie)->unique()->count() + $movie->views }}</td>
                                            <td>
                                                <a href="{{url('/admin/fakeViews/'.$movie->id.'/edit')}}" class="btn btn-round btn-outline-primary" title="{{ __('Edit') }}"> <i class="fa fa-edit"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-tv" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <div class="tab-pane fade show active" id="pills-movie" role="tabpanel" aria-labelledby="pills-home-tab">
                            <div class="table-responsive">
                                <table id="roletable" class="table table-borderd responsive " style="width: 100%">
                                    <thead>
                                        <th>#</th>
                                        <th>{{__('TV Series Name')}}</th>
                                        <th>{{__('Views')}}</th>
                                        <th>{{__('Fake Views')}}</th>
                                        <th>{{__('Total Views')}}</th>
                                        <th>{{__('Add Fake Views')}}</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($season as $key => $s)
                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td>{{ $s->tvseries['title'] }} [Season: {{ $s->season_no }}]</td>
                                                <td> {{ views($s)->unique()->count() }}</td>
                                                <td>{{$s->views}}
                                                <td> {{ views($s)->unique()->count() + $s->views }}</td>
                                                <td>
                                                    <a href="{{url('/admin/fakeSeasonViews/'.$s->id.'/edit')}}" class="btn btn-round btn-outline-primary" title="{{ __('Edit') }}"> <i class="fa fa-edit"></i></a>
                                                </td>
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