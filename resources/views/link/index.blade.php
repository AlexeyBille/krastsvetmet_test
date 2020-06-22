@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Ствтистика</div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Ссылка</th>
                                <th scope="col">Короткая ссылка</th>
                                <th scope="col">Уникальных визитов за последнии 14 дней</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($links as $link)
                                <tr>
                                    <th>{{$link->id}}</th>
                                    <td><a href="{{route('show_link', ['link' => $link])}}">{{$link->url}}</a></td>
                                    <td><a href="{{route('show_link', ['link' => $link])}}">{{url($link->short_uri)}}</a></td>
                                    <td>{{$link->unique_users_last_14_days}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
