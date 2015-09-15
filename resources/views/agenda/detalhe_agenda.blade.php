@extends('index')

@section('content')

<div class="breadcrumbs">
    <h1>Dashboard das turmas de {{ $tituloDashboard }}</h1>
    {{--<ol class="breadcrumb">--}}
        {{--<li><a href="#">Home</a></li>--}}
        {{--<li><a href="#">Application</a></li>--}}
        {{--<li class="active">Dashboard</li>--}}
    {{--</ol>--}}
</div>

<!-- BEGIN DASHBOARD STATS -->
{{--<div class="row">--}}

    {{--<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">--}}
        {{--<div class="dashboard-stat blue-madison">--}}
            {{--<div class="visual">--}}
                {{--<i class="fa fa-comments"></i>--}}
            {{--</div>--}}
            {{--<div class="details">--}}
                {{--<div class="number">--}}
                     {{--1349--}}
                {{--</div>--}}
                {{--<div class="desc">--}}
                     {{--Alunos totais--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<a class="more" href="javascript:;">--}}
            {{--Ver mais <i class="m-icon-swapright m-icon-white"></i>--}}
            {{--</a>--}}
        {{--</div>--}}
    {{--</div>--}}
    {{--<div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">--}}
            {{--<div class="dashboard-stat blue-madison">--}}
                {{--<div class="visual">--}}
                    {{--<i class="fa fa-comments"></i>--}}
                {{--</div>--}}
                {{--<div class="details">--}}
                    {{--<div class="number">--}}
                         {{--1349--}}
                    {{--</div>--}}
                    {{--<div class="desc">--}}
                         {{--Alunos consolidados--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<a class="more" href="javascript:;">--}}
                {{--Ver mais <i class="m-icon-swapright m-icon-white"></i>--}}
                {{--</a>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--<div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">--}}
        {{--<div class="dashboard-stat red-intense">--}}
            {{--<div class="visual">--}}
                {{--<i class="fa fa-bar-chart-o"></i>--}}
            {{--</div>--}}
            {{--<div class="details">--}}
                {{--<div class="number">--}}
                     {{--345--}}
                {{--</div>--}}
                {{--<div class="desc">--}}
                     {{--Não respondeu pré nem pós--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<a class="more" href="javascript:;">--}}
            {{--Ver mais <i class="m-icon-swapright m-icon-white"></i>--}}
            {{--</a>--}}
        {{--</div>--}}
    {{--</div>--}}
    {{--<div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">--}}
        {{--<div class="dashboard-stat green-haze">--}}
            {{--<div class="visual">--}}
                {{--<i class="fa fa-shopping-cart"></i>--}}
            {{--</div>--}}
            {{--<div class="details">--}}
                {{--<div class="number">--}}
                     {{--549--}}
                {{--</div>--}}
                {{--<div class="desc">--}}
                     {{--Respondeu somente pré--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<a class="more" href="javascript:;">--}}
            {{--Ver mais <i class="m-icon-swapright m-icon-white"></i>--}}
            {{--</a>--}}
        {{--</div>--}}
    {{--</div>--}}
    {{--<div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">--}}
        {{--<div class="dashboard-stat purple-plum">--}}
            {{--<div class="visual">--}}
                {{--<i class="fa fa-globe"></i>--}}
            {{--</div>--}}
            {{--<div class="details">--}}
                {{--<div class="number">--}}
                     {{--124--}}
                {{--</div>--}}
                {{--<div class="desc">--}}
                     {{--Respondeu somente pós--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<a class="more" href="javascript:;">--}}
            {{--Ver mais <i class="m-icon-swapright m-icon-white"></i>--}}
            {{--</a>--}}
        {{--</div>--}}
    {{--</div>--}}
    {{--<div class="col-lg-1 col-md-1 col-sm-6 col-xs-12">--}}
        {{--<div class="dashboard-stat purple-plum">--}}
            {{--<div class="visual">--}}
                {{--<i class="fa fa-globe"></i>--}}
            {{--</div>--}}
            {{--<div class="details">--}}
                {{--<div id="chartdiv"></div>--}}
            {{--</div>--}}
            {{--<a class="more" href="javascript:;">--}}
            {{--Ver mais <i class="m-icon-swapright m-icon-white"></i>--}}
            {{--</a>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}



<div class="row">

    <div class="col-md-6">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption caption-md font-blue">
                    <i class="icon-calendar font-blue"></i>
                    <span class="caption-subject theme-font bold uppercase">{{ $nomeAgenda }} MODULAR</span>
                    <span class="caption-helper">{{ $totalAgendasNormais }} Agendas</span>
                </div>
            </div>
            <div class="portlet-body">
                <div class="task-content">
                    <div class="scroller" style="height: 450px;">
                        <table class="table table-hover table-light">
                            <thead>
                                <tr class="uppercase">
                                    <th>AGENDA</th>
                                    <th>INSCRITOS</th>
                                    <th>RESP. PRÉ</th>
                                    <th>RESP. PÓS</th>
                                    <th>INSTRUTOR</th>
                                    <th>LOCAL</th>
                                    <th>STATUS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($agendasNormais as $agendaNormal)
                                <tr>
                                    <td><a href="{{ action('AgendaController@agenda', $agendaNormal->numreg_agenda) }}"/>{{ $agendaNormal->numreg_agenda }}</a></td>
                                    <td>{{ $agendaNormal->total_inscritos }}</td>
                                    <td>{{ $agendaNormal->responderam_pre }}</td>
                                    <td>{{ $agendaNormal->responderam_pos }}</td>
                                    <td>{{ $agendaNormal->instrutor }}</td>
                                    <td>{{ $agendaNormal->nome_local_curso }}</td>
                                    <td>
                                        @if($agendaNormal->status_curso == 'encerrado')
                                            <span class="label label-sm label-success">Encerrada</span>
                                        @elseif($agendaNormal->status_curso == 'andamento')
                                            <span class="label label-sm label-warning">Andamento</span>
                                        @else
                                            <span class="label label-sm label-default">Aberta</span>
                                        @endif
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

    <div class="col-md-6">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption caption-md font-blue">
                    <i class="icon-calendar font-blue"></i>
                    <span class="caption-subject theme-font bold uppercase">{{ $nomeAgenda }} INTENSIVO</span>
                    <span class="caption-helper">{{ $totalAgendasIntensivas }} Agendas</span>
                </div>
            </div>
            <div class="portlet-body">
                <div class="task-content">
                    <div class="scroller" style="height: 450px;">
                        <table class="table table-hover table-light">
                            <thead>
                                <tr class="uppercase">
                                    <th>AGENDA</th>
                                    <th>INSCRITOS</th>
                                    <th>RESP. PRÉ</th>
                                    <th>RESP. PÓS</th>
                                    <th>INSTRUTOR</th>
                                    <th>LOCAL</th>
                                    <th>STATUS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($agendasIntensivas as $agendaIntensiva)
                                <tr>
                                    <td><a href="{{ action('AgendaController@agenda', $agendaIntensiva->numreg_agenda) }}"/>{{ $agendaIntensiva->numreg_agenda }}</a></td>
                                    <td>{{ $agendaIntensiva->total_inscritos }}</td>
                                    <td>{{ $agendaIntensiva->responderam_pre }}</td>
                                    <td>{{ $agendaIntensiva->responderam_pos }}</td>
                                    <td>{{ $agendaIntensiva->instrutor }}</td>
                                    <td>{{ $agendaIntensiva->nome_local_curso }}</td>
                                    <td>
                                        @if($agendaIntensiva->status_curso == 'encerrado')
                                            <span class="label label-sm label-success">Encerrada</span>
                                        @elseif($agendaIntensiva->status_curso == 'andamento')
                                            <span class="label label-sm label-warning">Andamento</span>
                                        @else
                                            <span class="label label-sm label-default">Aberta</span>
                                        @endif
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

@stop