@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Переход... <span id="timer">5</span></div>

                    <div class="card-body">
                        <img src="{{Storage::url($linkStatistic->commercial_image)}}" alt="">
                        <div id="visit_url" data-url="{{$link->url}}" class="d-none"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
