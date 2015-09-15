@extends('index')

@section('content')

<div class="breadcrumbs">
    <h1>Detalhes da agenda</h1>
    {{--<ol class="breadcrumb">--}}
        {{--<li><a href="#">Home</a></li>--}}
        {{--<li><a href="#">Application</a></li>--}}
        {{--<li class="active">Dashboard</li>--}}
    {{--</ol>--}}
</div>

<div class="row">
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat blue-madison">
            <div class="visual">
                <i class="fa fa-comments"></i>
            </div>
            <div class="details">
                <div class="number">
                     {{ count($alunosConsolidados) }}
                </div>
                <div class="desc">
                     Alunos consolidados
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat red-intense">
            <div class="visual">
                <i class="fa fa-bar-chart-o"></i>
            </div>
            <div class="details">
                <div class="number">
                     12,5M$
                </div>
                <div class="desc">
                     Total Profit
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat green-haze">
            <div class="visual">
                <i class="fa fa-shopping-cart"></i>
            </div>
            <div class="details">
                <div class="number">
                     549
                </div>
                <div class="desc">
                     New Orders
                </div>
            </div>
            <a class="more" href="javascript:;">
            View more <i class="m-icon-swapright m-icon-white"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat purple-plum">
            <div class="visual">
                <i class="fa fa-globe"></i>
            </div>
            <div class="details">
                <div class="number">
                     +89%
                </div>
                <div class="desc">
                     Brand Popularity
                </div>
            </div>
            <a class="more" href="javascript:;">
            View more <i class="m-icon-swapright m-icon-white"></i>
            </a>
        </div>
    </div>
</div>

<div class="clearfix"></div>

<div class="row">

    <div class="col-md-6">
        <!-- BEGIN SAMPLE TABLE PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-user font-blue"></i>
                    <span class="caption-subject font-blue bold uppercase">ALUNOS DA AGENDA</span>
                </div>
            </div>
            <div class="portlet-body">
                <div class="task-content">
                    <div class="scroller" style="height: 310px;" data-always-visible="1" data-rail-visible="0">
                        <table class="table table-hover table-light">
                            <thead>
                                <tr class="uppercase">
                                    <th>COD</th>
                                    <th>ALUNO</th>
                                    <th>PRÉ</th>
                                    <th>PÓS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($alunos as $aluno)
                                <tr>
                                    <td>{{ $aluno->id_pessoa }}</td>
                                    <td>{{ $aluno->nome_aluno }}</td>
                                    <td>
                                        @if($aluno->pre_agendamento == 'realizado')
                                            <span class="label label-sm label-success">Realizado</span>
                                        @elseif($aluno->pre_agendamento == 'sem_agendamento_pre')
                                            <span class="label label-sm label-warning">Sem pré</span>
                                        @else
                                            <span class="label label-sm label-default">Pendente</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($aluno->pos_agendamento == 'realizado')
                                            <span class="label label-sm label-success">Realizado</span>
                                        @elseif($aluno->pos_agendamento == 'sem_agendamento_pos')
                                            <span class="label label-sm label-warning">Sem pós</span>
                                        @else
                                            <span class="label label-sm label-default">Pendente</span>
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
        <!-- END SAMPLE TABLE PORTLET-->
    </div>

    <div class="col-md-6">
        <!-- BEGIN PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption caption-md font-blue">
                    <i class="icon-share font-blue"></i>
                    <span class="caption-subject theme-font bold uppercase">ATIVIDADES RECENTES</span>
                </div>
            </div>
            <div class="portlet-body">
                <div class="scroller" style="height: 310px;" data-always-visible="1" data-rail-visible="0">
                    <ul class="feeds">

                    @foreach($ultimosScriptsRespondidos as $ultimoRespondido)
                        <li>
                            <div class="col1">
                                <div class="cont">
                                    <div class="cont-col1">
                                        <div class="label label-sm label-info">
                                            <i class="fa fa-user"></i>
                                        </div>
                                    </div>
                                    <div class="cont-col2">
                                        <div class="desc">
                                            {{ $ultimoRespondido->razao_social_nome }}
                                            <span class="label label-sm label-success">
                                                {{ $ultimoRespondido->nome_agendamento }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col2">
                                <div class="date">
                                     {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $ultimoRespondido->data_respondido)->diffForHumans() }}
                                </div>
                            </div>
                        </li>
                        @endforeach

                    </ul>
                </div>
            </div>
        </div>
        <!-- END PORTLET-->
    </div>

