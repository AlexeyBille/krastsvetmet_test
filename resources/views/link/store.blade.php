@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Ссылка укорочена</div>

                    <div class="card-body">
                        Короткая ссылка - <a href="{{url($link->short_uri)}}">{{url($link->short_uri)}}</a> <br>
                        Статистика по ссылке -
                        <a href="{{route('show_link', ['link' => $link])}}">{{route('show_link', ['link' => $link])}}</a>
                        <br>
                        Статистика по всем ссылкам - <a href="{{route('index_link')}}">{{route('index_link')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
