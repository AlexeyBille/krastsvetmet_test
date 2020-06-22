@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Статистика - {{url($link->short_uri)}} ({{$link->url}})</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">IP</th>
                                <th scope="col">Date</th>
                                @if($link->is_commercial)
                                    <th scope="col">Показываемая картинка</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($link->statistic as $statisticItem)
                                <tr>
                                    <th>{{$statisticItem->id}}</th>
                                    <td>{{$statisticItem->visitor_ip}}</td>
                                    <td>{{$statisticItem->visit_at}}</td>
                                    @if($link->is_commercial)
                                        <td><a href="{{Storage::url($statisticItem->commercial_image)}}"
                                               target="_blank">{{$statisticItem->commercial_image}}</a></td>
                                    @endif
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