</div>

<div class="row">

    <div class="col-md-6">
        <!-- BEGIN SAMPLE TABLE PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cogs font-green-sharp"></i>
                    <span class="caption-subject font-green-sharp bold uppercase">GRÁFICO PROGRESSÃO DE RESPONDIDOS PROJETO CERTIFICAÇÃO</span>
                </div>
            </div>
            <div class="portlet-body">
                <div id="chart_6" style="height: 280px;" data-always-visible="1" data-rail-visible="0"></div>
            </div>
        </div>
        <!-- END SAMPLE TABLE PORTLET-->
    </div>

</div>

<?php $graficos = [] ?>

<div class="row">
    <div class="col-md-12">
        <div class="tabbable-line nav-justified">
            <ul class="nav nav-tabs">
                @foreach($gruposPerguntasPre as $grupo)
                <li @if($grupo->ordem == 1) class="active" @endif>
                    <a href="#tab_{{ $grupo->grupo_numreg }}" data-toggle="tab">{{ $grupo->nome_grupo }}</a>
                </li>
                @endforeach
            </ul>

                <div class="tab-content">
                    @foreach($gruposPerguntasPre as $grupo)
                        <div @if($grupo->ordem == 1) class="tab-pane active" @else class="tab-pane" @endif id="tab_{{ $grupo->grupo_numreg }}">
                            <div class="scroller" style="height: 500px;" data-always-visible="1" data-rail-visible="0">
                                <blockquote>
                                    <p>{{ $grupo->descricao }}</p>
                                </blockquote>

                                @foreach(\App\Http\Repository\QuestionarioCertificacao::getPerguntasByScriptAndGrupo($scriptsPre, $grupo->grupo_numreg) as $pergunta)
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="portlet">
                                                <div class="portlet-title">
                                                    <div class="">
                                                        <i class="fa fa-check-square-o"></i>{{ $pergunta->pergunta }} | {{ $pergunta->tipo_pergunta }} - {{ $pergunta->numreg_tipo_pergunta }}
                                                    </div>
                                                </div>
                                                <div class="portlet-body">
                                                    <div class="table-scrollable">
                                                        <table class="table table-hover table-light">
                                                            <thead>
                                                                <tr>
                                                                    <th>Resposta</th>
                                                                    <th>Total</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            @if(empty($alunosConsolidados))
                                                                <tr>
                                                                    <td colspan="2">Não tem alunos consolidados para tirar relatorio.</td>
                                                                </tr>
                                                            @else
                                                                @foreach($respostas = \App\Http\Repository\QuestionarioCertificacao::getRespondidosByPessoasAndScriptsAndPergunta($alunosConsolidados, $scriptsPre, $pergunta->numreg_pergunta, $pergunta->numreg_tipo_pergunta) as $resposta)
                                                                    @if($pergunta->numreg_tipo_pergunta == 1)
                                                                        <tr>
                                                                            <td colspan="2">{{ $resposta->aluno }} respondeu: "{{ $resposta->resposta }}"</td>
                                                                        </tr>
                                                                    @else
                                                                        <tr>
                                                                            <td>{{ $resposta->resposta }}</td>
                                                                            <td>{{ $resposta->total }}</td>
                                                                        </tr>
                                                                    @endif
                                                                @endforeach
                                                                @if($pergunta->numreg_tipo_pergunta == 11 || $pergunta->numreg_tipo_pergunta == 8 || $pergunta->numreg_tipo_pergunta == 7)
                                                                    <tr>
                                                                        <td colspan="2">A média e: {{ round(\App\Http\Repository\QuestionarioCertificacao::getRespondidosByPessoasAndScriptsAndPergunta($alunosConsolidados, $scriptsPre, $pergunta->numreg_pergunta, $pergunta->numreg_tipo_pergunta, true)[0]->media_total, 2)  }}.</td>
                                                                    </tr>
                                                                @endif
                                                            @endif
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="portlet">
                                                <div class="portlet-title">
                                                    <div class="">
                                                        <i class="fa fa-bar-chart-o"></i>Grafico
                                                    </div>
                                                </div>
                                                <div class="portlet-body" id="chart_questao_{{$pergunta->numreg_pergunta}}" style="height: 360px;">
                                                    @if(empty($alunosConsolidados))
                                                        - - -
                                                    @else
                                                        <?php $graficos[$pergunta->numreg_pergunta] = json_encode($respostas) ?>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-12">
        <div class="tabbable-custom nav-justified">
            <ul class="nav nav-tabs nav-justified">
                @foreach($gruposPerguntasPos as $grupo)
                <li @if($grupo->ordem == 1) class="active" @endif>
                    <a href="#tab_{{ $grupo->grupo_numreg }}" data-toggle="tab">{{ $grupo->nome_grupo }}</a>
                </li>
                @endforeach
            </ul>

                <div class="tab-content">
                    @foreach($gruposPerguntasPos as $grupo)
                        <div @if($grupo->ordem == 1) class="tab-pane active" @else class="tab-pane" @endif id="tab_{{ $grupo->grupo_numreg }}">
                            <div class="scroller" style="height: 500px;" data-always-visible="1" data-rail-visible="0">
                                <blockquote>
                                    <p>{{ $grupo->descricao }}</p>
                                </blockquote>

                                @foreach(\App\Http\Repository\QuestionarioCertificacao::getPerguntasByScriptAndGrupo($scriptsPos, $grupo->grupo_numreg) as $pergunta)
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="portlet">
                                                <div class="portlet-title">
                                                    <div class="">
                                                        <i class="fa fa-check-square-o"></i>{{ $pergunta->pergunta }} {{ $pergunta->numreg_pergunta }} | {{ $pergunta->tipo_pergunta }} - {{ $pergunta->numreg_tipo_pergunta }}
                                                    </div>
                                                </div>
                                                <div class="portlet-body">
                                                    <div class="table-scrollable">
                                                        <table class="table table-hover table-light">
                                                            <thead>
                                                                <tr>
                                                                    <th>Resposta</th>
                                                                    <th>Total</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            @if(empty($alunosConsolidados))
                                                                <tr>
                                                                    <td colspan="2">Não tem alunos consolidados para tirar relatorio.</td>
                                                                </tr>
                                                            @else
                                                                @foreach($respostas = \App\Http\Repository\QuestionarioCertificacao::getRespondidosByPessoasAndScriptsAndPergunta($alunosConsolidados, $scriptsPos, $pergunta->numreg_pergunta, $pergunta->numreg_tipo_pergunta) as $resposta)
                                                                    @if($pergunta->numreg_tipo_pergunta == 1)
                                                                        <tr>
                                                                            <td colspan="2">{{ $resposta->aluno }} respondeu: "{{ $resposta->resposta }}"</td>
                                                                        </tr>
                                                                    @else
                                                                        <tr>
                                                                            <td>{{ $resposta->resposta }}</td>
                                                                            <td>{{ $resposta->total }}</td>
                                                                        </tr>
                                                                    @endif
                                                                @endforeach
                                                                @if($pergunta->numreg_tipo_pergunta == 11 || $pergunta->numreg_tipo_pergunta == 8 || $pergunta->numreg_tipo_pergunta == 7)
                                                                    <tr>
                                                                        <td>A média e: {{ round(\App\Http\Repository\QuestionarioCertificacao::getRespondidosByPessoasAndScriptsAndPergunta($alunosConsolidados, $scriptsPos, $pergunta->numreg_pergunta, $pergunta->numreg_tipo_pergunta, true)[0]->media_total, 2)  }}.</td>
                                                                        <td>
                                                                            <div id="slider-range-min" class="slider bg-yellow ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all">
                                                                                <div class="ui-slider-range ui-widget-header ui-corner-all ui-slider-range-min" style="width: 21.7454%;"></div>
                                                                                <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0" style="left: 21.7454%;"></span>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                @endif
                                                            @endif
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="portlet">
                                                <div class="portlet-title">
                                                    <div class="">
                                                        <i class="fa fa-bar-chart-o"></i>Grafico
                                                    </div>
                                                </div>
                                                <div class="portlet-body" id="chart_questao_{{$pergunta->numreg_pergunta}}" style="height: 360px;">
                                                    @if(empty($alunosConsolidados))
                                                        - - -
                                                    @else
                                                        <?php $graficos[$pergunta->numreg_pergunta] = json_encode($respostas) ?>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
        </div>
    </div>
</div>

@stop

@section('jquery')

    @foreach($graficos as $id_chart => $values)
        AmCharts.makeChart("chart_questao_{{$id_chart}}", {
            "type": "pie",
            "theme": "light",

            "fontFamily": 'Open Sans',

            "color":    '#888',

            "dataProvider": {!! $values !!},
            "valueField": "total",
            "titleField": "resposta",
            "export": {
                "enabled": true,
                "libs": {
                    "path": "http://amcharts.com/lib/3/plugins/export/libs/"
                }
            },
            "responsive": {
                "enabled": true
            }
        });
    @endforeach



var chart = AmCharts.makeChart("chart_6", {
    "type": "serial",
    "addClassNames": true,
    "classNamePrefix": "amcharts",
    "theme": "light",
    "marginRight": 80,
    "autoMarginOffset": 20,
    "dataDateFormat": "YYYY-MM-DD",
    "valueAxes": [{
        "maximum": {{ $totalScriptsAgendamento }},
        "minimum": 0,
        "id": "v1",
        "axisAlpha": 0,
        "position": "left"
    }],
    "balloon": {
        "borderThickness": 1,
        "shadowAlpha": 0
    },
    "graphs": [{
        "id": "graph2",
        "balloonText": "<span style='font-size:12px;'>[[title]] in [[category]]:<br><span style='font-size:20px;'>[[value]]</span> [[additional]]</span>",
        "bullet": "round",
        "bulletSize": 5,
        "bulletBorderAlpha": 1,
        "bulletColor": "#FFFFFF",
        "useLineColorForBulletBorder": true,
        "bulletBorderThickness": 2,
        "hideBulletsCount": 200,
        "lineThickness": 2,
        "title": "Expenses",
        "valueField": "value"
    }],

    "chartCursor": {
        "pan": true,
        "valueLineEnabled": true,
        "valueLineBalloonEnabled": true,
        "cursorAlpha":0,
        "valueLineAlpha":0.2
    },
    "categoryField": "date",
    "categoryAxis": {
        "parseDates": true,
        "dashLength": 1,
        "minorGridEnabled": false
    },
    "export": {
        "enabled": true,
        "libs": {
            "path": "http://amcharts.com/lib/3/plugins/export/libs/"
        }
    },
    "dataProvider": {!! $dadosGrafico !!},
    "responsive": {
        "enabled": true
    },

    "trendLines": [{
        "finalDate": "{{ $dataProgressaoFinal }}",
        "finalValue": {{ $totalScriptsAgendamento }},
        "initialDate": "{{ $dataProgressaoInicial }}",
        "initialValue": 0,
        "lineColor": "#CC0000",
        "bullet": "round",
        "lineThickness": 2,
        "bulletSize": 2,
        "lineAlpha": 1
    }]
});




@stop